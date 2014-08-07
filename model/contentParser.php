<!--Данный класс модели получает от контроллера список урлов-адресов статей и парсит их контент-->
<?php
class model_contentParser extends model_urlParser{

private $urlArray= array();
private $regexpRules=array(
    'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
    'time'=> '#<time .*>\s(.*)\s.*<\/time>#',
    'text_content'=> '#<div class="post-text.*">([^Ё]*){1}<footer class=".*post.*">#u'
);
private $contentArray=array();
private $documentContent;

function  __construct($arrayData)
 {
$this->setArray($arrayData);
$this->getContent($this->urlArray['content_url']);
 }
private function getContent(array $url){

	foreach($url as $value ) {
	$this->documentContent=parent::getPage(controller_index::getUrlQuery() . $value);

        foreach ($this->regexpRules as $key =>$secondValue)
        {
            preg_match_all($secondValue, $this->documentContent, $this->contentArray[$value][$key]);
        }
}
}

private function setArray (array $arrayData){
$this->urlArray=$arrayData;
}
public function getArray(){
    return $this->contentArray;
}
}
