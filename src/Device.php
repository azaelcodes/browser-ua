<?php
class Device {

    public function __construct()
    {

    }

    public static function getDeviceType($userAgent = null)
    {
        if (is_null($userAgent)) {
            throw new \Exception('Invalid user agent information');
        }

    }

}