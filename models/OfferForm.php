<?php
include_once('locals/IConnectInfo.php');
class OfferForm implements IConnectInfo {
	private $id;
	private $dataArray;
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct() {
		$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		}
	
	function outputOffers($Id) {
		$this->dataArray = mysqli_query($this->connection, "SELECT Oferta FROM dystryb_oferta WHERE d_oId = $Id");
		$offer = array("TP3", "Polanki");
		$assigned = array();
		while($SetArray = mysqli_fetch_array($this->dataArray)){
			array_push($assigned, $SetArray['Oferta']);
		}
		
		foreach($offer as $row) {
			echo((in_array($row, $assigned)) ? "<input type = 'checkbox' name = 'offers[]' value = '$row' checked> $row <br>" : "<input type = 'checkbox' name = 'offers[]' value = '$row'> $row <br>");
		}
	}
	
}



?>