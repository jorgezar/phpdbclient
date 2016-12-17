<?php
include_once('./locals/IConnectInfo');
class connection implements IConnectInfo
{	
	public static $servername = IConnectInfo::HOST;
	public static $username = IConnectInfo::UNAME;
	public static $password = IConnectInfo::PW;
	public static $dbname = IConnectInfo::DBNAME;
    public static $port="3306";
    public static $pdo;

    public static function addConnection()
    {
      try {
          self::$pdo = new PDO("mysql:host=self::$servername;port=self::$port;dbname=self::$dbname", self::$username, self::$password);
          self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
      }

      self::$pdo->query("use self::$dbname");
      return self::$pdo;
    }
}