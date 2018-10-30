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

  <script src="js/profile.js"></script>

  <link rel="stylesheet" href="css/profile.css"/>
</head>

<body>
  <div class="container-fluid">
    <div class="row h-100">

      <!-- Sidebar -->
      <nav class="col-sm-3 col-md-2 bg-dark sidebar p-3">

        <!-- Profile Picture -->
        <img src="img/default.jpg" alt="Profile Picture" class="rounded-circle sidebar-image mt-3" />

        <h4 class="text-center pt-2 text-white">First Last</h4>
        <p class="text-center text-light">
          <em>username</em>
        </p>
        <p class="text-light">
          Your bio goes here. Short text describing you.
        </p>

        <hr />

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
            <a class="nav-link text-light" href="updateInfo.php">Update</a>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <div class="col-sm-9 col-md-10">
        <div class="pt-2" id="header">
          <h2 class="display-4 logo">TerpMatch&#x1F422;</h2>
        </div>

        <hr />

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
                      Gender
                    </th>
                    <td>
                      M/F/Other
                    </td>
                  </tr>
                  <tr>
                    <th>
                      Year
                    </th>
                    <td>
                      Senior
                    </td>
                  </tr>
                  <tr>
                    <th>
                      Major
                    </th>
                    <td>
                      Your Major
                    </td>
                  </tr>
                  <tr>
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
                      M/F/Other
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

        <br />
      </div>
    </div>
  </body>

  </html>
