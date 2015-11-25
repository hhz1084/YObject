<?php
class Article
{
    const ARTICLE_DIR = 'db/Article';
    public function __construct()
    {
        
    }
    public static function getArticle()
    {
        $file = File::getFiles(ROOT_PATH.self::ARTICLE_DIR,true);
        usort($file,function ($a,$b){
            $a = explode('.', $a);
            $b = explode('.', $b);
            return intval($a[0]) > intval($b[0]) ? -1 : 1;
        });
        return $file;
    }
    public static function putArticle()
    {
        
    }
}