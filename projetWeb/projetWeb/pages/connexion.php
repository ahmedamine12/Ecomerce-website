<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fin_base";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
// $conn="";
// $MODE="";
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpassword = "toor";
// $database = "mydbpdo";

// $conn = new PDO ( "mysql:host=$dbhost;dbname=$database", "$dbuser", "$dbpassword", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
// $conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
