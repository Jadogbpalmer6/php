<?php
session_start();
 echo "here";
  $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
if (isset($_SESSION['user'])) {
    echo "  2";
    if ($_SESSION['user']=='librarian') {
        include 'headerlibrarian.php';
    }
    elseif ($_SESSION['user']=='assistant') {
        include 'headerassistant.php';
    }
    else{
        echo "no user set";
    }

    $id=$_GET['id'];
    mysqli_query($conn,"DELETE from punishments where punishmentId='$id'") or die(mysqli_error($conn)); 
    $msg="you have succesfully removed that punishmnet";
    header("location:dashboard.php?message=$msg");
}
echo "  3";
?>
