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

    <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>
<div>
    <nav class="navbar navbar-expand-sm bg-dark">
        <small class="pr-2 text-white">Powered by</small>
        <img class="navbar-brand nav-height" src="umd-logo-trans.jpg"/>
        <ul class="navbar-nav ml-auto">
            <li class="nav-link">
                <button type="button" class="btn bg-terps-gold text-black black-hover" data-toggle="modal"
                        data-target="#login">Login
                </button>
            </li>
            <li class="nav-link">
                <button type="button" class="btn bg-terps-gold text-black black-hover" data-toggle="modal"
                        data-target="#register">Register
                </button>
            </li>
        </ul>
    </nav>
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
                        <li>
                            Free to use.
                        </li>
                        <li>
                            Find Terps with similar interests, ideas, and goals as you.
                        </li>
                        <li>
                            Define the type of relationship you are looking for.
                        </li>
                        <li>
                            Direct message Terps that you match with.
                        </li>
                        <li>
                            Give feedback on your matches to help us tune future matches.
                        </li>
                    </ul>
                    <ul>
                        <li class="standout-point">
                            <strong>Become connected with Terps like never before.</strong>
                        </li>
                    </ul>
                    <div class="col-12 text-center pb-3">
                        <a class="btn btn-lg bg-terps-red text-white" href="#">Register Now</a>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4 text-center">
                <blockquote class="blockquote">
                    <p>
                        I met not only my first wife, but my next ten wives all on TerpMatch!
                        It's the best for UMD students.
                    </p>
                </blockquote>
                <em>- Finn Denhard</em>
            </div>
            <div class="col-4 text-center">
                <blockquote class="blockquote">
                    <p>
                        I was looking for someone to study with, but instead I found the
                        love of my life! Thanks TerpMatch!
                    </p>
                </blockquote>
                <em>- Fonn Donhord</em>
            </div>
            <div class="col-4 text-center">
                <blockquote class="blockquote">
                    <p>
                        I like turtles way more than the average person, so TerpMatch was
                        the perfect site for me.
                    </p>
                </blockquote>
                <em>- Fann Dinhurd</em>
            </div>
        </div>
    </div>
</div>
<div class="bg-dark mt-5 pb-1 pt-3">
    <h3 class="text-center text-white display-4">4 Easy Steps to Find the Perfect Terp</h3>
    <div class="card-deck pt-3 px-5 pb-3">
        <div class="card bg-terps-gold">
            <div class="card-body text-center">
                <h4 class="card-title">&#9312; Register Here</h4>
                <p class="card-text">
                    Sign up for TerpMatch by creating an account. It's as easy as
                    choosing a username and password. No payment. No strings attached.
                </p>
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
<div class="modal" id="register">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Registration</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="registration-form" method="post" onsubmit="return validation()" action="index.php">
                    <div class="form-row">
                        <div class="form-group col-sm-2">
                            <label>First name <span style="color:red">*</span>
                                <input class="form-control" type="text" name="first_name" required>
                            </label>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Middle name
                                <input class="form-control" type="text" name="middle_name">
                            </label>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Last name <span style="color:red">*</span>
                                <input class="form-control" type="text" name="last_name" required>
                            </label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Birthday
                                <input class="form-control" type="date" name="birthday" min="1950-1-1" max="2005-12-13">
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Gender
                                <select class="form-control" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn-default btn" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" data-dismiss="modal">
            </div>

        </div>
    </div>
</div>

<div class="modal" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Username:
                                <input class="form-control" type="text" name="username">
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Password:
                                <input class="form-control" type="password" name="password">
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Login</button>
            </div>

        </div>
    </div>
</div>

</body>

</html>
