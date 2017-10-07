<?php
define('DBHOST', 'localhost');
define('DBUSER', 'wwww');
define('DBPWD', 'www_kouling');
define('DBNAME', 'www_blog');


function connectDB( )
{
    $conn = mysql_connect(DBHOST,DBUSER,DBPWD);
    if(!$conn)return NULL;
    echo 'connect success<br>';
    mysql_select_db(DBNAME);
    return $conn;

}



?>
