<?php 

include 'class/CategoryParser.php';  
header("Content-Type: text/html; charset=utf-8");
$first = new CategoryParser('http://'.$_GET['url_query']);
