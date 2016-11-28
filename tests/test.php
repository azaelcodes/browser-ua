<?php

// Composer's autoloader
require '../vendor/autoload.php';

$browser = new \AzaelCodes\Utils\Browser();
$browser->detect();

foreach ($browser->debug() as $key => $value) {

    echo $key . ' : ' . $value . "<br>";

}