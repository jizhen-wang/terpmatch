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

    <script src="js/registration.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>

<!-- Navbar -->
<?php
session_start();
$nav = "";
if (isset($_SESSION['current_user'])) {

    $nav = <<<EONAV
<nav class="navbar navbar-dark navbar-expand-sm bg-dark">
    <small class="pr-2 text-white">Powered by</small>
    <img class="navbar-brand nav-height" src="img/umd-logo-trans.jpg"/>
    <ul class="navbar-nav ml-auto">
        <span class="navbar-brand text-white">Welcome {$_SESSION["current_user"]}! </span>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="matches.php">Match</a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="#" onclick="kill_session()">Logout</a>
        </li>
    </ul>
</nav>
EONAV;
} else {
    $nav = <<<EONAV
<nav class="navbar navbar-expand-sm bg-dark">
    <small class="pr-2 text-white">Powered by</small>
    <img class="navbar-brand nav-height" src="img/umd-logo-trans.jpg"/>
    <ul class="navbar-nav ml-auto">
        <li class="nav-link">
            <button type="button" class="btn bg-terps-gold text-black black-hover" data-toggle="modal"
                    data-target="#login_modal">
                Login
            </button>
        </li>
        <li class="nav-link">
            <button type="button" class="btn bg-terps-gold text-black black-hover" data-toggle="modal"
                    data-target="#register_modal">
                Register
            </button>
        </li>
    </ul>
</nav>
EONAV;
}
echo $nav;
?>

<!-- Jumbotron with image and yellow text box -->
<div class="jumbotron" id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 bg-faded-yellow jumbo-margin rounded">
                <h2 class="pt-2 text-center display-4">Welcome to <span class="logo">TerpMatch&#x1F422;</span></h2>
                <p class="ml-2">
                    Whether you're looking for friends, study mates, or a significant other,
                    TerpMatch has you covered.
                </p>
                <ul>
                    <li>Free to use.</li>
                    <li>Find Terps with similar interests, ideas, and goals as you.</li>
                    <li>Define the type of relationship you are looking for.</li>
                    <li>Direct message Terps that you match with.</li>
                    <li>Give feedback on your matches to help us tune future matches.</li>
                </ul>
                <ul>
                    <li class="standout-point">
                        <strong>Become connected with Terps like never before.</strong>
                    </li>
                </ul>
                <div class="col-12 text-center pb-3">
                    <button type="button" class="btn btn btn-lg bg-terps-red text-white" data-toggle="modal"
                            data-target="#register_modal">
                        Register Now
                    </button>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</div>

<!-- Quotes from users -->
<div class="container">
    <div class="row">
        <div class="col-4 text-center">
            <blockquote class="blockquote">
                <p><em>
                        I met not only my first wife, but my next ten wives all on TerpMatch!
                        It's the best for UMD students.
                    </em>
                </p>
            </blockquote>
            <em>- Finn Denhard</em>
        </div>
        <div class="col-4 text-center">
            <blockquote class="blockquote">
                <p><em>
                        I was looking for someone to study with, but instead I found the
                        love of my life! Thanks TerpMatch!
                    </em>
                </p>
            </blockquote>
            <em>- Fonn Donhord</em>
        </div>
        <div class="col-4 text-center">
            <blockquote class="blockquote">
                <p><em>
                        I like turtles way more than the average person, so TerpMatch was
                        the perfect site for me.
                    </em>
                </p>
            </blockquote>
            <em>- Fann Dinhurd</em>
        </div>
    </div>
</div>

<!-- 4 easy steps -->
<div class="bg-dark mt-5 pb-1 pt-3">
    <h3 class="text-center text-white display-4">4 Easy Steps to Find the Perfect Terp</h3>
    <div class="container">
        <div class="card-deck pt-3 px-5 pb-3">
            <div class="card bg-terps-gold">
                <div class="card-body text-center">
                    <h4 class="card-title">&#9312; Register Here</h4>
                    <p class="card-text">
                        Sign up for TerpMatch by creating an account. It's as easy as
                        choosing a username and password. No payment. No strings attached.
                    </p>
                    <button type="button" class="btn btn btn-lg bg-terps-red text-white" data-toggle="modal"
                            data-target="#register_modal">
                        Register Now
                    </button>
                </div>
            </div>
            <div class="card bg-terps-gold">
                <div class="card-body text-center">
                    <h4 class="card-title">&#9313; Fill out info</h4>
                    <p class="card-text">
                        Help us find you the perfect TerpMatch by providing us with information
                        about yourself and your interests. We use this info solely for finding
                        you matches, not nefarious purposes.
                    </p>
                </div>
            </div>
            <div class="card bg-terps-gold">
                <div class="card-body text-center">
                    <h4 class="card-title">&#9314; Generate matches</h4>
                    <p class="card-text">
                        You choose when to look for matches. We make it easy to sort through
                        your matches so that you can generate new ones whenever you like.
                    </p>
                </div>
            </div>
            <div class="card bg-terps-gold">
                <div class="card-body text-center">
                    <h4 class="card-title">&#9315; Give feedback</h4>
                    <p class="card-text">
                        Once you have seen and interacted with a TerpMatch, you can rate
                        how we did as well as what you though of your match.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="login_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <!-- <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div> -->

            <!-- Modal body -->
            <form method="post" id= "login_form" onsubmit="return login()">
                <div class="modal-body">
                    <h3 class="modal-title py-3 text-center">Login to TerpMatch</h3>
                    <div id="alerts"></div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username"
                               required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="pwd" placeholder="Password"
                               required>
                    </div>
                    <input type="submit" class="btn bg-terps-red btn-block" value="Login">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="register_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Registration</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form name="registration" id="registration" method="post" onsubmit="return register()"
                      action="registration.php">
                    <div id="alerts_2"></div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Username
                                <input class="form-control" type="text" name="username" required>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Password
                                <input class="form-control" type="password" name="password_regist" required>
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
                                <input class="form-control" type="text" name="first_name" required>
                            </label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Middle name
                                <input class="form-control" type="text" name="middle_name">
                            </label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Last name
                                <input class="form-control" type="text" name="last_name" required>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Gender
                                <select class="form-control" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Birthday
                                <input class="form-control" type="date" name="birthday" min="1950-1-1" max="2005-12-13"
                                       required>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Year in School
                                <select class="form-control" name="year_in_school" required>
                                    <option value="freshman">Freshman</option>
                                    <option value="sophomore">Sophomore</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                    <option value="master">Masters Candidate</option>
                                    <option value="phd">Doctoral Candidate</option>
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
                                        echo "<option value=" . $line . ">" . $line . "</option>";
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn bg-terps-red btn-block" value="Register">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>


</body>

</html>

