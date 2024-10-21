<?php
// Database connection settings
$servername = "localhost:3307";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "skill_swap"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$fullName = $_POST['fullName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$skillsOffered = $_POST['skillsOffered'];
$skillsWanted = $_POST['skillsWanted'];
$bio = $_POST['bio'];
$linkedin = $_POST['linkedin'];
$otherLinks = $_POST['otherLinks'];
$interests = $_POST['interests'];

// SQL to insert data
$sql = "INSERT INTO users_info (full_name, dob, gender, email, phone, location, skills_offered, skills_wanted, bio, linkedin, other_links, interests)
VALUES ('$fullName', '$dob', '$gender', '$email', '$phone', '$location', '$skillsOffered', '$skillsWanted', '$bio', '$linkedin', '$otherLinks', '$interests')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='dashboard.html'>Go to Dashboard</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
