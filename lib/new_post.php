<?php
require_once 'db.php';
if(empty($_POST['title']))
    {
        die("please input title!");
    }
if(empty($_POST['content']))
    {
        die("please input content!");

    }
if(empty($_POST['anonymous'])||$_POST['anonymous']=='0')
    {
        die("please login first");

    }
$uid=2;
date_default_timezone_set('PRC');
$datetime= date("Y-m-d H:i:s");

$sql = "INSERT INTO `post` (`id`, `title`, `content`, `time`, `uid`) VALUES (NULL,  :title , :content , :time ,:uid );";
$kv = array(
    "title" =>$_POST['title'],
    "content" =>$_POST['content'],
    "time" =>$datetime,
    "uid" =>$uid,
    );
$ret = false;
execSQL($sql,$kv,$ret );

//var_dump($ret);
if($ret){

    echo '<h3 style = "text-align:center;">Post success!</h3>';
}
else{
    echo '<h3 style = "text-align:center;">Post Failed!</h3>';
}
?>
<script language="javascript" type="text/javascript"> 

    setTimeout("javascript:location.href='../index.php'", 30000); 
</script>
