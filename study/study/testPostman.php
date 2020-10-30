<?php
$array = array('names' => $_POST['name']);	 	                            			
header('content-type:aplication/json');
echo json_encode($array);

