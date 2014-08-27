<?php

namespace application\controller;

use application\model\index as modelIndex;

use library\view as view;

    class index
    {
        private $queryUrl;

        function __construct($passedQueryUrl)
        {
            $this->queryUrl = $passedQueryUrl;
            $model = new modelIndex($this->queryUrl);
            $view = new view();
            $view->pageGeneration('', $model->getRowsCount());
        }

    }




