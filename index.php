<?php
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
            <button class="button" onclick="window.location.href='user.html'">User Info</button>
        </div>
    </div>
    <div class="energy-meter">
        <h2>Energy Meter</h2>
        <p>Huidig verbruik: <span class="current-usage"><?php echo $current_usage; ?></span> kWh</p>
        <button class="increase-usage">Verbruik verhogen</button>
        <button class="decrease-usage">Verbruik verlagen</button>
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
        <!-- Rest of the code -->
    </div>
</body>
</html>