<?php
require_once "services/dblogin.php";
require_once "services/photodb.php";
session_start();
if (!isset($_SESSION['current_user'])) {
    // not logged in
    header('Location: index.php');
    exit();
}
$db_connection = new mysqli($host, $user, $db_password, $database);
if ($db_connection->connect_error) {
    die($db_connection->connect_error);
}
$sqlQuery = sprintf("select * from accounts where username='%s'",
    $_SESSION["current_user"]);
$result = mysqli_query($db_connection, $sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    foreach (array_keys($recordArray) as $key) {
        $_SESSION[$key] = $recordArray[$key];
    }
}
$sqlQuery = sprintf("select * from photos where username='%s'",
    $_SESSION["current_user"]);
$result = mysqli_query($db_connection, $sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($recordArray)) {
        foreach (array_keys($recordArray) as $key) {
            $_SESSION[$key] = $recordArray[$key];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TerpMatch</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap stuff below -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/profile.css"/>
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<script src="js/update.js"></script>
<script src="js/photo.js"></script>
<body>
<div class="container-fluid">
    <div class="row h-100">

        <!-- Sidebar -->
        <nav class="col-sm-3 col-md-2 bg-dark sidebar p-3">

            <!-- Profile Picture -->
            <?php
            $src = "img/default.jpg";
            if (isset($_SESSION["docData"])) {
                $src = "services/retrievePhoto.php";
            }
            echo <<<EOT
<img onclick="$('#photoModal').modal('show');" src={$src} alt="Profile Picture"
                 class="rounded-circle sidebar-image mt-3 img-fluid">
EOT;
            echo '<h4 class="text-center pt-2 text-white">' . $_SESSION["first_name"] .
                " " . $_SESSION["last_name"] . "</h4>";
            echo '<p class="text-center text-light">
                <em>' . $_SESSION["current_user"] . '</em></p>';


            if (!strlen($_SESSION["bio"]) > 0) {
                echo '<p class="text-center">';
                echo '<a class="pt-2 text-white" data-toggle="modal"
                    data-target="#extra_modal" href="#">Add My Bio</a>';
            } else {
                echo '<p class="text-light text-center">';
                echo $_SESSION["bio"];
            }
            echo '</p>';
            ?>
            <hr/>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="matches.php">Matches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="messages.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light active-sb disabled text-dark" href="#">
                      Update
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php">Main Screen</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="col-sm-9 col-md-10">
            <div class="pt-2" id="header">
                <h2 class="display-4 logo"><a href="index.php" class="link-red">TerpMatch&#x1F422;</a></h2>
            </div>

            <hr/>

            <div class="container-fluid pb-3">
              <div class="row">
                <div class="col-6">
                  <!-- Standard update here -->
                  <h4>Core Info</h4>

                  <div id="#alert"></div>
                  <script src="js/update.js"></script>
                  <form name="update" id="update" method="post" onsubmit="return updateInfo()"
                        action="services/updateInfo.php">
                      <div id="alert"></div>
                      <div class="form-row">
                          <div class="form-group col-sm-6">
                              <label>Username
                                  <?php
                                  echo '<input class="form-control" type="text" name="username_update" value="' .
                                      $_SESSION['current_user'] . '" required readonly>';
                                  ?>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-6">
                              <label>Password
                                  <input class="form-control" type="password" name="password_update" required>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-6">
                              <label>Confirm Password
                                  <input class="form-control" type="password" name="confirm" required>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-4">
                              <label>First name
                                  <?php
                                  echo '<input class="form-control" type="text" name="first_name" required value=' .
                                      $_SESSION["first_name"] . ">";
                                  ?>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Middle name
                                  <?php
                                  echo '<input class="form-control" type="text" name="middle_name"';
                                  if (isset($_SESSION["middle_name"])) {
                                      echo 'value=' . $_SESSION["middle_name"];
                                  }
                                  echo ">";
                                  ?>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Last name
                                  <?php
                                  echo '<input class="form-control" type="text" name="last_name" required value=' .
                                      $_SESSION["last_name"] . ">";
                                  ?>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-4">
                              <label>Gender
                                  <?php
                                  $select = <<<EO
<select class="form-control" name="gender" required>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                      <option value="other">Other</option>
                                  </select>
EO;
                                  $select = str_replace('value="' . $_SESSION["gender"] . '"',
                                      'selected="selected" value="' . $_SESSION["gender"] . '"', $select);
                                  echo $select;
                                  ?>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Birthday
                                  <input class="form-control" type="date" name="birthday" min="1950-1-1"
                                         max="2005-12-13" value="<?php echo $_SESSION['birthdate']; ?>"
                                         required>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-4">
                              <label>Year in School
                                  <select class="form-control" name="year_in_school" required>
                                    <?php
                                    if($_SESSION['year_in_school'] != "freshman") {
                                      echo '<option value="freshman">Freshman</option>';
                                    } else {
                                      echo '<option value="freshman" selected>Freshman</option>';
                                    }
                                    if($_SESSION['year_in_school'] != "sophomore") {
                                      echo '<option value="sophomore">Sophomore</option>';
                                    } else {
                                      echo '<option value="sophomore" selected>Sophomore </option>';
                                    }
                                    if($_SESSION['year_in_school'] != "junior") {
                                      echo '<option value="junior">Junior</option>';
                                    } else {
                                      echo '<option value="junior" selected>Junior</option>';
                                    }
                                    if($_SESSION['year_in_school'] != "senior") {
                                      echo '<option value="senior">Senior</option>';
                                    } else {
                                      echo '<option value="senior" selected>Senior</option>';
                                    }
                                    if($_SESSION['year_in_school'] != "master") {
                                      echo '<option value="master">Masters Candidate</option>';
                                    } else {
                                      echo '<option value="master" selected>Masters Candidate</option>';
                                    }
                                    if($_SESSION['year_in_school'] != "doctor") {
                                      echo '<option value="doctor">Doctoral Candidate</option>';
                                    } else {
                                      echo '<option value="doctor" selected>Doctoral Candidate</option>';
                                    }
                                    ?>
                                  </select>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Major
                                  <select class="form-control" name="major" required>
                                      <?php
                                      $fp = fopen("major.txt", "r");
                                      while (!feof($fp)) {
                                          $line = fgets($fp);
                                          if (trim($line) == trim($_SESSION['major'])) {
                                            echo "<option selected value=\"" . $line . "\">" . $line . "</option>";
                                          } else {
                                            echo "<option value=\"" . $line . "\">" . $line . "</option>";
                                          }
                                      }
                                      ?>
                                  </select>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Minor
                                  <select class="form-control" name="minor">
                                      <?php
                                      $fp = fopen("major.txt", "r");
                                      echo "<option value=" . 'None' . ">" . 'None' . "</option>";
                                      while (!feof($fp)) {
                                          $line = fgets($fp);
                                          if (trim($line) == trim($_SESSION['minor'])) {
                                            echo "<option selected value=" . $line . ">" . $line . "</option>";
                                          } else {
                                            echo "<option value=" . $line . ">" . $line . "</option>";
                                          }
                                      }
                                      ?>
                                  </select>
                              </label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group col-sm-4">
                              <label>Relationship Type
                                  <select class="form-control" name="rs_type">
                                    <?php
                                    if ($_SESSION['rs_type'] == "Study Buddy") {
                                        echo '<option value="Study Buddy" selected>Study Buddy</option>';
                                    } else {
                                      echo '<option value="Study Buddy">Study Buddy</option>';
                                    }
                                    if ($_SESSION['rs_type'] == "Friend") {
                                        echo '<option value="Friend" selected>Friend</option>';
                                    } else {
                                      echo '<option value="Friend">Friend</option>';
                                    }
                                    if ($_SESSION['rs_type'] == "Lover") {
                                        echo '<option value="Lover" selected>Lover</option>';
                                    } else {
                                      echo '<option value="Lover">Lover</option>';
                                    }
                                    ?>
                                  </select>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Relationship Status
                                  <select class="form-control" name="rs_status">
                                    <?php
                                    if ($_SESSION['rs_status'] == "Single") {
                                      echo '<option value="Single" selected>Single</option>';
                                    } else {
                                      echo '<option value="Single">Single</option>';
                                    }
                                    if ($_SESSION['rs_status'] == "Married") {
                                      echo '<option value="Married" selected>Married</option>';
                                    } else {
                                      echo '<option value="Married">Married</option>';
                                    }
                                    if ($_SESSION['rs_status'] == "Divorced") {
                                      echo '<option value="Divorced" selected>Divorced</option>';
                                    } else {
                                      echo '<option value="Divorced">Divorced</option>';
                                    }
                                    ?>
                                  </select>
                              </label>
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Seeking Gender
                                  <select class="form-control" name="rs_seeking">
                                    <?php
                                    if ($_SESSION['rs_seeking'] == "male") {
                                      echo '<option value="male" selected>Male</option>';
                                    } else {
                                      echo '<option value="male">Male</option>';
                                    }
                                    if ($_SESSION['rs_seeking'] == "female") {
                                      echo '<option value="female" selected>Female</option>';
                                    } else {
                                      echo '<option value="female">Female</option>';
                                    }
                                    if ($_SESSION['rs_seeking'] == "other") {
                                      echo '<option value="other" selected>Other</option>';
                                    } else {
                                      echo '<option value="other">Other</option>';
                                    }
                                    ?>
                                  </select>
                              </label>
                          </div>
                      </div>
                      <input type=submit class="btn bg-terps-red btn-block" value="Update">
                  </form>
                </div>
                <div class="col-6">
                  <!-- Extra info update here -->
                  <h4>More About You</h4>

                  <form autocomplete="off" action="#" id="more_info" method="post" onsubmit="addInfo()">
                      <div class="row">
                          <div class="col-4"><strong>Hobbies</strong></div>
                      </div>
                      <div class="row">
                          <div class="autocomplete form-group col-6" style="width:300px;">
                              <strong></strong>
                              <input style="text-transform: capitalize" class="form-control" id="myInput" type="text"
                                     name="myHobby"
                                     placeholder="Enter Your Hobbies Here">
                          </div>
                          <button class="form-control col-2" type="button" onclick="show()">
                              Add
                          </button>
                      </div>
                      <input type="hidden" name="hidden">
                      <div class="row">
                          <div class="col-12 pb-3">
                              <div id="allHobbies">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-4"><strong>Interests</strong></div>
                      </div>
                      <div class="row">
                          <div class="form-group col-8" style="width:300px;">
                              <strong></strong>
                              <label>
                                  <select class="form-control" name="interests[]" multiple required>
                                      <option value="Arts & Entertainment">Arts & Entertainment</option>
                                      <option value="Automotive & Vehicle ">Automotive & Vehicle</option>
                                      <option value="Beauty & Fitness ">Beauty & Fitness</option>
                                      <option value="Business & Industrial">Business & Industrial</option>
                                      <option value="Computers & Technology">Computers & Technology</option>
                                      <option value="Education and Employment">Education and Employment</option>
                                      <option value="Food & Drink">Food & Drink</option>
                                      <option value="Home & Garden">Home & Garden</option>
                                      <option value="Law & Government">Law & Government</option>
                                      <option value="Leisure & Hobbies"> Leisure & Hobbies</option>
                                      <option value="News">News</option>
                                      <option value="Science">Science</option>
                                      <option value="Shopping">Shopping</option>
                                      <option value="Sports">Sports</option>
                                      <option value="Travel">Travel</option>
                                      <option value="Video Games">Video Games</option>
                                  </select>
                              </label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-4"><strong>Goals</strong></div>
                      </div>
                      <div class="row">
                          <div class="form-group col-8" style="width:300px;">
                              <label>
                                  <textarea class="form-control" name="goals" required></textarea>
                              </label>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-4"><strong>Bio</strong></div>
                      </div>
                      <div class="row">
                          <div class="form-group col-8" style="width:300px;">
                              <label>
                                  <textarea class="form-control" name="bio"></textarea>
                              </label>
                          </div>
                      </div>
                      <input type=submit class="btn bg-terps-red btn-block" value="Update">
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="js/profile.js"></script>
    <div class="modal fade" id="photoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Upload Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="photoForm">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Choose Photo:</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <button type="button" class="btn bg-terps-red btn-block text-white" onclick="upload()">Upload
                            Profile Photo
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
