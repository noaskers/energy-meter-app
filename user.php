<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user information from the database
$sql = "SELECT username, name, email, joined, profile_picture FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user_info = $result->fetch_assoc();

if ($user_info) {
    // Retrieve badges
    $sql = "SELECT badge_name FROM badges WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $badges = [];
    while ($row = $result->fetch_assoc()) {
        $badges[] = $row['badge_name'];
    }
    $user_info['badges'] = $badges;

    // Store user information in session
    $_SESSION['user_info'] = $user_info;
} else {
    $user_info = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>User Dashboard</h1>
        <div class="badges-container">
            <div class="badge completed">C</div>
            <div class="badge red">R</div>
            <div class="badge blue">B</div>
        </div>
        <div class="user-info">
            <h2>Personal Information</h2>
            <?php if ($user_info): ?>
                <form action="save_user_info.php" method="POST" enctype="multipart/form-data">
                    <label for="username"><strong>Username:</strong></label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_info['username']); ?>" required>
                    
                    <label for="name"><strong>Name:</strong></label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>" required>
                    
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>" required>
                    
                    <label for="joined"><strong>Joined:</strong></label>
                    <input type="date" id="joined" name="joined" value="<?php echo htmlspecialchars($user_info['joined']); ?>" required>
                    
                    <label for="badges"><strong>Badges:</strong></label>
                    <input type="text" id="badges" name="badges" value="<?php echo htmlspecialchars(implode(', ', $user_info['badges'])); ?>" placeholder="Comma separated badges">
                    
                    <label for="profile_picture"><strong>Profile Picture:</strong></label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    
                    <?php if ($user_info['profile_picture']): ?>
                        <p><strong>Current Profile Picture:</strong></p>
                        <img src="<?php echo htmlspecialchars($user_info['profile_picture']); ?>" alt="Profile Picture" style="max-width: 150px;">
                    <?php endif; ?>
                    
                    <button type="submit" class="button">Save</button>
                </form>
            <?php else: ?>
                <p>No user information found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>