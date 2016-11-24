<?php
namespace AzaelCodes\Utils;
/**
 *
 * Class Device
 * @package AzaelCodes\Utils
 */
class Device implements DeviceInterface {

    private $iPhone;
    private $android;
    private $iPad;
    private $tablet;
    private $mobile;
    private $userAgent;

    const DEVICE_IPHONE = 'iPhone';
    const DEVICE_ANDROID = 'Android';
    const DEVICE_IPAD = 'iPad';
    const DEVICE_TABLET = 'Android Tablet';


    /**
     * Device constructor.
     */
    public function __construct()
    {
        if (!array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            throw new \Exception('Your browser is not compatible : maybe time to upgrade?');
        }
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Static function to get device type
     * @param null $userAgent
     * @return null|string
     * @throws \Exception
     */
    public static function getDeviceType($userAgent = null)
    {
        $deviceType = null;

        if (is_null($userAgent)) {
            throw new \Exception('Invalid user agent information');
        }

        if (stripos($userAgent, self::DEVICE_IPHONE)) {
            $deviceType = self::DEVICE_IPHONE;
        } else if (stripos($userAgent, self::DEVICE_ANDROID)) {
            $deviceType = self::DEVICE_ANDROID;
        } else if (stripos($userAgent, self::DEVICE_IPAD)) {
            $deviceType = self::DEVICE_IPAD;
        }

        return !is_null($deviceType) ? $deviceType : 'device_type_not_found';

    }

    public function getServerInfo()
    {
        return $_SERVER;
    }

    /**
     * @return boolean
     */
    public function isIPhone()
    {
        return $this->iPhone;
    }

    /**
     * @return boolean
     */
    public function isAndroid()
    {
        return $this->android;
    }

    /**
     * @return boolean
     */
    public function isTablet()
    {
        return $this->tablet;
    }

    /**
     * @return boolean
     */
    public function isIpad()
    {
        return $this->iPad;
    }

    /**
     * TODO Add Logic
     * @return boolean
     */
    public function isMobile()
    {
        return true;
    }

}