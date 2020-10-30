<!DOCTYPE html>
<html>
<head>
	<title> study2 </title>
</head>
<body>
<?php
$BR='<br/>';
echo "<h1>study 2</h1><h2 align='center'><u> OOP </h2></u>";
/* class Byimana */
class Byimana
{
	var $size;
	
	function Byimana($size)
	{
		$this->size=$size;
	}
	function dispSize(){
		echo $this->size;
	}
}
/* class ESG */
class ESG extends Byimana
{
	var $Teachers;
	
	function Teachers($number)
	{
		$this->Teachers=$number;
	}
	function dispTeachers(){
		echo $this->Teachers;
	}
}
$S6MPC_BY= new Byimana(45);
echo "S6 MPC of byimana has the following students: ";
$S6MPC_BY->dispSize();         //echo $S6MPC->size.$BR;
echo $BR;
$S6PCB_BY= new Byimana(48);
echo "S6 PCB of byimana has the following students: ";
$S6PCB_BY->dispSize();
echo $BR.$BR;
$S6MPG_ESG=new ESG(50);
$S6PCB_ESG=new ESG(50);
echo "S6 MPG of ESG has the following students: ";
$S6MPG_ESG->dispSize();
echo $BR;
echo "S6 PCB of ESG has the following students: ";
$S6PCB_ESG->dispSize();
$S6MPG_ESG->Teachers(25);
echo $BR;
echo "S6 MPG of ESG has the following Teachers: ";
$S6MPG_ESG->dispTeachers();
?>
</body>
</html>
