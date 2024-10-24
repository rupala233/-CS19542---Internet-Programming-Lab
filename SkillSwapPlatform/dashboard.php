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
    <link rel="stylesheet" href="style2.css">
    <style>
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }
        .logout-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.html">SkillSwap</a>
    <div class="ml-auto">
        <form method="POST" action="home.html">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>
<div class="container mt-5">

    <!-- Profile Header -->
    <div class="text-center mb-4">
        <h1 class="font-weight-bold text-primary"><?php echo htmlspecialchars($user['full_name'] ?? 'N/A'); ?></h1>
        <p class="lead"><?php echo htmlspecialchars($user['bio'] ?? 'N/A'); ?></p>
        <div class="d-flex justify-content-center">
            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="btn btn-outline-primary mx-2">Email</a>
            <a href="message.php?user_id=<?php echo $userId; ?>" class="btn btn-outline-success mx-2">Message</a>
        </div>
    </div>

    <!-- Personal Info Card -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Personal Information</h5>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob'] ?? 'N/A'); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender'] ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($user['location'] ?? 'N/A'); ?></p>
            <p><strong>Interests:</strong> <?php echo htmlspecialchars($user['interests'] ?? 'N/A'); ?></p>
            <div class="social-links mt-3">
    <a href="<?php echo htmlspecialchars($user['linkedin'] ?? '#'); ?>" target="_blank" class="btn btn-outline-primary mr-2" style="border-radius: 20px;">
        LinkedIn
    </a>
    <a href="<?php echo htmlspecialchars($user['other_links'] ?? '#'); ?>" target="_blank" class="btn btn-primary" style="border-radius: 20px;">
        GitHub
    </a>
</div>


        </div>
    </div>

    <!-- Skills Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Skills Offered</h5>
                    <ul class="list-group">
                        <?php
                        $skills_offered = explode(',', $user['skills_offered']);
                        foreach ($skills_offered as $skill) {
                            echo "<li class='list-group-item'>" . htmlspecialchars($skill) . "</li>";
                        }
                        ?>
                    </ul>
                    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#editSkillsOfferedModal">Edit Skills Offered</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Skills Wanted</h5>
                    <ul class="list-group">
                        <?php
                        $skills_wanted = explode(',', $user['skills_wanted']);
                        foreach ($skills_wanted as $skill) {
                            echo "<li class='list-group-item'>" . htmlspecialchars($skill) . "</li>";
                        }
                        ?>
                    </ul>
                    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#editSkillsWantedModal">Edit Skills Wanted</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Skills Offered Modal -->
    <div class="modal fade" id="editSkillsOfferedModal" tabindex="-1" role="dialog" aria-labelledby="editSkillsOfferedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSkillsOfferedModalLabel">Edit Skills Offered</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_skills.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <div class="form-group">
                            <label for="skills_offered">Skills Offered (comma-separated)</label>
                            <textarea class="form-control" id="skills_offered" name="skills_offered"><?php echo htmlspecialchars($user['skills_offered']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Skills Wanted Modal -->
    <div class="modal fade" id="editSkillsWantedModal" tabindex="-1" role="dialog" aria-labelledby="editSkillsWantedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSkillsWantedModalLabel">Edit Skills Wanted</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_skills.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                        <div class="form-group">
                            <label for="skills_wanted">Skills Wanted (comma-separated)</label>
                            <textarea class="form-control" id="skills_wanted" name="skills_wanted"><?php echo htmlspecialchars($user['skills_wanted']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p class="text-muted">© 2024 Skill Swap. All rights reserved.</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
