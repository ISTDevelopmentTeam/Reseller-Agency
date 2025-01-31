// --------------------------------------------------------VALIDATION FOR INPUT------------------------------------------------------------ //
$('.letters_only_fname').on('input', function (event) {
    var inputValue = $(this).val();
    var letterRegex = /^[a-zA-ZñÑ\s]*$/u;
  
    if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s]/gu, ''));
      $('.validation-message_fname').text("Only Letters Allowed");
    } else {
      $('.validation-message_fname').text("");
    }
  });
  $('.letters_only_mname').on('input', function (event) {
    var inputValue = $(this).val();
    var letterRegex = /^[a-zA-ZñÑ\s]*$/u;
  
    if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s]/gu, ''));
      $('.validation-message_mname').text("Only Letters Allowed");
    } else {
      $('.validation-message_mname').text("");
    }
  });
  $('.letters_only_lname').on('input', function (event) {
    var inputValue = $(this).val();
    var letterRegex = /^[a-zA-ZñÑ\s]*$/u;
  
    if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s]/gu, ''));
      $('.validation-message_lname').text("Only Letters Allowed");
    } else {
      $('.validation-message_lname').text("");
    }
  });
  
  // this for number-only and letters will not work.
  $('.number_only').on('keypress', function(event) {
    var charCode = event.which || event.keyCode;
    var charStr = String.fromCharCode(charCode);
  
    var numberRegex = /^[0-9]+$/;
  
    if (!numberRegex.test(charStr)) {
        event.preventDefault();
    } 
  });
  // END FOR VALIDATION INPUT
  
  // ----------------------------------------------------------Validation for TAB/STEP------------------------------------------------------------------------------//
  // Form validation and submission handling
  document.addEventListener('DOMContentLoaded', function() {
    const resellerForm = document.getElementById('resellerForm');
    const submitBtn = document.getElementById('submit_btn');
    const mobileInput = document.getElementById('mobileNumber');
    const errorMsg = document.getElementById('error-msg-1');
    const chooseLabel = document.getElementById('choose');
    const radioInputs = document.querySelectorAll('input[name="selection"]');
    const checkboxInputs = document.querySelectorAll('.dl_restric');
    const dlCodesLabel = document.querySelector('#dlcodes label.d-flex');
    const restrictionLabel = document.getElementById('restrictionLabel');
    const restrictionCheckboxes = document.querySelectorAll('.restriction1');

    // Japan option elements
    const yesradio = document.getElementById('yesRadio');
    const noradio = document.getElementById('noRadio');
    const option_border = document.getElementById('japanoption');
    const yesDropdown = document.getElementById('yesDropdown');
    const noDropdown = document.getElementById('noDropdown');
    const members_purposetravel = document.getElementById('members_purposetravel');
    const members_purposetravel1 = document.getElementById('members_purposetravel1');
    const japan_border = document.getElementById('bordered1');
    const ofw_yes = document.getElementById('ofw_yes');
    const ofw_no = document.getElementById('ofw_no');
    const ofww = document.getElementById('op_ofw');
    const ofw_yes1 = document.getElementById('ofw_yes1');
    const ofw_no1 = document.getElementById('ofw_no1');
    const ofww1 = document.getElementById('op_ofw1');

    // Additional checkboxes
    const checkbox21 = document.getElementById('checkbox21');
    const checkbox22 = document.getElementById('checkbox22');
    const checkbox1 = document.getElementById('checkbox1');

    // Additional checkbox containers
    const noJapanDiv = document.getElementById('no_japan');
    const dropDownYesDiv = document.getElementById('japan_other_country');
    const dropDownYesDiv1 = document.getElementById('japan_other_country1');
    const dropDownNoDiv = document.getElementById('japan_only');

    // Plan type and license expiration date elements
    const planTypeSelect = document.getElementById('plantype');
    const expirationInput = document.getElementById('expiration');

    // Add event listener to each radio button for real-time validation
    radioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            if (Array.from(radioInputs).some(r => r.checked)) {
                chooseLabel.style.color = '';
            } else {
                chooseLabel.style.color = 'red';
            }
        });
    });

    // Add event listener to each checkbox for real-time validation
    checkboxInputs.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (Array.from(checkboxInputs).some(c => c.checked)) {
                dlCodesLabel.style.color = '';
            } else {
                dlCodesLabel.style.color = 'red';
            }
            validateClutchRadioButtons(); // Validate clutch radio buttons when checkbox state changes
        });
    });

    // Add event listeners to restriction checkboxes for real-time validation
    restrictionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (Array.from(restrictionCheckboxes).some(c => c.checked)) {
                restrictionLabel.style.color = '';
            } else {
                restrictionLabel.style.color = 'red';
            }
        });
    });

    // Add event listeners to additional checkboxes for real-time validation
    [checkbox21, checkbox22, checkbox1].forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            validateAdditionalCheckboxes();
        });
    });

    // Add event listeners to clutch radio buttons for real-time validation
    const clutchRadioInputs = document.querySelectorAll('.sub_dl');
    clutchRadioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            validateClutchRadioButtons(); // Validate clutch radio buttons when radio button state changes
        });
    });

    // Add event listeners to Japan option elements for real-time validation
    [yesradio, noradio, yesDropdown, noDropdown, ofw_yes, ofw_no, ofw_yes1, ofw_no1].forEach(element => {
        element.addEventListener('change', function() {
            validateJapanOptions(); // Validate Japan options when element state changes
        });
    });

    // Function to validate clutch radio buttons
    function validateClutchRadioButtons() {
        var restrictionCheckbox1 = document.getElementById('restrictionCheckbox1');
        var clutchRadio1_1 = document.getElementById('clutchRadio1_1');
        var labelclutchRadio1_1 = document.getElementById('clutch1_1');
        var restrictionCheckbox2 = document.getElementById('restrictionCheckbox2');
        var clutchRadio2_1 = document.getElementById('clutchRadio2_1');
        var clutchRadio2_2 = document.getElementById('clutchRadio2_2');
        var labelclutchRadio2_1 = document.getElementById('clutch2_1');
        var labelclutchRadio2_2 = document.getElementById('clutch2_2');
        var restrictionCheckbox3 = document.getElementById('restrictionCheckbox3');
        var clutchRadio3_1 = document.getElementById('clutchRadio3_1');
        var clutchRadio3_2 = document.getElementById('clutchRadio3_2');
        var labelclutchRadio3_1 = document.getElementById('clutch3_1');
        var labelclutchRadio3_2 = document.getElementById('clutch3_2');
        var restrictionCheckbox4 = document.getElementById('restrictionCheckbox4');
        var clutchRadio4_1 = document.getElementById('clutchRadio4_1');
        var clutchRadio4_2 = document.getElementById('clutchRadio4_2');
        var labelclutchRadio4_1 = document.getElementById('clutch4_1');
        var labelclutchRadio4_2 = document.getElementById('clutch4_2');
        var restrictionCheckbox5 = document.getElementById('restrictionCheckbox5');
        var clutchRadio5_1 = document.getElementById('clutchRadio5_1');
        var labelclutchRadio5_1 = document.getElementById('clutch5_1');

        if (restrictionCheckbox1.checked) {
            if (!clutchRadio1_1.checked) {
                labelclutchRadio1_1.style.color = "red";
            } else {
                labelclutchRadio1_1.style.color = "";
            }
        }

        if (restrictionCheckbox2.checked) {
            if (!clutchRadio2_1.checked && !clutchRadio2_2.checked) {
                labelclutchRadio2_1.style.color = "red";
                labelclutchRadio2_2.style.color = "red";
            } else {
                labelclutchRadio2_1.style.color = "";
                labelclutchRadio2_2.style.color = "";
            }
        }

        if (restrictionCheckbox3.checked) {
            if (!clutchRadio3_1.checked && !clutchRadio3_2.checked) {
                labelclutchRadio3_1.style.color = "red";
                labelclutchRadio3_2.style.color = "red";
            } else {
                labelclutchRadio3_1.style.color = "";
                labelclutchRadio3_2.style.color = "";
            }
        }

        if (restrictionCheckbox4.checked) {
            if (!clutchRadio4_1.checked) {
                labelclutchRadio4_1.style.color = "red";
            } else {
                labelclutchRadio4_1.style.color = "";
            }
        }

        if (restrictionCheckbox5.checked) {
            if (!clutchRadio5_1.checked) {
                labelclutchRadio5_1.style.color = "red";
            } else {
                labelclutchRadio5_1.style.color = "";
            }
        }
    }

    // Function to validate Japan options
    function validateJapanOptions() {
        if (!yesradio.checked && !noradio.checked) {
            option_border.style.border = "2px solid red";
            return false;
        } else {
            option_border.style.border = "";

            if (noradio.checked) {
                if (members_purposetravel.value === 'Work') {
                    if (!ofw_yes.checked && !ofw_no.checked) {
                        ofww.style.color = "red";
                        return false;
                    } else {
                        ofww.style.color = "";
                    }
                }
            } else if (yesradio.checked) {
                if (!yesDropdown.checked && !noDropdown.checked) {
                    japan_border.style.border = "2px solid red";
                    return false;
                } else {
                    japan_border.style.border = "";

                    if (members_purposetravel1.value === 'Work') {
                        if (!ofw_yes1.checked && !ofw_no1.checked) {
                            ofww1.style.color = "red";
                            return false;
                        } else {
                            ofww1.style.color = "";
                        }
                    }
                }
            }
        }
        return true;
    }

    // Function to validate additional checkboxes
    function validateAdditionalCheckboxes() {
        if (noJapanDiv.style.display !== 'none' && checkbox21.required && !checkbox21.checked) {
            noJapanDiv.style.border = "2px solid red";
        } else {
            noJapanDiv.style.border = "";
        }

        if (dropDownYesDiv.style.display !== 'none') {
            if (checkbox.required && !checkbox.checked) {
                dropDownYesDiv.style.border = "2px solid red";
            } else if (checkbox22.required && !checkbox22.checked) {
                dropDownYesDiv.style.border = "2px solid red";
            } else {
                dropDownYesDiv.style.border = "";
            }
        }

        if (dropDownYesDiv1.style.display !== 'none') {
            if (checkbox.required && !checkbox.checked) {
                dropDownYesDiv1.style.border = "2px solid red";
            } else if (checkbox22.required && !checkbox22.checked) {
                dropDownYesDiv1.style.border = "2px solid red";
            } else {
                dropDownYesDiv1.style.border = "";
            }
        }

        if (dropDownNoDiv.style.display !== 'none' && checkbox1.required && !checkbox1.checked) {
            dropDownNoDiv.style.border = "2px solid red";
        } else {
            dropDownNoDiv.style.border = "";
        }
    }

    // Function to check if the license expiration date is less than a year from the current date
    function isLicenseExpirationLessThanAYear() {
        const expirationDate = new Date(expirationInput.value);
        const currentDate = new Date();
        const oneYearFromNow = new Date(currentDate.getFullYear() + 1, currentDate.getMonth(), currentDate.getDate());
        return expirationDate < oneYearFromNow;
    }

    // Function to check if the plan type is valid for Japan
    function isPlanTypeValidForJapan() {
        const selectedPlanId = parseInt(planTypeSelect.value);
        return !(yesradio.checked && (selectedPlanId === 9 || selectedPlanId === 10));
    }

    // Function to check if all required fields are filled and valid
    function isFormValid() {
        // Check required fields
        const requiredElements = resellerForm.querySelectorAll('[required]');
        for (const element of requiredElements) {
            if (!element.value.trim()) {
                return {
                    valid: false,
                    title: 'Missing Required Fields',
                    message: 'Please fill in all required fields'
                };
            }

            // Special check for file inputs
            if (element.type === 'file' && !element.files.length) {
                return {
                    valid: false,
                    title: 'Missing Required Files',
                    message: 'Please upload all required files'
                };
            }

            // Special check for select elements
            if (element.tagName === 'SELECT' && element.value === '') {
                return {
                    valid: false,
                    title: 'Missing Required Options',
                    message: 'Please select all required options'
                };
            }
        }

        // Check radio buttons
        const isAnyRadioChecked = Array.from(radioInputs).some(radio => radio.checked);
        if (!isAnyRadioChecked) {
            chooseLabel.style.color = 'red';
            return {
                valid: false,
                title: 'Select DL Codes or Restriction',
                message: 'Please select either DL Codes or Restriction'
            };
        } else {
            chooseLabel.style.color = ''; // Reset the color if valid
        }

        // Check which radio button is selected
        const selectedOption = Array.from(radioInputs).find(radio => radio.checked);

        if (selectedOption.value === 'dlcode') {
            // Validate DL Codes
            const isAnyCheckboxChecked = Array.from(checkboxInputs).some(checkbox => checkbox.checked);
            if (!isAnyCheckboxChecked) {
                dlCodesLabel.style.color = 'red';
                return {
                    valid: false,
                    title: 'Select DL Code',
                    message: 'Please select at least one DL Code'
                };
            } else {
                dlCodesLabel.style.color = ''; // Reset the color if valid
            }

            // Validate clutch radio buttons
            validateClutchRadioButtons();
            const clutchLabels = document.querySelectorAll('.custom-control-label');
            for (const label of clutchLabels) {
                if (label.style.color === 'red') {
                    return {
                        valid: false,
                        title: 'Select Valid Clutch Option',
                        message: 'Please select a valid clutch option for the selected DL Codes'
                    };
                }
            }
        } else if (selectedOption.value === 'restriction') {
            // Validate Restriction
            const isAnyRestrictionChecked = Array.from(restrictionCheckboxes).some(checkbox => checkbox.checked);
            if (!isAnyRestrictionChecked) {
                restrictionLabel.style.color = 'red';
                return {
                    valid: false,
                    title: 'Select Restriction',
                    message: 'Please select at least one restriction'
                };
            } else {
                restrictionLabel.style.color = ''; // Reset the color if valid
            }
        }

        // Validate Japan options
        if (!validateJapanOptions()) {
            return {
                valid: false,
                title: 'Select Valid Japan Option',
                message: 'Please select a valid Japan option'
            };
        }

        // Check if mobile number has error message displayed
        if (!errorMsg.classList.contains('hide')) {
            return {
                valid: false,
                title: 'Invalid Mobile Number',
                message: 'Please enter a valid mobile number'
            };
        }

        // Validate additional checkboxes
        validateAdditionalCheckboxes();
        if (noJapanDiv.style.border === "2px solid red" || dropDownYesDiv.style.border === "2px solid red" || dropDownYesDiv1.style.border === "2px solid red" || dropDownNoDiv.style.border === "2px solid red") {
            return {
                valid: false,
                title: 'Check Required Checkboxes',
                message: 'Please check the required checkboxes'
            };
        }

        // Validate plan type and license expiration date
        const selectedPlanId = parseInt(planTypeSelect.value);
        if ((selectedPlanId === 9 || selectedPlanId === 10) && isLicenseExpirationLessThanAYear()) {
            return {
                valid: false,
                title: 'License Exiperation',
                message: 'Your current license period is less than one year. TWO YEARS (PIDP) or More than Two Years are not available. Only Annual (1-year) available, Please Choose Annual Year (PIDP).'
            };
        }

        // Validate plan type for Japan
        if (!isPlanTypeValidForJapan()) {
            return {
                valid: false,
                title: 'Plan Type Issue for Japan',
                message: 'Japan only offers an annual plan. Please change your plan type selection to an annual type.'
            };
        }

        return {
            valid: true,
            message: ''
        };
    }

    // Handle form submission
    resellerForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formValidation = isFormValid();

        if (!formValidation.valid) {
            // Show error message using SweetAlert
            Swal.fire({
                title: formValidation.title,
                text: formValidation.message,
                icon: 'error',
                confirmButtonColor: '#d33'
            });
            return;
        }

        // If form is valid, show confirmation SweetAlert
        Swal.fire({
            title: 'Submit Form?',
            text: 'Are you sure you want to submit this form?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                resellerForm.submit();
            }
        });
    });

    // File input validation
    const fileInputs = resellerForm.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const feedback = document.getElementById(this.getAttribute('data-feedback'));
            if (this.files.length === 0 && feedback) {
                feedback.textContent = 'Please select a file';
            } else if (feedback) {
                feedback.textContent = '';
            }
        });
    });

    // Add submit button click handler for additional validation
    submitBtn.addEventListener('click', function(e) {
        const isAnyRadioChecked = Array.from(radioInputs).some(radio => radio.checked);
        if (!isAnyRadioChecked) {
            chooseLabel.style.color = 'red';
        } else {
            chooseLabel.style.color = '';
        }

        const selectedOption = Array.from(radioInputs).find(radio => radio.checked);

        if (selectedOption.value === 'dlcode') {
            const isAnyCheckboxChecked = Array.from(checkboxInputs).some(checkbox => checkbox.checked);
            if (!isAnyCheckboxChecked) {
                dlCodesLabel.style.color = 'red';
            } else {
                dlCodesLabel.style.color = '';
            }

            validateClutchRadioButtons(); // Validate clutch radio buttons when submit button is clicked
        } else if (selectedOption.value === 'restriction') {
            const isAnyRestrictionChecked = Array.from(restrictionCheckboxes).some(checkbox => checkbox.checked);
            if (!isAnyRestrictionChecked) {
                restrictionLabel.style.color = 'red';
            } else {
                restrictionLabel.style.color = '';
            }
        }

        validateJapanOptions(); // Validate Japan options when submit button is clicked
        validateAdditionalCheckboxes(); // Validate additional checkboxes when submit button is clicked
    });
});


  document.addEventListener('DOMContentLoaded', function () {
    // manageFieldDisabling();
    // updateNavigationButtons();
    // VehicleHandling();
    // FileUploads();
    toggleRequiredAttributes();
  });
  // ----------------------------------------------------------Validation for TAB/STEP-----------------------------------------------------------------//
  
  // ----------------------------------------------------------LICENSE DETAILS FUNCTION----------------------------------------------------------//

  // EXPIRATION DATE FUNCTION
  document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById("expiration");
    let datePicker;
    let lastValue = "";
  
    // Function to check if a date is in the future
    const isFutureDate = (date) => {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        return date >= today;
    };

    
    datePicker = flatpickr("#expiration", {
        dateFormat: "m/d/Y",
        allowInput: true,
        minDate: "today", // Disable all past dates
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                if (isFutureDate(selectedDates[0])) {
                    input.value = dateStr;
                    lastValue = dateStr;
                    input.classList.remove('error');
                } else {
                    instance.clear();
                    input.classList.add('error');
                    alert("Please select a future date");
                }
            }
        }
    });
  
    // Add input event listener for manual typing
    input.addEventListener('input', function(e) {
        let v = this.value;
  
        // Handle backspace/delete - allow normal deletion
        if (v.length < lastValue.length) {
            lastValue = v;
            if (v.length === 0) {
                datePicker.clear();
                input.classList.remove('error');
            }
            return;
        }
  
        // Only proceed with formatting if we're adding characters
        if (v.length > lastValue.length) {
            // Handle MM/ format
            if (v.match(/^\d{2}$/) !== null) {
                let month = parseInt(v);
                v = (month > 12 ? 12 : month) + '/';
            } 
            // Handle MM/DD/ format
            else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                let parts = v.split('/');
                let month = parseInt(parts[0]);
                let day = parseInt(parts[1]);
                v = (month > 12 ? 12 : month) + '/' + (day > 31 ? 31 : day) + '/';
            }
            // Handle complete date format MM/DD/YYYY
            else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
                let parts = v.split('/');
                let month = parseInt(parts[0]);
                let day = parseInt(parts[1]);
                let year = parseInt(parts[2]);
                
                // Create a date object
                let dateStr = `${month}/${day}/${year}`;
                let date = new Date(dateStr);
                
                // Only update if it's a valid date and in the future
                if (!isNaN(date.getTime())) {
                    if (isFutureDate(date)) {
                        datePicker.setDate(date, true);
                        input.classList.remove('error');
                    } else {
                        input.classList.add('error');
                        alert("Please enter a future date");
                        // Clear the input after a short delay
                        setTimeout(() => {
                            this.value = '';
                            lastValue = '';
                            datePicker.clear();
                        }, 100);
                    }
                }
            }
            
            this.value = v;
            lastValue = v;
        }
    });
  
    // Add keydown listener for better backspace handling
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            if (this.value.length === 0) {
                datePicker.clear();
                input.classList.remove('error');
            }
        }
    });
});


