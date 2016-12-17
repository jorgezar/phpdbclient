<?php
include_once(ROOT . "/locals/IConnectInfo.php");
class UserUpdater implements IConnectInfo {
/*UserUpdater pobiera $_GET i sprawdza czy w bazie danych jest pasujący użytkownik
*/
	public   $name;
	#właściwość potato zmienia się gdy token zostaje wykrzystany do ustawienia hasła, 
	#jednorazowe ustawienie
	public   $potato;
	public   $id;
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct($access_code) {
		#pamiętaj żeby zmienić jednorazowy parametr
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
	#	$email = mysqli_real_escape_string($connection, $access_code);
		$token = $_GET['invite'];
		$query = "SELECT * FROM `koordynatorzy` where Token = '$token'";
		#echo $query;
		if($result = mysqli_fetch_assoc(mysqli_query($connection, $query))){
			$this->name = $result['Koordynator'];
			$this->potato = $result['Potato'];
			$this->id = $result['KoordId'];
		} else {
			die("Niestety, coś poszło nie tak. Czy na pewno adres w przeglądarce jest poprawny?<a href='index.php'><button type = 'button'>Powrót</button></a>");
		}
		mysqli_close($connection);
	}
	function get_name(){
		return $this->name;
	}
	function get_potato(){
		return $this->potato;
	}
	function set_password($password){
		$connection = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
		$password = md5(mysqli_real_escape_string($connection, $password));
		$query = "UPDATE koordynatorzy SET KoordPass = '$password', Potato = 1 WHERE KoordId = $this->id";
		
		#echo $query .  "<br>WIELKI ROW: " . mysqli_affected_rows(mysqli_query($connection, $query));
		mysqli_query($connection, $query);
		return mysqli_affected_rows($connection);
		echo "ROWS: " . mysqli_affected_rows($connection);
	}
	}
	
	
	
	
	
	#		$password = md5(mysqli_real_escape_string($connection, $password));