<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$configFile = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
$modemPassword = "MODEM_PASSWORD";
$modemIP = null;

if (file_exists($configFile)) {
    require_once($configFile);
}

$tp = new \TPLink\TPLinkM7200($modemPassword, $modemIP);
try {
    $l = $tp->authentication();
    $tp->rebootDevice($l->getToken());

} catch (JsonException $e) {
    print "Error:\n";
    print $e->getMessage()."\n\n";
}


