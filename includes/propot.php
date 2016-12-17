<?php 
include_once('Dystrybutor.php');
include_once('models/CoordinatorForm.php');
?>
<!DOCTYPE html>
<html>
<body>

<p><?php 
$form = new CoordinatorForm('663');


 ?></p>
<p id="demo"></p>
<form  action = 'propot.php' method = 'post' >
	<?php $form->outputCoordinators(); ?> 
	<input type = 'submit' value = 'wprowadź zmiany'>
</form>
<?php
if(isset($_POST)) {
	#$update = new CoordinatorUpdate($_POST['coordinators']);
	echo "POST RECEIVED";
}

?>

</body>
</html>
