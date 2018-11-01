<?php
/* Yufei Huang 10/29/2018 */

require_once "dblogin.php";

$db_connection=new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$username = trim($_POST['username_regist']);
$password = $_POST['password_regist'];
$first_name = trim($_POST['first_name']);
$middle_name = trim($_POST['middle_name']);
$last_name = trim($_POST['last_name']);
$gender = $_POST['gender'];
$bd = $_POST['birthday'];
$year_in_school = $_POST['year_in_school'];
$major = $_POST['major'];

$sql = sprintf("INSERT INTO accounts VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $username, $password, $first_name, $middle_name, $last_name, $gender, $bd, $year_in_school, $major); 
//echo $sql;
$result = mysqli_query($db_connection, $sql);

if ($result) {
    session_start();
    $_SESSION["current_user"] = $_POST["username_regist"];
    echo "success";
} else {
    echo mysqli_error($db_connection);
}
    
?>
