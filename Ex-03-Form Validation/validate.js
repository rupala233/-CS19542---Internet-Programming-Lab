function validate(){
var user_name = document.getElementById("name").value.trim();
var user_mail = document.getElementById("email").value.trim();
var user_gender = document.getElementById("gender").value;
var user_address = document.getElementById("address").value;
var user_number = document.getElementById("phone").value;
var user_password = document.getElementById("password").value;
var confirm_pass = document.getElementById("confirm_pass").value;
if(user_name === ""){
alert("Name field is required");
return false;
}

var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if(user_mail ===""){
alert("Email Id field is required.");
return false;
}
if(!emailPattern.test(user_mail)){
alert("Enter a valid Email Id.");
return false;
}

if(user_gender ==="place_holder"){
alert("Select a valid gender");
return false;
}

if(user_address ===""){
alert("Address Field is required");
return false;
}

if(user_number === ""){
alert("Phone Number Field is required.");
return false;
}
if (!/^\d{10}$/.test(user_number)) { 
alert("Phone number must be exactly 10 digits.");
return false;
}

if(user_password === ""){
alert("Enter your password. Password Field is required");
return false;
}

if(confirm_pass === ""){
alert("Confirm your Password.");
return false;
}

const combinedRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;

if (!combinedRegex.test(user_password)) {
alert('Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.');
return false;
}

if(user_password != confirm_pass){
alert("Two passwords are not the same.Kindly Confirm it again.");
return false;
}
}