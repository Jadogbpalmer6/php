<!DOCTYPE html>
<html>
<head>
    <title>export to excel</title>
</head>
<body>
<form action="study7.php" method="POST">
    <?php
    echo "<h1> u can dload this as report.xls </h1>";
    if (isset($_POST['submit'])) {
        header("content-Type: application/pdf");
        header("content-Disposition:attachment; filename=report.pdf");
        echo "wow";
    }
        $conn=mysqli_connect('localhost','root','','library managment') or die(mysqli_error($conn));
        $querySql=mysqli_query($conn,"select * from books ");
        echo "
        <table cellpadding=10 border=black>
        <tr>
        <th>book id </th>
        <th>book code </th>
        <th>book name </th>
        <th>book category </th>
        <th>author</th>
        <th>date received </th>
        </tr>
        ";
        while($row=mysqli_fetch_array($querySql)){
            echo "
            <tr>
            <td> $row[bookId] </td>
            <td> $row[bookCode] </td>
            <td> $row[bookName] </td>
            <td> $row[category] </td>
            <td> $row[author] </td>
            <td> $row[dateReceived] </td>
            </tr>
            ";
        }
        echo "</table><hr><hr/>";


        echo time();

    ?>
    <input type="submit" name="submit" value="export to excel">
    <?php 
    echo "hello,hello,\n hello, hell,
    hell,hell,hell,hell,hell,hell,hell,
    hell,hell,,hell,hell,";
    echo _LINE_;
    ?>
</form>
</body>
<!-- 
    php advanced
    -----------
    dload w3 schools
    refer to w3schools
    ----------------
    database designing
        (UML)
        normalization
        ....
    ------------------
    software engineering(refer to PHP)
        design patterns
        ...............
 -->
</html>