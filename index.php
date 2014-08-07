<!--@@Создается экземляр контроллера. который передает GET с адресом страницы в  модель  -->
<?php
include 'controller/index.php';
header("Content-Type: text/html; charset=utf-8");
new controller_index('http://'.$_GET['url_query']);

