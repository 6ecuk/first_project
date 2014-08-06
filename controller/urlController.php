<?php 
include 'model/urlParser.php';
include 'model/ContentParser.php';
include 'model/DataBase.php';

class urlController {
private static $query_url;
function __construct($transmitted_query_url)
{
 self::$query_url=$transmitted_query_url;
 $urlParse=new urlParser(self::$query_url);
 $contentParser=new ContentParser($urlParse->get_result_array());
 $DB=new DataBase($contentParser->get_array());

}
static public function get_url_query(){
 return self::$query_url;
}
}



