<!DOCTYPE html>
<html>
<head>
	<title>login </title>
</head>
<body>
<form action="login.php" method="POST">
	name: <input type="text" name="name"><br>
	password :<input type="password" name="pass"><br>
	<input type="submit" name="submit" value="login">
</form>
</body>
</html>

<?php
session_start();
if (isset($_POST['name'])&&isset($_POST['pass'])){
$con=mysqli_connect('localhost','root','');

mysqli_select_db($con,'study4');
$name=$_POST['name'];
$password=$_POST['pass'];
$s="select * from users where name='$name' && password='$password'";
$result=mysqli_query($con,$s);
$check=mysqli_num_rows($result);
if ($check==1) {
	$_SESSION['username']=$name;
	header('location:loged_in.php');
}
else {
	echo "empossible to login";
}
}
?>