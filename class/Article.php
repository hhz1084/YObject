<?php
class Article
{
    public static function getArticleById($id)
    {
        $sql = "SELECT * FROM ii_article WHERE id={$id}";
        $data = App::$db->get_row($sql);
        if(empty($data)){
            return false;
        }
        $data['title'] = Crypt::DeCrypt($data['title'], uniqid());
        $data['content'] = Crypt::DeCrypt($data['content'], uniqid());
        return $data;
    }
    public static function getArticle($page = 1)
    {
        $sql = "SELECT id,title FROM ii_article LIMIT ".(($page-1)*PAGE_SIZE) . ','.PAGE_SIZE;
        $data = App::$db->get_all($sql);
        foreach ($data as $k=>$v){
            $data[$k]['title'] = Crypt::DeCrypt($v['title'], uniqid());
        }
        return $data;
    }
    public static function putArticle($title,$content)
    {
        $data = array(
            'title'=>App::$db->filterStr($title),
            'content'=>App::$db->filterStr($content),
            'ctime'=>date('Y-m-d H:i:s'),
            'mtime'=>date('Y-m-d H:i:s')
        );
        App::$db->query(App::$db->get_insert_db_sql('ii_article', $data));
    }
}
