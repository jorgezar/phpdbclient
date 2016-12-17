<?php 
$storeId = $_SESSION['user']->id; 
session_destroy();
session_start();
$user = new User($storeId);
$_SESSION['user'] = $user;
header("Location: account.php");

?>