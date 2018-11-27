// <div class="card shadow">
//     <div class="card-body">
//         <img src="img/default.jpg" alt="profile picture" class="card-img-top rounded-circle"/>
//         <h4 class="pt-3">Match One</h4>
//         <p>
//             Bio text goes here. This is the same as the bio text that the
//             match sets.
//         </p>
//         <p class="text-center">
//             <b>Score:</b> XX
//         </p>
//     </div>
// </div>

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function displayCard(inData) {
  $('#no-matches-text').hide();

  let str = "<div class='card-deck'>";
  str += "<div class='card shadow'>";
  str += "<div class='card-body'>";
  let first = inData["name"].split("_")[0];
  let last = inData["name"].split("_")[1];
  let name = capitalizeFirstLetter(first + " " + last);
  str += `<h3 class='p-2'>${name}</h3>`;
  str += "<div class='container-fluid'><div class='row'>";
  str += "<div class='col-4'>"
  str += `<p><strong>Gender: </strong>${capitalizeFirstLetter(inData['gender'])}</p>`;
  str += `<p><strong>Year: </strong>${capitalizeFirstLetter(inData['year'])}</p>`;
  str += `<p><strong>Major: </strong>${capitalizeFirstLetter(inData['major'])}</p>`;
  str += `<p><strong>Minor: </strong>${capitalizeFirstLetter(inData['minor'])}</p>`;
  str += '</div>';
  str += "<div class='col-4'>"
  str += `<p><strong>Hobbies: </strong>${capitalizeFirstLetter(inData['hobbies'])}</p>`;
  str += `<p><strong>Interests: </strong>${capitalizeFirstLetter(inData['interests'])}</p>`;
  str += `<p><strong>Goals: </strong>${capitalizeFirstLetter(inData['goals'])}</p>`;
  str += '</div>';
  str += "<div class='col-4'>"
  //image goes here
  str += '</div>';

  str += "</div></div></div></div></div>";

  $('#matches-deck').append(str);
}

function generateMatch() {
  $.get('services/findmatch.php', function (data) {
    if (data != "") {
      let matchResult = JSON.parse(data)[0];
      console.log(matchResult);
      displayCard(matchResult);
    } else {
      alert("No more matches! Check back later.");
    }
  });
}

function getPreviousMatches() {
  $.get( "services/pastMatches.php").done(function( data ) {
    alert( "Data Loaded: " + data );
  });
}

// document ready
$(function() {
  $('#no-matches-text').show();

  getPreviousMatches();

  $('#gen-match').click(function() {
    generateMatch();
  });
});
