<?php
require_once 'db.php';

$required_keys=array(
	"username",
	"password", 
	"email",
	"phone",
);
$detail_keys=array(
	"gender",
);
$kv = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($required_keys as $key){
		if(!array_key_exists($key , $_POST)){
			die("Please input $key !");
		}else{
			$kv[$key] =  $_POST[$key];
		}
	}
	if($_POST["password2"] !=$kv["password"] ){
		die("please confirm you password! ");
	}
	if(getUID($kv["username"])){
		die("Username have been taken by others, chose another name!");
	}
	if(getUID($kv["email"])){
		die("You have alread regisered!");
	}
	$sql = "INSERT INTO `user_info` (`UID`, `name`, `password`, `email`,`phone`)".
	" VALUES (NULL, :username , :password , :email, :phone )";
	$s=false;
	execSQL($sql,$kv,$s);
	if($s){

		echo "Register success!";
	}else{
		echo "Register failed!";
	}


}
?>
<script src="jump.js"></script>