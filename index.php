<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM scores WHERE user_id='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $_SESSION['current_usage'] = $user_data['current_usage'] ?? 0;
    $_SESSION['score'] = $user_data['score'] ?? 0;
    $_SESSION['winkel_score'] = $user_data['winkel_score'] ?? 0;
    $_SESSION['badge_color'] = $user_data['badge_color'] ?? 'green';
} else {
    // Initialize default values if no data is found
    $_SESSION['current_usage'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['winkel_score'] = 0;
    $_SESSION['badge_color'] = 'green';
}

$sql = "SELECT badge_name FROM badges WHERE user_id='$user_id'";
$result = $conn->query($sql);
$_SESSION['badges'] = [];
while ($row = $result->fetch_assoc()) {
    $_SESSION['badges'][] = $row['badge_name'];
}

$current_usage = $_SESSION['current_usage'];
$score = $_SESSION['score'];
$winkel_score = $_SESSION['winkel_score'];
$badges = $_SESSION['badges'];
$badge_color = $_SESSION['badge_color'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Meter App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Energy Meter App</h1>
        <div class="header-buttons">
            <a href="logout.php" class="button">Logout</a>
            <button class="button" onclick="window.location.href='user.php'">Gebruiker</button>
        </div>
    </div>
    <div class="container">
        <div class="energy-meter">
            <h2>Energy Meter</h2>
            <p>Huidig verbruik: <span class="current-usage"><?php echo $current_usage; ?></span> kWh</p>
            <button class="increase-usage button">Verbruik verhogen</button>
            <button class="decrease-usage button">Verbruik verlagen</button>
        </div>
        <div class="gamification">
            <h2>Gamification</h2>
            <p>Score: <span class="score"><?php echo $score; ?></span></p>
            <div class="badges-container">
                <?php foreach ($badges as $badge): ?>
                    <div class="badge completed <?php echo $badge_color; ?>"><?php echo $badge; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="winkel">
            <h2>Winkel</h2>
            <p>Winkel Score: <span class="winkel-score"><?php echo $winkel_score; ?></span></p>
            <div class="winkel-container">
                <button class="buy-item-blue button" data-cost="50">Buy Blue Badge (50 coins)</button>
                <button class="buy-item-red button" data-cost="100">Buy Red Badge ( coins)</button>
            </div>
        </div>
        <div class="popup hidden">
            <div class="popup-content">
                <p class="popup-message"></p>
                <button class="popup-close button">Close</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentUsage = <?php echo $current_usage; ?>;
        let score = <?php echo $score; ?>;
        let winkelScore = <?php echo $winkel_score; ?>;
        let badges = <?php echo json_encode($badges); ?>;
        let badgeColor = '<?php echo $badge_color; ?>';
    </script>
    <script src="script.js"></script>
</body>
</html>