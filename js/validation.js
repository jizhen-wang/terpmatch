function validation() {
    let password = document.getElementsByName("password")[0].value;
    let confirm = document.getElementsByName("confirm")[0].value;
    if (password !== confirm) {
        alert("Password does not match!");
        return false;
    }
    return true;
}