<?php
include_once("locals/IConnectInfo.php");
class User implements IConnectInfo {
	public $id;
	public $name;
	public $email;
	public $hasAccess;
	protected $password;
	protected $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct($id) {
		$this->id = $id;
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$query = "SELECT * FROM koordynatorzy WHERE KoordId = '$id'";
		$data = mysqli_fetch_array(mysqli_query($connection, $query));
		$this->name = $data['Koordynator'];
		$this->email = $data['KoordEmail'];
		$this->password = $data['KoordPass'];
	}
	function get_name() {
		return $this->name;
	}
	function check_access($distributorId) {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$query = "SELECT d_kId FROM dystryb_koord WHERE (Koordynator = '$this->name' AND d_kId = $distributorId)";
		$data = mysqli_num_rows(mysqli_query($connection, $query));
		$this->hasAccess = $data;
		return $this->hasAccess;
	}
	function get_id() {
		return $this->id;
	}
	function get_mail() {
		return $this->email;
	}
	function get_password() {
		return $this->password;
	}
	function make_comment($comment, $subject){
		$connect = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$timestamp = date("Y-m-d");
		$coordinator = $this->name;
		$comment = htmlspecialchars($comment);
		$query = "INSERT INTO komentarze (`Timestamp`,`Koordynator`,`DystrId`,`Comment`) VALUES ('$timestamp','$coordinator','$subject','$comment')";
		$result = mysqli_query($connect, $query);
		return $result;
	}
	function add_contact($POSTArray, $dystrId) {
		$connect = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$koordId = $this->id;
		$osoba = $_POST['contactName'];
		$stanowisko = $_POST['contactJob'];
		$telefon = $_POST['contactTelephone'];
		$email = $_POST['contactEmail'];
		$query = "INSERT INTO kontakty (`DystrId`,`KoordId`,`Osoba`,`Stanowisko`,`Telefon`,`Email`) VALUES ('$dystrId','$koordId','$osoba','$stanowisko','$telefon','$email')";
		$result = mysqli_query($connect, $query);
		if ($result) {header("Location: " . $_SERVER['REQUEST_URI']);}
	}
}