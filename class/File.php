<?php
class File{
    public static function read($filename)
    {
        return file_get_contents($filename);
    }
    public static function write($path,$filename,$content)
    {
        $f = fopen($path.$filename, 'w');
        fwrite($f, $content);
        fclose($f);
        return $path.$filename;
    }
    public static function getFiles($dir,$onlyFileName = false)
    {
        $dir = str_replace('\\', '/', rtrim($dir,'/\\'));
        if (!is_dir($dir)){
            return false;
        }
        $f = opendir($dir);
        $files = array();
        while (($d = readdir($f)) !== false){
            if ($d == '.' || $d == '..'){
                continue;
            }
            $file = str_replace('\\', '/', $onlyFileName ? $d : $dir.'/'.$d);
            if (is_file($onlyFileName ? $dir.'/'.$file : $file)){
                $files[] = $file;
            }
        }
        closedir($f);
        return $files;
    }
}