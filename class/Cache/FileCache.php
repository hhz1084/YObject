<?php
class FileCache extends ICache
{
    const CACHE_DIR = 'cache_tmp/data/';
    public function set($sql, $data, $cacheTime = CACHE_TIME)
    {
        if (defined('IS_CACHED') && IS_CACHED){
            $data = array(
                'data' => $data,
                'expires' => time() + $cacheTime
            );
            $this->writeToFile($this->getKey($sql), $data);
        }
    }

    public function get($sql)
    {
        if (defined('IS_CACHED') && IS_CACHED){
            $filename = $this->getPath() . $this->getKey($sql);
            if (is_file($filename)) {
                $data = $this->getDataByFile($filename);
                if (! $this->isExpires($data['expires'])) {
                    return $data['data'];
                }
                unlink($filename);
                return false;
            }
        }
        return false;
    }

    public function has($sql)
    {
        $filename = $this->getPath() . $this->getKey($sql);
        if (is_file($filename)) {
            $data = $this->getDataByFile($filename);
            if (! $this->isExpires($data['expires'])) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function clear($sql)
    {
        $sql = trim($sql);
        $this->debug($sql);
        $sql = preg_replace("/\s+/", " ", $sql);
        if (stripos($sql, 'update') === 0 || stripos($sql, 'insert') === 0 ||
            stripos($sql, 'replace into') === 0 || stripos($sql, 'delete') === 0){
            $this->clearFile($this->getTablesBySql($sql));
        }
    }
    private function clearFile($tables)
    {
        $files = $this->getFiles();
        foreach ($files as $file){
            foreach ($tables as $t){
                if (stripos($file, $t) !== false){
                    unlink($this->getPath().$file);
                }
            }
        }
    }
    private function getFiles(){
        $dir = opendir($this->getPath());
        $files = array();
        while (false !== ($file = readdir($dir))){
            if ($file == '.' || $file == '..'){
                continue;
            }
            $files[] = $file;
        }
        closedir($dir);
        return $files;
    }
    protected function getDataByFile($filename)
    {
        if (is_file($filename)) {
            $data = file_get_contents($filename);
            $data = unserialize($data);
            return $data;
        }
        return false;
    }

    protected function getPath()
    {
        return ROOT_PATH . self::CACHE_DIR;
    }

    protected function writeToFile($key, $data)
    {
        $f = fopen($this->getPath().$key, 'w');
        fwrite($f, serialize($data));
        fclose($f);
    }
}