// FOR DL AND RESTRICTION HIDE AND SHOW
document.addEventListener('DOMContentLoaded', function () {
    const dlcodeRadio       = document.getElementById('dlcode');
    const restrictionRadio  = document.getElementById('restriction');
    const dlcodesDiv        = document.getElementById('dlcodes');
    const restrictionsDiv   = document.getElementById('restrictions');
    const dlcodeArrayInput  = document.getElementById('dlcodearray');
    const restricArrayInput = document.getElementById('restric');


    // For DL CODE
    dlcodeRadio.addEventListener('change', function () {
        if (this.checked) {

            const restrictionCheckboxes = restrictionsDiv.querySelectorAll('input[type="checkbox"]');
            restrictionCheckboxes.forEach(checkbox => checkbox.checked = false);

            restricArrayInput.value = '';

            // Display DL CODE and hide Restriction
            dlcodesDiv.style.display = 'block';
            restrictionsDiv.style.display = 'none';
        }
    });

    // FOR RESTRICTION 
    restrictionRadio.addEventListener('change', function () {
        if (this.checked) {
            // Clear DL CODE values
            const dlcodeCheckboxes = dlcodesDiv.querySelectorAll('input[type="checkbox"]');
            const dlcodeRadios = dlcodesDiv.querySelectorAll('input[type="radio"]');
            dlcodeCheckboxes.forEach(checkbox => checkbox.checked = false);
            dlcodeRadios.forEach(radio => {
                radio.checked = false;
                radio.required = false;
            });

            // Clear the DL CODE VALUE
            dlcodeArrayInput.value = '';

            // Display Restriction and hide DL CODE
            restrictionsDiv.style.display = 'block';
            dlcodesDiv.style.display = 'none';

            // Hide clutch radio options
            const clutchRadioOptionsGroups = document.querySelectorAll('.clutchRadioOptionsGroup');
            clutchRadioOptionsGroups.forEach(group => {
                group.style.display = 'none';
            });

        }
    });
});

