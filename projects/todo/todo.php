<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>todo</title>
</head>
<body >
	<h1 align="center" > here are todos of yours <u><i> <?php echo $_SESSION['userName']; ?></u></i></h1>
	<table cellpadding="5" cellspacing="3" border="black">
		<form action="addTodo.php" method="POST">
				<?php

			$tableName=$_SESSION['userName'];
			$conn=mysqli_connect('localhost', 'jado_6','<1379>j@6','todo')or die (mysqli_error($conn));
			$sql="select * from $tableName";
			$query=mysqli_query($conn,$sql);
			if (mysqli_num_rows($query)>0) {
				$count=1;
				while ($dataArray=mysqli_fetch_assoc($query)) {
					echo "<tr>";
					echo "<td>$count : </td>";
					echo "<td>".$dataArray['content']."</td>" ;
					echo "<td><a href=delete.php?id=".$dataArray['eventId']. ">delete </a></td>";
					echo "</tr>";
					
				}
				echo "<input type='text' name='content'> <input type='submit' name='addTodo' value='add'> ";

			}
			else{
				echo "<h4 align='center'> no todo added yet</h4>please add some<br/> ";
				echo "<input type='text' name='content'> <input type='submit' name='addTodo' value='add'> ";
			}

			?>
		</form>
	</table>
	<hr>
	<a href="logout.php"> logout <?php echo $tableName ?></a>
</body>
</html>
