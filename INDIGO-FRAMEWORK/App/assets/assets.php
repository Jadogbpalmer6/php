<?php
/**
 * the basic class to include all inputs of the framework
 */
class Assets{

    /**
     * the basic function to help in file uploading to the server
     */

    //the first parameter must be the whole _FILES[] array
    public function uploadFile($file, $name,$directory,$imageOnly=true){
        //the directory to store the image
        $target_dir = $directory;

        //the name the file should have on the server
        if($file_name = $name){
            $uploadOk = 1;
        }else throw new Exception("name must be set", 1);


        //the  file name from the client
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;

        //extension of the file
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //use of getimagesize function to check if the file is an image
        if ($imageOnly){
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

            if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
            && $FileType != "gif" ) {
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_dir."/".$file_name.".".$FileType)) {
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > 500000) {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return $uploadOk;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_dir."/".$file_name.".".$FileType)) {
                return $uploadOk;
            } else {
                $uploadOk = 0;
                return $uploadOk;
            }
        }
    }
}

?>