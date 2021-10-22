<?php
require "vendor/autoload.php";

$tp = new \TPLink\TPLinkM7200("MODEM_PASSWORD");
$l = $tp->authentication();
$tp->rebootDevice($l->getToken());
