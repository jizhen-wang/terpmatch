function login() {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "services/login.php", false);
    let formData = new FormData(document.querySelector("#login_form"));
    xmlHttp.send(formData);
    /* processing response */
    if (xmlHttp.readyState === 4) {
        if (xmlHttp.status === 200) {
            let results = xmlHttp.responseText;
            //alert(results);
            if (results === "success") {
                location.reload();
            } else {
                addAlert();
                //document.querySelector("#login_form").reset();
                return false;
            }
        }
    }
}

function addAlert() {
    $("#alerts").empty().append(
        '<div class="alert alert-danger" role="alert">' +
        'Invalid credentials.' +
        '</div>');
}