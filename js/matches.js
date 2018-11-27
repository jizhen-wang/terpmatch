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


function displayCard() {
  let str = "<div class='card-deck'>";
  str += "div class='card-shadow'>";
  str += "div class='card-body'>";
}

function generateMatch() {
  $.get('services/findmatch.php', function (data) {
    let matchResult = JSON.parse(data)[0];
    displayCard(matchResult);
  });
}

// document ready
$(function() {
  $('#no-matches-text').show();

  $('#gen-match').click(function() {
    generateMatch();
  });
});
