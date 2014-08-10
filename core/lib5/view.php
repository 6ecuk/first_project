<?php
namespace core\lib5;

/**
 * Date: 09.08.14
 * Time: 18:04
 */
class view
{

    public function pageGeneration($templateView, $data)
    {
        include 'application/view/' . $templateView;
    }
} 