<?php 
include 'class/CategoryParser.php';
include 'class/ContentParser.php';   
header("Content-Type: text/html; charset=utf-8");
$CategoryParser = new CategoryParser('http://'.$_GET['url_query']);
$ContentParser = new ContentParser( $CategoryParser->get_result_array());
