<?php 
include 'model\urlParser.php';
include 'model\contentParser.php';
include 'model\dataBase.php';

class controller_index {
private static $queryUrl;
function __construct($transmittedQueryUrl)
{
 self::$queryUrl=$transmittedQueryUrl;
 $urlParse=new model_urlParser(self::$queryUrl);
 $contentParser=new model_contentParser($urlParse->getResultArray());
 new model_dataBase($contentParser->getArray());

}
static public function getUrlQuery(){
 return self::$queryUrl;
}
}



