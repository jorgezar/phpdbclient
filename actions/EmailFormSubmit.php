<?php
$oldmail = htmlspecialchars($_POST['oldmail']);
$newmail1 = htmlspecialchars($_POST['newmail1']);
$newmail2 = htmlspecialchars($_POST['newmail2']);
$usermail = $_SESSION['user']->email;
$userid = $_SESSION['user']->get_id();
$errors = array();
#echo 'usermail' . $usermail;
#echo 'olmail' . $oldmail;
if (isset($_POST['EmailSubmit']) &&($oldmail != $usermail)) 
{
	$errors[] = "podaj prawidłowy mail";
}
if (isset($_POST['EmailSubmit']) && ($newmail1 != $newmail2)) 
{
	$errors[] = $newmail1 . " czy " . $newmail2 . " zdecyduj się";
}
if (empty($errors))
{
	$query = "UPDATE koordynatorzy SET KoordEmail = '$newmail1' WHERE KoordId = '$userid'";
	$result = mysqli_query($connect, $query);
	if($result) {
		echo "Dokonało się.<br>";
#header("Location: reload.php");
	}
} else {
	echo "Niestety nie udało się wprowadzić zmian: <br>";
	foreach($errors as $error) {
			echo "<ul>" . $error . "</ul>";
	}
	
}



?>