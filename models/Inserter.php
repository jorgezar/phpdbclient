<?php 
class Inserter  implements IConnectInfo {
	public $id = null;
	private $name = null;
	private $adress = null;
	private $contact = null;
	private $telephone = null;
	private $email = null;
	private $region = null;
	private $comment = null;
	private $deal = null;
	private $operations = null;
	private $coordinators = array();
	private $offers = array();
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct($query_row){
		$this->id = $this->clean_input($query_row['Id']);
		$this->name = $this->clean_input($query_row['Nazwa']);
		$this->email = $this->clean_input($query_row['Email']);
		$this->adress = $this->clean_input($query_row['Adres']);
		$this->contact = $this->clean_input($query_row['Kontakt']);
		$this->telephone = $this->clean_input($query_row['Telefon']);
		$this->operations = $this->clean_input($query_row['Operacje']);
		((isset($query_row['coordinators'])) ? $this->coordinators = $query_row['coordinators'] : $this->coordinators = array());
		((isset($query_row['offers'])) ? $this->offers = $query_row['offers'] : $this->offers = array());
	} 
	
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function update_offers() {
		
		$query = "DELETE FROM dystryb_oferta WHERE d_oId = $this->id; ";
		$query .= "INSERT INTO dystryb_oferta (d_oId, Oferta) VALUES ";
		foreach($this->offers as $row) {
			$query .= "($this->id, '$row'), ";
		}
		$query .= "($this->id, '');";
		#print $query;
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$connection->set_charset("utf8");
		$result = mysqli_multi_query($connection, $query);
	}
	function update_coordinators() {
		$query = "DELETE FROM dystryb_koord WHERE d_kId = $this->id; ";
		$query .= "INSERT INTO dystryb_koord (d_kId, Koordynator) VALUES ";
		foreach($this->coordinators as $row) {
			
			$query .= "($this->id, '$row'), ";
		}
		$query .= "($this->id, '');";
	#	print $query;
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$connection->set_charset("utf8");
		$result = mysqli_multi_query($connection, $query);
	}
	function update_distributor(){
		$query= "UPDATE dystrybutorzy 
		SET Nazwa = '$this->name', Kontakt = '$this->contact', Telefon = '$this->telephone', Email = '$this->email',  Operacje = '$this->operations', Adres = '$this->adress'
		WHERE Id = $this->id";
		echo $query;
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$connection->set_charset("utf8");
		$result = mysqli_query($connection, $query);
	}
	
	function output_post() {
		print_r($this->operations);
		print_r($this->coordinators);
		print_r($this->offers);
	}
	
	function do_update() {
	#	$this->output_post();
	#	$this->update_offers();
	#	$this->update_coordinators();
		$this->update_distributor();

	}
}
?>