<?php
include_once 'App.php';
$article = Article::getArticle();
print_r($article);


require_once(ROOT_PATH.'tpl/index.php');