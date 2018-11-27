function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

let firstMatch = true;

function displayCard(inData) {
    $('#no-matches-text').hide();

    $.get('services/hasPicture.php', {user:`${inData['username']}`}).done(function (data) {
      let returned = JSON.parse(data);
      console.log(returned);
      let hasPhoto = returned['c'] > 0;

      let str = "<div class='card-deck'>";
      str += "<div class='card shadow'>";
      str += "<div class='card-body'>";
      let first = inData["name"].split("_")[0];
      let last = inData["name"].split("_")[1];
      let name = capitalizeFirstLetter(first + " " + last);
      if (firstMatch) {
        str += `<h3 class='p-2' onclick="document.location='messages.php?receiver=${inData["username"]}';return false;">${name} - <small><em>${inData["username"]}</em></small> <span class='text-warning'>&#9733</span></h3>`;
      } else {
        str += `<h3 class='p-2' onclick="document.location='messages.php?receiver=${inData["username"]}';return false;">${name} - <small><em>${inData["username"]}</em></small></h3>`;
      }
      str += "<div class='container-fluid'><div class='row'>";
      str += "<div class='col-4'>"
      str += `<p><strong>Gender: </strong>${capitalizeFirstLetter(inData['gender'])}</p>`;
      str += `<p><strong>Year: </strong>${capitalizeFirstLetter(inData['year'])}</p>`;
      str += `<p><strong>Major: </strong>${capitalizeFirstLetter(inData['major'])}</p>`;
      str += `<p><strong>Minor: </strong>${capitalizeFirstLetter(inData['minor'])}</p>`;
      str += '</div>';
      str += "<div class='col-5'>"
      str += `<p><strong>Bio: </strong>${capitalizeFirstLetter(inData['bio'])}</p>`;
      str += `<p><strong>Hobbies: </strong>${capitalizeFirstLetter(inData['hobbies'])}</p>`;
      str += `<p><strong>Interests: </strong>${capitalizeFirstLetter(inData['interests'])}</p>`;
      str += `<p><strong>Goals: </strong>${capitalizeFirstLetter(inData['goals'])}</p>`;
      str += '</div>';
      str += "<div class='col-3'>"
      if (hasPhoto) {
        str += `<img src='services/retrieveMatchPhoto.php?user=${inData["username"]}' alt='Profile picture' class='rounded-circle match-image' />`;
      } else {
        str += `<img src='img/default.jpg' alt='Profile picture' class='rounded-circle match-image' />`;
      }
      str += '</div>';
      str += "</div></div></div></div></div>";

      firstMatch = false;

      $('#matches-deck').append(str);
    });
}

function generateMatch() {
    $.get('services/findmatch.php', function (data) {
        //alert(data);
        if (data != "") {
            let matchResult = JSON.parse(data)[0];
            displayCard(matchResult);
        } else {
            alert("No more matches! Check back later.");
        }
    });
}

function getInfo(username) {
    $.get("services/getInfoFor.php", {name: `${username}`}).done(function (data) {
        if (data != "") {
            let matchResult = JSON.parse(data)[0];
            displayCard(matchResult);
        }
    });
}

function getPreviousMatches() {
    $.get("services/pastMatches.php").done(function (data) {
        if (data != "") {
            let pastMatchesNames = JSON.parse(data);
            for (let i = 0; i < pastMatchesNames.length; i++) {
                getInfo(pastMatchesNames[i]);
            }
        }
    });
}

// document ready
$(function () {
    $('#no-matches-text').show();

    getPreviousMatches();

    $('#gen-match').click(function () {
        generateMatch();
    });
});
