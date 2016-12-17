<?php
include_once('locals/IConnectInfo.php');
class Dystrybutor implements IConnectInfo {
	
	public $connect;
	private $id = null;
	private $name = null;
	private $adress = null;
	private $contact = null;
	private $telephone = null;
	private $email = null;
	private $region = null;
	private $comment = null;
	private $deal = null;
	private $operations = null;
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	public $addContactForm = "";
	
	function __construct($query_row) {
		$this->id = $query_row['Id'];
		$this->name = $query_row['Nazwa'];
		$this->email = $query_row['Email'];
	#	$this->deal = $query_row['Umowa'];
	#	$this->comment = $query_row['Komentarz'];
		$this->adress = $query_row['Adres'];
		$this->contact = $query_row['Kontakt'];
		$this->telephone = $query_row['Telefon'];
	#	$this->region = $query_row['Region'];
		$this->operations = $query_row['Operacje'];
	}
	function get_name() {
		return $this->name;
	}
	function get_id() {
		return $this->id;
	}
	function get_adress() {
		return $this->adress;
	}
	function get_region() {
		return $this->region;
	}
	function get_contact() {
		return $this->contact;
	}
	function get_telephone() {
		return $this->telephone;
	}
	function get_email() {
		return $this->email;
	}
	function get_comment($id) {
		$connect = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$query = "SELECT * FROM komentarze WHERE DystrId = '$id' ORDER BY `Timestamp` DESC";
		
		#echo $query;
		$result = mysqli_query($connect, $query);
		if($result) {
			while ($row = mysqli_fetch_array($result)) {
				echo $row['Timestamp'] . "::" . $row['Koordynator'] . " dodał(a): " . $row['Comment'] . "<br>";
			}
		}
	}
	function get_offer() {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$storeId = $this->get_id();
		$query = "SELECT Oferta FROM dystryb_oferta WHERE d_oId = $storeId";
		$result = mysqli_query($connection, $query);
		if(!empty($result)){
			$offers = "";
		while ($dataArray = mysqli_fetch_assoc($result)) {
			$offers .= $dataArray['Oferta'] . '<br>';
		}}
		return $offers;
	}
	
	function get_coordinator() {
		
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$storeId = $this->get_id();
		$query = "SELECT Koordynator FROM dystryb_koord WHERE d_kId = $storeId";
		$result = mysqli_query($connection, $query);
		if(!empty($result)){
		$coordinators = "";
		while ($dataArray = mysqli_fetch_assoc($result)){
			$coordinators .= $dataArray['Koordynator'] . '<br>';
		}}
		return $coordinators;
	}
	function print_deal() {
		print $this->deal;
	}
	function got_deal() {
		 return (($this->deal === '1') ? True : False);
	}
	function get_operations() {
		return $this->operations;
	}
	function get_deal(){
		return $this->deal;
	}
	function deal_string() {
		echo ($this->got_deal() ? "<button style='background-color: green'>UMOWA</button>" : "<i class='fa fa-minus'></i>");
	}
	/*
	function show_contacts() {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$query = "SELECT * FROM `kontakty` WHERE DystrId = '$this->id'";
		$result = mysqli_query($connection, $query);
		if(!empty($result)) {
			while($data = mysqli_fetch_assoc($result)) {
				$name_button = "<button>" . $data['Osoba'] . "</button>";
				$contact_data ="Osoba: " . $data['Osoba'];
				$contact_data .= "<br>Stanowisko: " . $data['Stanowisko'];
				$contact_data .= "<br>Telefon: " . $data['Telefon'];
				$contact_data .= "<br>Email: " . $data['Email'];
				echo "<p><a id = 'show_contacts'>" . $name_button . "<span>" . $contact_data . "</span></a></p>";
				//echo "<br>";
			}
		} else {
			echo "Brak kontaków do wyświetlenia";
		}
	}
	*/
	function show_contacts() {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		mysqli_set_charset($connection, "utf8");
		$query = "SELECT * FROM `kontakty` WHERE DystrId = '$this->id'";
		$result = mysqli_query($connection, $query);
		if(!empty($result)) {
			while($data = mysqli_fetch_assoc($result)) {
				$name_button = "<button>" . $data['Osoba'] . "</button>";
				$contact_data = "Osoba: " . $data['Osoba'];
				$contact_data .= "<br>Stanowisko: " . $data['Stanowisko'];
				$contact_data .= "<br>Telefon: " . $data['Telefon'];
				$contact_data .= "<br>Email: " . $data['Email'];
				echo "<p><a id = 'show_contacts'>" . $name_button . "<span>" . $contact_data . "</span></a></p>";
				//echo "<br>";
			}
		} else {
			echo "Brak kontaków do wyświetlenia";
		}
	}
}





?>