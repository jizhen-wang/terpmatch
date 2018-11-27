<?php
/* Assumes file to retrieve is passed via URL parameter */
require_once("photodb.php");
session_start();

$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$current_user = $_GET["user"];

$sqlQuery = "select count(*) as c from $table where username = '{$current_user}'";
$result = mysqli_query($db_connection, $sqlQuery);

if ($result) {
  $resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC);
  echo json_encode($resultArr);
}

?>
