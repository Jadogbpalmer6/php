<?php

// let me now create a base file dealing with the database connection and queries
//let me use procedural programing at first let it be a spagetti code i dont give a dumb

#coonection

function connect($nameOfTable){
	$conn=mysqli_connect('localhost','root','',$nameOfTable')or die(mysqli_error());
}

function addBook()