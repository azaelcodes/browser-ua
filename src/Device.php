<?php
namespace AzaelCodes\Utils;
/**
 *
 * Class Device
 * @package AzaelCodes\Utils
 */
class Device implements DeviceInterface {

    private $userAgent;

    const APPLE = 'Apple';
    const ANDROID = 'Android';
    const DEVICE_IDENTIFIER_IPHONE = 'iPhone';
    const DEVICE_IPHONE = 'Apple iPhone';
    const DEVICE_ANDROID = 'Android Device';
    const DEVICE_ANDROID_TABLET = 'Android Tablet';
    const DEVICE_IDENTIFIER_IPAD = 'iPad';
    const DEVICE_IPAD = 'Apple iPad';
    const DEVICE_IDENTIFIER_ITOUCH = 'iTouch';
    const DEVICE_ITOUCH = 'Apple iTouch';
    const DEVICE_TABLET = 'Android Tablet';
    const DEVICE_MACINTOSH = 'Mac';
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
    public static function getDeviceOS($userAgent = null)
    {
        $deviceType = null;

        if (is_null($userAgent)) {
            throw new \Exception('Invalid user agent information');
        }

        $deviceType = self::parseOSType($userAgent);
        return !is_null($deviceType) ? $deviceType : 'device_type_not_found';

    }

    /**
     * @see DeviceInterface
     * @param null $userAgent
     *
     * @return iPhone, Android Phone, etc.. or not_found
     */
    public static function getDeviceType($userAgent = null)
    {
        $deviceType = 'not_found';

        if (is_null($userAgent)) {
            return $deviceType;
        }
        $firstPart = substr($userAgent, strpos($userAgent, '(') + 1);
        $deviceString = substr($firstPart, 0, strpos($firstPart, ')'));
        $pieces = explode(';', $deviceString);

        if (self::isLinux($pieces[0])) {
            $pieces[0] = $pieces[1];
        } else if (self::isIOSDevice($pieces[0])) {
            $pieces[0] = self::APPLE . ' ' . $pieces[0];
        } else if (self::isAndroidDevice($pieces[1])) {
            $pieces[0] = self::DEVICE_ANDROID;
        } else if (self::isWindows($pieces[0])) {
            $pieces[0] = self::DEVICE_WINDOWS;
        }

        return (!is_null($pieces[0]) || !empty($pieces[0])) ? $pieces[0] : 'not_found';

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
            $pieces[0] = $pieces[1];
        } else if (self::isWindows($pieces[0])) {
            $pieces[0] = self::$windowsOS[$pieces[0]];
        } else if (self::isLinux($pieces[0])) {
            $pieces[0] = self::OS_LINUX;
        } else if (self::isIOSDevice($pieces[0])) {
            $pieces[0] = self::OS_IOS;
        } else if (self::isMacOS($pieces[1])) {
            $pieces[0] = $pieces[1];
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
        return strpos($userAgentPart, self::ANDROID);
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
        return $userAgentPart == self::DEVICE_IDENTIFIER_IPHONE
        || $userAgentPart == self::DEVICE_IDENTIFIER_IPAD
        || $userAgentPart == self::DEVICE_IDENTIFIER_ITOUCH;
    }

    private static function isMacOS($userAgentPart)
    {
        return strpos($userAgentPart, self::DEVICE_MACINTOSH);
    }

    /**
     * Static function to see if the crrent device is a an Android Tablet
     * @param $userAgentPart
     * @return bool
     */
    public static function isAndroidTablet($userAgentPart)
    {
        return !self::isMobile() && strpos($userAgentPart, self::ANDROID);
    }



    public function getServerInfo()
    {
        return $_SERVER;
    }


    /**
     * Check if the user agent contains the Mobile identifier
     * @return boolean
     */
    public static function isMobile()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (is_null($userAgent)) {
            return false;
        }

        return preg_match('/' . self::DEVICE_MOBILE_IDENTIFIER . '/', $userAgent);
    }

    /**
     * A list of windows platform tokens
     * @var array
     */
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

    private static $windowsOS = array(

        'Windows NT 10.0' => 'Windows 10',
        'Windows NT 6.3'  => 'Windows 8.1',
        'Windows NT 6.2'  => 'Windows 8',
        'Windows NT 6.1'  => 'Windows 7',
        'Windows NT 6.0'  => 'Windows Vista',
        'Windows NT 5.2'  => 'Windows Server 2003; Windows XP x64 Edition',
        'Windows NT 5.1'  => 'Windows XP',
        'Windows NT 5.01' => 'Windows 2000, Service Pack 1 (SP1)',
        'Windows NT 4.0'  => 'Windows 2000',
        'Windows 98'      => 'Windows 98',
        'Windows 95'      => 'Windows 95',
        'Windows CE'      => 'Windows 95',

    );

}