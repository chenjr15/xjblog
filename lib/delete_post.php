<?php
require_once 'db.php';
require_once 'session.php';


if(!empty($_GET['id'])){
    $tid= intval( $_GET['id']);

    $ret = false;
    do{
        if($tid == 0)       break;
        if(!islogined())    break; 
        $uid=uidNow();
        if(haveDeletePermission($uid,$tid)){
            $sql = "DELETE FROM `post` WHERE `post`.`id` = :tid;";
            $kv = array(
                "tid"=> $tid
            );
            //echo $sql;
            //tolog("delete here");
            execSQL($sql,$kv,$ret );
        }
      
    }while(0);
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
<script src="jump.js"></script>