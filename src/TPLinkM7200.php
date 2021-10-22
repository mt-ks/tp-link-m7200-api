<?php
namespace TPLink;
use MClient\Request;
use TPLink\model\EncryptAes;
use TPLink\model\FetchAuthCgi;
use TPLink\model\LoginResponse;

class TPLinkM7200
{

    protected $gateway = "192.168.9.1";
    public ?FetchAuthCgi $authCgiInfo = null;
    protected EncryptAes $encryptAes;
    protected $password;
    public function __construct($password,$gateway = null){

        $this->gateway = $gateway ?? $this->gateway;
        $this->password = $password;
    }

    /**
     * @return \TPLink\model\FetchAuthCgi|null
     * @throws \JsonException
     */
    public function createLoginTokens(): ?FetchAuthCgi
    {
        $req = (new Request("http://" . $this->gateway . "/cgi-bin/auth_cgi"))
            ->addPost("data",base64_encode(json_encode(["module" => "authenticator","action" => 0], JSON_THROW_ON_ERROR)))
            ->setUserAgent('okhttp/3.11.0')
            ->addHeader('content-type','application/json')
            ->setJsonPost(true)
            ->execute()
            ->getResponse();

        $this->authCgiInfo = new FetchAuthCgi((json_decode(base64_decode($req), true, 512, JSON_THROW_ON_ERROR)));
        return $this->authCgiInfo;
    }

    /**
     * @return \TPLink\model\LoginResponse
     * @throws \JsonException
     */
    public function authentication(): LoginResponse
    {
        $this->createLoginTokens();
        $encryption = new Encryption();
        $buildDigest = md5($this->password.':'.$this->authCgiInfo->getNonce());
        $data = $encryption->encryptAES(json_encode(['module' => 'authenticator', 'action' => 1, 'digest' => $buildDigest], JSON_THROW_ON_ERROR));
        $this->encryptAes = $data;
        $rsaData = [
            'key' => $data->getKey(),
            'iv' => $data->getIv(),
            'h' => md5('admin'.$this->password),
            's' => (int)$this->authCgiInfo->getSeqnum() + (int)strlen($data->getEncryptedData()),
        ];
        $sign = $encryption->encryptRSA(http_build_query($rsaData),$this->authCgiInfo->getRsamod(),$this->authCgiInfo->getRsapubkey());

        $response = $this->request("/cgi-bin/auth_cgi")
            ->addPost('data',$data->getEncryptedData())
            ->addPost('sign',$sign)
            ->setJsonPost(true)
            ->execute()
            ->getResponse();

        return new LoginResponse(json_decode($encryption->decryptAES($response, $data->getKey(), $data->getIv()), true, 512, JSON_THROW_ON_ERROR));
    }

    public function rebootDevice($token){
        $data = json_encode([
            'token' => $token,
            'module' => 'reboot',
            'action' => 0
        ], JSON_THROW_ON_ERROR);
        $encrypt = openssl_encrypt($data,"aes-128-cbc",$this->encryptAes->getKey(),0,$this->encryptAes->getIv());
        $rsaData = [
            'h' => md5('admin'.$this->password),
            's' => (int)$this->authCgiInfo->getSeqnum() + (int)strlen($encrypt)
        ];
        $sign = (new Encryption())->encryptRSA(http_build_query($rsaData),$this->authCgiInfo->getRsamod(),$this->authCgiInfo->getRsapubkey());
        $response = $this->request("/cgi-bin/web_cgi")
            ->addPost('data',$encrypt)
            ->addPost('sign',$sign)
            ->setJsonPost(true)
            ->execute()
            ->getResponse();
        print_r((new Encryption())->decryptAES($response,$this->encryptAes->getKey(),$this->encryptAes->getIv()));
    }

    public function request($endpoint){
        return new Client("http://" . $this->gateway.$endpoint,$this);
    }

}
