function IsEmpty() {
    if (document.getElementById("application_phone").value === "") {
        alert("empty");
        return false;
    }
    return true;
}

$("application_save").submit(function(event) {

    var recaptcha = $("#g-recaptcha-response").val();
    if (recaptcha === "") {
        event.preventDefault();
        alert("Please check the recaptcha");
    }
});