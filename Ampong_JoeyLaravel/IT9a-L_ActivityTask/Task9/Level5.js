
document.addEventListener('DOMContentLoaded', function() {
    
    const coinCountEl = document.getElementById('coinCount');
    const increaseBtn = document.getElementById('increaseBtn');
    const decreaseBtn = document.getElementById('decreaseBtn');
    const coinMessage = document.getElementById('coinMessage');
    const coinIcon = document.getElementById('coinIcon');
    
    let coins = 0;
    const MIN_COINS = 0;
    
    // Function to update the coin display
    function updateCoinDisplay() {
        coinCountEl.textContent = coins;
        
        if (coins === 0) {
            coinMessage.textContent = '😢 You have 0 coins. Start collecting!';
            coinMessage.style.color = '#6c757d';
        } else if (coins === 1) {
            coinMessage.textContent = '🪙 You have 1 coin!';
            coinMessage.style.color = '#856404';
        } else {
            coinMessage.textContent = `💰 You have ${coins} coins! 🎉`;
            coinMessage.style.color = '#28a745';
            coinMessage.style.fontWeight = 'bold';
        }
        
        // Disable decrease button if coins are at minimum (0)
        if (coins <= MIN_COINS) {
            decreaseBtn.disabled = true;
            decreaseBtn.classList.add('disabled');
            decreaseBtn.style.opacity = '0.5';
            decreaseBtn.style.cursor = 'not-allowed';
        } else {
            decreaseBtn.disabled = false;
            decreaseBtn.classList.remove('disabled');
            decreaseBtn.style.opacity = '1';
            decreaseBtn.style.cursor = 'pointer';
        }
        
        // Add coin animation based on count
        if (coins > 5) {
            coinIcon.style.animation = 'bounce 0.5s ease infinite';
            coinIcon.style.fontSize = '5.5rem';
        } else if (coins > 10) {
            coinIcon.style.fontSize = '6rem';
        } else {
            coinIcon.style.animation = 'float 3s ease-in-out infinite';
            coinIcon.style.fontSize = '5rem';
        }
    }
    
    // Function to add coin animation effect
    function animateCoin() {
        coinIcon.style.transform = 'scale(1.2)';
        setTimeout(() => {
            coinIcon.style.transform = 'scale(1)';
        }, 150);
    }
    
    // Add event listener to INCREASE button (+)
    increaseBtn.addEventListener('click', function() {
        coins++;
        updateCoinDisplay();
        animateCoin();
        
        // Play click sound effect idea (visual feedback)
        increaseBtn.style.transform = 'scale(0.9)';
        setTimeout(() => {
            increaseBtn.style.transform = 'scale(1)';
        }, 100);
        
        console.log(`Coins: ${coins}`);
    });
    
    // Add event listener to DECREASE button (-)
    decreaseBtn.addEventListener('click', function() {
        if (coins > MIN_COINS) {
            coins--;
            updateCoinDisplay();
            
            // Visual feedback
            decreaseBtn.style.transform = 'scale(0.9)';
            setTimeout(() => {
                decreaseBtn.style.transform = 'scale(1)';
            }, 100);
            
            console.log(`Coins: ${coins}`);
        }
    });
    
    // Add keypress support (optional: press + or - keys)
    document.addEventListener('keydown', function(event) {
        if (event.key === '+' || event.key === '=') {
            event.preventDefault();
            increaseBtn.click();
        } else if (event.key === '-' || event.key === '_') {
            event.preventDefault();
            decreaseBtn.click();
        }
    });
    
    // Add CSS animations if not already in CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes spin {
            0% { transform: rotateY(0); }
            100% { transform: rotateY(360deg); }
        }
        
        .coin-spin {
            animation: spin 0.5s ease;
        }
    `;
    document.head.appendChild(style);
    
    // Initial display
    updateCoinDisplay();
});