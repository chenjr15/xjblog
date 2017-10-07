<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>
<body>
<?php 
require_once 'lib/db.php';
$dbh = connectDB();
if(!$dbh) echo "Empty db!<br>";

$sql = "SELECT * FROM post ";

$posts=$dbh->query($sql);

if(!empty($posts)){
    //echo $posts;
    foreach ($posts as $p) {
        echo '<div style="width:50%;margin: auto">';
        echo '<h2 style="text-align:center">'.$p['title'].'</h2>';
        echo '<h6 style="text-align:right">by '.$p['uid']."|".$p['time'].'</h6><br>';
        echo '<p style="text-indent:50px;">'.$p['text'].'</p>';
        echo '<hr style="width:90%"></div>';

    }
}else {
    echo "<h2 style='color:red;text-align:center'>No post yet!</h2>";
}


$dbh=null;
?>
    
</body>
</html>
