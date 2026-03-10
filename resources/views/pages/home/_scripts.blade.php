<script>
    function calculateLoan() {
        // Get input values
        const carPrice = parseFloat(document.getElementById('carPrice').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        const loanTerm = parseInt(document.getElementById('loanTerm').value) || 36;
        const interestRate = parseFloat(document.getElementById('interestRate').value) || 0;

        // Validate inputs
        if (carPrice <= 0) {
            alert('Please enter a valid car price');
            return;
        }

        if (downPayment >= carPrice) {
            alert('Down payment cannot be greater than or equal to car price');
            return;
        }

        // Calculate loan amount
        const loanAmount = carPrice - downPayment;

        // Calculate monthly interest rate
        const monthlyRate = interestRate / 100 / 12;

        // Calculate monthly payment using loan formula
        let monthlyPayment = 0;
        if (monthlyRate > 0) {
            monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, loanTerm)) /
                (Math.pow(1 + monthlyRate, loanTerm) - 1);
        } else {
            monthlyPayment = loanAmount / loanTerm;
        }

        // Calculate total payment and total interest
        const totalPayment = monthlyPayment * loanTerm;
        const totalInterest = totalPayment - loanAmount;

        // Update display
        document.getElementById('monthlyPayment').textContent = +monthlyPayment.toFixed(2);
        document.getElementById('loanAmount').textContent = +loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = +totalInterest.toFixed(2);
        document.getElementById('totalPayment').textContent = +totalPayment.toFixed(2);
    }

    document.getElementById('calculateBtn').addEventListener('click', calculateLoan);

    // Auto-calculate when inputs change
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = ['carPrice', 'downPayment', 'loanTerm', 'interestRate'];
        inputs.forEach(id => {
            document.getElementById(id).addEventListener('blur', calculateLoan);
        });
    });
</script>

