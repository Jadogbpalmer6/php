<?php 

#this demonstrate the use of classes in php
class MyClass extends mysqli
{
//     private $name;

//     // constructor
//     // function myClass($name){
//     //     $this->name=$name;
//     // }
//     // function getName(){
//     //     return $this->name;
//     // }
};
// //instantiation
// $myObject=new MyClass('jado');

// //call for class methods || member functions 
// //even private ones in an abstract way
// $name_of_myObject=$myObject->getName();

// echo"my name is <b>". $name_of_myObject ."</b>";

$obj=new myClass('localhost','root','','library managment');
if ($obj->connect_error){
    die('connection failed');
}
else{
    echo 'connected succesfully through MyClass an abstact class of mysqli';
}

//seems Object oriented with mysqli is suported but not good as my oppinion
echo $obj->num_rows($obj->query('SELECT * FROM books'));
