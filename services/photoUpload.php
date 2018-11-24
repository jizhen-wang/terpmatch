<?php

session_start();
require_once "photodb.php";

$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$username = trim($_SESSION['current_user']);
$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
$sql = sprintf("INSERT INTO photos VALUES('%s', '%s', '%s')", $username, $photo, mime_content_type($_FILES['photo']['tmp_name']));
//echo $sql;
$result = mysqli_query($db_connection, $sql);

if ($result) {
    echo "success";
} else {
    $sql = sprintf("REPLACE INTO photos VALUES('%s', '%s', '%s')", $username, $photo, mime_content_type($_FILES['photo']['tmp_name']));
    $result = mysqli_query($db_connection, $sql);
    if ($result){
        echo "success";
    }else{
        echo $result;
    }
}

?>
