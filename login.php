<?php
require_once 'lib/db.php';
function checkpwd($user , $pwd){
    $dbh = connectDB();
    $sql = "SELECT password FROM `user_info` WHERE `name` = $user ";
    $ret=$dbh->query($sql);
    $ulist = $ret->fetchAll();
    if(empty($ulist))
        return null;
    else {
        return $ulist[0]['password'] ==  $pwd;
        
    }
    

}
if ($_POST['username']&& $_POST['password']){

    

}



?>