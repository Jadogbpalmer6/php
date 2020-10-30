<!DOCTYPE html>
<html>
<head>
	<title>study 6</title>
</head>
<body>
<?php

$br="<br/>";
$con=mysqli_connect('localhost', 'jado_6','<1379>j@6','study4');
$sql="select * from users1";
if($result=$con-> query($sql)){
	echo "wow";
}
//if ($result-> num_rows()>0) {
if (mysqli_num_rows($result)>0) {
	//while ($data=$result->fetch_assoc()) {
	echo "<table cellspacing='20' cellpadding='2'> ";
	while ($data=mysqli_fetch_assoc($result)) {
		echo"<tr><td>". $data['email']."</td><td>".$data['password']."</td></tr>";
	}
	echo "</table";
}

?>
</body>
</html>