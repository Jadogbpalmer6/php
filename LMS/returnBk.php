<?php 
    $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
    $querySql=mysqli_query($conn,"select * from lentbooks ");
    $numberOfBooks=mysqli_num_rows($querySql);
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
    $id=$_GET['id'];
    $sql="select * from lentbooks where lentBookId='$id'";
    $querySql=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    while ($data=mysqli_fetch_array($querySql)) {
        echo "<script type='text/javascript'>alert('you are about to remove a book which was lended to $data[borrowerName] on $data[dateLent] if you wish you can cancel this')</script>";
        //now go on and delete the book from table lentBooks
        $sql2="delete from lentBooks where lentBookId='$id'";
        $querySql2=mysqli_query($conn,$sql2)or die(mysqli_error($conn));
        
# here better to use the correct timezone 
        if(date('20y-m-d')>$data['dateReturn']){
            $msg="you have succesfully returned the book but that user seems to have exceeded the deadline would you like to<a href='punish.php?bnm=$data[borrowerName]'> punish</a> him/her if you wish u can cancel this ";
         header("location:return.php?message=$msg");
        }
        else{
        $msg="you have succesfully returned a book  which was lended to $data[borrowerName] on $data[dateLent] you can continue to return more books";
        header("location:return.php?message=$msg");
    }
    }
}
?>
