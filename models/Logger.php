<?php
include_once(ROOT . "/locals/IConnectInfo.php");
class Logger implements IConnectInfo {
	#Logger pobiera w konstruktorze email i hasło, obsuguje szyfrowanie i po wykonaniu zapytania
	#do bazy danycn zwraca numer koordynatora który przekazany zostanie do utrworzenia obiektu klasy User 
	
	private $Id;
	private $loginPassword;
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	function __construct($email,  $password) {
		$connection = new mysqli($this->host, $this->user, $this->pass, $this->database);
		$email = mysqli_real_escape_string($connection, $email);
		$password = md5(mysqli_real_escape_string($connection, $password));
		$query = "SELECT KoordId FROM koordynatorzy WHERE (`KoordEmail` = '$email' AND `KoordPass` = '$password')";
	#	ECHO $query;
		$data = mysqli_fetch_array(mysqli_query($connection, $query));
		#mysqli_close($connection);
		$this->Id = $data['KoordId'];
	}
	function get_Id() {
		return $this->Id;
	}
	}