function IsEmpty() {
    if (document.getElementById("application_phone").value === "") {
        alert("empty");
        return false;
    }
    return true;
}