<?php
/**
 * Created by PhpStorm.
 * User: jizhenwang
 * Date: 10/28/18
 * Time: 20:31
 */
require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}
$sqlQuery = sprintf("select * from accounts where username='%s'",
    $_POST["username"]);
$result = mysqli_query($db_connection, $sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $numberOfRows = mysqli_num_rows($result);
    if ($numberOfRows == 1 && password_verify($_POST["password"], $recordArray["password"])) {
        session_start();
        $_SESSION["current_user"] = $_POST["username"];
        $_SESSION["curr_name"] = $recordArray["first_name"];
        echo "success";
        exit();
    }
}
?>