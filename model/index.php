<?php
/**
 * Date: 09.08.14
 * Time: 15:13
 */

class model_Index {
private $rowsAdded;
function __construct($queryUrl){
$urlParse=new core_urlParser($queryUrl,new core_htmlGrabber());
$contentParser=new core_contentParser($urlParse->getResultArray(),$queryUrl);
$DB=new core_dataBase($contentParser->getArray());
$this->rowsAdded=$DB->rowsAdded;
}

public function getRowsCount(){
    return $this->rowsAdded;
}
}