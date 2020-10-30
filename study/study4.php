<!DOCTYPE html>
<html>
<head>
	<title>study 4</title>
</head>
<body>
	<h1> registering in the DB</h1>
	<form action="study4.php" method="POST">
		id: <input type="number" name="id"><br/>
		name: <input type="text" name="name"><Br/>
		password: <input type="text" name="password"><br/>
		<input type="submit" value="register" name="submit" align="center">
	</form>
<?php
session_start();
if (isset($_POST['submit'])){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$password=$_POST['password'];
	$conn=mysqli_connect('localhost','root','');
if ($conn){
    mysqli_select_db($conn,'study4'); // u can even not use this line if u add the DB name in the arguments of  mysqli_connect(); 
    $s="select * from users where name='$name'";
    $result=mysqli_query($conn,$s);  // same as $conn->query($s);
    $Result=mysqli_num_rows($result);// this function mysqli_num_rows() returns number of rows and is the same as writting $result->num_rows; 
    if ($Result==1) {
    	echo "name allready taken";
    }
    else{
    $query1="insert into users (id,name,password) values('$id','$name','$password')";
    $Query1=mysqli_query($query1);
    if($Query1){
    	echo "<br/><h3>registerd successfully<h3/><hr/><hr/>";
    }
    else{
    	echo "unable to add";
    }
}
}
}
?>
<br>
<a href="login.php"> login instead</a>
</body>
</html>