<?php
/* Yufei Huang 10/29/2018 */

require_once "dblogin.php";
session_start();

$db_connection=new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$first_name = trim($_POST['first_name']);
$middle_name = trim($_POST['middle_name']);
$last_name = trim($_POST['last_name']);
$gender = $_POST['gender'];
$bd = $_POST['birthday'];
$year_in_school = $_POST['year_in_school'];
$major = $_POST['major'];

$sql = sprintf("INSERT INTO accounts VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $username, $password, $first_name, $middle_name, $last_name, $gender, $bd, $year_in_school, $major); 
echo $sql;
$result = mysqli_query($db_connection, $sql);

if ($result) {
    echo "hey it works";
    session_start();
    $_SESSION["current_user"] = $_POST["username"];
    header("Location: index.php");
    exit();
}
else {
    echo "oh it fails";
    echo $result;
    echo mysqli_error($db_connection);
}
    
?>
