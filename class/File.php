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
}