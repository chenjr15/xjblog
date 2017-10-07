<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Users</title>
</head>
<body>
<?php
require_once 'db.php';
$dbh = connectDB();
if($dbh)echo 'connect success<br>';
else{ 
    echo 'connect failed<br>';
    
}
//$result=mysqli_query("SELECT UID, name,gender,age FROM userinfo ");
//$dc = mysql_num_rows($result);
//echo "All $dc users <br>";
echo "<table><tr><th>UID</th><th>name<th><th>gender</th><th>age</th></tr>";
$ret = $dbh->query("SELECT UID, name,gender,age FROM user_info ");
if($ret) echo "query success";
foreach ($ret as $ret_arr) {
    # code...

	
    echo "<tr>";
    $uid=$ret_arr['UID'];
    $name = $ret_arr['name'];
    $gender = $ret_arr['gender'];
    $age = $ret_arr['age'];

	echo "<td>$uid</td>";
    echo "<td>$name</td>";
    echo "<td>$gender</td>";
    echo "<td>$age</td>";
	echo "</tr>";
}
echo "</table>";
?>
</body>
</html>

