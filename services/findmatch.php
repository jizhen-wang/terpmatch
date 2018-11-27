<?php
require_once "dblogin.php";
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
  die($db_connection->connect_error);
}

session_start();
$current_user = $_SESSION["current_user"];

$sqlQuery = sprintf("select * from accounts where username='%s'",$current_user);

$user_result = mysqli_query($db_connection, $sqlQuery);
$user_info = mysqli_fetch_array($user_result, MYSQLI_ASSOC);

$sqlOthers = sprintf("select * from accounts where not username='%s'",$current_user);

$others_result = mysqli_query($db_connection, $sqlOthers);

$numberOfPotentialMatches = mysqli_num_rows($others_result);

$maxScore = -1;
$maxScoreUser = "";

if ($numberOfPotentialMatches != 0) {
  //there are some potential matches
  //iterate through each one
  // 1. Check if already matched
  // 2. If not, generate score, check versus max
  //    If so, ignore them
  // 3. echo username of highest score or query and return result

  while ($other_info = mysqli_fetch_array($others_result, MYSQLI_ASSOC)) {
    //check if already matched here

    //generate score
    $score = 0;
    //name based scoring
    if ($user_info["first_name"] == $other_info["first_name"]) {
      $score += 20;
    }
    if ($user_info["middle_name"] == $other_info["middle_name"]) {
      $score += 50;
    }
    if ($user_info["last_name"] == $other_info["last_name"]) {
      $score += 1;
    }

    //age based scoring
    $user_age = 2018-(int)explode("-",$user_info["birthdate"])[0];
    $other_age = 2018-(int)explode("-",$other_info["birthdate"])[0];

    if ($user_age - $other_age < 2 || $user_age - $other_age > -2) {
      $score += 100;
    }
    if ($user_age == $other_age) {
      $score += 10;
    }

    //college based scoring
    if ($user_info["year_in_school"] == $other_info["year_in_school"]) {
      $score += 100;
    }
    $majorsSame = false;
    $minorsSame = false;
    if ($user_info["major"] == $other_info["major"]) {
      $score += 150;
      $majorsSame = true;
    }
    if ($user_info["minor"] == $other_info["minor"]) {
      $score += 50;
      $minorsSame = true;
    }
    if ($majorsSame && $minorsSame) {
      $score += 500;
    }

    //relationship based scoring
  }
}

echo var_dump($user_info);
echo var_dump($others_result);
?>
