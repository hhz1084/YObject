<?php
class FCache{
    private static $resource = null;
    public static function getInstance()
    {
        if (self::$resource !== null){
            return (self::$resource);
        }else{
            $type = strtoupper(CACHE_TYPE);
            switch ($type){
                case 'FILE':
//                     require_once(ROOT_PATH.'includes/cache/FileCache.class.php');
                    self::$resource = new FileCache();
                    break;
                case 'REDIS':
//                     require_once(ROOT_PATH.'includes/cache/RedisCache.class.php');
                    self::$resource = new RedisCache();
                    break;
                default:
                    self::$resource = new FileCache();
                    break;
            }
            return self::$resource;
        }
    }
}