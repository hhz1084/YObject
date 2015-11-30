<?php

class RedisCache extends ICache
{
    private $connect = null;
    const KEY_PREFIX = 'CACHE_REDIS:';
    public function __construct()
    {
        $this->isLoad();
        $this->connect();
    }
    public function set($sql,$data,$cacheTime = CACHE_TIME){
        if (defined('IS_CACHED') && IS_CACHED){
            $data = array(
                'data' => $data,
                'expires' => time() + $cacheTime
            );
            $this->connect->setex($this->getKey($sql),$cacheTime,serialize($data));
        }
    }
    public function get($sql){
        if (defined('IS_CACHED') && IS_CACHED){
            $key = $this->getKey($sql);
            $data = $this->connect->get($key);
            
            if ($data) {
                $data = unserialize($data);
                if (! $this->isExpires($data['expires'])) {
                    return $data['data'];
                }
                $this->connect->del($key);
                return false;
            }
        }
        return false;
    }
    public function has($sql){
        $key = $this->getKey($sql);
        $data = $this->connect->get($key);
        if ($data) {
            return true;
        }
        return false;
    }
    public function clear($sql)
    {
        $sql = trim($sql);
        $sql = preg_replace("/\s+/", " ", $sql);
        if (stripos($sql, 'update') === 0 || stripos($sql, 'insert') === 0 ||
            stripos($sql, 'replace into') === 0 || stripos($sql, 'delete') === 0){
            $tables = $this->getTablesBySql($sql);
            $this->clearKeyWithTable($tables);
        }
    }
    private function clearKeyWithTable($tables){
        $keys = array();
        foreach ($tables as $table){
            $key = $this->connect->keys("*".$table."*");
            if(!empty($key)){
                $keys = array_merge($keys,$key);
            }
        }
        $keys = array_unique($keys);
        foreach ($keys as $key){
            $this->connect->del($key);
        }
    }
    private function connect()
    {
        $this->connect = new Redis();
        try {
            $this->connect->connect(REDIS_HOST,REDIS_PORT);
        }catch (Exception $e){
            die($e);
        }
        
    }
    private function isLoad()
    {
        if (!extension_loaded('redis')){
            die('redis 扩展未加载');
        }
        if (!defined('REDIS_HOST')){
            define('REDIS_HOST', '127.0.0.1');
        }
        if (!defined('REDIS_PORT')){
            define('REDIS_PORT', 6379);
        }
    }
}