<?php
class Article
{
    const ARTICLE_DIR = 'db/Article';
    public static function getArticleById($id)
    {
        $file = ROOT_PATH.self::ARTICLE_DIR.'/'.$id;
        if(!is_file($file)){
            return false;
        }
        $data = File::read($file);
        $data = json_decode($data,true);
        foreach ($data as $k=>$v){
            $data[$k] = Crypt::DeCrypt($v, uniqid());
        }
        return $data;
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