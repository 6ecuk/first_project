<!--Данный класс модели получает урл-адрес от контроллера, после парсит урлы категорий и статей в документе  -->

<?php

class core_urlParser
{
    private $resultArray = array();
    private $regexpRule = array(
        'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
        'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#'
    );

    function __construct($queryUrl, core_htmlGrabber $htmlGrabber)
    {

        $htmlGrabber->getPage($queryUrl);
        $this->getUrls($htmlGrabber->documentContent);
        $this->arrayReindex($this->resultArray);

    }

    public function getResultArray()
    {
        return $this->resultArray;
    }

    private function getUrls($content)
    {

        foreach ($this->regexpRule as $key => $value) {
            preg_match_all($this->regexpRule[$key], $content, $this->resultArray[$key]);
            $this->resultArray[$key] = array_merge($this->resultArray[$key][1], $this->resultArray[$key][2]);
            $this->resultArray[$key] = array_diff($this->resultArray[$key], array(''));
            $this->resultArray[$key] = array_unique($this->resultArray[$key]);
        }
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
        $this->resultArray = $array;
    }
}
