<?php

function prepare_query($dataArray)
{
	if (isset($dataArray['deal'])){
	switch ($dataArray['deal'])
	{
		case "1":
			$deal_element = "`Umowa` = '1' ";
			break;
		case "0":
			$deal_element = "`Umowa` = '0' ";
			break;
		case "0, 1":
			$deal_element = "`Umowa` IN ('0', '1') ";
			break;
	} 
	} else {$deal_element = "";}
	//check if need for AND
	if(isset($dataArray['deal']) && isset($dataArray['koordynator']))
	{
		$first_connector = "AND ";
	} else 
	{
		$first_connector = "";
	}	
	if (isset($dataArray['koordynator']))
	{
		$coord_element = "`koordynator` in ('" . implode("', '", $dataArray['koordynator']) . "') ";
	} else {
		$coord_element = "";
	}
	if(isset($dataArray['region']) && (isset($dataArray['koordynator']) || isset($dataArray['deal'])))
	{
		$second_connector = "AND ";
	} else 
	{
		$second_connector = "";
	}
	if (isset($dataArray['region']))
	{
		$region_element = "`Region` in ('" . implode("', '", $dataArray['region']) . "') ";
	} else {
		$region_element = "";
	}
	if(isset($dataArray['offer']) && (isset($dataArray['region']) || isset($dataArray['koordynator']) || isset($dataArray['deal'])))
	{
		$third_connector = "AND ";
	} else 
	{
		$third_connector = "";
	}
	if (isset($dataArray['offer'])){
	switch (implode(", ", $dataArray['offer']))
	{
		case "TP3":
			$offer_element = "`Oferta` = 'TP3' ";
			break;
		case "Polanki":
			$offer_element = "`Oferta` = 'Polanki' ";
			break;
		case "NULL":
			$offer_element = "`Oferta` = 'NULL' ";
			break;
		case "TP3, Polanki":
			$offer_element = "`Oferta` = 'TP3, Polanki' ";
			break;
		case "TP3, NULL":
			$offer_element = "`Oferta` IN ('TP3', 'NULL') ";
			break;	
		case "Polanki, NULL":
			$offer_element = "`Oferta`IN ('Polanki', 'NULL') ";
			break;
		case "TP3, Polanki, NULL":
			$offer_element = "1 ";
			break;
	}
$query = "SELECT * FROM `alldistr` WHERE " . $deal_element . $first_connector . $coord_element  . $second_connector . $region_element . $third_connector . $offer_element . " order by `Nazwa` ASC";
return $query;
}
}

function test_connection ($connect){
	if ($connect->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br>";
}
if ($connect)
{
	echo $connect->host_info . "<br>";
}	
}

?>