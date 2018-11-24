<?php
/* Assumes file to retrieve is passed via URL parameter */
require_once("photodb.php");
session_start();

$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$current_user = $_SESSION["current_user"];

$sqlQuery = "select docData, docMimeType from $table where username = '{$current_user}'";
$result = mysqli_query($db_connection, $sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_assoc($result);
    header("Content-type: " . "{$recordArray['docMimeType']}");
    echo $recordArray['docData'];
    mysqli_free_result($result);
} else {
    echo "img/default.jpg";
}

?>