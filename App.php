<?php
include_once 'config/config.php';
class App
{
    public static $db = null;
    public static function run()
    {
        self::setPath();
        self::$db = new MySQL(HOST, USER, PASS, DBNAME);
    }
    public static function setPath()
    {
        $path = array(
            get_include_path(),
            ROOT_PATH.'class',
            ROOT_PATH.'class/Cache'
        );
        set_include_path(implode(PATH_SEPARATOR, $path));
        spl_autoload_extensions('.php');
        spl_autoload_register();
    }
}
App::run();