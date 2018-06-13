<?php

namespace App\Helpers;

use Ixudra\Curl\Facades\Curl;
use App\Interfaces\UtilityInterface;

class UtilityHelper implements UtilityInterface
{

    public static function getDelimiter()
    {
        return '$2y';
    }

    public function createCode($var = ''){
        $code = mt_rand(100000, 999999);
        return $code;
    }

    public function sendSmsMobile360($url, $params)
    {
        // API Call
        $response = Curl::to($url)->withData($params)->asJson(true)->post();

        return $response;
    }

    public function sendSmsInternational($mobile_no, $content)
    {
        // Internal API Call
        $response = Curl::to($url)->get();

        return $response;
    }
    
    public function cleanString($str)
    {
        $notif_array = explode("\n", $str);
        $notif_array = array_map(function ($val) { return trim($val); }, $notif_array);
        return implode("\n", $notif_array);
    }

    public function cleanString2($str, $delimiter)
    {
        $newstr = str_replace($delimiter, ' ', $str);

        return $newstr;
    }

    public function convertTimeDay($time, $mode)
    {
        if ($mode == 'hh') {
            if ($time >= 24) {
                $days = floor($time / 24);
                $response = $days.' days';
            } else {
                $response = $time > 0 ? $time.' hours' : 0;
            }
        } elseif ($mode == 'mm') {
            if ($time >= 60) {
                $hours = floor($time / 60);
                $minutes = ($time % 60);
                $response = $hours.' hours';

                if ($hours > 72) {
                    $days = floor($hours / 24);
                    $hours = floor($hours % 24);
                    $minutes = ($hours % 60);
                    $response = $days.' days';
                }
            } else {
                $response = $time > 0 ? $time.' mins' : 0;
            }
        }

        return $response;
    }

    public static function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }

    public static function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);

        return $min + $rnd;
    }
    
    public static function generateVoucherSerialNumber($site_id = 0)
    {
        $serial_number  = strtoupper('DGLS' . substr(md5(uniqid(rand(), true)), 10, 17)) . time();
        
        return $serial_number;
    }
}
?>