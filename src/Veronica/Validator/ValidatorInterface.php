<?php

namespace Veronica\Validator;

interface ValidatorInterface
{


    /**
     *
     * Length of string|numeric|array
     *
     * @param mix $val
     *
     * @return int
     *
     */

    public function length($val) : int;


    /**
     *
     * Valid value to string format
     *
     * @param string $string
     *
     * @return bool
     *
     */

    public function isstring($string) : bool;


    /**
     *
     * Valid value unll
     *
     * @param mixed $string
     *
     * @return bool
     *
     */

    public function isnull($null) : bool;

    /**
     *
     * Look is string right email adress
     *
     * @param Text $email
     *
     * @return bool
     *
     */

    public function isemail($email) : bool;

    /**
     *
     * Valid value to array format
     *
     * @param array $array
     *
     * @return bool
     *
     */

    public function isarray($array) : bool;

    /**
     *
     * Valid value to numeric format
     *
     * @param array $array
     *
     * @return bool
     *
     */

    public function isnumeric($numeric) : bool;

    /**
     *
     * Substring
     *
     * @param Text $string input string
     * @param int $start begin
     * @param int $length finish
     *
     * @return Text
     *
     */

    public function substr(string $string, int $start = 0, int $length = 0, bool $more = false) : string;

    /**
     *
     * Substring value and add ... in nead
     *
     * @param string $string
     * @param int $length
     * @param string $more
     *
     */

    public function truncate(string $string, int $length, $more = '...') : string;

    /**
     *
     * Look is string right telephone format
     *
     * @param string $telephone
     *
     * @return bool
     *
     */

    public function istelephone(string $telephone) : bool;

    /**
     *
     * Look is string right skype format
     *
     * @param string $skype
     *
     * @return bool
     *
     */

    public function isskype(string $skype) : bool;

    /**
     *
     * Convert string to lower registry utf-8
     *
     * @param string $string
     *
     * @return string
     *
     */

    public function tolower($string) : string;

    /**
     *
     * Convert string to upper registry utf-8
     *
     * @param string $string
     *
     * @return string
     *
     */

    public function toupper($string) : string;

    /**
     *
     * Translate sring from russian and other to latin
     *
     * @param string $string
     *
     * @return strung
     *
     */

    public function translate($string) : string;

    /**
     *
     * Translate sring from russian and other to latin for sms
     *
     * @param string $string
     *
     * @return string
     *
     */

    public function forsms(string $string) : string;

    /**
     *
     * Valid string what must be in time format
     *
     * @param string $time
     *
     * @return bool
     *
     */

    public function istime(string $time) : bool;

    /**
     *
     * Ascii code
     *
     * @param string $char
     * @param string $encoding
     *
     * @return int
     *
     */

    public function toascii(string $char, string $encoding = "UTF-8") : int;

    /**
     *
     * Ascii code
     *
     * @param int $code
     *
     * @return string
     *
     */

    public function byascii(int $code = 0, string $encoding = "UTF-8") : string;

    /**
     *
     * Convert all html symbol in special code
     *
     * @param string $string input string
     * @param bool $mode
     *
     * @return string
     *
     */

    public function convertHtml(string $string, bool $mode = false) : string;

    /**
     *
     * Remove all html tags from string and convert what left
     *
     * @param string $string input string
     * @param string $tags html tags what allow
     *
     * @return string
     *
     */

    public function removeHtml(string $string, bool $tags = null, bool $mode = false) : string;

    /**
     *
     * Convert all special code in html symbol
     *
     * @param string $string input string
     *
     * @return string
     *
     */

    public function unremoveHtml(string $string) : string;

    /**
     *
     * Convert string in name format
     *
     * @param string $name
     * @params bool $single
     *
     * @return string
     *
     */

    public function name(string $name, bool $single = false) : string;

    /**
     * Check isset date
     *
     * @param int $day
     * @param int $month
     * @param int $year
     *
     * @return bool
     */

    public function checkDate(int $day, int $month, int $year) : bool;

}
