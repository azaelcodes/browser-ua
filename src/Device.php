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
    const DEVICE_MACINTOSH = 'Macintosh';


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

        $deviceType = self::parseDeviceType($userAgent);
        return !is_null($deviceType) ? $deviceType : 'device_type_not_found';

    }

    /**
     * Parse the string that contains the device type
     *
     * Example:
     * User Agent : Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1
     *
     * Device Information: (iPad; CPU OS 9_1 like Mac OS X)
     *
     * @param $userAgent
     * @return Device type
     */
    private static function parseDeviceType($userAgent)
    {
        $firstPart = substr($userAgent, strpos($userAgent, '(') + 1);
        $deviceString = substr($firstPart, 0, strpos($firstPart, ')'));
        $pieces = explode(';', $deviceString);

        return (!is_null($pieces[1]) || !empty($pieces[1])) ? $pieces[1] : 'not_found';
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