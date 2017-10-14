<?php
require_once 'lib/db.php';
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
        "name" => $name  ,
        "logined" => $logined ,
        "startime" => $startime ,
    );
    $ret = execSQL($sql,$kv);
    return $ret;
}
function updateSessionDB($SID,$UID,$name,$logined,$startime){
    $ulist = querySession($SID);
    $session_existed = 0;
    //tolog("in update session ulist:".json_encode($ulist));
    if(!empty($ulist)){ 
        $session_existed = 1;
        
        header("Location:/");
    }
    if($session_existed == 1){
        $sql = "UPDATE `sessions` SET  `name` = :name , `logined` = :logined ,`startime`=:startime  WHERE `sessions`.`SID` = :SID";
        $kv = array(
            "name"=>$name,
            "logined"=> $logined,
            "startime"=>$startime,
            "SID"=>$SID
        );
        $ret = execSQL($sql,$kv);
    }else{
        //tolog("to add session");
        $ret=addSessionToDB($SID,$UID,$name,$logined,$startime);
    }
    return $ret;
}