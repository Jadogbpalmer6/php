<?php
$correctUserEmail="indigo@indigo.inc";
$correctUserPwd=1234567890;
$password=$_POST['password'];
$email=$_POST['email'];

if ($email==$correctUserEmail) {
    if($password==$correctUserPwd){
        session_start();
        header('location:dashboard.php');

    }else {
        echo" encorrect user password <br/>";
        echo"<a href='../index.html'>go back a <a/>";    
    }
}
else{
    echo" encorrect user email<br/>";
    echo"<a href='../index.html'>go back<a/>";
}
?>
