<?php
    $borrowerName=$_GET['borrowerName'];
if (isset($_POST['submit'])) {
    $borrowerName=$_GET['borrowerName'];
    $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
    $query=mysqli_query($conn,"SELECT * from borrowers where borrowerName='$borrowerName'")or die(mysqli_error($conn));
    while ($data=mysqli_fetch_assoc($query)) {
        $borrowerId=$data['borrowerId'];
    }
    //this is the function to generate id automatically by calling it 

    function getId(){
         $alphabets=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
         $randomId=date('y').rand(0,9).$alphabets[rand(0,25)].rand(0,9).$alphabets[rand(0,25)].rand(0,9).$alphabets[rand(0,25)].rand(0,9);

         $conn=mysqli_connect('localhost','root','','library managment')or die(mysqli_error($conn));
         $sql0="select * from punishments where punishmentId='$randomId'";
         $querySql0=mysqli_query($conn,$sql0);
         if (mysqli_num_rows($querySql0)==0) {
            return $randomId;

         }else{
            //the function will always try to find a unique id by recursion
            getId();
         }
     }

     $punishmentId=getId();
     $comment=mysqli_real_escape_string($conn,$_POST['comment']);
     $punishmentEnd=mysqli_real_escape_string($conn,$_POST['date']);
     mysqli_query($conn,"INSERT into punishments(borrowerId,borrowerName,comment,punishmentEnd,punishmentId) values('$borrowerId','$borrowerName','$comment','$punishmentEnd','$punishmentId')");
     $msg="you have succesfully punished $borrowerName the punishment will end on $punishmentEnd";
     header("location: dashboard.php?message=$msg");

}
else{
    session_start();
       $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
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
        $borrowerName=$_GET['bnm'];
        $sql1="select * from borrowers where borrowerName='$borrowerName'";
        $querySql1=mysqli_query($conn,$sql1);
        while ($data=mysqli_fetch_assoc($querySql1)) {
        	# 
        	$borrowerId=$data['borrowerId'];

        }
        $borrowerName=$_GET['bnm'];

    echo "<form action='punish.php?borrowerName=$borrowerName' method='POST'>
    <br>
    <textarea name='comment' placeholder='please comment on this punishment if you wish'></textarea><br>
    when will the punishment end<input type='date' name='date'><br>
    <input type='submit' name='submit' value='punish'>
</form>";

    }
}
?>