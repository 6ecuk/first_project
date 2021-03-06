<?php
namespace application\model;

use library\htmlGrabber as htmlGrabber;

use library\parser\contentParser as contentParser;

use library\parser\urlParser as urlParser;

use library\dataBase as dataBase;
/**
 * Date: 09.08.14
 * Time: 15:13
 */
class index
{
    private $rowsAdded;

    function __construct($queryUrl)
    {
        $urlParse = new urlParser($queryUrl, new htmlGrabber());
        $contentParser = new contentParser($urlParse->getResultArray(), $queryUrl);
        $DB = new dataBase($contentParser->getArray());
        $this->rowsAdded = $DB->rowsAdded;
    }

    public function getRowsCount()
    {
        return $this->rowsAdded;
    }
}