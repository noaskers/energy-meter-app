<?php
session_start();
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $current_usage = $_SESSION['current_usage'];
    $score = $_SESSION['score'];
    $winkel_score = $_SESSION['winkel_score'];
    $badges = $_SESSION['badges'];
    $badge_color = $_SESSION['badge_color'];

    // Update scores in the database
    $sql = "UPDATE scores SET current_usage='$current_usage', score='$score', winkel_score='$winkel_score', badge_color='$badge_color' WHERE user_id='$user_id'";
    $conn->query($sql);

    // Delete existing badges
    $sql = "DELETE FROM badges WHERE user_id='$user_id'";
    $conn->query($sql);

    // Insert new badges
    foreach ($badges as $badge) {
        $sql = "INSERT INTO badges (user_id, badge_name) VALUES ('$user_id', '$badge')";
        $conn->query($sql);
    }

    // Unset session variables
    unset($_SESSION['user_id']);
    unset($_SESSION['current_usage']);
    unset($_SESSION['score']);
    unset($_SESSION['winkel_score']);
    unset($_SESSION['badges']);
    unset($_SESSION['badge_color']);
}

session_destroy();
header("Location: login.php");
?>