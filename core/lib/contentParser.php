<?php
namespace core\lib;

use core\lib2\htmlGrabber as htmlGrabber;

class contentParser
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
        $this->getContent($this->urlArray['content_url'], new htmlGrabber(), $queryUrl);
    }

    private function getContent(array $url, htmlGrabber $htmlGrabber, $passedQueryUrl)
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
