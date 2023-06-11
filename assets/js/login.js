function validateLogin() {
	let un = $("#username").val();
	let pw = $("#password").val();
	if (un == "" || pw == "") {
		alert("Both Fields Are Required!");
		return false;
	}
	else {
		return true;
	}
}