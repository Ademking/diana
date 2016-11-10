<?php
$data= file_get_contents("http://tambal.azurewebsites.net/joke/random");
$data=substr($data,strpos($data,":")+2);
$data = substr($data,0,-2);
echo $data;
?>
