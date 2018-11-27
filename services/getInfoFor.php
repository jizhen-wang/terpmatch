<?php
require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
  die($db_connection->connect_error);
}

session_start();
$current_user = $_SESSION["current_user"];

$sqlQuery = sprintf("select * from accounts where username='%s'",$_GET["name"]);

$user_result = mysqli_query($db_connection, $sqlQuery);
$res_array = mysqli_fetch_array($user_result, MYSQLI_ASSOC);

$username = $res_array["username"];
$name = $res_array["first_name"] . "_" . $res_array["last_name"];
$gender = $res_array["gender"];
$year = $res_array["year_in_school"];
$major = $res_array["major"];
$minor = $res_array["minor"];
$hobbies = $res_array["hobbies"];
$interests = $res_array["interests"];
$goals = $res_array["goals"];
$bio = $res_array["bio"];

$info[] = array('username'=> $username,'name'=> $name, 'gender'=> $gender,
  'year'=>$year, 'major'=>$major, 'minor'=>$minor, 'hobbies'=>$hobbies,
  'interests'=>$interests, 'goals'=>$goals, 'bio'=>$bio);

$res_json = json_encode($info);

echo $res_json;
?>
