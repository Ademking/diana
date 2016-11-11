<?php
$lang = $_GET['tl'];

$languageCodes = array(
	'hindi' 	=> 'hi',
	'french'	=> 'fr'
);

$target_lang = $languageCodes[strtolower($lang)];



$obj = file_get_contents('https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl='.$target_lang.'&dt=t&q='.urlencode($_GET['q']));
if($target_lang === 'hi'){
	echo $obj;
}
else{
	echo mb_convert_encoding($obj, 'HTML-ENTITIES', "UTF-8");
}
?>
