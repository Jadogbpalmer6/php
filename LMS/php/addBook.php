<html>
    <head>
        <title>add book</title>
    </head>
    <body>
        <form action="addB.php" method="POST">
            <p> you have succesfully added a book called 
                <?php 
                echo $_GET['name']
                ?> 
            </p>
            name:<input type="text" name="bookName">
            category:<input type="text" name="category">
            author:<input type="text" name="author">
            number of books:<input type="text" name="bookNumbers">
            <input type="submit" value="add" name="added">
            <p><a href="dashboard.php"> go back to the dashboard </a></p>
        </form>
    </body>
</html>
