<?php
interface IConnectInfo 
{
	const HOST = 'localhost';
	const UNAME = 'root';
	const DBNAME = 'carda'; 
	const PW = '';
	
}
define("ROOT", realpath($_SERVER["DOCUMENT_ROOT"]) . "/dbclient/");

?>