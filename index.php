<?php
include_once 'App.php';
$article = Article::getArticle();
require_once(ROOT_PATH.'tpl/index.php');