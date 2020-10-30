<?php

try {
    $conn = new PDO("mysql:host = localhost;dbname=tests",'root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    throw $th;
}

try {
    $query = $conn->prepare("INSERT INTO images(image) values(:image)");
    $query->execute([':image'=>$_POST['image']]);
    // $num = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($num);
} catch (PDOException $th) {
    echo $th->getMessage();
}