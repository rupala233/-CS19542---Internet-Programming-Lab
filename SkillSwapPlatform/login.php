<?php
session_start(); // Start the session

// Database connection
$servername = "localhost:3307";  // Update with your correct values
$username = "root";  // Update with your correct values
$password = "";  // Update with your correct values
$dbname = "skill_swap";  // Update with your correct values

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Successful login
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password, set an error message and redirect back to login
            $_SESSION['error_message'] = "Invalid password!";
            
            header("Location: login.html");
            exit();
        }
    } else {
        // User not found, set an error message and redirect back to login
        $_SESSION['error_message'] = "User not found!";
        
        header("Location: login.html");
        exit();
    }

    $stmt->close();
}

$conn->close();
