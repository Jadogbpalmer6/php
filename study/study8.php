<?php 
	$conn=mysqli_connect('localhost','root','','study4')or die(mysql_error());
	if (isset($_POST['submit'])) {
		$UN=$_POST['UserName'];
		echo $UN;
		$sql="select * from users where userName= 'jado';INSERT INTO users(id, userName, password) VALUES (3,'injected','12'); ";
		mysqli_query($conn,$sql) or die(mysqli_error($conn));
		echo "logged in as $UN";

	}
	else{
			echo "<!DOCTYPE html>
				<html>
				<head>
					<title> SQL INJECTION </title>
				</head>
				<body>
				<form method='POST' action='study8.php' >
					<input type='text' name='UserName'><br/>
					<input type'password' name='password'><br/>
					<input type='submit' name='submit' value='login'>
				</form>
				</body>
				</html>
			";
}
?>