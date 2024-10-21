<?php
session_start();
$user_info = isset($_SESSION['user_info']) ? $_SESSION['user_info'] : null;
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
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user_info['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_info['email']); ?></p>
                <p><strong>Joined:</strong> <?php echo htmlspecialchars($user_info['joined']); ?></p>
                <p><strong>Badges:</strong> <?php echo htmlspecialchars(implode(', ', $user_info['badges'])); ?></p>
                <?php if ($user_info['profile_picture']): ?>
                    <p><strong>Profile Picture:</strong></p>
                    <img src="<?php echo htmlspecialchars($user_info['profile_picture']); ?>" alt="Profile Picture" style="max-width: 150px;">
                <?php endif; ?>
            <?php else: ?>
                <form action="save_user_info.php" method="POST" enctype="multipart/form-data">
                    <label for="name"><strong>Name:</strong></label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="joined"><strong>Joined:</strong></label>
                    <input type="date" id="joined" name="joined" required>
                    
                    <label for="badges"><strong>Badges:</strong></label>
                    <input type="text" id="badges" name="badges" placeholder="Comma separated badges">
                    
                    <label for="profile_picture"><strong>Profile Picture:</strong></label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    
                    <button type="submit" class="button">Save</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>