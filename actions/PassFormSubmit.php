<?php
$oldpass = md5(htmlspecialchars($_POST['oldpass']));
$newpass1 = md5(htmlspecialchars($_POST['newpass1']));
$newpass2 = md5(htmlspecialchars($_POST['newpass2']));
$userpass = $_SESSION['user']->get_password();
$userid = $_SESSION['user']->get_id();
$errors = array();
#echo 'usermail' . $usermail;
#echo 'olmail' . $oldmail;
if (isset($_POST['PassSubmit']) &&($oldpass != $userpass)) 
{
	$errors[] = "Stare hasło się nie zgadza";
}
if (isset($_POST['PassSubmit']) && ($newpass1 != $newpass2)) 
{
	$errors[] = "Hasło i powtórzone hasło nie pasują.";
}
if (empty($errors))
{
	$query = "UPDATE koordynatorzy SET KoordPass = '$newpass1' WHERE KoordId = '$userid'";
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