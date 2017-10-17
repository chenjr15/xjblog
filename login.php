<?php
require_once 'lib/db.php';
require_once 'lib/session.php';
function checkpwd($user , $pwd){
    
    $sql = "SELECT password FROM `user_info` WHERE `name` = :user ;";
    
    $ulist = execSQL($sql,array("user"=> $user));
    if(empty($ulist))
        return false;
    else {
        //tolog($ulist[0]['password']."::".$pwd);
        return $ulist[0]['password'] ==  $pwd;
        
    }
}

function OnSuccess($username){
    
    setcookie("xjbu",getUID($username));
    updateSessionDB(session_id(),getUID($username),$username,1, date("Y-m-d H:i:s"));
    //tolog("Login success here.");
}
function OnFailed(){
    echo "Username or password is wrong!<br>";
    //tolog("Login Fail here.");
}
@session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (empty($_POST['username'])){
        die("Please input username!");
    } 
    if(empty($_POST['password'])){
        die("Empty password!");
    }
    if(empty($_POST['type'])){
        die("Unknow type!");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    if($_POST['type']=="SignIn"){
        $varifed = checkpwd($username, $password);
        if($varifed){
            OnSuccess($username);
            header("location:/");
        }else{
            OnFailed();
        }
    }else{
        header("location:register.html");
    }
    
}//post
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
}//get
$logined = islogined();
if(intval($logined)==1){
    echo "Welcome <a href=me.php>".$s['name']."</a><br>";
    echo '<a href="logout.php">Log out</a>';
}else{

    require 'loginfrom.html';
}

?>
