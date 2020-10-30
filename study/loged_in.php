<?php

session_start();
echo ("succesflly loged in as  ".'<u>'.$_SESSION['username'].'<u/>');
?>
<!DOCTYPE html>
<html>
<head>
	<title>loged in</title>
</head>
<body>
	<br>
<a href="logout.php"> logout</a>
</body>
</html>