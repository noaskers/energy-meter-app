<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

$user_id = $_SESSION['user_id'];
$current_usage = $_POST['current_usage'];
$score = $_POST['score'];
$winkel_score = $_POST['winkel_score'];
$badges = $_POST['badges'];
$badge_color = $_POST['badge_color'];

$sql = "UPDATE scores SET current_usage='$current_usage', score='$score', winkel_score='$winkel_score', badge_color='$badge_color' WHERE user_id='$user_id'";
$conn->query($sql);

$sql = "DELETE FROM badges WHERE user_id='$user_id'";
$conn->query($sql);

foreach ($badges as $badge) {
    $sql = "INSERT INTO badges (user_id, badge_name) VALUES ('$user_id', '$badge')";
    $conn->query($sql);
}

echo "Data saved successfully";
?>