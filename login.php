<?php
require_once 'lib/db.php';
function checkpwd($user , $pwd){
    connectDB();
    mysql_query("SELECT password FROM user_info WHERE name = $user");
    

}
if ($_POST['username']&& $_POST['password']){



}



?>