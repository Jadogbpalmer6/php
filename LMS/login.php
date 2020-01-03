<?php
session_start();
$correctUserEmail="indigo@indigo.inc";
$correctUserPwd=1234567890;
$password=$_POST['password'];
$email=$_POST['email'];
echo $_POST['assistant'];
if ($email==$correctUserEmail) {
    if($password==$correctUserPwd){
        if (isset($_POST['librarian'])) {
        	$_SESSION['user']="librarian";
        	header('location:dashboard.php');
        }
        elseif (isset($_POST['assistant'])) {
        	$_SESSION['user']="assistant";
        	header('location:dashboard.php');
        }
        elseif (isset($_POST['manager'])) {
        	$_SESSION['user']="manager";
        	header('location:dashboard.php');
        }
        else{
        	echo "fuck sdfghjkljhfdsdfg.h/jk";
        }
        

    }
    else {
        echo" encorrect user password ";    
    }
}
else{
    echo" encorrect user email<br/>";
    echo"<a href='index.html'>go back<a/>";
}
?>