<?php

namespace TPLink;

use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;
use TPLink\model\EncryptAes;

class Encryption
{
    public function encryptRSA($plainText,$rsaMOD,$pubKEY){
        $rsa  = new RSA();
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
        $publicKey = [
            'e' => new BigInteger($pubKEY,16),
            'n' => new BigInteger($rsaMOD,16)
        ];
        $rsa->loadKey($publicKey);
        $ciphertext = $rsa->encrypt($plainText);
        return bin2hex($ciphertext);
    }

    public function encryptAES($data){
        $cipher = "aes-128-cbc";
        $key  = substr((int)(microtime(true)*1000) . "" . 1e9 * (float)rand()/(float)getrandmax(),0,16);
        $iv   = substr((int)(microtime(true)*1000) . "" . 1e9 * (float)rand()/(float)getrandmax(),0,16);
        $data = openssl_encrypt($data,$cipher,$key,0,$iv);
        return new EncryptAes(['encrypted_data' => $data, 'key' => $key, 'iv' => $iv]);
    }

    public function decryptAES($data,$key,$iv){
        $cipher = "aes-128-cbc";
        return openssl_decrypt($data,$cipher,$key,0,$iv);
    }

}
