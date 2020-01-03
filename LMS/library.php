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
                <li class="breadcrumb-item active"><b>Library</b> </li>
            </ol>
        </div>
        
        <div class="container-fluid">
            <h5 class="text-success">
                 <?php 
                    if (isset($_GET['message'])) {

                        echo $_GET['message']."</br>";
            }
                ?> </h5>

            <h3 class="text-center">FILL THIS FORM</h3>
            <form action="control.php" id="addBook" method="POST">
                    <div class="form-group">
                            <label for="ID">Date of Return:</label>
                           <input type="date" name="dateReturn" id="" class="form-control">
                       </div>
                    <div class="form-group">
                        <label for="ID">Borrower's Name:</label>
                         <input type="text" name="borrowerName" id="" class="form-control">
                    </div>
                    <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="ID">Book code</label>
                    <input type="text" name="bookCode" id="bookId" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="lend" value="Lend Book" class="form-control bg-dark text-light">
                </div>
            </form>
        </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>