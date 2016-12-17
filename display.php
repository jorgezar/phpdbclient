<?php
/*
strona zawiera obecnie dwa formularze:
jeden wywołuje metodę $inserter-> do_update() która wprowadz dane dystrybutora
oraz metodę $user->make_comment() która odpowiada za dodanie komentarz do 
bazy danych komentarzy
*/
include_once('models/User.php');
@session_start();
//dostęp tylko dla zalogowanych
if(!isset($_SESSION['user'])) {die("Musisz być zalogowany<br><a href='index.php'><button type = 'button'>Powrót</button></a>");} 
include_once('locals/IConnectInfo.php');
include_once('models/CoordinatorForm.php');
include_once('models/Inserter.php');
include_once('models/OfferForm.php');
include_once('models/Dystrybutor.php');
include_once('connect.php');
include_once('styles/styles.css');
include_once('includes/header.html');
// sprawdzamy parametr numer w bazie danych - indywidualny ID dystrybutora
if(isset($_GET['dbid'])){
$storeId = $_GET['dbid']; 
} else {
	die("Brak danych do wyświetlenia");
}
//czy zgłoszono formularz zmiany danych?
if(!empty($_POST['submitData'])) {
	$insert = new Inserter($_POST);
	if($insert->do_update()) {
		echo "dokonano zmian";
	}
} 
//czy zgłoszono formularz dodania nowego kontaktu?
if(isset($_POST['addContact'])) {
	//dodawanie kontaktu jest metodą użytkowników
	$_SESSION['user']->add_contact($_POST, $storeId); 
}
// czy zgłoszono komentarz i czy wprowadzono komentarz
if(!empty($_POST['submitComment']) && $_POST['Komentarz'] != "") {
$_SESSION['user']->make_comment($_POST['Komentarz'], $storeId);
//nagłówek odsyła na powrót celem wyczyszczenia parametrów POST
header("Location: " . $_SERVER['REQUEST_URI']);	
}  
//pobieramy obiekt dystrybutor
$query = "SELECT * FROM dystrybutorzy WHERE Id = $storeId";
$result = $connect->query($query);
$data = mysqli_fetch_array($result);
$dystrybutor = new Dystrybutor($data);
echo '<H1>OGLĄDASZ WŁAŚNIE: ' . $dystrybutor->get_name() . '</h1>'; 
//dopisać klasę decydującą o udostępnieniu edycji
/*if ($_SESSION['user']->check_access($storeId)){
	echo "<h3> <font color='green'>Możesz dokonać zmian.</font></h3>";
	} else {
		echo "<h3> <font color='red'>Brakuje ci uprawnień by dokonać zmian.</font></h3>";
	}*/
//pobieramy lisstę przypisanych kontaktów
?>
<div id = "backButton"><button id type="button" action='index.php' ><a href='index.php'> WRÓC </a></button></div>
<!-- przycisk skrywający formularz dodawania kontaktu -->
<div id="contacts">KONTAKTY<br><input onclick = "document.getElementById('addContactForm').innerHTML = showAddContactForm()" type="button" value = "Dodaj Osobę" id = "addContact"/>
<p id = "addContactForm"></p>
<div id="contactShowcase">
<?php $dystrybutor->show_contacts(); ?>
</div></div>

<div id = 'section'>DANE DYSTRYBUTORA<br>
<form id='update' action = '' href = 'display.php?dbid=<?php echo $dystrybutor->get_id(); ?>' method = 'post'>	<input id='insert_button' type = 'submit' name = 'submitData'value = 'Wprowadź zmiany'>
<table id='display_table'>
	<tr>
		<input type ="hidden" name="Id" value = "<?php echo $dystrybutor->get_id(); ?>"/>
		<td><ul><li>Nazwa</li></ul></td>
		<td><input name = 'Nazwa' type = 'text' value = '<?php echo $dystrybutor->get_name(); ?>'></td>
	</tr>
	<tr>
		<td><ul><li>Kontakt</li></ul></td>
		<td><input name = 'Kontakt' type = 'text' value = '<?php echo $dystrybutor->get_contact(); ?>'></td>
	</tr>
	<tr>
		<td><ul><li>Adres</li></ul></td>
		<td><input name='Adres' type = 'text' value = '<?php echo $dystrybutor->get_adress(); ?>'></td>
	</tr>
	<tr>
		<td><ul><li>Telefon</li></ul></td>
		<td><input name='Telefon' type = 'text' value = '<?php echo $dystrybutor->get_telephone(); ?>'></td>
	</tr>
	<tr>
		<td><ul><li>Email</li></ul></td>
		<td><input name='Email' type = 'text' value = '<?php echo $dystrybutor->get_email(); ?>'></td>
	</tr>
	<tr>
		<td><ul><li>Działalność</li></ul></td>
		<td><input name='Operacje' type = 'text' value = '<?php echo $dystrybutor->get_operations(); ?>'></td>
	</tr>
		</table>
	</form>
</div>
<div id = 'aside'>
		<p>ZOSTAW KOMENTARZ</p>
		<form action = ''method = 'post'>
		<input type = 'submit' value ='Skomentuj' name='submitComment'></input>

		<textarea id='Komentarz' name = 'Komentarz' ></textarea></form>
		<p id='Comments'><?php echo	$dystrybutor->get_comment($storeId); ?></p>
</div>
<script>

</script>











