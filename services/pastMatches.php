<?php

require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
  die($db_connection->connect_error);
}

session_start();
$current_user = $_SESSION["current_user"];

?>
