<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XJBlog</title>

</head>

<div style="width:60%;margin: auto ;">
   

<?php
require_once "lib/session.php";
require_once "lib/comment.php";
require "header.html";


echo "<h3>My Post</h3><hr>";
$sql = "SELECT * FROM post WHERE `uid` = :uid ";

$posts=execSQL($sql,array("uid"=>uidNow()));

if(!empty($posts)){
    //echo $posts;
    foreach ($posts as $p) {
        echo '<div style="width:80%;margin: auto">';
        echo '<h2 style="text-align:center">'.$p['title'].'</h2>';
        echo '<h6 style="text-align:right">by '.getUserName($p['uid'])."|".$p['time'].'</h6><br>';
        echo '<p style="text-indent:50px;"> '.$p['content'].' </p>';
        if(haveDeletePermission(uidNow(1),$p['id']))
            echo '<div style="text-align:right" ><a href="lib/delete_post.php?id='.$p['id'].'">delete</a></div>';
        show_comments($p['id'],uidNow());
        echo '<hr style="width:100%"></div>';

    }
}else {
    echo "<h2 style='color:red;text-align:center'>No post yet!</h2>";
}

?>

</div>