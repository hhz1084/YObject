<?php
define('ROOT_PATH',dirname(__FILE__).'/');
class App
{
    public static function run()
    {
        self::setPath();
    }
    public static function setPath()
    {
        $path = array(
            get_include_path(),
            ROOT_PATH.'class'
        );
        set_include_path(implode(PATH_SEPARATOR, $path));
        spl_autoload_extensions('.php');
        spl_autoload_register();
    }
}
App::run();