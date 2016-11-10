<?php
if($_POST['pwd']!="666"){
	die("Incorrect Password");
}
if(isset($_POST['key'])&& isset($_POST['value'])){
	$key = $_POST['key'];
	$value = $_POST['value'];
	$newMemory =  '"'.$key.'": "'.$value.'"';
	$newMemory = strtolower($newMemory);
}
else{
	exit();
}
$memory = file_get_contents('memory.txt');
$memory = substr($memory, 0, -1);
$memory.=','.$newMemory.'}';
try{
	file_put_contents('memory.txt', $memory);
	echo $_POST['key'].' is '.$_POST['value'].'. Saved';
}
catch(Exception $e){
	echo $e;
}