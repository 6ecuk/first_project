<?php 
class CategoryParser {
private $document_content;
public $result_array=array();
private $regexp_rule=array(
'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#',
'header'=> '#<h1 class="post-title(.*) ">(.*)<\/h1>|<h1 class="post-title (.*)">(.*) <\/h1>|<h1 class="post-title(.*)">(.*)<\/h1># ',
'category_clean_url' =>'#href=".*\/"#'  
);

 function __construct ($query) {

$this->document_content=$this->get_page($query);
$this->get_content_urls();
$this->get_category_urls();
$this->array_reindex($this->result_array);
}


public function get_result_array()
{
return $this->result_array;
}


private function get_page($document_url)
{
return file_get_contents($document_url);
}

private function get_content_urls (){
preg_match_all($this->regexp_rule['content_url'], $this->document_content, $this->result_array['content_url']);
$this->result_array['content_url']=array_merge($this->result_array['content_url'][1],$this->result_array['content_url'][2]);
$this->result_array['content_url']=array_diff($this->result_array['content_url'],array(''));
$this->result_array['content_url']= array_unique($this->result_array['content_url']);

}
private function get_category_urls(){
preg_match_all($this->regexp_rule['category_url'], $this->document_content, $this->result_array['category_url']);
$this->result_array['category_url']=array_merge($this->result_array['category_url'][1],$this->result_array['category_url'][2]);
$this->result_array['category_url'] =array_diff($this->result_array['category_url'],array(''));
$this->result_array['category_url'] = array_unique($this->result_array['category_url']);

}
private function array_reindex ($array){
	 
 foreach($array as $key =>$temp_value)
 {
	$counter=0;
	foreach ($temp_value as $Tkey=>$value) {
	unset($array[$key][$Tkey]);
	$array[$key][$counter]=$temp_value[$Tkey];
	$counter++;	
	}
	
	}
$this->result_array=$array;	
}
}
































?>