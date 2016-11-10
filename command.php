<?php

$memory = file_get_contents('.commands');
$memory = json_decode($memory,true);
if(array_key_exists(strtolower($_POST['q']),$memory)){
	$answer = $memory[strtolower($_POST['q'])];
	exec($answer.' 2>&1',$op);
	print_r($op);
	echo 'Executing '.$_POST['q'];
}
else{
	die('Command not found');
}
