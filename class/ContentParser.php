<?php
class ContentParser extends CategoryParser{

private $url_array= array();
private $regexp_rule=array(
'header'=> '#<h1 class="post-title(?:.*) ">(.*)<\/h1>|<h1 class="post-title (?:.*)">(.*) <\/h1>|<h1 class="post-title(?:.*)">(.*)<\/h1># ' 
);
private $content_array=array();
private $document_content;

function  __construct($array_data)
 {
 $this->set_array($array_data);
 $this->document_content=$this->get_page('http://'.$_GET['url_query'].$this->url_array['content_url'][0]);
$this->get_content();
print_r($this->content_array);
 // print_r($this->document_content);
 }
 

private function get_content (){ 
preg_match_all($this->regexp_rule['header'], $this->document_content, $this->content_array['H1']);
}
 
private function set_array ($array_data){
$this->url_array=$array_data;
}

}
?>