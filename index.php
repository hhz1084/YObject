<?php
include_once 'App.php';
Kill::run();
$article = Article::getArticle();
require_once(ROOT_PATH.'tpl/index.php');