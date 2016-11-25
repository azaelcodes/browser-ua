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


    public function isMobile()
    {
        return $this->device->isMobile();
    }

    public function isDesktop()
    {
        // TODO: Implement isDesktop() method.
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
        return Device::getOSType($this->userAgent);
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

    public function getOS()
    {
        $browser = $this->getBrowser();
        if ($browser == null) {
            throw new \Exception('Unsupported browser #1002');
            return;
        }

        $start = stripos($browser, '(');
        $end   = stripos($browser, ') ');

        $osInfo = substr($browser, $start, $end);

        return $osInfo;
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
            'Device Type' => $this->getDeviceType(),
            'Mobile Device' => $this->isMobile(),
            'Language' => $this->getLanguage(),
        );
    }
}