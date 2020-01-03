<?php
$conn=mysqli_connect('localhost', 'jado_6','<1379>j@6','todo')or die (mysqli_error($conn));
if (isset($_POST['login'])) {
    // if (!empty($userName=$_POST['userName'])) {
    //     $sql="select * from users where userName='$userName'";
    //     $query=mysqli_query($conn,$sql);

    //     if (mysqli_num_rows($query) > 0) {
    //       $no_error=1;
    //     }
    //     else{
    //       echo "there is no person with that user name '$userName' <br/>";
    //       $no_error=0;
    //     }
    // }
    // else{
    //   echo "plz enter a user name";
    // }
    // if (!empty($pwd=$_POST['password'])) {
    //     $sql="select * from users where userName='$userName'";

    // }
    // else{
    //   echo "plz enter the password";
    // }

  if (empty($_POST['userName'])) {
    echo "please enter the user name";
  }
  elseif (empty($_POST['password'])) {
    echo "please enter the passord";
  }
  else{
    $userName=$_POST['userName'];
    $password=$_POST['password'];
    $sql0="select * from users where userName='$userName'";
    if ($query0=mysqli_query($conn,$sql0)) {
      if(mysqli_num_rows($query0)==0){
        echo "there is no such user name registerd plz";
      }
      else{
        $sql="select * from users where userName='$userName' and userPwd='$password'";
        if($query=mysqli_query($conn,$sql)){
          if(mysqli_num_rows($query)==1){
            echo "username and password match<br/> you are now going to be logged in as $userName";
            session_start();
            $_SESSION["userName"]=$userName;
            header("location: todo.php");
        }
          else{
          echo "user name and password did not match";
        }
          }
        else{
      die(mysqli_error($conn));
    }
  }
}
  else{
      die(mysqli_error($conn));
    }

  }



}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>todo</title>
    <meta name='jado_6' content='width=device-width, initial-scale=1'>
</head>
<body>
   <h1 align='center'> 
       <i>welcome to my todo app</i>
   </h1> 
   <form action='login.php' method="POST">
       user name: <input type="text" name="userName"><br/>
       password: <input type="text" name="password"><br/>
       <input type="submit" name="login" value="login">
   </form>
   <br/>
   <a href="login.php" > login instead </a>
</body>
</html>