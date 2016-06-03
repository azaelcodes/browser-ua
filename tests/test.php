<?php

// Composer's autoloader
require '../vendor/autoload.php';

$browser = new \AzaelCodes\Utils\Browser();
$browser->detect();
$browser->debug();