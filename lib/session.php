<?php
require_once 'lib/db.php';
function querySession($SID){
    $sql = "SELECT UID,name,logined,startime FROM `sessions` WHERE `SID` = '$SID' ";
    $ret = execSQL($sql);
    if($ret){
        return $ret[0];
    }
    else return null;
}
function addSessionToDB($SID,$UID,$name,$logined,$startime){
    $sql ="INSERT INTO `sessions` (`id`, `SID`, `UID`, `name`, `logined`, `startime`)";
    $sql =  $sql." VALUES (NULL, '".$SID."' ,'".$UID."', '".$name." ', '".$logined." ', '".$startime."' );";
    $ret = execSQL($sql);
    return $ret;
}
function updateSessionDB($SID,$UID,$name,$logined,$startime){
    $ulist = querySession($SID);
    $session_existed = 0;
    if(!empty(ulist)) $session_existed = 1;
    if($session_existed == 1){
        $sql = "UPDATE `sessions` SET `SID` = '$SID', `name` = '$name', `logined` = '$logined' ,`startime`='$startime' WHERE `sessions`.`SID` = '$SID'";
        $ret = execSQL($sql);
    }else{
        $ret=addSeeionToDB($SID,$UID,$name,$logined,$startime);
    }
    return $ret;
}