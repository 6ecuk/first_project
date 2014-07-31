<?php
class ContentParser {

private $url_array= array();

function  __construct($array_data)
 {
 $this->set_array($array_data);
 print_r($this->url_array);
 }
 
private function set_array ($array_data){
$this->url_array=$array_data;
}

}
?>