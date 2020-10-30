<?php
// birikwanga gufunguka  ;
if(isset($_GET['file'])){
	header("content-Control: public");
	header("content-Description: File Transfer");
	header("content-Disposition: attachment; filename=test.xlsx");
	header("content-Type: application/xls");
	header("content-Transfer-Emcoding: binary");
	readfile('test.xlsx');
	exit();
}else{
	echo "<a href='study10.php?file=test.xls' > dload here </a>";
}