<?php
include_once('locals/IConnectInfo.php');
class CoordinatorForm implements IConnectInfo {
	private $id;
	private $dataArray;
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct() {
		$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		
	}
	
	function outputCoordinators($Id) {
		$this->dataArray = mysqli_query($this->connection, "SELECT Koordynator FROM dystryb_koord WHERE d_kId = $Id");
		$coordinator = array("Ada", "Aneta", "Diana", "Grzegorz", "Leszek", "Weronika", "Piotr");
		$assigned = array();
		while($SetArray = mysqli_fetch_array($this->dataArray)){
			#echo $SetArray['Koordynator'];
			array_push($assigned, $SetArray['Koordynator']);
		}
		
		foreach($coordinator as $row) {
			echo((in_array($row, $assigned)) ? "<input type = 'checkbox' name = 'coordinators[]' value = '$row' checked> $row <br>" : "<input type = 'checkbox' name = 'coordinators[]' value = '$row'> $row <br>");
		}
	}
	
}



?>