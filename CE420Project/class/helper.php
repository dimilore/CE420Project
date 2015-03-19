<?php

function validStrLen($field_name, $str, $min, $max){
    $len = strlen($str);
    if($len < $min){
        echo "Field $field_name is too short, minimum is $min characters ($max max).";
    }
    elseif($len > $max){
        echo "Field $field_name is too long, maximum is $max characters ($min min).";
    }
	else return "1";
}

//good for usernames
function validNumsLettersOnly($string){
    
	if (ctype_alnum($string)==1) return 1; //pass
	else echo "only numbers and digits for username"; //not valid
}

?>