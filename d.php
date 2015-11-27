<?php
include_once 'App.php';
$id = Http::getParam('id');
if (intval($id) <= 0){
    header('location:/index.php');
    exit;
}
$id = intval($id);
$article = Article::getArticleById($id);
if ($article === false){
    header('location:/index.php');
    exit;
}
require_once 'tpl/d.php';