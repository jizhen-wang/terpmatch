<?php

require_once "dblogin.php";

$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}
session_start();
$sender = trim($_SESSION['current_user']);
$receiver = $_POST['receiver'];
$body = trim($_POST['body']);
$timestamp = date('Y-m-d H:i:s');

$sql = sprintf("INSERT INTO messages VALUES('%s', '%s', '%s', '%s')",
  $sender, $receiver, $body, $timestamp);
//echo $sql;
$result = mysqli_query($db_connection, $sql);

if ($result) {
    header("Location: ../messages.php");
} else {
    echo mysqli_error($db_connection);
}

?>
