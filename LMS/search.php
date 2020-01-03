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
<html>
<head>
	<title>search a book</title>
</head>
<body>
        <div class="container-fluid">
            <h5 class="text-success">
                <?php if (isset($_GET['message'])) {
                    echo $_GET['message'];
                } ?>
                <br>
            please enter the tittle or the category of the book
        </h5>

            <form action="searchBook.php" method="POST">
                <input type="text" name="searchKey">
                <input type="submit" value="search by tittle" name="searchByTitle">
                <input type="submit" value="search by category" name="searchByCategory">
            </form>
        </div>
    </body>
</html>
