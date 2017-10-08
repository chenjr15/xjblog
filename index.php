<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XJBlog</title>

</head>

<div style="width:60%;margin: auto ;">
    <div  style="background:#8d8d8d; height:100px"  >
        <div style="float:left;padding-left:45px;">
            <h1 style="color:white;" ><a href = "/" class="head"> XJBlog</a></h1>
        </div>

        <div style = "text-align:center;float:right;padding: 15px; ">
            <form action="login.php" method="post">
                <div>Username:  
                    <input type="text" name="name" value="" style="width:40%">
                    <input type="submit" name = "type" value="SignIn" style="width:18%">
                </div> 
                <div>Password: 
                    <input type="password" name="password" value="" style="width:40%">
                    <input type="submit"name = "type" value="SignUp" style="width:18%">
                </div>
            </form>
            
        </div>
        
    </div>
    <div id="post_row">
        <form action="lib/new_post.php" method="post">
            
            <div >
                <input type="text" name = "title" value="title here..." onfocus="if (this.value =='title here...')this.value='';" onblur="if (this.value =='')this.value='title here...'" class= "post_">
            </div>

            
            <div>
                <input type="text" name = "content"  value="Your content here" onfocus="if (this.value =='Your content here')this.value='';" onblur="if (this.value =='')this.value='Your content here'"  size=500 class= "post_ content">
            </div>
            
            <div style = "margin-right:0">
                <input type="checkbox" name="anonymous" value=1  >Anonymous
                <input type="submit" name="submit" id="post_cnt_btn" value="New Post">
                <input type="reset" value = "reset">
            </div>
            
        </form>   


    </div>
    <div>
        <?php
        require_once 'showpost.php';

        ?>

    </div>
  

</div>


<style type="text/css">

        a.head:link, a.head:visited, a.head:hover, a.head:active {
            color:  white;
            text-decoration: none
            }
        #post_row{
            width:80%;
            margin: 25px;
        }
        .post_{
            width:100%;
            

        }
     
        .content{
            text-align:left;
           
            height:100px;

        }
   
</style>
<div style = "text-align:center;">Copyright © 2017 XJBlog All Rights Reserved. </div>
</html>
