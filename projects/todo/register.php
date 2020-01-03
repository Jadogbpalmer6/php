<?php

$conn=mysqli_connect('localhost', 'jado_6','<1379>j@6','todo')or die (mysqli_error($conn));

	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$userName=$_POST['userName'];
	$password=$_POST['password'];

		//this did not happen to work
		// function Check_if_all_are_provided(){

		// 	if (!isset($_POST['firstName'])) {
		// 		#check whether firstName is given
		// 		header("location: error.php?error='first Name'");
		// 	}
		// 	if (!isset($_POST['lastName'])) {
		// 		#check whether lastName is given
		// 		header("location: error.php?error='last Name'");
		// 	}
		// 	if (!isset($_POST['userName'])) {
		// 		#check whether userName is given
		// 		header("location: error.php?error='user Name'");
		// 	}
		// 	if (!isset($_POST['password'])) {
		// 		#check whether password is given
		// 		header("location: error.php?error='password'");
		// 	}
		// }// end of function
		// Check_if_all_are_provided();
	

	
	echo "hello $userName ".'<br/>';

	// this below is the SQL query to create a table to store the events of this user
	$sql2="create table $userName(      
	eventId int PRIMARY KEY not null,
	Name varchar(20) not null,
	content text not null );";

	//this one is the SQL code to ensert the user in the user table
	$sql1="insert into users(firstName,lastName,userName,userPwd) values ('$firstName','$lastName','$userName','$password')";
// here u need to check whether ther is no other users
//?with the provided info

	$sql3="select * from users where userName='%$userName%'";
	$result=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
	if(mysqli_query($conn,$sql2)){
		mysqli_query($conn,$sql1) or die(mysqli_error($conn));
		echo "successfully registerd as ".$userName;
		echo "<a href='login.php'>  login then  </a> to create todos or to see ur todos";
	}
	else{
		die("that user name allready registerd");
	}

?>