<?php

namespace AzaelCodes\Utils;
/**
 * This is a simple class to detect browser information, the current features support
 * - iPhone Detect
 * - Android Detect
 * - iPad Detect
 *
 * More features will be added in the future
 *
 * Class Browser
 * @package AzaelCodes\Utils
 */
class Browser {


	private $browser;
    private $isiPhone;
    private $isIPad;
    private $isAndroid;
	
	/**
	 *	Default constructor
	 */
	public function __construct()
	{
	}

    /**
     * First function to call which detects browser information from the client
     * @throws \Exception
     */
	public function detect()
	{
		
		$browser = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT']: null;
		if ($browser == null) {
			throw new \Exception('Unsupported browser #1001');
			return;
		}

		// Let's store the browser information inside a class variable for later use.
		self::setBrowser($browser);

        // Detect mobile devices
		$this->detectMobileDevices();
	}

    /**
     * Detect available mobile devices from the browser
     * @throws \Exception
     */
	protected function detectMobileDevices()
	{
        $browser = $this->getBrowser();
		if ($browser == null) {
			throw new \Exception('Unsupported browser #1002');
			return;
		}
        if (stripos($browser, 'iPhone')) {
            $this->setIsIPhone(true);
        } else if (stripos($browser, 'Android')) {
            $this->setIsAndroid(true);
        } else if (stripos($browser, 'iPad')) {
            $this->isIPad = true;
        }
	}

    protected function detectOperatingSystem()
    {

        $browser = $this->getBrowser();
        if ($browser == null) {
            throw new \Exception('Unsupported browser #1002');
            return;
        }

    }

    /**
     * Helper function to debug information
     */
    public function debug()
    {
        print('-- Start browser detection --');
        echo '<br>';
        print_r($this->getBrowser());
        echo '<br>';
        print_r('Is iPhone: ' . $this->isiPhone);
        echo '<br>';
        print_r('Is Android: ' . $this->isAndroid);
        echo '<br>';
        print_r('Is iPad: ' . $this->isIPad);

    }

    /**
     * @param boolean $iphone
     */
    public function setIsIPhone($iphone)
    {
        $this->isiPhone = $iphone;
    }

    /**
     * @return boolean
     */
    public function isPhone()
    {
        return $this->isiPhone;
    }

    /**
     * @param boolean $android
     */
    public function setIsAndroid($android)
    {
        $this->isAndroid = $android;
    }

    /**
     * @return boolean
     */
    public function isAndroid()
    {
        return $this->isAndroid;
    }

    /**
     * @param boolean $ipad
     */
    public function setIsIPad($ipad)
    {
        $this->isIPad = $ipad;
    }


    /**
     * @return boolean
     */
    public function isIpad()
    {
        return $this->isIPad;
    }


    /**
     * @param String $browser
     */
	public function setBrowser($browser)
	{
		$this->browser = $browser;
	}

    /**
     * @return user agent
     */
	public function getBrowser()
	{
		return $this->browser;
	}


}