<?php
$conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
$querySql=mysqli_query($conn,"select * from books ");
$numberOfBooks=mysqli_num_rows($querySql);
 function getId(){
	 $alphabets=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	 $randomId=date('y').$alphabets[rand(0,25)].$alphabets[rand(0,25)].$alphabets[rand(0,25)].rand(1,1000);
	 $sql0="select * from books where bookId='$randomId'";
	 $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
	 $querySql0=mysqli_query($conn,$sql0);
	 if (mysqli_num_rows($querySql0)==0) {
	 	return $randomId;

	 }else{
	 	getId();
	 }
}

if ($bookName=$_POST['bookName']) {
	if ($category=$_POST['category']) {
		if ($author=$_POST['author']) {
					if($bookCode=$_POST['bookCode']){
						if ($dateR=$_POST['dateReceived']) {
							$bookId=getId();
							$sql1="insert into books(bookId,bookCode,bookTittle,bookAuthors,bookCategory,dateReceived) values('$bookId','$bookCode','$bookName','$category', '$author','$dateR')";
							$querySql=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
							header("location: addBook.php?name=$bookName");
						}
						else{
							echo "please <a href=addBook.php>go back </a> to enter the date when book received";
						}
					}
					else {
						echo "please <a href=addBook.php>go back </a> to enter the code of the book received";
					}
				
		}
		else{
			echo "u did not give out the author of the book please<br/>";
			echo "<a href=addBook.php> go back</a> tho put in the author of the book ";
		}
	}
	else{
		echo "u did not give out the category of the book please<br/>";
		echo "<a href=addBook.php> go back</a> tho put in the category of the book ";
	}
}
else{
	echo "u did not give out the tittle of the book please<br/>";
	echo "<a href=addBook.php> go back</a> to put in the name of the book ";
}



?>