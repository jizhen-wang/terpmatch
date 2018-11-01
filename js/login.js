function login() {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "login.php", false);
    let formData=new FormData(document.querySelector("#login_form"));
    xmlHttp.send(formData);
    /* processing response */
    if (xmlHttp.readyState === 4) {
        if (xmlHttp.status === 200) {
            let results = xmlHttp.responseText;
            //alert(results);
            if (results === "success"){
                location.reload();
            }else {
                addAlert();
                return false;
            }
        }
    }
}

function addAlert() {
    $('#alerts').append(
    '<div class="alert alert-danger" role="alert">'+
        'Invalid credentials.'+
    '</div>');
}
