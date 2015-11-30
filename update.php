<?php
include_once 'App.php';
if (Kill::update()){
    echo 'success';
}else{
    echo 'error';
}