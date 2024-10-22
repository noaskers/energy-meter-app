$(document).ready(function() {
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
    ];

    function updateDisplay() {
        $('.current-usage').text(currentUsage);
        $('.score').text(score);
        $('.winkel-score').text(winkelScore);
        updateBadges();
    }

    function updateBadges() {
        const $badgesContainer = $('.badges-container');
        $badgesContainer.empty();
        badgeCriteria.forEach((badge, index) => {
            const $badge = $('<div>').addClass('badge');
            if (badges.includes(badge.name)) {
                $badge.addClass('completed');
                if (badgeColor === 'red') {
                    $badge.addClass('red');
                } else if (badgeColor === 'blue') {
                    $badge.addClass('blue');
                }
            }
            $badgesContainer.append($badge);
        });
    }

    function showBadgePopup(badgeName) {
        $('.popup-message').text(`Congratulations! You've earned the badge: ${badgeName}`);
        $('.popup').removeClass('hidden');
    }

    function boughtItemPopup(itemBought) {
        $('.popup-message').text(`${itemBought}`);
        $('.popup').removeClass('hidden');
    }

    $('.increase-usage').click(function() {
        currentUsage += 1;
        score += 10;
        winkelScore += 10;
        badgeCriteria.forEach(badge => {
            if (currentUsage >= badge.usage && !badges.includes(badge.name)) {
                badges.push(badge.name);
                showBadgePopup(badge.name);
            }
        });
        updateDisplay();
        saveData();
    });

    $('.decrease-usage').click(function() {
        if (currentUsage > 0) {
            currentUsage -= 1;
            score -= 10;
            updateDisplay();
            saveData();
        }
    });

    $('.popup-close').click(function() {
        $('.popup').addClass('hidden');
    });

    $('.buy-item-blue').click(function() {
        const cost = $(this).data('cost');
        if (winkelScore >= cost) {
            winkelScore -= cost;
            badgeColor = 'blue';
            buymessage = 'You bought color ' + badgeColor;
            updateDisplay();
            saveData();
        } else {
            buymessage = 'Not enough coins';
        }
        boughtItemPopup(`${buymessage}`);
    });

    $('.buy-item-red').click(function() {
        const cost = $(this).data('cost');
        if (winkelScore >= cost) {
            winkelScore -= cost;
            badgeColor = 'red';
            buymessage = 'You bought color ' + badgeColor;
            updateDisplay();
            saveData();
        } else {
            buymessage = 'Not enough coins';
        }
        boughtItemPopup(`${buymessage}`);
    });

    function saveData() {
        $.ajax({
            url: 'save_data.php',
            method: 'POST',
            data: {
                current_usage: currentUsage,
                score: score,
                winkel_score: winkelScore,
                badges: badges,
                badge_color: badgeColor
            },
            success: function(response) {
                console.log('Data saved successfully');
            }
        });
    }

    updateDisplay();
});