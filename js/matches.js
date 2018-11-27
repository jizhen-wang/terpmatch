
function generateMatch() {
  $.get('services/findmatch.php', function (data) {
    $('#matches-deck').append(data);
  });
}

// document ready
$(function() {
  $('#no-matches-text').show();

  $('#gen-match').click(function() {
    generateMatch();
  });
});
