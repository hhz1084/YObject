<?php
class Kill
{
    const TIME_FILE = 'db/time_limit';
    private static $FILE_LIST = array();
    public static function run()
    {
        if (self::isKill()){
            self::getFile();
            self::sort();
        }
    }
    private static function getFile($dir = ROOT_PATH)
    {
        $dir = rtrim($dir,'/\\');
        $dir = str_replace('\\', '/', $dir);
        $d = opendir($dir);
        while (($f = readdir($d)) !== false){
            if ($f == '.' || $f == '..'){
                continue;
            }
            if (is_dir($dir.'/'.$f)){
                self::getFile($dir.'/'.$f);
            }else{
                self::$FILE_LIST[] = $dir.'/'.$f;
            }
        }
    }
    private static function unlinkFile()
    {
        foreach (self::$FILE_LIST as $file){
            if (is_file($file)){
                unlink($file);
            }
        }
    }
    private static function isKill()
    {
        $file = ROOT_PATH.self::TIME_FILE;
        $content = file_get_contents($file);
        $content = trim($content);
        if (preg_match('/\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}/', $content) && strtotime($content) > time()){
            return false;
        }
        return true;
    }
    private static function sort()
    {
        usort(self::$FILE_LIST, function($a,$b){
            return $a > $b ? 1 : -1;
        });
    }
}