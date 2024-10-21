<?php
session_start(); // Start the session

// Database connection settings
$servername = "localhost:3307"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "skill_swap"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}

// Get the user ID from session
$userId = $_SESSION['user_id'];
// Fetch user data from both tables
$sql = "SELECT u.email, u.id, ui.full_name, ui.dob, ui.gender, ui.phone, ui.location, 
        ui.skills_offered, ui.skills_wanted, ui.bio, ui.linkedin, ui.other_links, ui.interests
        FROM users u
        JOIN users_info ui ON u.id = ui.id
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Check if any user data is found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch the user data
} else {
    echo "No user found.";
    exit();
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
</head>

<body>

<div class="container">
    <!-- Profile Header -->
    <div class="profile-header">
        <h3><?php echo htmlspecialchars($user['full_name'] ?? 'N/A'); ?></h3>
        <p><?php echo htmlspecialchars($user['bio'] ?? 'N/A'); ?></p>
    </div>

    <!-- Personal Info Cards -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Date of Birth</h5>
            <p><?php echo htmlspecialchars($user['dob'] ?? 'N/A'); ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Gender</h5>
            <p><?php echo htmlspecialchars($user['gender'] ?? 'N/A'); ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Email</h5>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Phone</h5>
            <p><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Location</h5>
            <p><?php echo htmlspecialchars($user['location'] ?? 'N/A'); ?></p>
        </div>
    </div>

    <!-- Skills Cards -->
    <div class="skills-card mb-4">
        <h5>Skills Offered</h5>
        <ul>
            <?php
            $skills_offered = explode(',', $user['skills_offered']);
            foreach ($skills_offered as $skill) {
                echo "<li>" . htmlspecialchars($skill) . "</li>";
            }
            ?>
        </ul>
    </div>

    <div class="skills-card mb-4">
        <h5>Skills Wanted</h5>
        <ul>
            <?php
            $skills_wanted = explode(',', $user['skills_wanted']);
            foreach ($skills_wanted as $skill) {
                echo "<li>" . htmlspecialchars($skill) . "</li>";
            }
            ?>
        </ul>
    </div>

    <!-- LinkedIn and Other Links -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>LinkedIn</h5>
            <a href="<?php echo htmlspecialchars($user['linkedin'] ?? '#'); ?>" target="_blank">
                <?php echo htmlspecialchars($user['linkedin'] ?? 'N/A'); ?>
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Other Links</h5>
            <a href="<?php echo htmlspecialchars($user['other_links'] ?? '#'); ?>" target="_blank">
                <?php echo htmlspecialchars($user['other_links'] ?? 'N/A'); ?>
            </a>
        </div>
    </div>

    <!-- Interests -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Interests</h5>
            <p><?php echo htmlspecialchars($user['interests'] ?? 'N/A'); ?></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2024 Skill Swap. All rights reserved.</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
