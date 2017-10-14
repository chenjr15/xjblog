<?php
require_once 'db.php';
if(!empty($_GET['id'])){
    $tid= intval( $_GET['id']);

    $sql = "DELETE FROM `post` WHERE `post`.`id` = :tid;";
    $kv = array(
        "tid"=> $tid
    );
    //echo $sql;
    //tolog("delete here");
    $ret = false;
    execSQL($sql,$kv,$ret );

    echo '<h3 style = "text-align:center;">';
    //var_dump($ret);
  
    if($ret){
        echo "Success!";
    }else{
        echo "Failed!";
    }

}
?>
</h3>
<script language="javascript" type="text/javascript"> 

    setTimeout("javascript:location.href='../index.php'", 3000); 
</script>