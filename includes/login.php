<?php 
#define("ROOT", realpath($_SERVER["DOCUMENT_ROOT"]) . "/loid");
include_once("../locals/IConnectInfo.php");

if (isset($_POST['email']) && isset($_POST['password']))  {
	$logger = new Logger($_POST['email'], $_POST['password']);
	if ($logger->get_Id()){
		session_start();
		$user = new User($logger->get_Id());
	#	$user->check_Access(9999);
		$_SESSION['user']= $user;
	#	header("Location: ROOT . querytable.php");
	#	print_r($_SESSION['user']);
	#	echo "hs access? " . $user->hasAccess;
	}
}



if (isset($_SESSION['user'])) {
	$name= $_SESSION['user']->name;
	echo "Jesteś zalogowany jako $name <br> <a href";
} else	{
	echo "<form action = 'index.php' method='post'>Email:<input type='text' name = 'email'>Hasło:<input type='password' name = 'password'><input type= 'submit' value = 'Zaloguj się'></form>";
} 
#header("Location: " . ROOT . "/Index.php");