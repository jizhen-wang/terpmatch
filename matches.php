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

    <script src="js/matches.js"></script>
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
                    <a class="nav-link active-sb disabled text-dark" href="#">Matches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="messages.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?moreInfo=1">Update
                    </a>
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
                    <b>Your top matches</b>
                </h1>

                <!-- Matches card decks -->
                <!-- After generate matches is pressed, append new deck to this div -->
                <div id="matches-deck">
                    <div id="no-matches-text">
                        <h6>No matches yet! Click "Generate Matches" to get started.</h6>
                    </div>
                    <!-- <div class="card-deck">
                        Match One
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="img/default.jpg" alt="profile picture" class="card-img-top rounded-circle"/>
                                <h4 class="pt-3">Match One</h4>
                                <p>
                                    Bio text goes here. This is the same as the bio text that the
                                    match sets.
                                </p>
                                <p class="text-center">
                                    <b>Score:</b> XX
                                </p>
                            </div>
                        </div>

                        Match Two
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="img/default.jpg" alt="profile picture" class="card-img-top rounded-circle"/>
                                <h4 class="pt-3">Match Two</h4>
                                <p>
                                    Bio text goes here. This is the same as the bio text that the
                                    match sets.
                                </p>
                                <p class="text-center">
                                    <b>Score:</b> XX
                                </p>
                            </div>
                        </div>

                        Match Three
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="img/default.jpg" alt="profile picture" class="card-img-top rounded-circle"/>
                                <h4 class="pt-3">Match Three</h4>
                                <p>
                                    Bio text goes here. This is the same as the bio text that the
                                    match sets.
                                </p>
                                <p class="text-center">
                                    <b>Score:</b> XX
                                </p>
                            </div>
                        </div>

                        Match Four
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="img/default.jpg" alt="profile picture" class="card-img-top rounded-circle"/>
                                <h4 class="pt-3">Match Four</h4>
                                <p>
                                    Bio text goes here. This is the same as the bio text that the
                                    match sets.
                                </p>
                                <p class="text-center">
                                    <b>Score:</b> XX
                                </p>
                            </div>
                        </div>
                    </div> -->
                </div>

                <!-- Generate More Matches -->
                <div class="my-5 text-center">
                    <button class="btn btn-xl bg-terps-red text-white py-4">Generate Matches</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/photo.js"></script>
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
</body>

</html>
