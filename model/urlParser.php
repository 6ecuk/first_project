<!--Данный класс модели получает урл-адрес от контроллера, после парсит урлы категорий и статей в документе  -->

<?php
  
class model_urlParser {
private $documentContent;
private $resultArray=array();
private $regexpRule=array(
'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#'
);

 function __construct ($queryUrl) {

$this->documentContent=$this->getPage($queryUrl);
$this->getUrls();
$this->arrayReindex($this->resultArray);
}

public function getResultArray()
{
return $this->resultArray;
}

protected function getPage($documentUrl)
{
return file_get_contents($documentUrl);
}
private function getUrls(){

    foreach ($this->regexpRule as $key=>$value){
        preg_match_all($this->regexpRule[$key], $this->documentContent, $this->resultArray[$key]);
        $this->resultArray[$key]=array_merge($this->resultArray[$key][1],$this->resultArray[$key][2]);
        $this->resultArray[$key]=array_diff($this->resultArray[$key],array(''));
        $this->resultArray[$key]= array_unique($this->resultArray[$key]);
    }
 }
private function arrayReindex (array $array){
	 
 foreach($array as $key =>$tempValue)
 {
	$counter=0;
	foreach ($tempValue as $secondKey=>$value) {
	unset($array[$key][$secondKey]);
	$array[$key][$counter]=$tempValue[$secondKey];
	$counter++;	
	}
	
	}
$this->resultArray=$array;
}
}
