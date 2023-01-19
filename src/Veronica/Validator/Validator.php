<?php

namespace Veronica\Validator;
use Veronica\Validator\ValidatorInterface as ValidatorInterface;

class Validator implements ValidatorInterface
{

    public function __construct()
    {

    }

    public function length($val): int
    {
        if (0 === $val || $val === '0')
        {
            return 1;
        }

        if (is_string($val))
        {
            return mb_strlen(trim($val), 'utf-8');
        }

        if (is_numeric($val))
        {
            return strlen($val);
        }

        if (is_array($val))
        {
            return count($val);
        }

        if ($val instanceof \stdClass)
        {
            $k = 0;
            foreach ($val as $item)
            {
                $k++;
            }
            return $k;
        }

        return 0;
    }

    public function isnull($null) : bool
    {
        return is_null($null);
    }

    public function isstring($string): bool
    {
        return ($string && is_string($string) && $this->length($string) > 0) ? true : false;
    }

    public function isemail($email): bool
    {
        if ($email && $this->isstring($email) && $this->length($email) > 0)
        {
            if (count(explode('@', $email)) > 2)
            {
                return false;
            }

            if (preg_match('/^[a-zA-Z0-9-_.]+[@]+[a-z0-9-_]+[.]+[a-z0-9-_.]+$/', trim($email)))
            {
                return true;
            }
        }

        return false;
    }

    public function isarray($array): bool
    {
        return (!is_null($array) && $array && is_array($array) && count($array) > 0) ? true : false;
    }

    public function isnumeric($numeric): bool
    {
        return (is_numeric($numeric)) ? true : false;
    }

    public function substr(string $string, int $start = 0, int $length = 0, string|bool $more = false): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        if ($this->isnumeric($string))
        {
            $string = (string) $string;
        }

        if ($start < 0)
        {
            $start = 0;
        }

        if ($length < 0)
        {
            $length = 0;
        }

        $usemore = false;

        $l = $this->length($string);
        if ($l > $length)
        {
            $usemore = true;
        }

        $r = mb_substr($string, $start, (($length > 0) ? $length : $l), 'utf-8');
        if ($usemore && $this->isstring($more))
        {
            $r .= $more;
        }

