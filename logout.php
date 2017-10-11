<?php
require_once 'lib/db.php';
require_once 'lib/session.php';
@$s_id = $_COOKIE[session_name()];
if($s_id ){
    $s =  querySession($s_id);
    //print_r($s);
    if ($s){
        foreach($s as $key=>$value){
            $_SESSION[$key] = $value;
        }
    }
}
$_SESSION["logined"] = 0;
updateSessionDB($s_id,$_SESSION['UID'],$_SESSION['name'],0,date("Y-m-d H:i:s"));
session_destroy();
header("location:/");
