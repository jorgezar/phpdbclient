<?php
	echo '++KOORDYNATORZY++<br>';
if(isset($_POST['coordinator'])) {
	$koorArray = $_POST['coordinator'];

	foreach ($koorArray as $koordynator){
		echo $koordynator . '<br>';
	}
}
	echo '++++++OFERTY+++++++<br>';
if(isset($_POST['offer'])) {
	$offerArray = $_POST['offer'];

	foreach ($offerArray as $oferta){
		echo $oferta . '<br>';
	}
}
?>