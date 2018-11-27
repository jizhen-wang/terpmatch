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

    <script src="js/messages.js"></script>
    <script src="js/photo.js"></script>
    <link rel="stylesheet" href="css/profile.css"/>
</head>
<?php
require_once "services/dblogin.php";
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


?>
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
            //session_start();
            echo '<h4 class="text-center pt-2 text-white">' . $_SESSION["first_name"] .
                " " . $_SESSION["last_name"] . "</h4>";
            echo '<p class="text-center text-light">
                <em>' . $_SESSION["current_user"] . '</em></p>';
            if (!strlen($_SESSION["bio"]) > 0) {
                echo '<p class="text-center">';
                echo '<a class="pt-2 text-white" href="profile.php?moreInfo=1">Add My Bio</a>';
            } else {
                echo '<p class="text-light text-center">';
                echo $_SESSION["bio"];
            }
            echo '</p>'
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
                    <a class="nav-link active-sb disabled text-dark" href="#">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="update.php">Update
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
                <h2 class="display-4 logo">TerpMatch&#x1F422;</h2>
            </div>

            <hr/>

            <div class="mx-3">
                <h1 class="pb-3">
                    <b>Messaging</b>
                </h1>

                <h3>Send a Message</h3>

                <!-- Matches card decks -->
                <!-- After generate matches is pressed, append new deck to this div -->
                <div id="messaging div">
                  <form action="services/sendMessage.php" method="post" onsubmit="return validateMessage()">
                    To: <input type="text" class="form-control" id="receiver" name="receiver"/><br />
                      <?php
                        if (isset($_GET["receiver"])){
                            echo '<script>document.getElementById("receiver").setAttribute("value","' . $_GET["receiver"] .'")</script>';
                        }
                      ?>
                    Message Text: <br /><textarea name="body" id="body" class="form-control"></textarea><br />
                    <button type="submit" id="send" class="btn bg-terps-red btn-block text-white">Send</button>
                    <br />
                  </form>
                </div>

                <div id="messages">
                  <h3>Sent Messages</h3>
                  <?php
                  $sqlQuery = sprintf("select * from messages where sender='%s'",
                      $_SESSION["current_user"]);
                  $result = mysqli_query($db_connection, $sqlQuery);
                  if ($result) {
                    echo "<table class='table table-bordered'><tr><th>Timestamp</th><th>Recipient</th><th>Message</th></tr>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                      echo "<tr><td>{$row['timestamp']}</td><td>{$row['receiver']}</td><td>{$row['message_body']}</td></tr>";
                    }
                    echo "</table>";

                  }
                  ?>

                  <h3>Recieved Messages</h3>
                  <?php
                  $sqlQuery = sprintf("select * from messages where receiver='%s'",
                      $_SESSION["current_user"]);
                  $result = mysqli_query($db_connection, $sqlQuery);
                  if ($result) {
                    echo "<table class='table table-bordered'><tr><th>Timestamp</th><th>Sender</th><th>Message</th></tr>";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                      echo "<tr><td>{$row['timestamp']}</td><td>{$row['sender']}</td><td>{$row['message_body']}</td></tr>";
                    }
                    echo "</table>";

                  }
                  ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
