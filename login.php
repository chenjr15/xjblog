<?php
require_once 'lib/db.php';
require_once 'lib/session.php';
function checkpwd($user , $pwd){
    
    $sql = "SELECT password FROM `user_info` WHERE `name` = '$user' ;";
    
    $ulist = execSQL($sql);
    if(empty($ulist))
        return false;
    else {
        tolog($ulist[0]['password']."::".$pwd);
        return $ulist[0]['password'] ==  $pwd;
        
    }
}

function OnSuccess($username){
    
    setcookie("xjbu",getUID($username));
    updateSessionDB(session_id(),getUID($username),$username,1, date("Y-m-d H:i:s"));

    

}
function OnFailed(){
    echo "Username or password is wrong!<br>";

}
@session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (empty($_POST['username'])){
        die("Please input username!");


    } if(empty($_POST['password'])){
        die("Empty password!");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $varifed = checkpwd($username, $password);
    if($varifed){
        OnSuccess($username);
        header("location:/");
    }else{
        OnFailed();
    }
    
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){

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
}

if(intval($_SESSION['logined']==1)){
    echo "Welcome ".$s['name']."<br>";
    echo '<a href="logout.php">Log out</a>';
}else{

    require 'loginfrom.html';
}

?>
