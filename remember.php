<?php

$memory = file_get_contents('memory.txt');
$memory = json_decode($memory,true);
if(array_key_exists(strtolower($_POST['key']),$memory)){
	$answer = $memory[strtolower($_POST['key'])];
}
else if(array_key_exists(strtolower("the ".$_POST['key']),$memory)){
	$answer = $memory[strtolower("the ".$_POST['key'])];
}
else{
	$answer = 'null';
}
echo ucwords($answer);