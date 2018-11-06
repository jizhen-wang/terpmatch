<!DOCTYPE html>
<html lang="en">

<?php
require_once "services/dblogin.php";
session_start();
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

    <script src="js/profile.js"></script>

    <link rel="stylesheet" href="css/profile.css"/>
</head>

<body>
<div class="container-fluid">
    <div class="row h-100">

        <!-- Sidebar -->
        <nav class="col-sm-3 col-md-2 bg-dark sidebar p-3">

            <!-- Profile Picture -->
            <img onclick="show_profile()" src="img/default.jpg" alt="Profile Picture"
                 class="rounded-circle sidebar-image mt-3"
            >
            <?php
            echo '<h4 class="text-center pt-2 text-white">' . $_SESSION["first_name"] .
                " " . $_SESSION["last_name"] . "</h4>";
            echo '<p class="text-center text-light">
                <em>' . $_SESSION["current_user"] . '</em></p>';



            if (!isset($_SESSION["bio"])) {
                echo '<p class="text-center">';
                echo '<a class="pt-2 text-white" href="services/updateInfo.php">Add My Bio</a>';
            }else{
                echo '<p class="text-light">';
            }
            echo '</p>'
            ?>
            <hr/>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active-sb disabled text-dark" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="matches.php">Matches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="messages.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="services/updateInfo.php">Update</a>
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
                    <b>About You</b>
                    <small class="text-gray"><em>This information can be seen by your matches.</em></small>
                </h1>
                <div class="card-deck">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="pb-2">School & Personal Info</h3>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>
                                        <?php
                                        echo 'Gender';
                                        echo '</th>
                                    <td>';
                                        echo ucfirst($_SESSION['gender']);
                                        echo '</td>
                                </tr>
                                <tr>';

                                        echo '<th>
                                        Year
                                    </th>
                                    <td>';
                                        echo ucfirst($_SESSION["year_in_school"]);
                                        echo '</td>
                                </tr>';
                                        echo '<tr>
                                    <th>
                                        Major
                                    </th>
                                    <td>';
                                        echo $_SESSION["major"];
                                        echo '</td>
                                </tr>
                                <tr>'; ?>
                                    <th>
                                        Minor
                                    </th>
                                    <td>
                                        None
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="pb-2">Match Info</h3>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>
                                        Seeking
                                    </th>
                                    <td>
                                        <?php
                                       echo ucfirst($_SESSION["gender"]);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Relationship Type
                                    </th>
                                    <td>
                                        Study Buddy
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Language
                                    </th>
                                    <td>
                                        English
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Relationship Status
                                    </th>
                                    <td>
                                        Single
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hobbies and Interests -->
            <div class="mx-3 mt-3">
                <div class="card-deck">
                    <div class="card shadow">
                        <div class="card-body pb-3">
                            <p>
                                <b>Hobbies:</b>
                                Your, Hobbies, Go, Here
                            </p>
                            <p>
                                <b>Interests:</b>
                                Your, Interests, Go, Here
                            </p>
                            <p>
                                <b>Goals:</b>
                                Your, goals, should, be, here
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
        </div>
    </div>
</body>

</html>
