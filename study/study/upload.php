<?php
//the directory to store the image
$target_dir = "uploads";

//the name the file should have on the server
if($file_name = $_POST['name']){
    $uploadOk = 1;
}else throw new Exception("name must be set", 1);


//the  file name from the client
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

//extension of the file
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


//use of getimagesize function to check if the file is an image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

// Check if image file is a actual image or fake image 
//we can emmit this to allow uploads of even other files
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_dir."/".$file_name.".".$imageFileType)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats 
//we can also emmit this to allow other formats of files or limit others
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir."/".$file_name.".".$imageFileType)) {
        echo "The file ".$file_name.".".$imageFileType. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>