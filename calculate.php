<?php
echo trim("The Result is. ".@file_get_contents('https://www.calcatraz.com/calculator/api?c='.urlencode($_GET['q'])));
?>
