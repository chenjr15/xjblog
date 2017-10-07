<?php
define('DBHOST', '192.168.20.104');
define('DBUSER', 'wwww');
define('DBPWD', 'www_kouling');
define('DBNAME', 'www_blog');


function connectDB( )
{
    $conn = mysqli_connect(DBHOST,DBUSER,DBPWD);
    
    if(!$conn)return NULL;
    echo 'connect success<br>';
    mysql_select_db(DBNAME);
    return $conn;

}



?>
