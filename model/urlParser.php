<!--Данный класс модели получает урл-адрес от контроллера, после парсит урлы категорий и статей в документе  -->

<?php
  
class urlParser {
private $document_content;
private $result_array=array();
private $regexp_rule=array(
'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#'
);

 function __construct ($query_url) {

$this->document_content=$this->get_page($query_url);
$this->get_urls();
$this->array_reindex($this->result_array);
}

public function get_result_array()
{
return $this->result_array;
}

protected function get_page($document_url)
{
return file_get_contents($document_url);
}
private function get_urls(){

    foreach ($this->regexp_rule as $key=>$value){
        preg_match_all($this->regexp_rule[$key], $this->document_content, $this->result_array[$key]);
        $this->result_array[$key]=array_merge($this->result_array[$key][1],$this->result_array[$key][2]);
        $this->result_array[$key]=array_diff($this->result_array[$key],array(''));
        $this->result_array[$key]= array_unique($this->result_array[$key]);
    }
 }
private function array_reindex (array $array){
	 
 foreach($array as $key =>$temp_value)
 {
	$counter=0;
	foreach ($temp_value as $second_key=>$value) {
	unset($array[$key][$second_key]);
	$array[$key][$counter]=$temp_value[$second_key];
	$counter++;	
	}
	
	}
$this->result_array=$array;	
}
}
