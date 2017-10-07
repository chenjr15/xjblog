
<?php
define('DBHOST', '127.0.0.1');
define('DBUSER', 'www');
define('DBPWD', 'www_kouling');
define('DBNAME', 'www_blog');


function connectDB( )
{
    $dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME;
   // echo $dsn.'<br>';
    try{
        $dbh = new PDO($dsn, DBUSER, DBPWD);
    }catch(PDOException $e){
        $encode = mb_detect_encoding($e->getMessage(),array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
        $errmsg = $str_encode = mb_convert_encoding($e->getMessage(), 'UTF-8', $encode);
        die("连接数据库失败<br>".$errmsg);
    }
  
    //echo 'connect success<br>';
   
    return $dbh;

}



?>

