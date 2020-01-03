<?php 
	$conn=mysqli_connect('localhost','root','','LMS') or die(mysqli_error($conn));
	$querySql=mysqli_query($conn,"select * from books ");
	$numberOfBooks=mysqli_num_rows($querySql);
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>INDIGO POLYMER</title>
</head>
<body>
    <div class="sidebarwrapper">
        <!-- BRAND SECTION -->
        <div class="brand-container">
            <p id="brand">POLYMER &trade;</p>
        </div>
        <!-- SIDEBAR NAVIGATION LINKS -->
        <div class="link-container">
            <ul class="flex-container1 list-unstyled">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="all.php">All Books</a></li>
            <li><a href="addBook.php">Add Book</a></li>
            <li><a href="booksRent.php">Books lent</a></li>
            <li><a href="library.php">Library</a></li>></li>
         
                
            </ul>
        </div>
    </div>
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
                    if (!$numberOfBooks==0) {
                        echo "<thead class=thead-dark>";
                        echo "<tr>";
                        echo "<th scope=col>Book ID</th>";
                        echo "<th scope=col>Book code</th>";
                        echo "<th scope=col>Book tittle</th>";
                        echo "<th scope=col>Book category</th>";
                        echo "<th scope=col>Book authors</th>";
                        echo "<th scope=col>date received</th>";
                        echo "</tr>";
                        echo "</thead>";   
                    }
                    while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td> $dataAray[bookId]"." </td>";
                        echo " <td> $dataAray[bookCode]"." </td>";
                        echo "<td> $dataAray[bookName]"." </td>";
                        echo "<td> $dataAray[category]"." </td>";
                        echo "<td> $dataAray[author]"." </td>";
                        echo "<td> $dataAray[dateReceived]"." </td>";
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