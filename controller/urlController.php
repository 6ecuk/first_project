<?php 
include 'model/urlParser.php';
include 'model/ContentParser.php'; 

class urlController {

function __construct($query_url)
{
 $urlParse_instance=new urlParser($query_url);
 $Content_instance= new ContentParser($urlParse_instance->get_result_array());
		
}

}



