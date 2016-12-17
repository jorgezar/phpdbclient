
<?php
include_once('functions.php');
include_once('locals/IConnectInfo.php');
class Connection implements IConnectInfo {
	
	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::UNAME;
	private $pass = IConnectInfo::PW;
	private $database = IConnectInfo::DBNAME;
	
	public function make_connection() {
		$hookup = new mysqli($this->host, $this->user, $this->pass, $this->database);
		return $hookup;
	}
}

$connect = new Connection;
$connect = $connect->make_connection();
$connect->set_charset("utf8");
?>