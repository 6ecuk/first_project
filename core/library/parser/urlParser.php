<?php
namespace library\parser;

use library\htmlGrabber as htmlGrabber;

class urlParser
{
    private $resultArray = array();
    private $regexpRule = array(
        'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
        'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#'
    );

    function __construct($queryUrl, htmlGrabber $htmlGrabber)
    {

        $htmlGrabber->getPage($queryUrl);
        $this->getCategoryUrls($htmlGrabber->documentContent);
        $this->spider($this->resultArray['category_url'], $htmlGrabber,$queryUrl);
        $this->completeList($this->resultArray['content_url']);


    }

    private function spider(array $categoryUrls, htmlGrabber $htmlGrabber,$queryUrl)
    {
        foreach($categoryUrls as $value) {
            $htmlGrabber->getPage($queryUrl . $value);
            $this->getContentUrls($htmlGrabber->documentContent,$value);
        }

    }

    public function getResultArray()
    {
        return $this->resultArray;
    }

    private function completeList(array $listOfUrls) {

        $tempArray = array();
        foreach($listOfUrls as $key => $value) {
            foreach($value as $secondValue) {
                $tempArray[]=$secondValue;
            }
        }
       $this->resultArray['content_url']=array_unique($tempArray);
    }

    private function getCategoryUrls($content)
    {
        preg_match_all($this->regexpRule['category_url'], $content, $this->resultArray['category_url']);
        $this->resultArray['category_url'] = array_merge($this->resultArray['category_url'][1], $this->resultArray['category_url'][2]);
        $this->resultArray['category_url'] = array_diff($this->resultArray['category_url'], array(''));
        $this->resultArray['category_url'] = array_unique($this->resultArray['category_url']);
        $this->resultArray = $this->arrayReindex($this->resultArray);
    }

    private function getContentUrls($content, $category)
    {
        preg_match_all($this->regexpRule['content_url'], $content, $this->resultArray['content_url'][$category]);
        $this->resultArray['content_url'][$category] = array_merge($this->resultArray['content_url'][$category][1], $this->resultArray['content_url'][$category][2]);
        $this->resultArray['content_url'][$category] = array_diff($this->resultArray['content_url'][$category], array(''));
        $this->resultArray['content_url'][$category] = array_unique($this->resultArray['content_url'][$category]);
        $this->resultArray['content_url'] = $this->arrayReindex($this->resultArray['content_url']);

    }


    private function arrayReindex(array $array)
    {

        foreach ($array as $key => $tempValue) {
            $counter = 0;
            foreach ($tempValue as $secondKey => $value) {
                unset($array[$key][$secondKey]);
                $array[$key][$counter] = $tempValue[$secondKey];
                $counter++;
            }

        }
        return $array;
    }
}
