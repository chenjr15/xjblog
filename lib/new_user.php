<?php
require_once 'db.php';

$required_keys=array(
	"username",
	"password", 
	"password2",
	"email",
	"phone",
);
$detail_keys=array(
	"gender",
);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($required_keys as $key){
		if(!array_key_exists($key , $_POST)){
			die("Please input $key !");
			}
		}
		
}