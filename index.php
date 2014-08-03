<!--@@Файл по умолчанию,
передает адрес страницы контроллеру-->
<?php
include 'controller/urlController.php'; 
header("Content-Type: text/html; charset=utf-8");
new urlController('http://'.$_GET['url_query']);

