<?php
namespace AzaelCodes\Utils;

interface DeviceInterface {

    /**
     * Get a device type which will be taken from the User Agent
     * @param null $userAgent
     * @return mixed
     */
    public static function getDeviceType($userAgent = null);

}