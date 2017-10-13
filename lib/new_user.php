<?php
require_once 'db.php';

$required_keys=array("username",
"password", 
"password2",
"email",
"phone",);
$detail_keys=array(
"gender"
);
foreach($required_keys as $key){
	if(!array_key_exists($key,$_SESSION)){
		die("Please input $key !");
		}
	}
