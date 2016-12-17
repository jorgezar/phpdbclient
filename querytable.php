<?php
include_once('styles/styles.css');
include_once('functions.php');
include_once('connect.php');
include_once('models/Dystrybutor.php');
include_once('includes/header.html');	
include_once('includes/form.html'); 
include_once('sql/selectQuery.php');
?>
<table id = "view_table"><thead>
		<th class='name'>Nazwa</th>
		<th class='contact'>Osoba kontaktowa</th>
		<th class='telephone'>Telefon</th>
		<th class='mail'>Email</th>
		<th class='offer'>Oferta</th>
		<th class='coordinator'>Koordynator</th>
</thead>
	<?php

#echo '' . $query . '<br>';
if (!empty($_GET)){
	#echo "QUERY: " . $query;
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result))
{
	$dystrybutor = new Dystrybutor($row);
	?><tr>
	<td><?php echo $dystrybutor->deal_string(); ?><button><a href="display.php?dbid=<?php echo $dystrybutor->get_id(); ?>" action = '<?php session_start(); $_SESSION['dbid'] = $dystrybutor->get_id(); ?>'><?php echo $dystrybutor->get_name(); ?></a></button></td>
	<td><?php echo $dystrybutor->get_contact(); ?></td>
	<td><?php echo $dystrybutor->get_telephone(); ?></td>
	<td><?php echo $dystrybutor->get_email();?></td>
	<td><?php echo $dystrybutor->get_offer();?></td>
	<td><?php echo $dystrybutor->get_coordinator();?></td>
	</tr><?php
}?></table>
<?php
}

?>
