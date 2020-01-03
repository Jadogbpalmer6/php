<?php
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
                <li class="breadcrumb-item active"><b>Add Book</b> </li>
            </ol>
        </div>
        
        <div class="container-fluid">
            <h3 class="text-center">FILL THIS FORM</h3>
            <h5 class="text-success">
                 <?php 
                    if (isset($_GET['name'])) {

                        echo " you have succesfully added book called $_GET[name]  you can continue to add more books";
            }
                ?> </h5>
            <form action="addB.php" id="addBook" method="POST">
                <div class="form-group">
                    <label for="ID">book code</label>
                    <input type="text" name="bookCode" id="bookId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Book Title</label>
                    <input type="text" name="bookName" id="bookTitle" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ID">Book Category</label>
                    <input type="text" name="category" id="bookCategory" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title">Book Authors</label>
                    <input type="text" name="author" id="bookAuthor" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ID">date of recival </label>
                    <input type="date" name="dateReceived" id="bookId" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="add" value="Add Book" class="form-control bg-dark text-light">
                </div>
            </form>
        </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>