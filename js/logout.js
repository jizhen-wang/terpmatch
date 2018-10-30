function kill_session() {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "logout.php", false);
    xmlHttp.send(null);
    /* processing response */
    if (xmlHttp.status === 200) {
        location.reload();
    }

}