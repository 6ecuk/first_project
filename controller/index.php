<?php

class controller_index {
private $queryUrl;
function __construct($passedQueryUrl)
{
$this->queryUrl=$passedQueryUrl;
$model= new model_Index($this->queryUrl);
$view=new core_View();
$view->pageGeneration('default.php',$model->getRowsCount());
}

}