function handleCheckboxChange(checkboxId, radioGroupId) {
    var checkbox = document.getElementById(checkboxId);
    var radioGroup = document.getElementById(radioGroupId);

    if (checkbox.checked) {
        radioGroup.style.display = 'block';
    } else {
        radioGroup.style.display = 'none';
    }
}


document.getElementById('restrictionCheckbox1').addEventListener('change', function () {
    handleCheckboxChange('restrictionCheckbox1', 'clutchRadioOptionsGroup1');
});

document.getElementById('restrictionCheckbox2').addEventListener('change', function () {
    handleCheckboxChange('restrictionCheckbox2', 'clutchRadioOptionsGroup2');
});

document.getElementById('restrictionCheckbox3').addEventListener('change', function () {
    handleCheckboxChange('restrictionCheckbox3', 'clutchRadioOptionsGroup3');
});

document.getElementById('restrictionCheckbox4').addEventListener('change', function () {
    handleCheckboxChange('restrictionCheckbox4', 'clutchRadioOptionsGroup4');
});

document.getElementById('restrictionCheckbox5').addEventListener('change', function () {
    handleCheckboxChange('restrictionCheckbox5', 'clutchRadioOptionsGroup5');
});

$(document).ready(function () {
    function updateRestrictionNumber() {
        var restrictionNumbers = [];

        if ($('#restrictionCheckbox1').prop('checked')) {
            if ($('#clutchRadio1_1').prop('checked')) {
                restrictionNumbers.push(1);
            }
        }

        if ($('#restrictionCheckbox2').prop('checked')) {
            if ($('#clutchRadio2_1').prop('checked')) {
                restrictionNumbers.push(2);
            }
        }

        if ($('#restrictionCheckbox2').prop('checked')) {
            if ($('#clutchRadio2_2').prop('checked')) {
                restrictionNumbers.push(4);
            }
        }

        if ($('#restrictionCheckbox3').prop('checked')) {
            if ($('#clutchRadio3_1').prop('checked')) {
                restrictionNumbers.push(3);
            }
        }

        if ($('#restrictionCheckbox3').prop('checked')) {
            if ($('#clutchRadio3_2').prop('checked')) {
                restrictionNumbers.push(5);
            }
        }

        if ($('#restrictionCheckbox4').prop('checked')) {
            if ($('#clutchRadio4_1').prop('checked')) {
                restrictionNumbers.push(6);
            }
        }

        if ($('#restrictionCheckbox5').prop('checked')) {
            if ($('#clutchRadio5_1').prop('checked')) {
                restrictionNumbers.push(8);
            }
        }

        // Update the input field with the restriction numbers
        $('#dlcodearray').val(restrictionNumbers.join(', '));
    }

    $('.checkbox-btn, .radio-btn').on('change', function () {
        updateRestrictionNumber();
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

document.getElementById('restrictionCheckbox1').addEventListener('change', function () {

    var radio1 = document.getElementById('clutchRadio1_1');
    var radio2 = document.getElementById('clutchRadio1_2');

    if (this.checked) {
        radio1.disabled = false;
        radio2.disabled = true;
        // radio1.required = true;

    } else {
        radio1.checked = false;
        radio2.checked = false;
        // radio1.required = false;

    }
});

document.getElementById('restrictionCheckbox2').addEventListener('change', function () {

    var radio1 = document.getElementById('clutchRadio2_1');
    var radio2 = document.getElementById('clutchRadio2_2');


    if (this.checked) {
        radio1.disabled = false;
        radio2.disabled = false;
        // radio1.required = true;
        // radio2.required = true;
    } else {
        radio1.checked = false;
        radio2.checked = false;
        radio1.disabled = true;
        radio2.disabled = true;
        // radio1.required = false;
        // radio2.required = false;
    }
});

document.getElementById('restrictionCheckbox3').addEventListener('change', function () {

    var radio1 = document.getElementById('clutchRadio3_1');
    var radio2 = document.getElementById('clutchRadio3_2');


    if (this.checked) {
        radio1.disabled = false;
        radio2.disabled = false;
        // radio1.required = true;
        // radio2.required = true;
        // clutchRadio.style.border = '2px solid red';
    } else {
        radio1.checked = false;
        radio2.checked = false;
        radio1.disabled = true;
        radio2.disabled = true;
        // radio1.required = false;
        // radio2.required = false;
    }
});

document.getElementById('restrictionCheckbox4').addEventListener('change', function () {

    var radio1 = document.getElementById('clutchRadio4_1');
    var radio2 = document.getElementById('clutchRadio4_2');

    if (this.checked) {
        radio1.disabled = false;
        radio2.disabled = true;
        // radio1.required = true;
    } else {
        radio1.checked = false;
        radio2.checked = false;
        // radio1.required = false;
    }
});

document.getElementById('restrictionCheckbox5').addEventListener('change', function () {

    var radio1 = document.getElementById('clutchRadio5_1');
    var radio2 = document.getElementById('clutchRadio5_2');

    if (this.checked) {
        radio1.disabled = false;
        radio2.disabled = true;
        // radio1.required = true;
    } else {
        radio1.checked = false;
        radio2.checked = false;
        // radio1.required = false;
    }
});

$(document).ready(function () {
    var dlcode = document.getElementById('dlcode');
    var restriction = document.getElementById('restriction');


    function toggleRequired() {
        if (dlcode.checked) {
            var atLeastOneChecked = $("[id^=restrictionCheckbox]:checked").length > 0;
            $("[id^=restrictionCheckbox]").prop("required", !atLeastOneChecked);

        } else {
            $("[id^=restrictionCheckbox]").prop("required", false);
        }

        if (restriction.checked) {
            var atLeastOneChecked1 = $(".restriction1:checked").length > 0;
            $(".restriction1").prop("required", !atLeastOneChecked1);
        } else {
            $(".restriction1").prop("required", false);
        }
    }

    toggleRequired();

    $("[id^=restrictionCheckbox], [class*=restriction]").on("click", toggleRequired);

    $('#dlcode, #restriction').on('change', function () {
        toggleRequired();
    });

});
// Are you going to Japan---------------
$(document).ready(function () {

  $('#yesRadio').on('click', function () {
    $('#collapsibleYesJapan').show();
    $('#Nojapan').hide();
    $('#dropDownYes').hide();
    $('#dropDownNo').hide();
    $('#travelDestination').hide();
    $('#travelDestination1').hide();
    $('#japanNoPlan').show();
    $('#auto_japan').hide();
    $('#purpose_ofw').hide();

    $('#destinationOut').val('');
    $('#option_ofw').hide();
    $('#optional_date').hide();
    $('#dremarks1').text('');
    $('#members_purposetravel').val('');
    $('#departure_date').val('');
    $('#return_date').val('');
    $('#op_ofw').css('color', '');

    // Reset the checkboxes
    $('#checkbox_waiver').prop('checked', false);
    $('#checkbox21').prop('checked', false);
    $('#checkbox').prop('checked', false);
    $('#checkbox22').prop('checked', false);
    $('#ofw_yes').prop('checked', false);
    $('#ofw_no').prop('checked', false);

  });

  $('#noRadio').on('click', function () {
    $('#collapsibleYesJapan').hide();
    $('#dropDownNo').hide();
    $('#travelDestination').show();
    $('#japanNoPlan').show();
    $('#auto_japan').hide();
    $('#option_ofw').hide();
    $('#optional_date').hide();
    $('#dropDownYes').hide();

    // Reset the radioButtons
    $('#yesDropdown').prop('checked', false);
    $('#noDropdown').prop('checked', false);  // Auto-check the "NO" radio button

    // Reset the checkboxes
    $('#checkbox_waiver').prop('checked', false);
    $('#checkbox_waiver1').prop('checked', false);
    $('#checkbox_waiver2').prop('checked', false);
    $('#checkbox').prop('checked', false);
    $('#checkbox1').prop('checked', false);
    $('#checkbox22').prop('checked', false);
    $('#destinationIn').val('');
    $('#dremarks').text('');
    $('#members_purposetravel').val('');
    $('#departure_date1').val('');
    $('#return_date1').val('');
  });

  $('#yesDropdown').on('click', function () {
    $('#collapsibleYesJapan').show();
    $('#dropDownNo').hide();
    $('#auto_japan').hide();

    $('#travelDestination').hide();
    $('#travelDestination1').show();
    $('#dropDownYes1').show();
    $('#option_ofw').hide();
    $('#optional_date').hide();
    $('#purpose_ofw').show();
    $('#option_ofw1').hide();
    $('#optional_date1').hide();
    $('#members_purposetravel1').val('');
    $('#departure_date1').val('');
    $('#return_date1').val('');
    $('#op_ofw1').css('color', '');

    // Reset the checkboxes
    $('#checkbox_waiver2').prop('checked', false);
    $('#checkbox21').prop('checked', false);
    $('#checkbox1').prop('checked', false);
    $('#ofw_yes1').prop('checked', false);
    $('#ofw_no1').prop('checked', false);

  });

  $('#noDropdown').on('click', function () {
    $('#collapsibleYesJapan').show();
    $('#dropDownYes').hide();
    $('#dropDownYes1').hide();
    $('#dropDownNo').show();
    $('#auto_japan').show();
    $('#travelDestination').hide();
    $('#travelDestination1').hide();
    $('#option_ofw').hide();
    $('#optional_date').hide();
    $('#purpose_ofw').show();

    $('#destinationIn').val('');
    $('#dremarks').text('');
    $('#option_ofw1').hide();
    $('#optional_date1').hide();
    $('#members_purposetravel1').val('');
    $('#departure_date1').val('');
    $('#return_date1').val('');
    $('#op_ofw1').css('color', '');

    // Reset the checkboxes
    $('#checkbox_waiver1').prop('checked', false);
    $('#checkbox').prop('checked', false);
    $('#checkbox21').prop('checked', false);
    $('#checkbox22').prop('checked', false);
    $('#ofw_yes1').prop('checked', false);
    $('#ofw_no1').prop('checked', false);
  });
});

var noRadio           = document.getElementById('noRadio');
var yesRadio          = document.getElementById('yesRadio');
var yesDropdown       = document.getElementById('yesDropdown');
var noDropdown        = document.getElementById('noDropdown');
var destinationInput1 = document.getElementById('destinationOut');
var destinationInput2 = document.getElementById('destinationIn');
var purposetravel     = document.getElementById('members_purposetravel');
var purposetravel1    = document.getElementById('members_purposetravel1');
var check_waiver1     = document.getElementById('checkbox_waiver1');
var check_waiver2     = document.getElementById('checkbox_waiver2');
var checkbox1         = document.getElementById('checkbox1');
var checkbox2         = document.getElementById('checkbox22');
var checkbox3         = document.getElementById('checkbox');
var checkbox4         = document.getElementById('checkbox21');

noRadio.addEventListener('change', updateRequiredAttribute);
yesRadio.addEventListener('change', updateRequiredAttribute);
yesDropdown.addEventListener('change', updateRequiredAttribute);
noDropdown.addEventListener('change', updateRequiredAttribute);

function updateRequiredAttribute() {
  destinationInput1.required = noRadio.checked || yesDropdown.checked;
  purposetravel.required     = noRadio.checked;
  purposetravel1.required    = yesDropdown.checked || noDropdown.checked;

  if (yesRadio.checked) {
    destinationInput1.removeAttribute('required');
    purposetravel.removeAttribute('required');
    yesDropdown.required = true;
    noDropdown.required  = true;
    checkbox4.required   = false;
  } else {
    yesDropdown.required = false;
    noDropdown.required  = false;
  }
  if (yesRadio.checked && yesDropdown.checked) {
    destinationInput1.removeAttribute('required');
    purposetravel.removeAttribute('required');
    check_waiver2.removeAttribute('required');
    checkbox1.removeAttribute('required');
    checkbox4.required = false;
  } else {
    destinationInput1.required = true;
    purposetravel.required     = true;
    checkbox1.required         = true;
  }

  destinationInput2.required = (yesRadio.checked && yesDropdown.checked) && !noDropdown.checked;


  if (noRadio.checked) {
    destinationInput2.removeAttribute('required');
    checkbox1.removeAttribute('required');
    checkbox2.removeAttribute('required');
    checkbox3.removeAttribute('required');
    check_waiver1.removeAttribute('required')
    check_waiver2.removeAttribute('required')

          //   if (purposetravel.value === 'Work') {
          //     ofw_yes.setAttribute('required', '');
          //     ofw_no.setAttribute('required', '');
          // } else {
          //     ofw_yes.removeAttribute('required');
          //     ofw_no.removeAttribute('required');
          // }
  }

        // purposetravel.addEventListener('change', function() {
        //   if (noRadio.checked && this.value === 'Work') {
        //       ofw_yes.setAttribute('required', '');
        //       ofw_no.setAttribute('required', '');
        //   } else {
        //       ofw_yes.removeAttribute('required');
        //       ofw_no.removeAttribute('required');
        //   }
        // });

  if (yesRadio.checked && noDropdown.checked) {
    destinationInput1.removeAttribute('required');
    purposetravel.removeAttribute('required');
    check_waiver1.removeAttribute('required');
    checkbox3.removeAttribute('required');
    checkbox2.removeAttribute('required');
    checkbox4.removeAttribute('required');
  }

}

// PURPOSE OF TRAVEL FUNCTION (OFW && Tourism)
document.getElementById('members_purposetravel').addEventListener('change', function () {
  var ofwDiv       = document.querySelector('.ofw');
  var date_pDiv    = document.querySelector('.date_p');
  var radioButtons = ofwDiv.querySelectorAll('input[type="radio"]');

  if (this.value === 'Work') {
    ofwDiv.style.display    = 'block';
    date_pDiv.style.display = 'block';
  } else {
    ofwDiv.style.display    = 'none';
    date_pDiv.style.display = 'block';
    radioButtons.forEach(function (radio) {
      radio.checked = false;
    });
  }
});
document.getElementById('members_purposetravel1').addEventListener('change', function () {
  var ofwDiv         = document.querySelector('.ofw1');
  var date_departDiv = document.querySelector('.date_depart1');
  var radioButtons   = ofwDiv.querySelectorAll('input[type="radio"]');
  if (this.value === 'Work') {
    ofwDiv.style.display         = 'block';
    date_departDiv.style.display = 'block';
  } else {
    ofwDiv.style.display         = 'none';
    date_departDiv.style.display = 'block';
    radioButtons.forEach(function (radio) {
      radio.checked = false;
    });
  }
});

// WAIVER MODAL --------------------
const checkBox1        = document.getElementById('checkbox');
const checkBox2        = document.getElementById('checkbox1');
const waiverModal      = document.getElementById('waiverModal');
const waiver1          = document.getElementById('waiver1');
const waiver2          = document.getElementById('waiver2');
const checkbox_waiver1 = document.getElementById('checkbox_waiver1');
const checkbox_waiver2 = document.getElementById('checkbox_waiver2');

checkBox1.addEventListener('change', function () {
  if (this.checked) {
    waiver1.style.display     = 'block';
    waiver2.style.display     = 'none';
    waiverModal.style.display = 'block';
  } else {
    waiverModal.style.display = 'none';
    waiver1.style.display     = 'none';
  }
});

checkBox2.addEventListener('change', function () {
  if (this.checked) {
    waiver1.style.display     = 'none';
    waiver2.style.display     = 'block';
    waiverModal.style.display = 'block';
    checkbox_waiver2.required = true;
  } else {
    waiverModal.style.display = 'none';
    checkbox_waiver2.required = false;
  }
});


var closeBtn         = document.getElementsByClassName("closeBtn")[0];
    closeBtn.onclick = function () {
  if (waiver1.style.display === 'block') {
    if (checkbox_waiver1.type === "checkbox" && checkbox_waiver1.hasAttribute("required") && !checkbox_waiver1.checked) {
      Swal.fire({
        icon : "error",
        title: "Oops...",
        text : "You must agree to the terms before proceeding."
      });
      return false;
    } else {
      waiverModal.style.display = "none";
    }
  } else if (waiver2.style.display === 'block') {
    if (checkbox_waiver2.type === "checkbox" && checkbox_waiver2.hasAttribute("required") && !checkbox_waiver2.checked) {
      Swal.fire({
        icon : "error",
        title: "Oops...",
        text : "You must agree to the terms before proceeding."
      });
      return false;
    } else {
      waiverModal.style.display = "none";
    }
  } else {

  }
}


  
  // ----------------------------------------------------------PERSONAL INFORMATION  FUNCTION----------------------------------------------------------//
  
//   const yesRadio = document.getElementById('yes_japan');
//   const noRadio  = document.getElementById('no_japan');
//   const card3    = document.getElementById('no_japan_card');
//   const card4    = document.getElementById('yes_japan_card');
  
//     // For "Are you going to another country aside JAPAN?"
//   const anotherCountryYes = document.getElementById('yes_other');
//   const anotherCountryNo  = document.getElementById('anotherCountryNo');
  
//                                                                        // Declaration text container
//   const declarationText = document.getElementById('declarationText');  // Make sure this ID matches your declaration container
  
//     // Function to update the visibility of cards
//   function updateCardsVisibility() {
//       if (yesRadio.checked) {
//           card3.style.display = 'none';
//           card4.style.display = 'block';
//       } else if (noRadio.checked) {
//           card3.style.display = 'block';
//           card4.style.display = 'none';
//       } else {
//           card3.style.display = 'none';
//           card4.style.display = 'none';
//       }
//   }
  
//     // Function to update the visibility of content in Card 4 and declaration text
//   function updateCard4ContentVisibility() {
//       const card4ExtraContent = document.querySelector("#card4 .card-body > div:nth-child(4), #card4 .card-body > div:nth-child(5)");
  
//         // Always hide declaration text by default
//       declarationText.style.display = "none";
  
//       if (anotherCountryYes.checked) {
//           card4ExtraContent.style.display = "flex";
//       } else if (anotherCountryNo.checked) {
//           card4ExtraContent.style.display = "none";
  
//                                                     // Show declaration text if "NO" is selected
//           declarationText.style.display = "block";  // Show declaration text when "NO" is selected
//       }
//   }
  
//     // Add event listeners for the main "Japan" question
//   yesRadio.addEventListener('change', updateCardsVisibility);
//   noRadio.addEventListener('change', updateCardsVisibility);
  
//     // Add event listeners for the secondary question in Card 4
//   anotherCountryYes.addEventListener('change', updateCard4ContentVisibility);
//   anotherCountryNo.addEventListener('change', updateCard4ContentVisibility);
  
//     // Initialize visibility on page load
//   updateCardsVisibility();
//   updateCard4ContentVisibility();
  




  // File upload handling
  // function FileUploads() {
  //   const fileInputs = document.querySelectorAll('input[type="file"]');
  //   fileInputs.forEach(input => {
  //     input.addEventListener('change', function () {
  //       handleGeneralFileUpload(this,
  //         this.id === 'orcrAttachment' ? 'orcr' : 'valid_id',
  //         this.id === 'orcrAttachment' ? 'orcrFeedback' : 'idFeedback'
  //       );
  //     });
  //   });
  // }
  
  
  function handleGeneralFileUpload(input, imageId, feedbackId) {
    const file = input.files && input.files[0];
    if (!file) {
        return;
    }
  
    const feedback = document.getElementById(feedbackId);
    const imagePreview = document.getElementById(imageId);
  
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSizeInBytes = 8 * 1024 * 1024; // 8MB
  
    // Reset previous feedback and preview
    feedback.textContent = '';
    imagePreview.style.display = 'none';
    imagePreview.src = '';
  
    // Validate file type
    if (!allowedTypes.includes(file.type)) {
        feedback.textContent = 'Invalid file type. Please select a JPG, JPEG, PNG, or GIF file.';
        input.value = '';
        return;
    }
  
    // Validate file size
    if (file.size > maxSizeInBytes) {
        feedback.textContent = 'File size exceeds 8MB limit.';
        input.value = '';
        return;
    }
  
    // Create preview
    const reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
  // END FILE UPLOAD
  
  // Start Title Gender-----------------
  document.getElementById('title').addEventListener('change', function() {
      const title = this.value;
      const genderSelect = document.getElementById('gender');
  
      switch (title) {
          case 'MR':
              genderSelect.value = 'MALE';
              break;
          case 'MS':
          case 'MRS':
              genderSelect.value = 'FEMALE';
              break;
          case 'ATTY':
          case 'DR':
          case 'ENGR':
              genderSelect.value = '';
              break;
          default:
              genderSelect.value = '';
      }
  });
  
  // Start Citizenship Dropdown-------------------
  document.addEventListener('DOMContentLoaded', function () {
    var citizenshipDropdown = document.getElementById('citizenship');
    var addInfoSection = document.getElementById('add_info');
  
    citizenshipDropdown.addEventListener('change', function () {
      if (citizenshipDropdown.value === 'foreigner') {
        addInfoSection.style.display = 'block';
        setRequiredForeigner(true);
  
      } else {
        addInfoSection.style.display = 'none';
        setRequiredForeigner(false);
        nationality.value = "";
      }
    });
  });
  
  function setRequiredForeigner(isRequired) {
    var nationality = document.getElementById("nationality");
    nationality.required = isRequired;
  }
  // END Citizenship Dropdown
  
  
  // FLAT Picker FOR BIRTHDATE
  document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("birthdate");
    let datePicker;
    let lastValue = "";
  
    // Calculate the maximum allowed date (18 years ago from today)
    const maxDate = new Date();
    maxDate.setFullYear(maxDate.getFullYear() - 18);
  
    // Initialize Flatpickr
    datePicker = flatpickr("#birthdate", {
      dateFormat: "m/d/Y",
      allowInput: true,
      maxDate: maxDate, // Set the maximum allowed date
      onChange: function (selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          input.value = dateStr;
          lastValue = dateStr;
        }
      }
    });
  
    // Add input event listener for manual typing
    input.addEventListener('input', function (e) {
      let v = this.value;
  
      // Handle backspace/delete - allow normal deletion
      if (v.length < lastValue.length) {
        lastValue = v;
        if (v.length === 0) {
          datePicker.clear();
        }
        return;
      }
  
      // Only proceed with formatting if we're adding characters
      if (v.length > lastValue.length) {
        // Handle MM/ format
        if (v.match(/^\d{2}$/) !== null) {
          let month = parseInt(v);
          v = (month > 12 ? 12 : month) + '/';
        }
        // Handle MM/DD/ format
        else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
          let parts = v.split('/');
          let month = parseInt(parts[0]);
          let day = parseInt(parts[1]);
          v = (month > 12 ? 12 : month) + '/' + (day > 31 ? 31 : day) + '/';
        }
        // Handle complete date format MM/DD/YYYY
        else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
          let parts = v.split('/');
          let month = parseInt(parts[0]);
          let day = parseInt(parts[1]);
          let year = parseInt(parts[2]);
  
          // Create a date object and update the calendar
          let dateStr = `${month}/${day}/${year}`;
          let date = new Date(dateStr);
  
          // Only update if it's a valid date and at least 18 years ago
          if (!isNaN(date.getTime()) && date <= maxDate) {
            datePicker.setDate(date, true);
          } else {
            // If the date is not valid or not at least 18 years ago, clear the input
            this.value = lastValue;
            return;
          }
        }
  
        this.value = v;
        lastValue = v;
      }
    });
  
    // Add keydown listener for better backspace handling
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Backspace' || e.key === 'Delete') {
        if (this.value.length === 0) {
          datePicker.clear();
        }
      }
    });
  });
  // END OF FLAT PICKER
  
  // ---------------------------------------------------END FUNCTION FOR PERSONAL INFORMATION------------------------------------------------ //
  
  
  // ---------------------------------------------------CONTACT INFORMATION FUNCTION-------------------------------------------------------- //
  document.addEventListener('DOMContentLoaded', function () {
    var mailingAddressDropdown = document.getElementById('mail');
    var officeAddressSection   = document.getElementById('officeAddress');
    var street1                = document.getElementById('street1');
    var town1                  = document.getElementById('town1');
    var city1                  = document.getElementById('city1');
    var province1              = document.getElementById('province1');
    var zcode1                 = document.getElementById('zcode1');
    var comname                = document.getElementById('comname');
  
      // Function to set or remove the required attribute for the specified fields
    function updateRequiredFields(required) {
      street1.required   = required;
      town1.required     = required;
      city1.required     = required;
      province1.required = required;
      zcode1.required    = required;
      comname.required   = required;
    }
  
    mailingAddressDropdown.addEventListener('change', function () {
      if (mailingAddressDropdown.value === 'OFFICE ADDRESS') {
        officeAddressSection.style.display = 'block';
        updateRequiredFields(true);
      } else {
        officeAddressSection.style.display = 'none';
        street1.value                      = "";
        town1.value                        = "";
        city1.value                        = "";
        province1.value                    = "";
        zcode1.value                       = "";
        comname.value                      = "";
        updateRequiredFields(false);
      }
    });
  });
  
  function toggleRequiredAttributes() {
    const phoneInput = document.getElementById('mobileNumber');
    const emailInput = document.getElementById('emailAddress');
  
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    const isEmailValid = emailRegex.test(emailInput.value.trim());
  
    phoneInput.addEventListener('input', function() {
      if (this.value.trim() !== '') {
        emailInput.removeAttribute('required');
      } else {
        emailInput.setAttribute('required', 'required');
      }
    });
  
    if (isEmailValid) {
      phoneInput.removeAttribute('required');
    } else {
      phoneInput.setAttribute('required', 'required');
    }
  }
  
  function maskTelNo(id) {
    $("#" + id).mask("9-999-9999");
  }
  
  // ---------------------------------------------------VEHICLE DETAILS FUNCTION-------------------------------------------------------- //
  
   // vehicleFileUpload function to work with dynamic IDs
   function handleVehicleFileUpload(input, imageId, feedbackId) {
    const file = input.files && input.files[0];
    if (!file) {
        return;
    }
  
    const feedback = document.getElementById(feedbackId);
    const imagePreview = document.getElementById(imageId);
  
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSizeInBytes = 8 * 1024 * 1024; // 8MB
  
    // Reset previous feedback and preview
    feedback.textContent = '';
    imagePreview.style.display = 'none';
    imagePreview.src = '';
  
    // Validate file type
    if (!allowedTypes.includes(file.type)) {
        feedback.textContent = 'Invalid file type. Please select a JPG, JPEG, PNG, or GIF file.';
        input.value = '';
        return;
    }
  
    // Validate file size
    if (file.size > maxSizeInBytes) {
        feedback.textContent = 'File size exceeds 8MB limit.';
        input.value = '';
        return;
    }
  
    // Create preview
    const reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
  
// Function to update label and mask for conduction sticker/plate number
function updateLabeldyna(checkedId, uncheckedId) {
    const checkedCheckbox = document.getElementById(checkedId);
    const uncheckedCheckbox = document.getElementById(uncheckedId);
    uncheckedCheckbox.disabled = false;
    uncheckedCheckbox.checked = false;
    checkedCheckbox.disabled = true;
  
    const vehicleNum = checkedId.match(/\d+$/)?.[0] || '';
    const platenumId = vehicleNum ? `platenum${vehicleNum}` : 'platenum';
    const cstickerId = vehicleNum ? `csticker${vehicleNum}` : 'csticker';
  
    const platenumInput = document.getElementById(platenumId);
    const platenumLabel = document.querySelector(`label[for="${platenumId}"]`);
    const var_csticker = document.getElementById(cstickerId);
  
    $(platenumInput).unmask();
    
    if (checkedCheckbox.value == 1) {
        platenumLabel.textContent = "Conduction Sticker";
        platenumInput.placeholder = "Enter conduction sticker";
        platenumInput.dataset.inputType = 'conduction';
        $(platenumInput).mask('AAAAAA');
    } else {
        platenumLabel.textContent = "Plate No";
        platenumInput.placeholder = "Enter plate no";
        platenumInput.dataset.inputType = 'plate';
        $(platenumInput).mask('AAAAAAAA', {
            translation: {
                'A': {
                    pattern: /[A-Za-z0-9\s-]/,
                    transform: function(val) {
                        let currentVal = this.el.val();
                        if (currentVal.replace(/[-\s]/g, '').length >= 7 && val !== '-' && val !== ' ') {
                            return '';
                        }
                        return val;
                    }
                }
            }
        });
    }
    platenumInput.value = "";
    var_csticker.value = checkedCheckbox.value;
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    // Initial vehicle plate mask
    const initialPlateInput = document.getElementById('platenum');
    if (initialPlateInput) {
        applyPlateMask(initialPlateInput);
    }
  
    // Observer for dynamic vehicles
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.classList?.contains('vehicle-item')) {
                    const plateInput = node.querySelector('.platenum');
                    if (plateInput) {
                        applyPlateMask(plateInput);
                    }
                }
            });
        });
    });
  
    const vehicleContainer = document.getElementById('vehicleFields');
    if (vehicleContainer) {
        observer.observe(vehicleContainer, { childList: true, subtree: true });
    }
  });
  
  function applyPlateMask(element) {
    $(element).mask('AAAAAAAA', {
        translation: {
            'A': {
                pattern: /[A-Za-z0-9\s-]/,
                transform: function(val) {
                    let currentVal = this.el.val();
                    if (currentVal.replace(/[-\s]/g, '').length >= 7 && val !== '-' && val !== ' ') {
                        return '';
                    }
                    return val;
                }
            }
        }
    });
  }
  
  // --------------------------------------INFORMATION SUMMARY FUNCTION-------------------------------------------- //
  function summary_fetch() {
  
      // Step 1 Values
    var membershipType  = $('#membership_type').val();
    var plan_type       = $('#plan_type').val();
    var pin_code        = $('#pinCode').val();
    var paInsurance     = $('#paInsurance').val();
    var activationDate  = $('#activationDate').val();
    var applicationType = $('#applicationType').val();
  
  
      // Step 2 Values
    var title       = $('#title').val();
    var first_name  = $('#firstName').val();
    var last_name   = $('#lastName').val();
    var middle_name = $('#middleName').val();
      // var full_name    = first_name+ ' ,'+ last_name;
    var gender      = $('#gender').val();
    var birthdate   = $('#birthdate').val();
    var birthplace  = $('#birthplace').val();
    var citizenship = $('#citizenship').val();
    var nationality = $('#nationality').val();
      // var civilStatus        = $('#civilStatus').val();
      // var acrNo        = $('#acrNo').val();
    var occupation   = $('#occupation').val();
    var mobileNumber = $('#mobileNumber').val();
    var emailAddress = $('#emailAddress').val();
    var occupation   = $('#occupation').val();
    var civilStatus  = $('#civilStatus').val();
  
      // Step 3 Values
  
      // Home Address
    var mailing       = $('#mail').val();
    var street        = $('#street').val();
    var town          = $('#town').val();
    var city          = $('#city').val();
    var province      = $('#province').val();
    var zcode         = $('#zcode').val();
    var homeaddress   = street + ' ' + town + ' ' + city + ' ' + province + ' ' + zcode + ' ';
    var availMagazine = $('#availMagazine').val();
  
      // Office Address
    var street        = $('#street1').val();
    var town          = $('#town1').val();
    var city          = $('#city1').val();
    var province      = $('#province1').val();
    var zcode         = $('#zcode1').val();
    var officeaddress = street + ' ' + town + ' ' + city + ' ' + province + ' ' + zcode + ' ';
    var companyName   = $('#comname').val();
  
  
      // Summary Fields
    document.getElementById('summaryApplicationType').textContent = applicationType;
    document.getElementById('summaryMembershipType').textContent  = membershipType;
    document.getElementById('summaryPlanType').textContent        = plan_type;
    document.getElementById('summaryActivationDate').textContent  = activationDate;
  
    document.getElementById('summaryTitle').textContent       = title;
    document.getElementById('summaryLastname').textContent    = last_name;
    document.getElementById('summaryFirstname').textContent   = first_name;
    document.getElementById('summaryMiddlename').textContent  = middle_name;
    document.getElementById('summaryGender').textContent      = gender;
    document.getElementById('summaryBirthdate').textContent   = birthdate;
    document.getElementById('summaryBirthplace').textContent  = birthplace;
    document.getElementById('summaryCivilstatus').textContent = civilStatus;
    document.getElementById('summaryCitizenship').textContent = citizenship;
    document.getElementById('summaryOccupation').textContent  = occupation;
  
    document.getElementById('summaryCompanyName').textContent       = companyName;
    document.getElementById('summaryhomeaddress').textContent       = homeaddress;
    document.getElementById('summaryofficeaddress').textContent     = officeaddress;
    document.getElementById('summaryMailingPreference').textContent = mailing;
    document.getElementById('summaryMagazine').textContent          = availMagazine;
  
  } 
  // -------------------------------------- END INFORMATION SUMMARY FUNCTION-------------------------------------------- //