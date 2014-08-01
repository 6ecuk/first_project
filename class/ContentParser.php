<?php
class ContentParser extends CategoryParser{

private $url_array= array();
private $regexp_rule=array(
'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
'text_content'=> '#<div class="post-text post-text_news">([^Ё]*)[^a]{1}<figure class="post-media">#u'
);
private $content_array=array();
private $document_content;

function  __construct($array_data)
 {
$this->set_array($array_data);
$this->document_content=parent::get_page('http://'.$_GET['url_query'].$this->url_array['content_url'][1]);
$this->get_content();
print_r($this->content_array);

 }
 

 
 
 
private function get_content (){ 


preg_match_all($this->regexp_rule['header'], $this->document_content, $this->content_array['H1']);
preg_match_all($this->regexp_rule['time'], $this->document_content, $this->content_array['time']);
preg_match_all($this->regexp_rule['text_content'], $this->document_content, $this->content_array['text_content']);
}
 
private function set_array ($array_data){
$this->url_array=$array_data;
}

}
?>