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
    str += `<h3 class='p-2' onclick="document.location='messages.php?receiver=${inData["username"]}';return false;">${name}</h3>`;
    str += "<div class='container-fluid'><div class='row'>";
    str += "<div class='col-4'>"
    str += `<p><strong>Gender: </strong>${capitalizeFirstLetter(inData['gender'])}</p>`;
    str += `<p><strong>Year: </strong>${capitalizeFirstLetter(inData['year'])}</p>`;
    str += `<p><strong>Major: </strong>${capitalizeFirstLetter(inData['major'])}</p>`;
    str += `<p><strong>Minor: </strong>${capitalizeFirstLetter(inData['minor'])}</p>`;
    str += '</div>';
    str += "<div class='col-8'>"
    str += `<p><strong>Hobbies: </strong>${capitalizeFirstLetter(inData['hobbies'])}</p>`;
    str += `<p><strong>Interests: </strong>${capitalizeFirstLetter(inData['interests'])}</p>`;
    str += `<p><strong>Goals: </strong>${capitalizeFirstLetter(inData['goals'])}</p>`;
    str += '</div>';
    str += "</div></div></div></div></div>";

    $('#matches-deck').append(str);
}

function generateMatch() {
    $.get('services/findmatch.php', function (data) {
        //alert(data);
        if (data != "") {
            let matchResult = JSON.parse(data)[0];
            console.log(matchResult);
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
