document.getElementById("loginForm").onsubmit = adminLogin;

function adminLogin() {
	clearErrors();

	let username = document.getElementById("username").value;
	let password = document.getElementById("password").value;
	let valid = true;

	let adminUsername = "admin";
	let adminPassword = "admin";

	if (username === "" || username !== adminUsername) {
		document.getElementById("usernameErr").style.display = "block";
		valid = false;
	}

	if (password === "" || password !== adminPassword) {
		document.getElementById("passwordErr").style.display = "block";
		valid = false;
	}

	return valid;
}

function clearErrors() {
	let errors = $(".error");
	for (let i = 0; i < errors.length; i++) {
		errors[i].style.display = "none";
	}
}