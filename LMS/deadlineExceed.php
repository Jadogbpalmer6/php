<?php 
    $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
# for hosting its neccessary to use the correct timezone
 
    $currentDate=date("20y-m-j");

    #i too dont know

    $querySql=mysqli_query($conn,"SELECT * from lentbooks  ");
    echo "the current date is ".$currentDate;
    $numberOfBooks=0;
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>INDIGO POLYMER</title>
</head>
<body>
    <!-- MAIN CONTENT CONTAINER -->

    <div class="main-content">
        <!-- TOP NAVIGATION BAR -->
        <div class="nav-container">
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link"></a></li>
            </ul>
        </nav>
        </div>
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><b>Dashboard</b></li>
                <li class="breadcrumb-item active"><b>Books Lent</b> </li>
            </ol>
        </div>
        
        <div class="myContainer">
            <h3 class="text-center">ALL BOOKS LENT</h3>
             <table class="table">
                 <thead class="thead-dark">
                   <?php
                    if ($numberOfBooks==0) {
                        echo "<thead class=thead-dark>";
                        echo "<tr>";
                        echo "<th scope=col>id of lending</th>";
                        echo "<th scope=col>id of the book lent</th>";
                        echo "<th scope=col>Book tittle</th>";
                        echo "<th scope=col>date lent </th>";
                        echo "<th scope=col>date to be returned </th>";
                        echo "<th scope=col>borrower name</th>";
                        echo "<th scope=col>borrower ID</th>";
                        echo "</tr>";
                        echo "</thead>";   
                    }
                    while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
                        if ($dataAray['dateReturn']<$currentDate) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td> $dataAray[lentBookId]"." </td>";
                        echo " <td> $dataAray[bookId]"." </td>";
                        $querySqlo=mysqli_query($conn,"select * from books where bookId='$dataAray[bookId]' ")or die(mysqli_error($conn));
                        while ($data=mysqli_fetch_assoc($querySqlo)) {
                            echo "<td> $data[bookTittle] </td>";                  
                        }
                        echo "<td> $dataAray[dateLent]"." </td>";
                        echo "<td> $dataAray[dateReturn]"." </td>";
                        echo "<td> $dataAray[borrowerName]"." </td>";
                        echo "<td> $dataAray[borrowerId]"." </td>";
                        echo "</tbody>";
                        $numberOfBooks++;
                    }
                    }
        echo "<p> $numberOfBooks users have exceeded the deadline by now</p>";
    ?>
               </table>
         </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>