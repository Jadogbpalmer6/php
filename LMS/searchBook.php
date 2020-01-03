<?php 

# here i will use pdo and prepared staements as well as mysqli_real_escape_string() function


# include the left panel for librarian
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
if ($_POST['searchKey'] !="") {
	try{
		$conn= new PDO("mysql:host=localhost;dbname=library managment","root","");
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "connection failed: ".$e->getMessage();
	}
	if (isset($_POST['searchByTitle'])) {
		$preparedstmt=$conn->prepare("select * from books where bookTittle=:searchKey");
	}
	elseif (isset($_POST['searchByCategory'])) {
		$preparedstmt=$conn->prepare("select * from books where bookCategory=:searchKey");
	}
	$preparedstmt->execute([
		'searchKey'=>$_POST['searchKey']
	]);
	$books=$preparedstmt->fetchAll();
	}
else{
	echo"you have not enterd the search key";
}
$numberOfBooks=$preparedstmt->rowcount();
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
           <h3 class="text-center">books found</h3>
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

                    
                    	foreach ($books as $book) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo " <td> $book[bookId]"." </td>";
                        echo " <td> $book[bookCode]"." </td>";
                        echo "<td> $book[bookTittle]"." </td>";
                        echo "<td> $book[bookCategory]"." </td>";
                        echo "<td> $book[bookAuthors]"." </td>";
                        echo "<td> $book[dateReceived]"." </td>";
                        $sql2="select * from lentbooks where bookId='$book[bookId]'";
                        $querySql2=$conn->prepare($sql2);
                        $querySql2->execute();
                        if ($querySql2->rowcount()==1) {
                            echo "<td> book lent </td>";
                        }
                        else{
                            echo "<td> book in the library </td>";
                        }
                    }
                        echo "</tbody>";
                    
        echo "<p> there are $numberOfBooks books in the library with that search Key</p>";
	?>
                  
              </table>
        </div>

<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

