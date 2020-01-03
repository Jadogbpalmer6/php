<?php 
//logout.php
session_start();
session_destroy();
echo " succefully logged out <hr>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>logout</title>
</head>
<body>
<a href="login.php">login </a> as an other user or as u again<br>or
<a href="index.php"> register</a>
</body>
</html>