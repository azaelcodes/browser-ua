<?php
namespace AzaelCodes\Utils;

class Location {

    const DEFAULT_LANGUAGE = 'en';

    public function __construct()
    {

    }

    /**
     * Get the language from the user's browser
     * @param null $httpAcceptLanguage
     * @return string
     */
    public static function getLanguage($httpAcceptLanguage = null)
    {
        $language = self::DEFAULT_LANGUAGE;

        if (is_null($httpAcceptLanguage)) {
            return self::DEFAULT_LANGUAGE;
        }

        // Split the HTTP_ACCEPT_LANGUAGE value string
        $parts = explode(',', $httpAcceptLanguage);

        // Get the language weight which is stored inside the q- string.
        // If not found the weight is 1.0 by default
        foreach ($parts as $val) {

            if (preg_match('/(.*);q=([0-1]{0,1}.\d{0,4})/i', $val, $matches)) {
                $lang[$matches[1]] = (float) $matches[2];
            } else {
                $lang[$val] = 1.0;
            }
        }

        // Return the language with the highest q- value (The main language)
        $qVal = 0.0;
        foreach ($lang as $key => $value) {

            if ($val > $qVal) {

                $qVal = (float)$value;
                $language = (strlen($key) > 1) ? substr($key, 0, 2) : $key;

            }
        }

        return strtolower($language);
    }


}