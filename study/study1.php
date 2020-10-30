<!DOCTYPE html>
<html>
<head>
	<title>study1</title>
</head>
<body>
<?php
echo"<h1> study1 </h1>";
$name = array('name' =>'jado' ,'age'=>16,'career'=>'software developer' );
echo '<pre>';
print_r($name);
echo '</pre>';
echo 'in a table <br/>';
echo "<table bgcolor='white' border='3' cellspacing='4' cellpadding='4'>";
foreach ($name as $key => $value) {
	# code...
	echo '<tr><td>'.ucwords($key).'</td><td>'.$value.'</tr>';
}
echo '</table><br/>';
//$age=17;
//echo $name.$age
echo "here is arandom number btn 1 and 20<br/>";
echo rand(1,20);
//this is impossible it's an error 
// global $jj=5;
echo "<br/> ";
$tmzone=date_default_timezone_get();
date_default_timezone_set($tmzone);
echo date('h:i:s');
?>
</body>
</html>