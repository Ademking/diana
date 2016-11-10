<?php
$obj = file_get_contents('https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=fr&dt=t&q='.urlencode($_GET['q']));
echo mb_convert_encoding($obj, 'HTML-ENTITIES', "UTF-8");
?>
