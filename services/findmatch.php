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

$sqlOthers = sprintf("select * from accounts where not (username='%s')",$current_user);

$others_result = mysqli_query($db_connection, $sqlOthers);

$numberOfPotentialMatches = mysqli_num_rows($others_result);

$maxScore = 1;
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
    $sql = sprintf("SELECT * FROM matches WHERE match_username='%s'", $other_info["username"]);
    $res = mysqli_query($db_connection, $sql);
    if (mysqli_num_rows($res) == 0) {

      //gen score
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
      if ($user_info["rs_status"] == $other_info["rs_status"]) {
        $score += 70;
      }
      if ($user_info["rs_type"] != $other_info["rs_type"]) {
        $score = 0;
      }
      if ($user_info["rs_seeking"] != $other_info["gender"] || $user_info["gender"] != $other_info["rs_seeking"]) {
        $score = 0;
      }

      if ($score > $maxScore) {
        $maxScore = $score;
        $maxScoreUser = $other_info["username"];
      }
    }
  }
}

$res_json = "";

if ($maxScoreUser != "") {
  //found match, query and return info, and add to matches table
  $sql = sprintf("SELECT * FROM accounts WHERE username='%s'", $maxScoreUser);
  $res = mysqli_query($db_connection, $sql);

  $res_array = mysqli_fetch_array($res, MYSQLI_ASSOC);

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
    'interests'=>$interests, '$goals'=>$goals, 'bio'=>$bio);

  $res_json = json_encode($info);

  $addSql = sprintf("INSERT INTO matches VALUES ('%s','%s',%d)", $current_user, $username, $maxScore);
  $res2 = mysqli_query($db_connection, $addSql);
}

echo $res_json;
?>
