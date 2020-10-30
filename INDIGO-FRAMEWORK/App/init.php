<?php
//this performs all necessary includes for each file

//the routing file
include_once 'config/router.php';

//the controller file for linking different controllers to corresponding models and views
include_once 'config/Controller.php';

//the basic model file to perform database connection and database configuration
include_once 'config/model.php';

//the main view file for basic view class for correct response
include_once 'config/view.php';

//the main file for mounting routes and perform routes to correct controllers
include_once 'Routes/index.php';

//for use of tokens
include_once 'Libs/indigoAuth/indigoAuth.php';

?>
