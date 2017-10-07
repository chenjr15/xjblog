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
                    <input type="submit" value="SignIn" style="width:18%">
                </div> 
                <div>Password: 
                    <input type="password" name="password" value="" style="width:40%">
                    <input type="submit" value="SignUp" style="width:18%">
                </div>
            </form>
            
        </div>
        
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
   
</style>
</html>
