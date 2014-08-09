<!--Данный класс модели получает от контроллера список урлов-адресов статей и парсит их контент-->
<?php

class core_contentParser
{

    private $urlArray = array();
    private $regexpRules = array(
        'header' => '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time' => '#<time .*>\s(.*)\s.*<\/time>#',
        'text_content' => '#<div class="post-text.*">([^Ё]*){1}<footer class=".*post.*">#u'
    );
    private $contentArray = array();

    function  __construct(array $arrayData, $queryUrl)
    {
        $this->setArray($arrayData);
        $this->getContent($this->urlArray['content_url'], new core_htmlGrabber(), $queryUrl);
    }

    private function getContent(array $url, core_htmlGrabber $htmlGrabber, $passedQueryUrl)
    {

        foreach ($url as $value) {
            $htmlGrabber->getPage($passedQueryUrl . $value);

            foreach ($this->regexpRules as $key => $secondValue) {
                preg_match_all($secondValue, $htmlGrabber->documentContent, $this->contentArray[$value][$key]);
            }
        }
    }

    private function setArray(array $arrayData)
    {
        $this->urlArray = $arrayData;
    }

    public function getArray()
    {
        return $this->contentArray;
    }
}
