
document.addEventListener('DOMContentLoaded', function() {
    

    const levelBadge = document.getElementById('levelBadge');
    const levelNumberSpan = document.getElementById('levelNumber');
    const levelUpBtn = document.getElementById('levelUpBtn');
    const levelText = document.getElementById('levelText');
    

    let currentLevel = 3;
    const MAX_LEVEL = 6;
    
    // Function to update the UI with current level
    function updateLevelDisplay() {
        // Update badge text
        levelBadge.textContent = `Level ${currentLevel}`;
        
        // Update level number in text
        levelNumberSpan.textContent = currentLevel;
        
        // Update level text message
        if (currentLevel === MAX_LEVEL) {
            levelText.innerHTML = `🏆 MAX LEVEL REACHED! <span id="levelNumber">${currentLevel}</span> / 6`;
            // Disable level up button at max level
            levelUpBtn.disabled = true;
            levelUpBtn.classList.add('disabled');
            levelUpBtn.style.opacity = '0.6';
            levelUpBtn.innerHTML = '🎯 Max Level';
        } else {
            levelText.innerHTML = `🔰 Current Level: <span id="levelNumber">${currentLevel}</span> / 6`;
            // Re-enable button if not max level
            levelUpBtn.disabled = false;
            levelUpBtn.classList.remove('disabled');
            levelUpBtn.style.opacity = '1';
            levelUpBtn.innerHTML = '🚀 Level Up';
        }
        
        // Re-attach the span ID (since innerHTML overwrites it)
        document.getElementById('levelNumber').textContent = currentLevel;
    }
    
    // Add event listener to Level Up button
    levelUpBtn.addEventListener('click', function() {
        // Increase level if not at max
        if (currentLevel < MAX_LEVEL) {
            currentLevel++;
            updateLevelDisplay();
            
            // Add a little animation effect
            levelUpBtn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                levelUpBtn.style.transform = 'scale(1)';
            }, 100);
            
            // Optional: console log for debugging
            console.log(`Level increased to: ${currentLevel}`);
        }
    });
    
    // Initial display
    updateLevelDisplay();
});