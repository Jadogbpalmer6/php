<?php
class divisionByZero extends Exception{};
class tooLow extends Exception{};
echo "<center>
<h1><u> ecception handling</h1>
</center></u>";
function devide($first_num,$second_num){
    if ($second_num==0) {
        echo $first_num." / ".$second_num." = ";
        throw new divisionByZero(" .......<i> an error ocured</i></br>math error");
    }
    elseif(((($first_num / $second_num)*10000)<1)){
        echo $first_num." / ".$second_num." = ";
        throw new tooLow("  .......<i> an error ocured</i> <br/>the result is too low it is almost zero");
        
    }
    else {
        echo $first_num." / ".$second_num." = ". ($first_num / $second_num);
    }
}
try {
    devide(6,0000000000);
} catch (Exception $th) {
    echo $th->getMessage();
}


?>