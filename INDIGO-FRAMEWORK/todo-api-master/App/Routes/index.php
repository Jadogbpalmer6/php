<?php
$Router= new Router;
//iyi function yitwa **addroute** igomba kugira parameters ebyiri(2)
//parameter ya 1 ni routepath
//parameter ya 2 ni controllername
//@ igaragaza method izaba called igihe route izaba ibaye mounted
$Router -> addroute('/','HomeController');
$Router -> addroute('/test','test');
 ?>
