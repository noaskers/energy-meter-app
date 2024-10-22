<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$current_usage = isset($_SESSION['current_usage']) ? $_SESSION['current_usage'] : 0;
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$badges = isset($_SESSION['badges']) ? $_SESSION['badges'] : [];
$badge_color = isset($_SESSION['badge_color']) ? $_SESSION['badge_color'] : 'gray';
$winkel_score = isset($_SESSION['winkel_score']) ? $_SESSION['winkel_score'] : 0;
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
    <script src="script.js"></script>
    <script>
        // Initialize variables for JavaScript
        let currentUsage = <?php echo $current_usage; ?>;
        let score = <?php echo $score; ?>;
        let winkelScore = <?php echo $winkel_score; ?>;
        let badges = <?php echo json_encode($badges); ?>;
        let badgeColor = '<?php echo $badge_color; ?>';
    </script>
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
</body>
</html>