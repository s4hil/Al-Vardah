$(document).ready(()=>{
	// Get Click
	function checkLength(str) {
		if (str.length < 8 || str.length > 30) {
			return false;
		}
		else {
			return true;
		}
	}

	$("#signUp").click((e)=>{
		e.preventDefault();
		let un = $("#username").val();
		let pw = $("#password").val();
		let email = $("#email").val();
		if (un == "" || pw == "" || email == "") {
			alert("All Fields Are Required!");
		}
		else if (checkLength(un) == false) {
			alert("Username Length Invalid.");
			$("#username").focus();
		}
		else if (checkLength(pw) == false) {
			alert("Password Length Invalid.");
			$("#password").focus();
		}
		else if (checkLength(email) == false) {
			alert("Email Length Invalid.");
			$("#email").focus();
		}
		else{
			let un = $("#username").val();
			let pw = $("#password").val();
			let email = $("#email").val();
			const rawData = { username:un, password:pw, email:email };
			const data = JSON.stringify(rawData);
			$.ajax({
				url: "assets/php/createAccount.php",
				method: "POST",
				data: data,
				dataType: "json",
				success: function (data) {
					x = data;
					if (x.status == true) {
						alert(x.msg);
						window.location = "index.php";
					}
					else {
						alert(x.msg);
						$(".form")[0].reset();
					}
				},
				error: function () {
					console.log("err with signUp req.");
				}
			});
		}
	});	
}); // Main