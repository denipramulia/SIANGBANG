window.onload = function () {
	document.getElementById("password").onchange = validatePassword;
	document.getElementById("confirmpassword").onchange = validatePassword;
	document.getElementById("email").onchange = validateEmail;
	document.getElementById("confirmemail").onchange = validateEmail;
}

//password confirmation
function validatePassword(){
var pass2=document.getElementById("confirmpassword").value;
var pass1=document.getElementById("password").value;
if(pass1!=pass2)
	document.getElementById("confirmpassword").setCustomValidity("Password Tidak Sama");
else
	document.getElementById("confirmpassword").setCustomValidity('');	
//empty string means no validation error
}

//email confirmation
function validateEmail(){
var email2=document.getElementById("confirmemail").value;
var email1=document.getElementById("email").value;
if(email1!=email2)
	document.getElementById("confirmemail").setCustomValidity("Email Tidak Sama");
else
	document.getElementById("confirmemail").setCustomValidity('');	
//empty string means no validation error
}

