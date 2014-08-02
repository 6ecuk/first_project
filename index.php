<?php 
include 'class/urlParser.php';
include 'class/ContentParser.php';   
header("Content-Type: text/html; charset=utf-8");
$CategoryParser = new urlParser('http://'.$_GET['url_query']);

