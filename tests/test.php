<?php
require 'vendor/autoload.php';

$browser = new \AzaelCodes\Utils\Browser();
$browser->detect();
$browser->getBrowser();
$browser->debug();