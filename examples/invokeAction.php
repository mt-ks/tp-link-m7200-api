<?php

$opt = getOpt('m:a:h');

function printHelp() {
    print "Usage:\n";
    print " * -m <MODULE>: Specify module\n";
    print " * -a <ACTION>: Specify action\n";
    print " * -h: print this help\n";
    print "\n\n";
    die();
}

if (
    array_key_exists('h', $opt)
    || !array_key_exists('m', $opt)
    || !array_key_exists('a', $opt)
) {
    printHelp();
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$configFile = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
$modemPassword = "MODEM_PASSWORD";
$modemIP = null;

if (file_exists($configFile)) {
    require_once($configFile);
}

$tp = new \TPLink\TPLinkM7200($modemPassword, $modemIP);
try {
    $l = $tp->authentication();
    print_r($tp->invokeAction($l->getToken(), $opt['m'], $opt['a']));
    print "\n\n";

} catch (JsonException $e) {
    print "Error:\n";
    print $e->getMessage() . "\n\n";
}


