<?php
namespace AzaelCodes\Utils;
/**
 * @desc Browser Interface
 * @author Azael Garcia
 *
 * Interface BrowserInterface
 */
interface BrowserInterface {

    /**
     * Detect the browser information and stored data inside this function
     * that can be used later.
     *
     * @return mixed
     */
    public function detect();

    /**
     * Detect if the current user is on a Mobile Device
     * @return mixed
     */
    public function isMobile();

    /**
     * Detect if the current user is on a Desktop device
     * @return mixed
     */
    public function isDesktop();

    /**
     * Check if the current device is Tablet
     * @return mixed
     */
    public function isTablet();

    /**
     * Get the operating system
     *
     * Example: Windows, Mac, Linux, Android, iOS
     *
     * @return mixed
     */
    public function getOS();

    /**
     * Get the browser type
     *
     * Example: Mozilla, Safari
     *
     * @return mixed
     */
    public function getBrowserType();

    /**
     * Get the browser version
     *
     * Example: 1.4.5
     *
     * @return mixed
     */
    public function getBrowserVersion();

    /**
     * Get device type
     *
     * Example: Android, iPhone
     *
     * @return mixed
     */
    public function getDeviceType();

    /**
     * Get the main language of the user's browser
     *
     * Example: en
     *
     * @return mixed
     */
    public function getLanguage();

    /**
     * Get the country of the user
     *
     * Example: Canada
     *
     * @return mixed
     */
    public function getCountry();

    /**
     * Get region of the user
     *
     * Example: Montreal
     *
     * @return mixed
     */
    public function getRegion();

    /**
     * A function to output all the information related to this
     * project's implementation.
     *
     * Example: Output browser type, device type, etc..
     *
     * @return mixed
     */
    public function debug();

}