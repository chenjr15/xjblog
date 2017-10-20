

<?php 
require_once 'lib/db.php';
require_once 'lib/session.php';

$sql = "SELECT * FROM post ";

$posts=execSQL($sql);

if(!empty($posts)){
    //echo $posts;
    foreach ($posts as $p) {
        echo '<div style="width:80%;margin: auto">';
        echo '<h2 style="text-align:center">'.$p['title'].'</h2>';
        echo '<h6 style="text-align:right">by '.getUserName($p['uid'])."|".$p['time'].'</h6><br>';
        echo '<p style="text-indent:50px;"> '.$p['content'].' </p>';
        if(haveDeletePermission(uidNow(1),$p['id']))
            echo '<div style="text-align:right" ><a href="lib/delete_post.php?id='.$p['id'].'">delete</a></div>';
        echo '<hr style="width:100%"></div>';

    }
}else {
    echo "<h2 style='color:red;text-align:center'>No post yet!</h2>";
}

?>

