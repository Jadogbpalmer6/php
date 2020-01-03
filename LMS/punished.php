<?php 
    $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
# for hosting its neccessary to use the correct timezone
 
    $currentDate=date("20y-m-j");

    #i too dont know

    $querySql=mysqli_query($conn,"SELECT * from punishments  ");
    $numberOfPunishments=mysqli_num_rows($querySql);
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
            <h3 class="text-center">ALL punishments </h3>
             <table class="table">
                 <thead class="thead-dark">
                   <?php
                    if (!$numberOfPunishments==0) {
                        echo "<thead class=thead-dark>";
                        echo "<tr>";
                        echo "<th scope=col>id of punishmentg</th>";
                        echo "<th scope=col>comment </th>";
                        echo "<th scope=col>date of punishment end</th>";
                        echo "<th scope=col>borrower Id </th>";
                        echo "<th scope=col>borrower name</th>";
                        echo "</tr>";
                        echo "</thead>";   
                    }
                    while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td> $dataAray[punishmentId]"." </td>";
                        echo " <td> $dataAray[comment]"." </td>";
                        echo " <td> $dataAray[punishmentEnd]"." </td>";
                        echo "<td> $dataAray[borrowerId]"." </td>";
                        echo "<td> $dataAray[borrowerName]"." </td>";
                        echo "</tbody>";
                        $numberOfPunishments++;
                    }
        echo "<p> $numberOfPunishments users have punished so far</p>";
    ?>
               </table>
         </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>