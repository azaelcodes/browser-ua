<?php

namespace AzaelCodes\Utils;

class Browser implements BrowserInterface {


	public $userAgent;
    private $device;

	/**
	 *	Default constructor
	 */
	public function __construct()
	{
        $this->userAgent = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT']: null;
        if ($this->userAgent == null) {
            throw new \Exception('Unsupported browser #1001');
            return;
        }

        $this->device = new Device();

	}

    /**
     * Check if the current device is a Mobile one.
     * @return bool
     */
    public function isMobile()
    {
        return Device::isMobile();
    }

    /**
     * Since we already have a isMobile function it is easy to check if
     * the current device is desktop.
     * @return bool
     */
    public function isDesktop()
    {
        return !$this->isMobile() && !$this->isTablet();
    }

    /**
     * Check if the current device is a tablet
     * @see
     * @return bool
     */
    public function isTablet()
    {
        return Device::isAndroidTablet($this->userAgent);
    }

    /**
     * Check if the current device is Android
     * @return bool
     */
    public function isAndroid()
    {
        return $this->getDeviceType() == Device::DEVICE_ANDROID;
    }

    public function isIPhone()
    {
        return $this->getDeviceType() == Device::DEVICE_IPHONE;
    }

    public function isIPad()
    {
        return $this->getDeviceType() == Device::DEVICE_IPAD;
    }

    public function isWindows()
    {
        return $this->getDeviceType() == Device::DEVICE_WINDOWS;
    }

    public function isMac()
    {
        return $this->getDeviceType() == Device::DEVICE_MACINTOSH;
    }

    /**
     * A linux device is identified by its OS.
     * @return bool|int
     */
    public function isLinux()
    {
        return $this->getOS() == Device::OS_LINUX;
    }


    public function getBrowserType()
    {
        // TODO: Implement getBrowserType() method.
    }

    public function getBrowserVersion()
    {
        // TODO: Implement getBrowserVersion() method.
    }

    public function getDeviceType()
    {
        return Device::getDeviceType($this->userAgent);
    }

    public function getLanguage()
    {
        return Location::getLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }

    public function getCountry()
    {
        // TODO: Implement getCountry() method.
    }

    public function getRegion()
    {
        // TODO: Implement getRegion() method.
    }

    /**
     * Get OS type
     *
     * Example: Windows, Linux, iOS, etc..
     *
     * @return null|string
     */
    public function getOS()
    {
        return Device::getDeviceOS($this->userAgent);
    }

    /**
     * This function is now deprecated, no need to detect the browser information since the
     * constructor will do it.
     * @deprecated
     */

    public function detect()
    {

        $this->userAgent = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT']: null;
        if ($this->userAgent == null) {
            throw new \Exception('Unsupported browser #1001');
            return;
        }

    }

    /**
     * Helper function to debug information
     */
    public function debug()
    {
        return array(
            'User Agent' => $this->userAgent,
            'OS' => $this->getOS(),
            'Mobile Device' => $this->isMobile(),
            'Desktop' => $this->isDesktop(),
            'Tablet' => $this->isTablet(),
            'Device Type' => $this->getDeviceType(),
            'Language' => $this->getLanguage(),
        );
    }
}