function register() {
    function addAlert(message) {
        $('#alerts_2').empty().append(
            '<div class="alert alert-danger" role="alert">' +
            message +
            '</div>');
    }

    //alert(validation());
    if (validation().length !== 0) {
        addAlert(validation());
        return false;
    } else {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "services/registration.php", false);
        let formData = new FormData(document.querySelector("#registration"));
        xmlHttp.send(formData);
        /* processing response */
        if (xmlHttp.readyState === 4) {
            if (xmlHttp.status === 200) {
                let results = xmlHttp.responseText;
                alert(results);
                if (results === "success") {
                    location.reload();
                } else {
                    if (results.includes("Duplicate")) {
                        addAlert("Username is used, please try again");
                    }
                    return false;
                }
            }
        }
        return false;
    }
}

function validation() {
    let password = document.getElementsByName("password_regist")[0].value;
    let confirm = document.getElementsByName("confirm")[0].value;
    if (password !== confirm) {
        return "Password does not match!";
    }
    return "";
}

