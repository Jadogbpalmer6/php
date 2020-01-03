<?php
session_start();
$tableName=$_SESSION['userName'];
$content=$_POST['content'];
$conn=mysqli_connect('localhost', 'jado_6','<1379>j@6','todo')or die (mysqli_error($conn));
$sql="insert into $tableName(content) values('$content')";
if($query=mysqli_query($conn,$sql)){
	header('location: todo.php');
}
else{
	die(mysqli_error($conn));
}
?>