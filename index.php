<?php
#define("ROOT", realpath($_SERVER["DOCUMENT_ROOT"]) . "/loid/");
include_once('locals/IConnectInfo.php');
include_once(ROOT . 'models/Dystrybutor.php');
include_once(ROOT . "/models/User.php");
include_once(ROOT . "/models/Logger.php");
include_once(ROOT . "/models/Table.php");
include_once(ROOT . "/models/UserUpdater.php");   
include_once(ROOT . '/includes/header.html');
include_once(ROOT . "/models/EmailButton.php");
include_once('connect.php');
?>

<div id = 'search_form'>
<?php
//widok tylko dla zalogowanych	
if (isset($_SESSION['user'])) {
	include_once("includes/form.html");
	} else {
	die("Musisz być zalogowany.");
	}
?>
</div><div id='show_distributors'>
<?php
if (isset($_POST['dawaj'])){

	include_once(ROOT . "/sql/selectQuery.php");
//	echo $query;
	$result = mysqli_query($connect, $query);
//	print_r($result);
	if($result) {
		echo 'hello';
	$table = new Table();
	$table->show_head();
	$table->show_rows($result);
	} else {
		echo "<p>Brak wyników</p>";
	}
}	
?>
	</div>
</body>
