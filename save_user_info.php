<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$joined = $_POST['joined'];
$badges = explode(',', $_POST['badges']);
$profile_picture = null;

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
} else {
    $profile_picture = $_SESSION['user_info']['profile_picture'];
}

// Update user information
$sql = "UPDATE users SET username='$username', name='$name', email='$email', joined='$joined', profile_picture='$profile_picture' WHERE id='$user_id'";
$conn->query($sql);

// Delete existing badges
$sql = "DELETE FROM badges WHERE user_id='$user_id'";
$conn->query($sql);

// Insert new badges
foreach ($badges as $badge) {
    $badge = trim($badge);
    if (!empty($badge)) {
        $sql = "INSERT INTO badges (user_id, badge_name) VALUES ('$user_id', '$badge')";
        $conn->query($sql);
    }
}

// Update session information
$_SESSION['user_info'] = [
    'username' => $username,
    'name' => $name,
    'email' => $email,
    'joined' => $joined,
    'badges' => $badges,
    'profile_picture' => $profile_picture
];

header("Location: user.php");
?>