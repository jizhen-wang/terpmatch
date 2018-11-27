<?php

require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
  die($db_connection->connect_error);
}

session_start();
$current_user = $_SESSION["current_user"];

$sqlQuery = sprintf("select match_username from matches where username='%s'",$current_user);
$past_matches_res = mysqli_query($db_connection, $sqlQuery);

if (mysqli_num_rows($past_matches_res) > 0) {;
  $names_arr = [];

  while ($pm_arr = mysqli_fetch_array($past_matches_res, MYSQLI_ASSOC)) {
    array_push($names_arr,$pm_arr["match_username"]);
  }

  echo json_encode($names_arr);
}

?>
