
<?php
define('DBHOST', '127.0.0.1');
define('DBUSER', 'www');
define('DBPWD', 'www_kouling');
define('DBNAME', 'www_blog');
define('LOGFILE','../xjblog.log');

function tolog($data,$filename =null){
    if ($filename == null)$filename = LOGFILE;
    $f= fopen($filename,'a');
    fwrite($f,date("[Y-m-d H:i:s]").$data."\n");
    fclose($f);

}

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
function execSQL($sql){
    //$sql = addslashes($sql);
    //echo $sql;
    tolog($sql);
    connectDB();
    $dbh = connectDB();
    $ret=$dbh->query($sql);
    if($ret){
        $ulist = $ret->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        if(empty($ulist))
            return false;
        else {
            return $ulist;
        }
    } else {
        return null;
    }
    


}
function getUserName($uid){
    $dbh = connectDB();
    
    $sql = "SELECT name FROM `user_info` WHERE `UID` = ".intval($uid)." ";
    //echo $sql;
    $ret=$dbh->query($sql);
    $ulist = $ret->fetchAll();
    $dbh=null;
    if(empty($ulist))
        return null;
    else {
        return $ulist[0]['name'];
        
    }
}
function getUID($username){
    
    
    $sql = "SELECT UID FROM `user_info` WHERE `name` = '".$username."' ";
    //echo $sql;
    $ulist = execSQL($sql);
    if(empty($ulist))
        return null;
    else {
        return $ulist[0]['UID'];
        
    }



}


?>

