<?php

/**
 * Date: 09.08.14
 * Time: 18:04
 */
class core_View
{

    public function pageGeneration($templateView, $data)
    {
        include '/view/' . $templateView;
    }
} 