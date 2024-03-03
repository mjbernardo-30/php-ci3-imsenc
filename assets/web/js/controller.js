function validateEmail(email) {
    var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return re.test(String(email).toLowerCase());
}

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function isInputNumber(event) {
	var ch = String.fromCharCode(event.which);
	if (!(/[0-9, ., +, :]/.test(ch))) {
		event.preventDefault();
	}
}

function check_password(type) {
    password = document.getElementById('pw');
    confirmPassword = document.getElementById('confirm_pw');
    submit = document.getElementById('btn_submit');

    submit.disabled = password.value != confirmPassword.value;
    if (submit.disabled) {
        confirmPassword.classList.add("is-invalid");
    } else {
        confirmPassword.classList.remove("is-invalid");
    }
}