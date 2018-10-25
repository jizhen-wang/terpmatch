<!DOCTYPE html>
<html lang="en">
<head>
    <title>TerpMatch Registration</title>

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
    <script src="js/validation.js"></script>
    <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>
<div id="registration">
    <nav class="navbar navbar-expand-sm bg-semiTrans">
        <h1 class="navbar-brand logo">TerpMatch&#x1F422;</h1>
        <ul class="navbar-nav ml-auto">
            <li class="nav-link">
                <a class="btn bg-kale" href="#">Login</a>
            </li>
        </ul>
    </nav>
    <br>
    <div class="container-fluid">
        <h2>Your Information</h2>
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
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label>Birthday
                        <input class="form-control" type="date" name="birthday" min="1950-1-1" max="2005-12-13">
                    </label>
                </div>
                <div class="form-group col-sm-2">
                    <label>Gender
                        <select class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label>
                        <input type="submit" class="form-control">
                    </label>
                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
</body>

</html>
