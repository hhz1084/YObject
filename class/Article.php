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
        $result = array();
        foreach ($file as $f){
            $c = File::read(ROOT_PATH.self::ARTICLE_DIR.'/'.$f);
            $c = json_decode($c,true);
            $tmp = array(
                'id'=>$f,
                'title'=>Crypt::DeCrypt($c['title'], uniqid())
            );
            $result[] = $tmp;
        }
        return $result;
    }
    public static function putArticle($title,$content)
    {
        File::write(ROOT_PATH, self::ARTICLE_DIR.'/'.$title, $content);
    }
}