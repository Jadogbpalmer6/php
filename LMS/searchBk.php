<?php 
if ($_POST['searchKey']!="") {
#first check if the user have enterd a searchKey
    $searchKey=$_POST['searchKey'];

        session_start();
    	$conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
      $querySql=mysqli_query($conn,"select * from lentBooks where borrowerName='$searchKey'")or die(mysqli_error($conn));
    	$numberOfBooks=mysqli_num_rows($querySql);
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
}else{
    $msg="it seems as if you have not enterd a search key";
    header("location: search.php?message=$msg");
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
                <li class="breadcrumb-item active"><b>search</b> </li>
            </ol>
        </div>
        
        <div class="myContainer">
           <h3 class="text-center">FOUND BOOKS</h3>
            <table class="table">
                <thead class="thead-dark">
                    <?php
                    if (!$numberOfBooks==0) {
                        echo "  <h5 class='text-success'>
                            <br>
                        to return the book click on the id of lending
                    </h5>";
                        echo "<thead class=thead-dark>";
                        echo "<tr>";
                        echo "<th scope=col>Book ID</th>";
                        echo "<th scope=col>Book code</th>";
                        echo "<th scope=col>Book tittle</th>";
                        echo "<th scope=col>Book category</th>";
                        echo "<th scope=col>date lent</th>";
                        echo "<th scope=col>date returned</th>";
                        echo "<th scope=col>borrower Name</th>";
                        echo "<th scope=col>id of the borrower </th>";
                        echo "</tr>";
                        echo "</thead>";   
                    }
                    while ($dataAray=mysqli_fetch_assoc($querySql) ) { 
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td><a href='returnBk.php?id=$dataAray[lentBookId]'> $dataAray[lentBookId]"." </td>";
                        echo " <td> $dataAray[bookId]"." </td>";
                        $querySqlo=mysqli_query($conn,"select * from books where bookId='$dataAray[bookId]' ")or die(mysqli_error($conn));
                        while ($data=mysqli_fetch_assoc($querySqlo)) {
                            echo "<td> $data[bookTittle] </td>";                  
                            echo "<td> $data[bookCategory] </td>";                  
                        }
                        echo "<td> $dataAray[dateLent]"." </td>";
                        echo "<td> $dataAray[dateReturn]"." </td>";
                        echo "<td> $dataAray[borrowerName]"." </td>";
                        echo "<td> $dataAray[borrowerId]"." </td>";
                        echo "</tbody>";
                    }
                 echo "<p> $numberOfBooks books found</p>";
	?>
                  
              </table>
        </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>