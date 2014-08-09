<?php

class controller_index {
private $queryUrl;
function __construct($passedQueryUrl)
{
 $this->queryUrl=$passedQueryUrl;
 new model_Index($this->queryUrl);
}

}



