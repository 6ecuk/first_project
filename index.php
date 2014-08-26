<?php
use application\controller\index as controller;

require 'SplClassLoader.php';
$application = new SplClassLoader('application', __DIR__);
$application->register();
$library = new SplClassLoader('library', __DIR__ . '/core');
$library->register();
header("Content-Type: text/html; charset=utf-8");
new controller('http://' . 'news.auto.ru');

