<?php 
if(isset($_POST)){
	(isset($_POST['coordinator']) ? $koorArray = $_POST['coordinator'] : $koorArray = '');
	(isset($_POST['offer']) ? $offerArray = $_POST['offer'] : $offerArray = '');
	if(!empty($koorArray))
	{
		((in_array("Brak", $koorArray)) ? $koorNULL = "OR d.Id NOT IN (SELECT Id FROM dystryb_koord as d_k WHERE d.Id = d_k.d_kId)" : $koorNULL = "");
		$koordynatorzy = "(d_k.Koordynator = '" . implode("' OR d_k.Koordynator = '", $koorArray) . "' " . $koorNULL . ") ";
	} else {
		$koordynatorzy = "";
	}
	if(!empty($offerArray)) {
		((in_array("Brak", $offerArray)) ? $offerNULL = "OR d.Id NOT IN (SELECT Id FROM dystryb_oferta as d_o WHERE d.Id = d_o.d_oId)" : $offerNULL = "");
		$oferty = "(d_o.Oferta = '" . implode("' OR d_o.Oferta = '", $offerArray) . "' " . $offerNULL . ") ";
	} else {
		$oferty = "";
	}
	((($koorArray != '') && ($offerArray != '') ) ? $AND = ' AND' : $AND = '');
}
$query = "SELECT DISTINCT *
FROM dystrybutorzy AS d
LEFT OUTER JOIN dystryb_koord AS d_k ON d.Id = d_k.d_kId
LEFT OUTER JOIN dystryb_oferta AS d_o ON d.Id = d_o.d_oId
WHERE $koordynatorzy $AND $oferty
GROUP BY d.Nazwa DESC";
#echo $query;

?>

