<?php
$Router= new Router;

$Router -> addroute('/','HomeController');
$Router -> addroute('/register','register');
$Router -> addroute('/insertions','stockLogs@insertionLogs');
$Router -> addroute('/deletions','stockLogs@deletionLogs');
$Router -> addroute('/allLogs','stockLogs@allLogs');

?>
