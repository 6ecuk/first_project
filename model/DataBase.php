<?php
/**
 * Класс для работы с базой данных проекта.
 * Добавление данных в базу данных.
 */

class model_dataBase {
private $content;
private $login='root';
private $password='root';

function __construct($data)
{
    $this->content=$data;
   $this->DatabaseInsert();
}
private function DatabaseInsert (){
    try{
$dbh = new PDO('mysql:host=localhost;dbname=test', $this->login, $this->password);
        foreach ($this->content as $key =>$value ){
            $url=$key;
            $header=$this->content[$key]['header'][1][0];
            $time=$this->content[$key]['time'][1][0];
            $content=$this->content[$key]['text_content'][0][0];
            $dbh->beginTransaction();
            $query="INSERT INTO content(URL,Header,Time,Content) values (:url,:header,:time,:content)";
            $sth=$dbh->prepare($query);
            $sth->bindParam(':url',$url);
            $sth->bindParam(':header',$header);
            $sth->bindParam(':time',$time);
            $sth->bindParam(':content',$content);
            $sth->execute();
            $dbh->commit();
        }
    }
    catch(PDOException $error)
    {
        echo $error->getMessage();
    }


}
}