        return $r;
    }

    public function truncate(string $string, int $length, $more = '...'): string
    {
        return $this->substr($string, 0, $length, $more);
    }

    public function istelephone(string $telephone): bool
    {
        return ($this->isstring($telephone)) && preg_match('/^([\d\-\(\)\,\s\+]{3,})$/', trim(strval($telephone))) ? true : false;
    }

    public function isskype(string $skype): bool
    {
        return (($this->isstring($skype)) && preg_match('/^([a-zA-Z\d\-\_\.]+)$/', $skype)) ? true : false;
    }

    public function tolower($string): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        $convert_to = [
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "a", "a", "a", "a", "a", "a", "?", "c", "e", "e", "e", "e", "i", "i", "i", "i",
            "?", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "а", "б", "в", "г", "д", "е", "ё", "ж",
            "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
            "ь", "э", "ю", "я"
        ];

        $convert_from = [
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "A", "A", "A", "A", "A", "A", "?", "C", "E", "E", "E", "E", "I", "I", "I", "I",
            "?", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
            "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы",
            "Ь", "Э", "Ю", "Я"
        ];

        return str_replace($convert_from, $convert_to, mb_strtolower($string, 'utf-8'));
    }

    public function toupper($string): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        $convert_to = [
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V", "W", "X", "Y", "Z", "A", "A", "A", "A", "A", "A", "?", "C", "E", "E", "E", "E", "I", "I", "I", "I",
            "?", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
            "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы",
            "Ь", "Э", "Ю", "Я"
        ];

        $convert_from = [
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "a", "a", "a", "a", "a", "a", "?", "c", "e", "e", "e", "e", "i", "i", "i", "i",
            "?", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "а", "б", "в", "г", "д", "е", "ё", "ж",
            "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
            "ь", "э", "ю", "я"
        ];

        return str_replace($convert_from, $convert_to, mb_strtoupper($string, 'utf-8'));
    }

    public function translate($string): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        $ms = ["ю" => "yu", "я" => "ya", "ё" => "yo", "ж" => "zh", "х" => "kh", "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "shh", "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "з" => "z", "і" => "i", "ї" => "yi", "и" => "i", "й" => "j", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "ы" => "y", "э" => "eh", "є" => "ye", "ь" => "", "ъ" => "",
            "Ю" => "Yu", "Я" => "Ya", "Ё" => "Yo", "Ж" => "Zh", "Х" => "Kh", "Ц" => "Ts", "Ч" => "Ch", "Ш" => "Sh", "Щ" => "Shh", "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "З" => "Z", "І" => "I", "Ї" => "Yi", "И" => "I", "Й" => "J", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Ы" => "Y", "Э" => "Eh", "Є" => "Ye", "Ь" => "", "Ъ" => ""];
        return strtr($string, $ms);
    }

    public function forsms(string $string): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        $convert_to = [
            'A','B','V','G','D','E','Yo','J','Z','I','Y',
            'K','L','M','N','O','P','R','S','T','U','F',
            'X','Ts','Ch','Sh','’','-','E','Yu','Ya','O‘',
            'Q','G‘','H','a','b','v','g','d','e','yo','j',
            'z','i','y','k','l','m','n','o','p','r','s',
            't','u','f','x','ts','ch','sh','-','-','e',
            'yu','ya','o‘','q','g‘','h','i','I','Sch','sch','i','i'
        ];

        $convert_from = [
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','ъ','ь','Э','Ю','Я','У','К','Г',
            'Х','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о',
            'п','р','с','т','у','ф','х','ц','ч','ш','ъ','ь','э','ю','я','с','с',
            'г','с','ы','Ы','Щ','щ','ї','і'
        ];

        return str_replace($convert_from, $convert_to, $string);
    }

    public function istime(string $time): bool
    {
        if (!$this->isstring($time) && !$this->isnumeric($time))
        {
            return false;
        }

        $time = trim($time);
        if (preg_match('/^([\d]{1,2})(\:|\.|\-|\s)([\d]{1,2})$/', $time, $resp))
        {
            if ($this->length($resp) != 4)
            {
                return false;
            }
            if (intval($resp[1]) >= 0 && intval($resp[1]) <= 23 && intval($resp[3]) >= 0 && intval($resp[3]) <= 59)
            {
                return true;
            }
        }
        return false;
    }

    public function toascii(string $char, string $encoding = "UTF-8"): int
    {
        if (!$this->isstring($char) && !$this->isnumeric($char))
        {
            return 0;
        }

        if ($this->isnumeric($char))
        {
            $char = intval($char);
        }

        $char = mb_convert_encoding($char, "UCS-4BE", $encoding);
        $order = unpack("N", $char);
        return $order ? $order[1] : 0;
    }

    public function byascii(int $code = 0, string $encoding = "UTF-8"): string
    {
        if (!$this->isstring($code) && !$this->isnumeric($code))
        {
            return '';
        }

        $order = pack("N", intval($code));
        $char = mb_convert_encoding($order, $encoding, "UCS-4BE");
        return $char;
    }

    public function convertHtml(string $string, bool $mode = false): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }
        if (!$mode)
        {
            $quote = ENT_QUOTES;
        }
        else
        {
            $quote = ENT_QUOTES;
            if ($mode == ENT_NOQUOTES)
            {
                $quote = ENT_NOQUOTES;
            }
            elseif($mode == ENT_COMPAT)
            {
                $quote = ENT_COMPAT;
            }
        }
        return strval(htmlspecialchars(trim(urldecode($string)), $quote, $encoding = 'UTF-8'));
    }

    public function removeHtml(string $string, bool $tags = null, bool $mode = false): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }

        return $this->convertHtml(strip_tags(urldecode($string), $tags), $mode);
    }

    public function unremoveHtml(string $string): string
    {
        if (!$this->isstring($string) && !$this->isnumeric($string))
        {
            return '';
        }
        return htmlspecialchars_decode($string, ENT_QUOTES);
    }

    public function name(string $name, bool $single = false): string
    {
        if (!$this->isstring($name) && !$this->isnumeric($name))
        {
            return '';
        }

        if ($single)
        {
            $encoding='UTF-8';
            if (strlen(trim($name)) > 0)
            {
                if (preg_match('/-/ui', $name))
                {
                    $names = explode('-', $name);
                    foreach($names as &$singlename)
                    {
                        $singlename = $this->tolower($singlename);
                        $singlename = mb_ereg_replace('^[\ ]+', '', $singlename);
                        $singlename = $this->toupper(mb_substr($singlename, 0, 1, $encoding), $encoding).mb_substr($singlename, 1, mb_strlen($singlename), $encoding);
                    }
                    $name = implode('-', $names);
                }
                else
                {
                    $name = $this->tolower($name);
                    $name = mb_ereg_replace('^[\ ]+', '', $name);
                    $name = mb_strtoupper(mb_substr($name, 0, 1, $encoding), $encoding).mb_substr($name, 1, mb_strlen($name), $encoding);
                }
            }
            return trim($name);
        }
        else
        {
            $names = explode(' ', trim($name));
            if (count($names) > 1)
            {
                $resp = '';
                foreach ($names as &$singlename)
                {
                    $singlename = $this->name($singlename, true);
                }
                return implode(' ', $names);
            }
            return $this->name($name, true);
        }
    }

    public function checkDate(int $day, int $month, int $year) : bool
    {
        return checkdate($month, $day, $year);
    }
}
