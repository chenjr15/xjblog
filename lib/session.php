<?php
require_once 'db.php';
@session_start();
function querySession($SID){
    $sql = "SELECT UID,name,logined,startime FROM `sessions` WHERE `SID` = :SID ";
    $kv = array(
        "SID"=>$SID
    );
    $ret = execSQL($sql,$kv);
    if($ret){  
        return $ret[0];
    }
    else return null;
}
function addSessionToDB($SID,$UID,$name,$logined,$startime){
    $sql ="INSERT INTO `sessions` (`id`, `SID`, `UID`, `name`, `logined`, `startime`)";
    $sql =  $sql." VALUES (NULL, :SID ,:UID , :name  , :logined  , :startime  );";
    $kv = array(
        "SID"=>$SID,
        "UID"=>$UID,
        "name" => $name,
        "logined" => $logined,
        "startime" => $startime,
    );
    $ret = execSQL($sql,$kv);
    return $ret;
}
function updateSessionDB($SID,$UID,$name,$logined,$startime){
    $ulist = querySession($SID);
    $session_existed = 0;
    //tolog("in update session ulist:".json_encode($ulist));
    //check whether the session have already existed
    if(!empty($ulist)){
        $session_existed = 1;
        
        //header("Location:/");
    }
    if($session_existed == 1){
        $sql = "UPDATE `sessions` SET `UID` = :UID ,`name` = :name , `logined` = :logined ,`startime`=:startime  WHERE `sessions`.`SID` = :SID";
        $kv = array(
            "name"=>$name,
            "logined"=> $logined,
            "startime"=>$startime,
            "SID"=>$SID,
            "UID"=>$UID
        );
        $ret = execSQL($sql,$kv);
    }else{
        //tolog("to add session");
        $ret=addSessionToDB($SID,$UID,$name,$logined,$startime);
    }
    //update info into $_SESSION
   foreach($kv as $key=>$val){
       $_SESSION[$key] = $val;
   }

    return $ret;
}
function uidNow($logined_require= 1){
    //tolog(json_encode($_SESSION));
    if(array_key_exists('UID',$_SESSION))
        $uid = $_SESSION['UID'];
    else 
        $uid = null;
    if($logined_require&&!islogined()){
        $uid = null;
        
    }

    tolog(sprintf("uid is %d",$uid));
    return $uid;
    
}
function islogined(){
    if(array_key_exists('logined',$_SESSION))
        $logined = $_SESSION['logined'];
    else 
    $logined = 0;
    return $logined;
}