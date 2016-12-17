<?php

include_once('locals/IConnectInfo.php');
include_once(ROOT . 'models/Dystrybutor.php');
include_once(ROOT . "/models/User.php");
@session_start();
include_once(ROOT . "/models/Logger.php");
include_once(ROOT . "/models/UserUpdater.php");   
include_once(ROOT . '/includes/header.html');
include_once('connect.php');
if(!isset($_SESSION['user'])) 
{
	die("Musisz być zalogowany<br><a href='index.php'><button type = 'button'>Powrót</button></a>");
} 
$user = $_SESSION['user'];
if (isset($_SESSION['user']) && isset($_POST['EmailSubmit'])) 
{ 
	include_once("actions/EmailFormSubmit.php");
}	else if (isset($_SESSION['user']) && isset($_POST['PassSubmit'])) {
	include_once("actions/PassFormSubmit.php");
} else {
	echo "<h4>Chcesz coś zmienić w swoich danych?</h4>";
}
	

?>
	
	<button type="button"
onclick="document.getElementById('emailForm').innerHTML = showEmailForm()">
Chcę zmienić email</button>
	<p id="emailForm"></p>
	
	
	<button type="button"
onclick="document.getElementById('passForm').innerHTML = showPasswordForm()">
Chcę zmienić hasło</button>
	<p id="passForm"></p>
	
	<button type="button" action='index.php' ><a href='index.php'> WRÓC </a></button>
   