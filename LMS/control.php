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
else{
    exit();
}
if (isset($_POST['lend'])) {
if ($bookCode=$_POST['bookCode']) {

            if ($dateReturn=$_POST['dateReturn']) {                     //check if all fields are filled

                if ($borrowerName=$_POST['borrowerName']){
                    echo "<form action='lendBook.php?bookCode=$bookCode & dateReturn=$dateReturn' method='POST'>
                    enter name
                          <input type='text' name='bname'><br>
                          enter the password
                          <input type='password' name='password'><br>
                          <input type='submit' name='submit' value='lend book'>
                        </form>";
                }
                else{
                    $msg="please you did not specify the name of the pearson to whom you are lending the book please fill all fields";
                    header("location: library.php?message= $msg");
                }
            
            }
            else{
                $msg="please you did not specify the date the book must be returned please fill all fields";
                header("location: library.php?message= $msg");
            }

        }else{
            $msg="please you did not specify the code of book please fill all fields";
                    header("location: library.php?message= $msg");
        }
        
    }
   else{
    $msg="please you have not given the code of the book you are about to lend please fill all fields";
    header("location: library.php?message=$msg & dateReturn=$dateReturn");
}

    
?>
<!DOCTYPE html>
<html lang="en">
<body>

 </body>
<!-- BOOTSTRAP JAVASCRIPT FILES -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>