<?php
use application\controller\index as controller;

require 'core\SplClassLoader.php';
$autoLoader = new SplClassLoader(null, __DIR__);
$autoLoader->register();
header("Content-Type: text/html; charset=utf-8");
new controller('http://' . $_GET['url_query']);

