<!--Данный класс модели получает от контроллера список урлов-адресов статей и парсит их контент-->
<?php
class ContentParser extends urlParser{

private $url_array= array();
private $regexp_rules=array(
'url_rules'=>array (
    'company_news_validate'=>'#[a-z]{1,}\/[a-z]{1,}\/company_news\/.*#',
    'day_ratings'=>'#[a-z]{1,}\/[a-z]{1,}\/day_ratings\/.*#',
    'tune_project'=>'#[a-z]{1,}\/[a-z]{1,}\/tune_project\/.*#',
    'testdrives_comparison'=>'#[a-z]{1,}\/[a-z]{1,}\/testdrives_comparison\/.*#',
    'day_event'=>'#[a-z]{1,}\/[a-z]{1,}\/day_event\/.*#',
    'testdrives_modification'=>'#[a-z]{1,}\/[a-z]{1,}\/testdrives_modification\/.*#',
    'day_news'=>'#[a-z]{1,}\/[a-z]{1,}\/day_news\/.*#',
    'tune_news'=>'#[a-z]{1,}\/[a-z]{1,}\/tune_news\/.*#',
    'trailer_travel'=>'#[a-z]{1,}\/[a-z]{1,}\/trailer_travel\/.*#',
    'sound_test'=>'#[a-z]{1,}\/[a-z]{1,}\/sound_test\/.*#',
    'sound_news'=>'#[a-z]{1,}\/[a-z]{1,}\/sound_news\/.*#',
    'media_galleries'=>'#[a-z]{1,}\/[a-z]{1,}\/media_galleries\/.*#',
    'testdrives_firsttrip'=>'#[a-z]{1,}\/[a-z]{1,}\/testdrives_firsttrip\/.*#',
    'testdrives_subjective'=>'#[a-z]{1,}\/[a-z]{1,}\/testdrives_subjective\/.*#',
),
'template_company_news'=>array(
    'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
    'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
    'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
),
'template_day_ratings'=>array(
    'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
    'time'=>'#<time.*>\s(.*)<\/time>#',
    'text_content'=> '#<div class="post-text (?:.*) ">([^Ё]*){1}<footer class="post-foot (?:.*)">#u'
),
'template_tune_project'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#<time .*>\s(.*)\s.*<\/time>#',
        'text_content'=> '#<div class="post-text .*">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_testdrives_comparison'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_day_event'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_testdrives_modification'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_day_news'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_tune_news'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_trailer_travel'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_sound_test'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_sound_news'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_media_galleries'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_testdrives_firsttrip'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    ),
'template_testdrives_subjective'=>array(
        'header'=> '#<h1 class="(?:.*)">(.*)<\/h1># ',
        'time'=> '#(?:post-meta-rubric">(?:.*)<\/a><\/li>\s*<li class="post-meta-item">)(?:\s.*)(?:\s)(.*)(?:<\/time>)#',
        'text_content'=> '#<div class="post-text post-text_news">([^Ё]*){1}<figure class="post-media">#u'
    )
);
private $content_array=array();
private $document_content;

function  __construct($array_data)
 {
$this->set_array($array_data);
$this->get_content($this->url_array['content_url']);
print_r($this->content_array);
 }


private function get_content(array $url){

	foreach($url as $value ) {
	$this->document_content=parent::get_page('http://' . $_GET['url_query'] . $value);
    $this->template_choice($value);
}

}
private function template_choice($url)
    {
        if(preg_match($this->regexp_rules['url_rules']['company_news_validate'],$url))
        {
            foreach ($this->regexp_rules['template_company_news'] as $key =>$value)
            {
                preg_match_all($value, $this->document_content, $this->content_array[$url][$key]);
            }
        }
        if(preg_match($this->regexp_rules['url_rules']['day_ratings'],$url))
        {
            foreach ($this->regexp_rules['template_day_ratings'] as $key =>$value)
            {
                preg_match_all($value, $this->document_content, $this->content_array[$url][$key]);
            }
        }
        if(preg_match($this->regexp_rules['url_rules']['tune_project'],$url))
        {
            foreach ($this->regexp_rules['template_tune_project'] as $key =>$value)
            {
                preg_match_all($value, $this->document_content, $this->content_array[$url][$key]);
            }
        }
        else {
            echo "Template not found, sorry ";
        }
    }
private function set_array (array $array_data){
$this->url_array=$array_data;
}

}
?>