<?php

namespace App\Interfaces;

interface UtilityInterface
{
    public function createCode($var);
    public function sendSmsMobile360($url, $params);
    public function sendSmsInternational($mobile_no, $content);
    public function cleanString($str);
    public static function getDelimiter();
    public function cleanString2($str, $delimiter);
    public function convertTimeDay($int, $mode);
}

?>