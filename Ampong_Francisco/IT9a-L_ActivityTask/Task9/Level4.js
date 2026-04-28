
document.addEventListener('DOMContentLoaded', function() {
    
    const nameInput = document.getElementById('nameInput');
    const submitBtn = document.getElementById('submitBtn');
    const messageArea = document.getElementById('messageArea');
    
    // Function to validate form
    function validateForm() {
        const nameValue = nameInput.value.trim();
        
        // Check if empty
        if (nameValue === '') {
            messageArea.innerHTML = `
                <span style="font-size: 1.2rem;">⚠️</span> Error: Name cannot be empty!
            `;
            
            // Apply error styling (red)
            messageArea.classList.remove('success-message');
            messageArea.classList.add('error-message');
            
            // Optional: Add shake animation
            messageArea.style.animation = 'shake 0.5s ease';
            setTimeout(() => {
                messageArea.style.animation = '';
            }, 500);
            
        } else {
            // FILLED FIELD 
            messageArea.innerHTML = `
                <span style="font-size: 1.2rem;">✅</span> Success! Hello, <strong>${nameValue}</strong>!
            `;
            
            // Apply success styling
            messageArea.classList.remove('error-message');
            messageArea.classList.add('success-message');
            
            // Optional: Add pop animation
            messageArea.style.animation = 'pop 0.3s ease';
            setTimeout(() => {
                messageArea.style.animation = '';
            }, 300);
        }
    }
    
    // Add event listener to Submit button
    submitBtn.addEventListener('click', validateForm);
    
    // Optional: Press Enter key to submit
    nameInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            validateForm();
        }
    });
    
    // Optional: Clear message when user starts typing
    nameInput.addEventListener('focus', function() {
        messageArea.innerHTML = '';
        messageArea.classList.remove('error-message', 'success-message');
    });
    
 
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            50% { transform: translateX(10px); }
            75% { transform: translateX(-5px); }
        }
        
        @keyframes pop {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);
    
    // Initial empty message area
    messageArea.innerHTML = '';
    messageArea.classList.remove('error-message', 'success-message');
});