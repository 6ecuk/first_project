<?php
namespace library;

/**

 * Date: 09.08.14
 * Time: 13:44
 */
class htmlGrabber
{

    public $documentContent;

    public function getPage($documentUrl)
    {
        $this->documentContent = file_get_contents($documentUrl);
    }
} 