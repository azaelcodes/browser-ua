<?php

namespace AzaelCodes\Utils;

class Browser implements BrowserInterface {


	private $browser;
    private $iphone;
    private $android;
    private $ipad;
    private $tablette;

	/**
	 *	Default constructor
	 */
	public function __construct()
	{
	}

    /**
     * Detect the browser information and stored data inside this function
     * that can be used later.
     */

    public function detect()
    {

        $this->browser = (array_key_exists('HTTP_USER_AGENT', $_SERVER)) ? $_SERVER['HTTP_USER_AGENT']: null;
        if ($this->browser == null) {
            throw new \Exception('Unsupported browser #1001');
            return;
        }

    }

    public function isMobile()
    {
        // TODO: Implement isMobile() method.
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
        if ($this->browser == null) {
            throw new \Exception('Unsupported browser #1002');
            return;
        }
        if (stripos($this->browser, 'iPhone')) {
            $this->iphone = true;
        } else if (stripos($this->browser, 'Android')) {
            $this->android = true;
        } else if (stripos($this->browser, 'iPad')) {
            $this->ipad = true;
        }
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
        $end   = stripos($browser, ')');

        $osInfo = substr($browser, $start, $end);

        return $osInfo;
    }


    /**
     * Detect available mobile devices from the browser
     * @throws \Exception
     */
	private function detectMobileDevices()
	{
		if ($this->browser == null) {
			throw new \Exception('Unsupported browser #1002');
			return;
		}
        if (stripos($this->browser, 'iPhone')) {
            $this->iphone = true;
        } else if (stripos($this->browser, 'Android')) {
            $this->android = true;
        } else if (stripos($this->browser, 'iPad')) {
            $this->ipad = true;
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
        echo '<br>';
        print_r($this->detectOperatingSystem());
        echo '<br>';
        print_r($this->getLanguage());

    }
}