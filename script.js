$(document).ready(function() {
    let currentUsage = 0;
    let score = 0;
    let badges = [];

    // Array to store badge criteria
    const badgeCriteria = [
        { usage: 10, name: '10 kWh Verbruiker' },
        { usage: 20, name: '20 kWh Verbruiker' },
        { usage: 30, name: '30 kWh Verbruiker' },
        { usage: 40, name: '40 kWh Verbruiker' },
        { usage: 50, name: '50 kWh Verbruiker' },
        { usage: 60, name: '60 kWh Verbruiker' },
        { usage: 70, name: '70 kWh Verbruiker' },
        { usage: 80, name: '80 kWh Verbruiker' },
        { usage: 90, name: '90 kWh Verbruiker' },
        { usage: 100, name: '100 kWh Verbruiker' },
        // Add more badges as needed
    ];

    function updateDisplay() {
        $('.current-usage').text(currentUsage);
        $('.score').text(score);
        updateBadges();
    }

    function updateBadges() {
        const $badgesContainer = $('.badges-container');
        $badgesContainer.empty();
        badgeCriteria.forEach((badge, index) => {
            const $badge = $('<div>').addClass('badge');
            if (badges.includes(badge.name)) {
                $badge.addClass('completed');
            }
            $badgesContainer.append($badge);
        });
    }

    function showBadgePopup(badgeName) {
        $('.popup-message').text(`Congratulations! You've earned the badge: ${badgeName}`);
        $('.popup').removeClass('hidden');
    }

    $('.increase-usage').click(function() {
        currentUsage += 1;
        score += 10;
        badgeCriteria.forEach(badge => {
            if (currentUsage >= badge.usage && !badges.includes(badge.name)) {
                badges.push(badge.name);
                showBadgePopup(badge.name);
            }
        });
        updateDisplay();
    });

    $('.decrease-usage').click(function() {
        if (currentUsage > 0) {
            currentUsage -= 1;
            score -= 5;
            updateDisplay();
        }
    });

    $('.popup-close').click(function() {
        $('.popup').addClass('hidden');
    });

    updateDisplay();
});$(document).ready(function() {
    let currentUsage = 0;
    let score = 0;
    let badges = [];

    // Array to store badge criteria
    const badgeCriteria = [
        { usage: 10, name: '10 kWh Verbruiker' },
        { usage: 20, name: '20 kWh Verbruiker' },
        { usage: 30, name: '30 kWh Verbruiker' },
        // Add more badges as needed
    ];

    function updateDisplay() {
        $('#current-usage').text(currentUsage);
        $('#score').text(score);
        
        updateBadges();
    }

    function updateBadges() {
        const $badgesContainer = $('#badges-container');
        $badgesContainer.empty();
        badgeCriteria.forEach((badge, index) => {
            const $badge = $('<div>').addClass('badge');
            if (badges.includes(badge.name)) {
                $badge.addClass('completed');
            }
            $badgesContainer.append($badge);
        });
    }

    function showBadgePopup(badgeName) {
        $('#popup-message').text(`Congratulations! You've earned the badge: ${badgeName}`);
        $('#popup').removeClass('hidden');
    }

    $('#increase-usage').click(function() {
        currentUsage += 1;
        score += 10;
        badgeCriteria.forEach(badge => {
            if (currentUsage >= badge.usage && !badges.includes(badge.name)) {
                badges.push(badge.name);
                showBadgePopup(badge.name);
            }
        });
        updateDisplay();
    });

    $('#decrease-usage').click(function() {
        if (currentUsage > 0) {
            currentUsage -= 1;
            score -= 5;
            updateDisplay();
        }
    });

    $('#popup-close').click(function() {
        $('#popup').addClass('hidden');
    });

    updateDisplay();
});