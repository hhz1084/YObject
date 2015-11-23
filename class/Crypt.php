<?php
class Crypt
{
    const SPLIT_COUNT = 3;
    public static function EnCrypt($str,$key)
    {
        $md5 = strtoupper(md5($key));
        $str = base64_encode($str);
        $strArr = array_chunk(str_split($str), self::SPLIT_COUNT);
        foreach ($strArr as $k=>$v){
            $strArr[$k][] = $md5[mt_rand(0, 31)];
            $strArr[$k] = implode('', $strArr[$k]);
        }
        $str = implode('', $strArr);
        $str = self::swap(strrev($str));
        return $str;
    }
    public static function DeCrypt($str,$key)
    {
        $str = strrev(self::swap($str));
        $strArr = array_chunk(str_split($str), self::SPLIT_COUNT+1);
        foreach ($strArr as $k=>$v){
            array_pop($strArr[$k]);
            $strArr[$k] = $strArr[$k] = implode('', $strArr[$k]);
        }
        return base64_decode(implode('', $strArr));
    }
    private static function swap($str)
    {
        $strArr = str_split($str);
        for($i=0;$i<strlen($str);$i=$i+2){
            $tmp = $strArr[$i];
            if (isset($strArr[$i+1])){
                $strArr[$i] = $strArr[$i+1];
                $strArr[$i+1] = $tmp;
            }
        }
        return implode('', $strArr);
    }
}