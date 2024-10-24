<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "skill_swap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $skills_offered = $_POST['skills_offered'];
    $skills_wanted = $_POST['skills_wanted'];

    // Update skills offered
    if (!empty($skills_offered)) {
        $sql = "UPDATE users_info SET skills_offered = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $skills_offered, $userId);
        $stmt->execute();
    }

    // Update skills wanted
    if (!empty($skills_wanted)) {
        $sql = "UPDATE users_info SET skills_wanted = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $skills_wanted, $userId);
        $stmt->execute();
    }

    $stmt->close();
}

$conn->close();
header("Location: dashboard.php");
exit();
