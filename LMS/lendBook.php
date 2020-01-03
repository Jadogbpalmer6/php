<?php
#...author = UWIZEYE JEAN DE DIEU
#all rights reserved 

#dashboard elements
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']=='librarian') {
        include 'headerlibrarian.php';
    }
    elseif ($_SESSION['user']=='assistant') {
        include 'headerassistant.php';
    }
    else{
        echo "no user set";
    }

#database connection using mysql and mysqli
    $conn=mysqli_connect('localhost','root','','library managment')or die(mysqli_error($conn));


//this is the function to generate id automatically by calling it 

function getId(){
	 $alphabets=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	 $randomId=date('y').rand(0,9).$alphabets[rand(0,25)].rand(0,9).$alphabets[rand(0,25)].rand(0,9).$alphabets[rand(0,25)].rand(0,9);

	 $conn=mysqli_connect('localhost','root','','library managment')or die(mysqli_error($conn));
	 $sql0="select * from lentbooks where lentBookId='$randomId'";
	 $querySql0=mysqli_query($conn,$sql0);
	 if (mysqli_num_rows($querySql0)==0) {
	 	return $randomId;

	 }else{
	 	//the function will always try to find a unique id by recursion
	 	getId();
	 }

}
# getting the data submitted from the form
$bookCode=$_GET['bookCode'];
$dateReturn=$_GET['dateReturn'];
$borrowerName=$_POST['bname'];
$borrowerPwd=$_POST['password'];
$queryBorrower = mysqli_query ($conn,"select * from borrowers where borrowerName='$borrowerName' AND borrowerPassword='$borrowerPwd' ")or die(mysql_error());
while ($borrower=mysqli_fetch_assoc($queryBorrower)) {

	if (mysqli_num_rows($queryBorrower)==1) {
		$querySql1=mysqli_query($conn,"select * from books where bookCode='$bookCode' ");
		//get an id to uniquelly identify it
		$lentBookId=getId();
		if($numberOfBooks=mysqli_num_rows($querySql1)==1){
			while($data=mysqli_fetch_assoc($querySql1)){
					$bookId=$data['bookId'];
					// then check if there is no record that the book is allready lent
					 $sql2="select * from lentbooks where bookId='$bookId'";
			        $querySql2=mysqli_query($conn,$sql2)or die(mysqli_error($conn,));
			        if (mysqli_num_rows($querySql2)==1) {
			            $msg="it seemz as if that book is allready lent ";
					header("location: library.php?message=$msg");

			        }
			        else{
			        	$dateLent=date('20y-m-d');
							$querySql3=mysqli_query($conn,"INSERT INTO lentbooks VALUES('".$lentBookId."','".$bookId."','".$dateLent."','".$dateReturn."','".$borrowerName."','".$borrower['borrowerId']."')")or die(mysqli_error($conn));
								$msg="you have successfully lended that book to $borrowerName";
								header("location: library.php?message= $msg");
							}
						}
					}
							else{
		echo "it seems there is no book in the library with that code or there are more than one book in the library with that code";
	}
			}
			else{
	echo"problem with your password or name";
}

}

	}




?>


