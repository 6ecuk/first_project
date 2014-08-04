<!--Данный класс модели получает от контроллера список урлов-адресов статей и парсит их контент-->
<?php
class ContentParser extends urlParser{

private $url_array= array();
private $regexp_rules=array(
    'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
    'time'=> '#<time .*>\s(.*)\s.*<\/time>#',
    'text_content'=> '#<div class="post-text.*">([^Ё]*){1}<footer class=".*post.*">#u'
);
private $content_array=array();
private $document_content;

function  __construct($array_data)
 {
$this->set_array($array_data);
$this->get_content($this->url_array['content_url']);
print_r($this->content_array);
 }


private function get_content(array $url){

	foreach($url as $value ) {
	$this->document_content=parent::get_page('http://' . $_GET['url_query'] . $value);

        foreach ($this->regexp_rules as $key =>$second_value)
        {
            preg_match_all($second_value, $this->document_content, $this->content_array[$value][$key]);
        }
}
}

private function set_array (array $array_data){
$this->url_array=$array_data;
}

}
