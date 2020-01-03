<?php
/*
this is the page to display all library books
all registerd books including the lended ones
*/ 

//connect to the DB and count the number of books
    session_start();
	$conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
	$querySql=mysqli_query($conn,"select * from books ");
	$numberOfBooks=mysqli_num_rows($querySql);

//check for the excitence of a session and display the correct links according to the privaleges
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
                <li class="breadcrumb-item active"><b>All Books</b> </li>
            </ol>
        </div>
        
        <div class="myContainer">
           <h3 class="text-center">ALL REGISTERED BOOKS</h3>
            <table class="table">
                <thead class="thead-dark">
                    <?php

                    //displays the table only when there are some books in the library


                    if (!$numberOfBooks==0) {
                        echo "<thead class=thead-dark>";
                        echo "<tr>";
                        echo "<th scope=col>Book ID</th>";
                        echo "<th scope=col>Book code</th>";
                        echo "<th scope=col>Book tittle</th>";
                        echo "<th scope=col>Book category</th>";
                        echo "<th scope=col>Book authors</th>";
                        echo "<th scope=col>date received</th>";
                        echo "<th scope=col>status</th>";
                        echo "</tr>";
                        echo "</thead>";   
                    }
                    //after puting on the headers of the table it continues looping in the database 

                    
                    while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td> $dataAray[bookId]"." </td>";
                        echo " <td> $dataAray[bookCode]"." </td>";
                        echo "<td> $dataAray[bookTittle]"." </td>";
                        echo "<td> $dataAray[bookCategory]"." </td>";
                        echo "<td> $dataAray[bookAuthors]"." </td>";
                        echo "<td> $dataAray[dateReceived]"." </td>";
                        $sql2="select * from lentbooks where bookId='$dataAray[bookId]'";
                        $querySql2=mysqli_query($conn,$sql2)or die(mysqli_error($conn));
                        if (mysqli_num_rows($querySql2)==1) {
                            echo "<td> book lent </td>";
                        }
                        else{
                            echo "<td> book in the library </td>";
                        }
                        echo "</tbody>";
                    }
        echo "<p> there are $numberOfBooks books in the library </p>";
	?>
                  
              </table>
        </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>