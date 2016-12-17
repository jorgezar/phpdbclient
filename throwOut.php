<?php
function show_head() {
	$table_head = "<table id='view_table'>";
	$table_head .= "<th>Nazwa</th>";
	$table_head .= "<th>Oferty</th>";
	$table_head .= "<th>Koordynatorzy</th>";
	
	}
function show_rows($result){
	mysql_data_seek($result, 0);
	while($row = mysql_fetch_array($result){
		$dystrybutor = new Dystrybutor($row);
		$name_button = "<button>" . $dystrybutor->get_name() . "</button>";
		$distributor_data = "Nazwa: " . $dystrybutor->get_name() . $dystrybutor->deal_string();
		$distributor_data .= "<br>Adres: " . $dystrybutor->get_adress();
		$distributor_data .= "<br>Kontakt: " . $dystrybutor->get_contact();
		$distributor_data .= "<br>Telefon: " . $dystrybutor->get_telephone();
		$distributor_data .= "<br>Email: " . $dystrybutor->get_email();		
		$table_row = "<tr><td id='show_distributor'>" . $name_button . "<span>" . $distributor_data . "</span></td>";
		$table_row = "<td>" . $dystrybutor->get_offer() . "</td>";
		$table_row = "<td>" . $dystrybutor->get_coordinator() . "</td></tr>";
		echo $table_row;
	}
}
"<button><a href='display.php?dbid=" . $dystrybutor->get_id() . "' action = '<?php session_start(); $_SESSION['dbid'] = " . $dystrybutor->get_id(); . "?>'>" . $dystrybutor->get_name() . "</a></button>";

<button><a href="display.php?dbid=<?php echo $dystrybutor->get_id(); ?>" action = '<?php session_start(); $_SESSION['dbid'] = $dystrybutor->get_id(); ?>'><?php echo $dystrybutor->get_name(); ?></a></button>"

"<button><a href='display.php?dbid=" . $dystrybutor->get_id() . "' action = ' <?php session_start(); $_SESSION['dbid'] = " . 