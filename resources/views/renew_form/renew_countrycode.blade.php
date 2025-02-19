
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
<script>
// Error messages map
const errorMap = [
    "Invalid Number",
    "Invalid Country Code",
    "Too Short",
    "Too Long",
    "Invalid Number"
];

// Initialize phone inputs
const phoneInputs = document.querySelectorAll('.phone-input');
const phoneInstances = [];

phoneInputs.forEach(input => {
    const errorContainer = document.getElementById(input.dataset.errorContainer);
    const validContainer = document.getElementById(input.dataset.validContainer);
    const codeInput = document.getElementById(input.dataset.codeInput);

    // Initialize intl-tel-input
    const iti = window.intlTelInput(input, {
        preferredCountries: ['ph'],
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
    });

    // Get the iti container and make it match input's visibility
    const itiContainer = input.closest('.iti');
    if (itiContainer) {
        if (input.classList.contains('update_contact')) {
            // Set initial display based on contact checkbox
            const isContactChecked = $('.contact').is(":checked");
            if (!isContactChecked) {
                itiContainer.style.display = 'none';
            }
        }
    }

    // Set initial value if it exists
    if (input.value.trim()) {
        try {
            iti.setNumber(input.value.trim());
        } catch (e) {
            console.error("Error setting initial number:", e);
        }
    }

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
        if (errorContainer) errorContainer.innerHTML = "";
        if (errorContainer) errorContainer.classList.add("hide");
        if (validContainer) validContainer.classList.add("hide");
    };

    // Input formatting
    input.addEventListener('input', () => {
    const currentValue = input.value.replace(/\D/g, '');
    const formattedNumber = iti.getNumber(intlTelInputUtils.numberFormat.INTERNATIONAL);
    const countryData = iti.getSelectedCountryData();
    
    if (countryData && countryData.dialCode) {
        const cleanDialCode = countryData.dialCode.replace(/\D/g, '');
        if (currentValue.startsWith(cleanDialCode)) {
            input.value = formattedNumber;
        } else {
            input.value = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
        }
    } else {
        input.value = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
    }
});

    // Validation on blur
    // Validation on blur
input.addEventListener('blur', () => {
    reset();
    if (input.value.trim()) {
        if (iti.isValidNumber()) {
            // Check if validContainer exists before using it
            if (validContainer) {
                validContainer.classList.remove("hide");
                validContainer.textContent = "✓ Valid";
            }
            
            // Check if codeInput exists before using it
            const countryData = iti.getSelectedCountryData();
            if (codeInput && countryData) {
                codeInput.value = countryData.dialCode;
            }
        } else {
            input.classList.add("error");
            const errorCode = iti.getValidationError();
            // Check if errorContainer exists before using it
            if (errorContainer) {
                errorContainer.innerHTML = errorMap[errorCode];
                errorContainer.classList.remove("hide");
            }
        }
    }
});

    // Reset on input changes
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

    // Ensure the flag dropdown is visible when the input has a value
    if (input.value.trim()) {
        itiContainer.style.display = 'block';
    }
});

// Create MutationObserver to watch for changes in input visibility
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
            const element = mutation.target;
            if (element.classList.contains('update_contact')) {
                const itiContainer = element.closest('.iti') || element.querySelector('.iti');
                const errorContainer = document.getElementById(element.dataset.errorContainer);
                const validContainer = document.getElementById(element.dataset.validContainer);

                // Sync iti container visibility with input
                if (itiContainer) {
                    itiContainer.style.display = window.getComputedStyle(element).display;
                }

                // Handle error and valid messages
                if (window.getComputedStyle(element).display === 'none') {
                    if (errorContainer) {
                        errorContainer.classList.add('hide');
                        errorContainer.innerHTML = '';
                    }
                    if (validContainer) {
                        validContainer.classList.add('hide');
                        validContainer.textContent = '';
                    }
                    element.classList.remove('error');
                }
            }
        }
    });
});

// Observe each phone input
phoneInputs.forEach(input => {
    observer.observe(input, {
        attributes: true,
        attributeFilter: ['style']
    });
});

// Additional observer for parent elements that might be hidden
phoneInputs.forEach(input => {
    const parent = input.closest('.update_contact') || input.closest('td');
    if (parent) {
        observer.observe(parent, {
            attributes: true,
            attributeFilter: ['style']
        });

        // Initialize visibility
        if (window.getComputedStyle(parent).display === 'none') {
            const itiContainer = input.closest('.iti');
            if (itiContainer) {
                itiContainer.style.display = 'none';
            }
            const errorContainer = document.getElementById(input.dataset.errorContainer);
            const validContainer = document.getElementById(input.dataset.validContainer);
            if (errorContainer) {
                errorContainer.classList.add('hide');
                errorContainer.innerHTML = '';
            }
            if (validContainer) {
                validContainer.classList.add('hide');
                validContainer.textContent = '';
            }
        }
    }
});
</script>
