<?php 
include 'model/urlParser.php';
include 'model/ContentParser.php';

class urlController {
private static $query_url;
function __construct($transmitted_query_url)
{
 self::$query_url=$transmitted_query_url;
 $urlParse_instance=new urlParser(self::$query_url);
 new ContentParser($urlParse_instance->get_result_array());
		
}
static public function get_url_query(){
 return self::$query_url;
}
}



