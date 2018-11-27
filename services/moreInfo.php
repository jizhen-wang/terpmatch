<?php
/* Yufei Huang 10/29/2018 */

require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}
$hobbies = trim(substr($_POST['hidden'],0,strlen($_POST['hidden']) - 1));
$interests = "";
if (isset($_POST['interests'])) {
  $interests = implode(",", $_POST['interests']);
}
$goals = trim($_POST['goals']);
$bio = trim($_POST['bio']);

session_start();
$sql = sprintf("UPDATE accounts SET hobbies = '%s', interests ='%s', goals = '%s', bio='%s' WHERE username='%s'",
    $hobbies, $interests, $goals, $bio, $_SESSION["current_user"]);
//echo $sql;
$result = mysqli_query($db_connection, $sql);

if ($result) {
    echo "success";
} else {
    echo mysqli_error($db_connection);
}

?>
