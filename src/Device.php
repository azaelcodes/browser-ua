<?php
namespace AzaelCodes\Utils;
/**
 *
 * Class Device
 * @package AzaelCodes\Utils
 */
class Device implements DeviceInterface {

    private $userAgent;

    const DEVICE_IPHONE = 'iPhone';
    const DEVICE_ANDROID = 'Android';
    const DEVICE_IPAD = 'iPad';
    const DEVICE_ITOUCH = 'iTouch';
    const DEVICE_TABLET = 'Android Tablet';
    const DEVICE_MACINTOSH = 'Macintosh';
    const DEVICE_WINDOWS = 'Windows';
    const OS_IOS = 'iOS';
    const OS_LINUX = 'Linux';
    const DEVICE_LINUX_IDENTIFIER = 'X11';
    const DEVICE_MOBILE_IDENTIFIER = 'Mobile';


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
    public static function getOSType($userAgent = null)
    {
        $deviceType = null;

        if (is_null($userAgent)) {
            throw new \Exception('Invalid user agent information');
        }

        $deviceType = self::parseOSType($userAgent);
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
    private static function parseOSType($userAgent)
    {
        $firstPart = substr($userAgent, strpos($userAgent, '(') + 1);
        $deviceString = substr($firstPart, 0, strpos($firstPart, ')'));
        $pieces = explode(';', $deviceString);

        if (self::isAndroidDevice($pieces[1])) {
            $pieces[0] = self::DEVICE_ANDROID;
        } else if (self::isWindows($pieces[0])) {
            $pieces[0] = self::DEVICE_WINDOWS;
        } else if (self::isLinux($pieces[0])) {
            $pieces[0] = self::OS_LINUX;
        } else if (self::isIOSDevice($pieces[0])) {
            $pieces[0] = self::OS_IOS;
        }
        return (!is_null($pieces[0]) || !empty($pieces[0])) ? $pieces[0] : 'not_found';
    }

    /**
     * Check parts of the user agent string to see if the device is Android.
     *
     * Android devices return Linux as the main device so we need to do another search to see if
     * It's also an Android device.
     *
     * @param $userAgentPart
     * @return bool|int
     */
    private static function isAndroidDevice($userAgentPart)
    {
        return strpos($userAgentPart, self::DEVICE_ANDROID);
    }

    /**
     * @param $userAgentPart
     * @return bool
     */
    private static function isWindows($userAgentPart)
    {
        return in_array($userAgentPart, self::$windowsPlatformTokens);
    }

    /**
     * @param $userAgentPart
     * @return bool|int
     */
    private static function isLinux($userAgentPart)
    {
        return preg_match('/' . self::DEVICE_LINUX_IDENTIFIER . '/', $userAgentPart);
    }

    private static function isIOSDevice($userAgentPart)
    {
        return $userAgentPart == self::DEVICE_IPHONE
        || $userAgentPart == self::DEVICE_IPAD
        || $userAgentPart == self::DEVICE_ITOUCH;
    }



    public function getServerInfo()
    {
        return $_SERVER;
    }


    /**
     * TODO Add Logic
     * @return boolean
     */
    public function isMobile()
    {
       return preg_match('/' . self::DEVICE_MOBILE_IDENTIFIER . '/', $this->userAgent);
    }

    private static $windowsPlatformTokens = array(
        'Windows NT 10.0',
        'Windows NT 6.3',
        'Windows NT 6.2',
        'Windows NT 6.1',
        'Windows NT 6.0',
        'Windows NT 5.2',
        'Windows NT 5.1',
        'Windows NT 5.01',
        'Windows NT 4.0',
        'Windows 98',
        'Windows 95',
        'Windows CE',
    );

}