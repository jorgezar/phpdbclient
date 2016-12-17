<?php
/*strona rejestracyjna przyjmuje kod przekazany w parametrze GET 
i konfrontuje go z zapisanym w bazie danych. jeśli kod pasuje, 
wyświetli się formularz ustalenia hasła

*/
isset($_GET['invite']) or die("<a href='index.php'><button type = 'button'>Powrót</button></a>");
include_once('locals/IConnectInfo.php');
?>
<!DOCTYPE html>
<html lang="pl-PL" >
<head>
<title>Ustaw hasło</title>
<meta charset = "UTF-8">
<link rel="stylesheet" href="styles/styles.css"></head>
<?php
include_once("models/UserUpdater.php");
$visitor = new UserUpdater($_GET['invite']);
$username = $visitor->get_name();
echo "Witaj $username!<br> ";
if ($visitor->potato){
	die("Twój kod już został wykorzystany. Moduł 'zmień hasło' zostanie dodany później. <br><a href='index.php'><button type = 'button'>Powrót</button></a>");
}
#weryfikacja wprowadzonego hasła
if(isset($_POST['pass1']) && isset($_POST['pass2'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			die("Znalazłem różnice między wprowadzonymi hasłami");
		} elseif (strlen($_POST['pass1']) < 6) {
			die("Hasło musi mieć przynajmniej 6 znaków");
		} else { 
			if(!$visitor->set_password($_POST['pass1'])){
				die("<br>Nasz chomik skręcił kark w kołowrotku. Skontaktuj się z adminem.");
			} else {
				echo "<br><h4>Twoje hasło zostało ustawione.<h4>";
			}		
		}
}
?>
<form method='post' action=''>
Tutaj możesz ustalić swoje hasło: <br>
<input type='password' name = 'pass1' maxlenght='32'><br>
Powtórz hasło:<br>
<input type='password' name = 'pass2' maxlenght='32'>
<input type='submit'>
</form>
