<?php
namespace application\model;

use core\lib2\htmlGrabber as htmlGrabber;

use core\lib\contentParser as contentParser;

use core\lib3\urlParser as urlParser;

use core\lib4\dataBase as dataBase;
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