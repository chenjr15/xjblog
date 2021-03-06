
<?php
define('DBHOST', '127.0.0.1');
define('DBUSER', 'www');
define('DBPWD', 'www_kouling');
define('DBNAME', 'www_blog');
define('LOGFILE','../xjblog.log');
date_default_timezone_set('PRC');
function tolog($data,$filename =null){
    if ($filename == null)$filename = LOGFILE;
    $f= fopen($filename,'a');
    fwrite($f,date("[m-d H:i:s]").$data."\n");
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
function execSQL($sql,$kv=null,&$s = null){
    //$sql = addslashes($sql);
    //echo $sql;
    tolog($sql."\n\t".json_encode($kv));
    $dbh = connectDB();
    $prepared = $dbh->prepare($sql);
    if($kv)
        $ret = $prepared->execute($kv);
    else 
        $ret = $prepared->execute();
    $s = $ret;
    $dbh=null;
    if($ret){
        $ulist = $prepared->fetchAll(PDO::FETCH_ASSOC);
        tolog(json_encode($ulist));
        if(empty($ulist)){
            tolog("Empty list!");
            return false;
        }else {
            //tolog(json_encode($ulist));
            return $ulist;
        }
    } else {
        tolog("RET is NULL");
        return false;
    }
    


}
function getUserName($uid){
    $dbh = connectDB();
    
    $sql = "SELECT name FROM `user_info` WHERE `UID` = :uid ";
    $kv = array("uid"=>$uid);
    //echo $sql;
    $ulist = execSQL($sql,$kv);
    $dbh=null;
    if(empty($ulist))
        return null;
    else {
        return $ulist[0]['name'];
        
    }
}
function getUID($username){
    
    //tolog("in get uid");
    $sql = "SELECT UID FROM `user_info` WHERE `name` = :username ";
    //echo $sql;
    $kv = array("username"=>$username);
    $ulist = execSQL($sql,$kv);
    if(empty($ulist))
        return null;
    else {
        return $ulist[0]['UID'];
    }
}
function getUidByTid($tid){
    $sql = "SELECT `uid` FROM `post` where `id` = :id ";
    $uid = null;
    //if(array_key_exists('uid',$_SESSION)&&islogined())
    $arr=execSQL($sql,array("id"=>$tid))[0];
    if($arr)
        if(array_key_exists("uid",$arr))
            $uid = $arr["uid"];
    //tolog("quired uid of $tid is $uid");
    return intval($uid);

}
function isAdmin($uid){
    if($uid == 1)
    return TRUE;
}

function getUidByCid($cid){
    $sql = "SELECT `uid` FROM `comment` where `id` = :id ";
    $uid = null;
    //if(array_key_exists('uid',$_SESSION)&&islogined())
    $arr=execSQL($sql,array("id"=>$cid))[0];
    if(array_key_exists("uid",$arr))
        $uid = $arr["uid"];
    //tolog("quired cid of $tid is $uid");
    return intval($uid);

}

function haveDeletePermission($uid,$id,$type = 1){
    tolog("checking whether user $uid can delete text $id, type $type");
    if($type == 1)
        return ($uid == getUidByTid($id))||(isAdmin($uid)&&islogined());
    else 
        return ($uid == getUidByTid($id))||(isAdmin($uid)&&islogined())||($uid == getUidByCid($id));
}

?>

