<?php
class Table {
function show_head() {
	$table_head = "<table id='view_table'>";
	$table_head .= "<th>Nazwa</th>";
	$table_head .= "<th>Oferty</th>";
	$table_head .= "<th>Koordynatorzy</th>";
	echo $table_head;
	}
function show_rows($result){
//	mysqli_data_seek($result, 0);
	while($row = mysqli_fetch_array($result)){
//		echo "<br>";
//		print_r($row);
		$dystrybutor = new Dystrybutor($row);
		$offers = $dystrybutor->get_offer();
		$coordinators = $dystrybutor->get_coordinator();
		$name_button = "<button onclick = 'openPopup(this);'>" . $dystrybutor->get_name() . "</button>";
		$distributor_data = "<br>Nazwa: " . $dystrybutor->get_name() . $dystrybutor->deal_string();
		$distributor_data .= "<br>Adres: " . $dystrybutor->get_adress();
		$distributor_data .= "<br>Kontakt: " . $dystrybutor->get_contact();
		$distributor_data .= "<br>Telefon: " . $dystrybutor->get_telephone();
		$distributor_data .= "<br>Email: " . $dystrybutor->get_email();
		$edit_button = "<br><button><a href='display.php?dbid=" . $dystrybutor->get_id() . "' action = '<?php session_start(); \$_SESSION['dbid'] = " . $dystrybutor->get_id() . "; ?>Edytuj</a></button>";
		$table_row = "<tr><td>" . $name_button . "<div id = '" . $dystrybutor->get_name()  . "'class = 'popup' style='display:none;'><div class='cancel' onclick='closePopup();'></div>" . $distributor_data . $edit_button . "</div></td>";
		$table_row .= "<td>" . $offers . "</td>";
		$table_row .= "<td>" . $coordinators . "</td></tr>";
		echo $table_row; 
	}
	echo "</table>";
}
}