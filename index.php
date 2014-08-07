<!--@@Создается экземляр контроллера. который передает GET с адресом страницы в  модель  -->
<?php
require_once 'class/SplClassLoader.php';
$autoLoader= new SplClassLoader(null,__DIR__);
$autoLoader->register();
header("Content-Type: text/html; charset=utf-8");
new controller_index('http://'.$_GET['url_query']);

