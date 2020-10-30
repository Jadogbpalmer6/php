<?php
$Router= new Router;

$Router -> addroute('/','HomeController');
$Router -> addroute('/register','register');
$Router -> addroute('/login', 'login');
$Router -> addroute('/stock/newItem', 'StockController@create');
$Router -> addroute('/stock/removeItem', 'StockController@outflow');
$Router -> addroute('/stock/inflows','stockLogs@insertionLogs');
$Router -> addroute('/stock/outflows','stockLogs@deletionLogs');
$Router -> addroute('/stock/history','stockLogs@allLogs');
$Router -> addroute('/rooms/addcategory','roomsCatController@create');
$Router -> addroute('/rooms/addrooms','roomsController@create');
$Router -> addroute('/rooms/availablecategories','roomsCatController@availableCategories');
$Router -> addroute('/rooms/grantroom','roomsController@grantRoom');
$Router -> addroute('/rooms/checkout','roomsController@checkOut');
$Router -> addroute('/rooms/inrooms','roomsReports@inRooms');
$Router -> addroute('/rooms/available','roomsReports@availableRooms');
?>
