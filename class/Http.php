<?php
class Http
{
    public static function getParam($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : null);
    }
}