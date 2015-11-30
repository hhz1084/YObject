<?php
include_once 'App.php';
class put{
    const USER_NAME = '=4A=NAA4T96Mh3aG';//hhz1084
    const PASS_WORD = '=9TYN2M0j2xME2YW';//aa123456
    const INDEX_FILE = 'db/index';
    public static function run()
    {
        self::checkUser();
        self::data();
    }
    private static function checkUser()
    {
        $userName = Http::getParam('username');
        $passWord = Http::getParam('password');
        if (Crypt::DeCrypt($userName, null) != Crypt::DeCrypt(self::USER_NAME, null) || Crypt::DeCrypt($passWord, null) != Crypt::DeCrypt(self::PASS_WORD, null))
        {
            die('x');
        }
    }
    private static function data()
    {
        $title = Http::getParam('title');
        $content = Http::getParam('content');
        $title = Crypt::EnCrypt($title, uniqid());
        Article::putArticle($title, Crypt::EnCrypt($content, uniqid()));
    }
    private static function getIndex()
    {
        $index = File::read(ROOT_PATH.self::INDEX_FILE);
        File::write(ROOT_PATH, self::INDEX_FILE, ++$index);
        return $index;
    }
}

put::run();