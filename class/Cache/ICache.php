<?php
abstract class ICache{
    const KEY_SPLIT = '~';
    protected static function getTablesBySql($sql)
    {
        $mode = '/(ii_\w+)/i';
        preg_match_all($mode, $sql, $matches);
        return ! empty($matches[1]) ? $matches[1] : array();
    }
    //是否已经到期
    protected function isExpires($time){
        return $time < time();
    }
    protected function getKey($sql){
        $tables = self::getTablesBySql($sql);
        $tables = array_unique($tables);
        return implode(self::KEY_SPLIT, $tables).self::KEY_SPLIT.sha1($sql);
    }
    protected function debug($sql){
        $file = ROOT_PATH.'cache_tmp/data/debug.sql';
        $fopen = fopen($file, 'a');
        fwrite($fopen, $sql."\n");
        fclose($fopen);
    }
    abstract function set($sql,$data,$cacheTime);
    abstract function get($sql);
    abstract function has($sql);
    abstract function clear($sql);
}