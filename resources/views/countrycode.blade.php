<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Error messages map
    const errorMap = [
        "Invalid number",
        "Invalid country code",
        "Too short",
        "Too long",
        "Invalid number"
    ];

    // Initialize phone inputs
    const phoneInputs = document.querySelectorAll('.phone-input');
    const phoneInstances = [];

    phoneInputs.forEach(input => {
        // Check if data attributes exist
    if (!input.dataset.errorContainer || !input.dataset.validContainer || !input.dataset.codeInput) {
        console.error('Missing data attributes on input:', input);
        return;
    }

    const errorContainer = document.getElementById(input.dataset.errorContainer);
    const validContainer = document.getElementById(input.dataset.validContainer);
    const codeInput = document.getElementById(input.dataset.codeInput);

    // // Check if elements exist
    // if (!errorContainer || !validContainer || !codeInput) {
    //     console.error('Could not find required elements');
    //     return;
    // }

        // Initialize intl-tel-input
        const iti = window.intlTelInput(input, {
            preferredCountries: ['ph'],
            // hiddenInput: "full_number",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
        });

        phoneInstances.push({
            input,
            iti,
            errorContainer,
            validContainer,
            codeInput
        });

        // Reset function
        const reset = () => {
            input.classList.remove("error");
            errorContainer.innerHTML = "";
            errorContainer.classList.add("hide");
            validContainer.classList.add("hide");
        };

        // Input formatting
        input.addEventListener('input', () => {
            const currentValue = input.value.replace(/\D/g, '');
            const formattedNumber = iti.getNumber(intlTelInputUtils.numberFormat.INTERNATIONAL);

            if (currentValue.startsWith(iti.getSelectedCountryData().dialCode.replace(/\D/g, ''))) {
                input.value = formattedNumber;
            } else {
                input.value = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
            }
        });

        // Validation on blur
        input.addEventListener('blur', () => {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    validContainer.classList.remove("hide");
                    validContainer.textContent = "✓ Valid";
                    const countryData = iti.getSelectedCountryData();
                    codeInput.value = countryData.dialCode;
                } else {
                    input.classList.add("error");
                    const errorCode = iti.getValidationError();
                    errorContainer.innerHTML = errorMap[errorCode];
                    errorContainer.classList.remove("hide");
                }
            }
        });

        // Reset on input changes
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
    });
});
</script>