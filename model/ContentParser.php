<?php 
class ContentParser extends urlParser{

private $url_array= array();
private $regexp_rule=array(
'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
'text_content'=> '#<div class="post-text post-text_news">([^Ё]*)[^a]{1}<figure class="post-media">#u'
);
private $content_array=array(
);
private $document_content;

function  __construct($array_data)
 {
$this->set_array($array_data);
// $this->parse();
$this->document_content=parent::get_page('http://'.$_GET['url_query'].$this->url_array['content_url'][0]);
$this->get_content($this->document_content);
print_r($this->content_array);

 }
 
private function parse(){

	// foreach($this->url_array['content_url'] as $key => $value ) {
	// $this->document_content=parent::get_page('http://' . $_GET['url_query'] . $value);
	// $this->get_content($this->document_content);
// }

}
 
 
 
private function get_content ($content){ 

foreach ($this->regexp_rule as $key =>$value){
preg_match_all($value, $content, $this->content_array[$key]);

}

}
 
private function set_array ($array_data){
$this->url_array=$array_data;
}

}
?>