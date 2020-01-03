<!DOCTYPE html>
<html>
<head>
	<title>books view </title>
</head>
<body>
	<?php 
	$conn=mysqli_connect('localhost','root','','LMS') or die(mysqli_error($conn));
	$querySql=mysqli_query($conn,"select * from books ");
	$numberOfBooks=0;
	?>
<table cellspacing="0" cellpadding="40" border="black">
	<?php
		echo "<tr>";
		echo "<th>identifier </td>";
		echo "<th>book name </td>";
		echo "<th>book category </td>";
		echo "<th>book author</td>";
		echo "<th>number of books </td>";
	    echo "</tr>";
	while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
		echo "<tr>";
		echo " <td> $dataAray[bookId]"." </td>";
		echo "<td> $dataAray[bookName]"." </td>";
		echo "<td> $dataAray[category]"." </td>";
		echo "<td> $dataAray[author]"." </td>";
		echo "<td> $dataAray[bookNumbers]"." </td>";
		$numberOfBooks+=$dataAray['bookNumbers'];
	}
	echo "<p> there are $numberOfBooks books in the library </p>";
	?>
</table>
	<a href="dashboard.php"> go back to the dashboard</a>
</body>
</html>