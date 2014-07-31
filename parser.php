<?php 
// header("Content-Type: text/html; charset=utf-8");
// $ConnectDB = mysqli_connect('localhost','root','mysql','test') or die('Ошибка подключения к базе данных');
// /* Чистим от пустных элементов массив ссылок */
// function array_clean(&$array, &$parent = NULL, $parent_key = NULL) { 
    // if(count($array) > 0) {
        // foreach($array as $key => &$item) {
            // if(is_array($item))
                // array_clean($item, $array, $key);
            // elseif(trim($item) == '') {
                // unset($array[$key]);
                // if(count($array) == 0)
                    // unset($parent[$parent_key]);
            // }
        // }
    // } else
        // unset($parent[$parent_key]);
// }

// $userquery=$_GET['url_query'];
// preg_match_all('#http:\/\/news\.auto\.ru#',$userquery,$rootdomain);
// $get_document=file_get_contents($userquery);
// preg_match_all('#<a class="post-item-link" href="(.*)">|<a href="(.*)" class="post-item-link">#', $get_document, $divArray);
// array_clean($divArray);
// $complete_array_url=array ();
// $realy_complete_array_url=array ();
// $complete_array_url=$divArray[1]+$divArray[2];
// foreach ($complete_array_url as $arrayvalue )
// {
 // $complete_url=$rootdomain[0][0].$arrayvalue;
 // array_push($realy_complete_array_url,$complete_url);
// }


// $content_massive=array();
// foreach ($realy_complete_array_url as $url_value){
// $get_content=file_get_contents($url_value);
// preg_match_all( ' /<h1 class="post-title(.*) ">(.*)<\/h1>|<h1 class="post-title (.*)">(.*) <\/h1>|<h1 class="post-title(.*)">(.*)<\/h1>/',$get_content,$content_array);
// array_push($content_massive,$content_array);
// }
// print_r($content_massive);


// foreach($content_massive[0][0] as $value){
// $sql_query = " INSERT INTO Content(Header) VALUES ( ' $value' ) ";
// mysqli_query($ConnectDB, $sql_query); 

// }
// echo mb_detect_encoding($sql_query);




class Parser {
private $document_content;

private $result_array=array();
private $regexp_rule=array(
'category_url' => '#<a\s*href="(.*)"\s*class="service-nav-a">| <a class="post-meta-link post-meta-rubric" href="(.*)"># ',
'content_url' => '#(?:<a class="post-item-link" href="(.*)">)|(?:<a href="(.*)" class="post-item-link">)#',
'header'=> '#<h1 class="post-title(.*) ">(.*)<\/h1>|<h1 class="post-title (.*)">(.*) <\/h1>|<h1 class="post-title(.*)">(.*)<\/h1># ',
'category_clean_url' =>'#href=".*\/"#'  
);

 function __construct ($query) {

$this->document_content=$this->get_page($query);
$this->get_content_urls();
$this->get_category_urls();
$this->array_reindex($this->result_array);
}

private function get_page($document_url)
{
return file_get_contents($document_url);
}

private function get_content_urls (){
preg_match_all($this->regexp_rule['content_url'], $this->document_content, $this->result_array[0]);
$this->result_array[0]=array_merge($this->result_array[0][1],$this->result_array[0][2]);
$this->result_array[0] =array_diff($this->result_array[0],array(''));
$this->result_array[0] = array_unique($this->result_array[0]);

}
private function get_category_urls(){
preg_match_all($this->regexp_rule['category_url'], $this->document_content, $this->result_array[1]);
$this->result_array[1]=array_merge($this->result_array[1][1],$this->result_array[1][2]);
$this->result_array[1] =array_diff($this->result_array[1],array(''));
$this->result_array[1] = array_unique($this->result_array[1]);

}
private function array_reindex ($array){
	 
 foreach($array as $key =>$temp_value)
 {
	$counter=0;
	foreach ($temp_value as $Tkey=>$value) {
	unset($array[$key][$Tkey]);
	$array[$key][$counter]=$temp_value[$Tkey];
	$counter++;	
	}
	
	}
$this->result_array=$array;	
}
}
$first = new Parser('http://'.$_GET['url_query']);































?>