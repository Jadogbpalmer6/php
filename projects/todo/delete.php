<?php
session_start();
$tableName=$_SESSION['userName'];
$conn=mysqli_connect('localhost', 'jado_6','<1379>j@6','todo')or die (mysqli_error($conn));
$sql="delete from $tableName where eventId=".$_GET['id'];
if($query=mysqli_query($conn,$sql)){
	header('location: todo.php');
}
else{
	die(mysqli_error());
}