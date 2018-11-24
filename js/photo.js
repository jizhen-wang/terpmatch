function upload() {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "services/photoUpload.php", false);
        let formData = new FormData(document.querySelector("#photoForm"));
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
                        addAlert("Failed, please try again");
                    }
                    return false;
                }
            }
        }
        return false;
}