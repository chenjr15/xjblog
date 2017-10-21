

<?php
require_once "session.php";
function show_comments($tid,$viwer){
    
    $sql = "SELECT * FROM comment WHERE `tid` = :tid ";

    $comments=execSQL($sql,array("tid"=>$tid));

    if($comments){
        echo '<div  class = "comment_box" style="text-align:right">';
        echo '<table  style="width:100%">';
        foreach($comments as $comment){
            echo '<td><span>';
            
            echo '</sapn></td> <td colspan = "8"><span>';
            echo $comment['text'];
            echo '</span></td><td><span>--';
            echo getUserName($comment['uid']);
            echo '&nbsp</span>';
            if(haveDeletePermission($viwer,$comment['id'],2))
                echo '<a href="lib/comment.php?action=del&cid='.$comment['id'].'">delete</a>';
            echo '</td>';
        }
        echo' </table>';
    }
?>
    <div>
        <form class="comment form" action="lib/comment.php?action=add" method="post" style="width=100%">

            <div style="width:100%">
                <input type="text" id="comment_text" class="post_" name = "text" wrap="virtual" placeholder="Your comment here" ></input>
            </div>
            
            <div style = "margin-right:0">
                <input type="checkbox" name="anonymous" value=1>Anonymous
                <input type="submit" name="comment" id="cmt_cnt_btn" value="add comment">
                <input type="reset" value = "reset">
                <input type="text" name="tid" value="<?php echo $tid; ?>" hidden >
            </div>
        
        </form> 
    </div>
</div>
    
<?php } 

function add_comment($tid,$text,$uid){
    $s=0;
    $sql = "INSERT INTO `comment` (`id`, `tid`, `uid`, `text`, `add_time`, `last_modified`) VALUES (NULL, :tid, :uid, :text, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
    execSQL($sql,array("uid"=>$uid,"tid"=>$tid,"text"=>$text),$s);
    return $s;
}
function del_comment($cid){
    if(haveDeletePermission(uidNow(),$cid,2)){
        $status=FALSE;
        $sql = "DELETE FROM `comment` WHERE `comment`.`id` = :cid";
        execSQL($sql,array("cid"=>$cid),$status);
        return $status;

    }
    return FALSE;

}
$ret = FALSE;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($_GET['action']=='add'){
        if(empty(($_POST['anonymous'])||$_POST['anonymous']=='0')&&islogined() == 0)
        {
            die("please login first");
    
        }
        if(empty($_POST['text']))
        {
            die("please input content!");
    
        }
        if(array_key_exists('anonymous',$_POST))
            if($_POST['anonymous']=='1')
                $reviewer=2;
            else
                $reviewer=uidNow();
        $ret = add_comment($_POST['tid'],$_POST['text'],$reviewer);

    }
}else if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(array_key_exists('action',$_GET))
        if ($_GET['action']=='del')
        $ret = del_comment($_GET['cid']);
}
if((array_key_exists('action',$_GET) )||($_SERVER['REQUEST_METHOD'] == 'POST')){
    ?>
    <html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        
    
    <?php
    if($ret){
            echo '<h3 style = "text-align:center;">Operation success!</h3>';
        }
        else{
            echo '<h3 style = "text-align:center;">Operation Failed!</h3>';
        }

?>
</body>
</html>
        <script src="jump.js"></script>
<?php
}
   


