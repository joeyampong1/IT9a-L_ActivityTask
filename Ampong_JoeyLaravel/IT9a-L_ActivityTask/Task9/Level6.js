
document.addEventListener('DOMContentLoaded', function() {
    
    const door1 = document.getElementById('door1');
    const door2 = document.getElementById('door2');
    const door3 = document.getElementById('door3');
    const doorMessage = document.getElementById('doorMessage');
    const resultDetails = document.getElementById('resultDetails');
    
    const doors = [door1, door2, door3];
    
    // ===== RANDOMLY SELECT CORRECT DOOR (1-3) =====
    // Each game, the correct door is random!
    const correctDoorNumber = Math.floor(Math.random() * 3) + 1; 
    
    // Store correct door in hidden field (optional)
    const correctDoorField = document.getElementById('correctDoor');
    if (correctDoorField) {
        correctDoorField.textContent = correctDoorNumber;
    }
    
    // Track if game is finished (prevent multiple selections)
    let gameFinished = false;
    
    // Track which door was selected
    let selectedDoorNumber = null;
    
    // ===== DISPLAY INITIAL MESSAGE =====
    doorMessage.innerHTML = '🔮 Choose a door... Only 1 is correct!';
    doorMessage.classList.add('info-message');
    doorMessage.classList.remove('success-message', 'error-message');
    
    // ===== FUNCTION TO RESET DOOR STYLES =====
    function resetDoorStyles() {
        doors.forEach(door => {
            door.classList.remove('selected', 'correct-door', 'wrong-door');
            door.disabled = false;
            door.style.opacity = '1';
        });
    }
    
    // ===== FUNCTION TO HANDLE DOOR SELECTION =====
    function selectDoor(doorNumber, doorElement) {
        // If game is already finished, prevent further selections
        if (gameFinished) {
            return;
        }
        
        // Mark game as finished
        gameFinished = true;
        selectedDoorNumber = doorNumber;
        
        // Disable all doors
        doors.forEach(door => {
            door.disabled = true;
        });
        
        // Add selected class to clicked door
        doorElement.classList.add('selected');
        
        // ===== IF / ELSE CONDITIONALS TO CHECK SELECTION =====
        if (doorNumber === correctDoorNumber) {
            // ✅ CORRECT DOOR - SUCCESS MESSAGE
            doorMessage.innerHTML = '🎉🎊 CONGRATULATIONS! 🎊🎉<br>Door #' + doorNumber + ' is CORRECT! You win!';
            doorMessage.classList.add('success-message');
            doorMessage.classList.remove('error-message', 'info-message');
            
            // Mark this door as correct
            doorElement.classList.add('correct-door');
            
            // Show success details
            resultDetails.innerHTML = '✨ You found the treasure! ✨';
            
            // Add victory animation to door icon
            const doorIcon = doorElement.querySelector('.door-icon');
            if (doorIcon) {
                doorIcon.style.animation = 'shine 1s ease infinite';
                doorIcon.innerHTML = '🏆'; // Change door to trophy
            }
            
        } else {
            // ❌ WRONG DOOR - ERROR MESSAGE
            doorMessage.innerHTML = '😢 Sorry! Door #' + doorNumber + ' is WRONG.<br>The correct door was #' + correctDoorNumber + '.';
            doorMessage.classList.add('error-message');
            doorMessage.classList.remove('success-message', 'info-message');
            
            // Mark this door as wrong
            doorElement.classList.add('wrong-door');
            
            // Show the correct door
            doors.forEach(door => {
                const doorNum = door.id === 'door1' ? 1 : door.id === 'door2' ? 2 : 3;
                if (doorNum === correctDoorNumber) {
                    door.classList.add('correct-door');
                    // Change correct door icon to treasure
                    const correctDoorIcon = door.querySelector('.door-icon');
                    if (correctDoorIcon) {
                        correctDoorIcon.innerHTML = '💎';
                    }
                }
            });
            
            // Show error details
            resultDetails.innerHTML = '💔 Better luck next time! 💔';
            
            // Add shake animation to wrong door
            doorElement.classList.add('shake-animation');
            setTimeout(() => {
                doorElement.classList.remove('shake-animation');
            }, 500);
        }
        
        // Log to console (for debugging)
        console.log('Door selected: ' + doorNumber);
        console.log('Correct door: ' + correctDoorNumber);
        console.log('Result: ' + (doorNumber === correctDoorNumber ? 'WIN' : 'LOSE'));
    }
    
    // ===== ADD EVENT LISTENERS TO DOORS =====
    door1.addEventListener('click', function() {
        selectDoor(1, door1);
    });
    
    door2.addEventListener('click', function() {
        selectDoor(2, door2);
    });
    
    door3.addEventListener('click', function() {
        selectDoor(3, door3);
    });
    
    // ===== RESTART BUTTON already links to level1.html =====
    // No need for additional JS, but we can add confirmation
    const restartBtn = document.getElementById('restartBtn');
    if (restartBtn) {
        restartBtn.addEventListener('click', function(event) {
            // Optional: Add confirmation dialog
            const confirmRestart = confirm('Restart from Level 1?');
            if (!confirmRestart) {
                event.preventDefault();
            }
        });
    }
    
    // ===== HINT: Display which door is correct (for testing) =====
    // You can remove this in production, but helpful for testing
    console.log('🎯 CORRECT DOOR: Door #' + correctDoorNumber + ' (hidden)');
    
    doors.forEach(door => {
        door.addEventListener('mouseenter', function() {
            if (!gameFinished) {
                this.style.transform = 'scale(1.05)';
            }
        });
        
        door.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});