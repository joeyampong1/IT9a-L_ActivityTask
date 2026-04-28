document.addEventListener('DOMContentLoaded', function() {
    const screen = document.querySelector('.screen');
    let currentInput = '0';
    let expression = ''; 
    let lastInputWasOperator = false;
    
    function updateScreen() {
        screen.value = expression || currentInput;
    }
    
    function inputNumber(number) {
        if (lastInputWasOperator) {
            currentInput = number;
            lastInputWasOperator = false;
        } else {
            if (number === '.' && currentInput.includes('.')) {
                return;
            }
            
            if (currentInput === '0' && number !== '.') {
                currentInput = number;
            } else {
                currentInput += number;
            }
        }
        
        // Update expression to show the full calculation
        if (expression && !lastInputWasOperator) {
            const lastOperatorIndex = Math.max(
                expression.lastIndexOf('+'),
                expression.lastIndexOf('-'),
                expression.lastIndexOf('*'),
                expression.lastIndexOf('/')
            );
            
            if (lastOperatorIndex !== -1) {
                expression = expression.substring(0, lastOperatorIndex + 1) + currentInput;
            } else {
                expression = currentInput;
            }
        } else {
            expression = currentInput;
        }
        
        updateScreen();
    }
    
    // Handle operator button clicks
    function inputOperator(op) {
        if (lastInputWasOperator) {
            expression = expression.slice(0, -1) + op;
        } else {
            expression += op;
        }
        
        lastInputWasOperator = true;
        updateScreen();
    }
    
    // Perform calculation 
    function calculate() {
        try {
            const safeExpression = expression.replace(/[^0-9+\-*/. ]/g, '');
            
            const result = new Function('return ' + safeExpression)();
            
            const roundedResult = Math.round(result * 100000000) / 100000000;
            
            if (!isFinite(result)) {
                throw new Error("Division by zero or invalid calculation");
            }
            
            // Update display with result
            currentInput = roundedResult.toString();
            expression = currentInput;
            lastInputWasOperator = false;
            updateScreen();
            
        } catch (error) {
            alert("Error in calculation: " + error.message);
            clearCalculator();
        }
    }
    
    // Clear 
    function clearCalculator() {
        currentInput = '0';
        expression = '';
        lastInputWasOperator = false;
        updateScreen();
    }
    
    // Add event listeners 
    document.querySelectorAll('.button').forEach(button => {
        button.addEventListener('click', function() {
            const value = this.textContent;
            
            
            if (!isNaN(value) || value === '.') {
                
                inputNumber(value);
            } else if (value === 'C') {
                
                clearCalculator();
            } else if (value === '=') {
               
                if (expression && !lastInputWasOperator) {
                    calculate();
                }
            } else {
               
                inputOperator(value);
            }
        });
    });
    
    updateScreen();
    
    // Add keyboard support
    document.addEventListener('keydown', function(event) {
        const key = event.key;
        
        // Number keys (0-9)
        if (key >= '0' && key <= '9') {
            inputNumber(key);
        }
        // Decimal point
        else if (key === '.') {
            inputNumber('.');
        }
        // Operators
        else if (['+', '-', '*', '/'].includes(key)) {
            inputOperator(key);
        }
        // Equals or Enter
        else if (key === '=' || key === 'Enter') {
            if (expression && !lastInputWasOperator) {
                calculate();
            }
        }
        // Escape for clear
        else if (key === 'Escape' || key === 'Delete') {
            clearCalculator();
        }
        else if (key === 'Backspace') {
            if (expression.length > 0) {
                expression = expression.slice(0, -1);
                

                const lastOperatorIndex = Math.max(
                    expression.lastIndexOf('+'),
                    expression.lastIndexOf('-'),
                    expression.lastIndexOf('*'),
                    expression.lastIndexOf('/')
                );
                
                if (lastOperatorIndex !== -1) {
                    currentInput = expression.substring(lastOperatorIndex + 1);
                    lastInputWasOperator = false;
                } else {
                    currentInput = expression || '0';
                    lastInputWasOperator = false;
                }
                
                updateScreen();
            } else {
                clearCalculator();
            }
        }
        
        // Prevent default behavior for calculator keys
        if (['0','1','2','3','4','5','6','7','8','9','+','-','*','/','=','Enter','Escape','Delete','Backspace','.'].includes(key)) {
            event.preventDefault();
        }
    });
});