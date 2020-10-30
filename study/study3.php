<!DOCTYPE html>
<html>
<head>
	<title>study 3 todo</title>
</head>
<body>
	<?php
	echo "to day is :".date('l');
	?>
	<h1> adding data in the DB</h1>
	<form action="study3.php" method="POST">
		name: <input type="text" name="name"><br/>
		description :<textarea name="description"></textarea>
		<input type="submit" value="submit" name="submit" align="center">
	</form>
<?php
if (isset($_POST['submit'])){
	$name=$_POST['name'];
	$description=$_POST['description'];
	$conn=mysql_connect('localhost','root','');
if ($conn){
    echo"connection succesful";
    if(mysql_select_db('tododb')){
    echo "<br/> succesfuly selected db";
    echo "<br/><br/> $name, <br/> $description";
    $query1="insert into todo (name,description) values('$name','$description')";
    $Query1=mysql_query($query1);
    if($Query1){
    	echo "<br/><h3>added successfully</h3/><hr/><hr/>";
    }
    $query2="select description where name='jado'";
    $result=mysql_query($query2);
    echo $result;
}
}
}
?>
</body>
</html>