<?php
session_start();
$conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
$querySql=mysqli_query($conn,"select * from books ");
$numberOfBooks=mysqli_num_rows($querySql);
$querySqlo=mysqli_query($conn,"select * from lentBooks ");
$numberOfBooksLent=mysqli_num_rows($querySqlo);
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']=='librarian') {
        include_once 'headerlibrarian.php';
    }
    elseif ($_SESSION['user']=='assistant') {
        include_once 'headerassistant.php';
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
                <li class="breadcrumb-item active"><b>Admin</b> </li>
            </ol>
        </div>
        <div class="container-fluid">
            <h5 class="text-success">
                 <?php 
                    if (isset($_GET['message'])) {

                        echo $_GET['message']."</br>";
            }
                ?> </h5>
        <div class="box-group2">
                <div class="flex-container2">
                        <div class="box rounded">
                            <div><span>Total Books in the library :</b></span> ....<?php echo $numberOfBooks ?></div>
                        </div>
                        <div class="box rounded">
                            <div><span> Books rent:</b> </span> ....<?php echo $numberOfBooksLent ?></div>
                        </div>
                </div>
                <div class="flex-container3">
                        <div class="box rounded"></div>
                        <div class="box rounded"></div>
                </div>
                <div class="calendar-container">
                    
                </div>
            </div>
    </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>