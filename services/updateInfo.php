<?php
/* Yufei Huang 10/29/2018 */

require_once "dblogin.php";

$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}

$username = trim($_POST['username_update']);
$password = password_hash($_POST["password_update"], PASSWORD_DEFAULT);
$first_name = trim($_POST['first_name']);
$middle_name = trim($_POST['middle_name']);
$last_name = trim($_POST['last_name']);
$gender = $_POST['gender'];
$bd = $_POST['birthday'];
$year_in_school = $_POST['year_in_school'];
$major = $_POST['major'];
$minor = $_POST['minor'];
$rs_type = $_POST['rs_type'];
$rs_status = $_POST['rs_status'];
$rs_seeking = $_POST['rs_seeking'];

$sql = "UPDATE accounts
    SET password='{$password}', first_name='{$first_name}', middle_name='{$middle_name}', last_name='{$last_name}', gender='{$gender}', birthdate='{$bd}',
    year_in_school='{$year_in_school}', major='{$major}', minor='{$minor}', rs_type='{$rs_type}', rs_status='{$rs_status}', rs_seeking='{$rs_seeking}'
    WHERE username='{$username}'";

$result = mysqli_query($db_connection, $sql);

if ($result) {
    session_start();
    $_SESSION["current_user"] = $_POST["username_update"];
    echo "success";
} else {
    echo mysqli_error($db_connection);
}

?>
