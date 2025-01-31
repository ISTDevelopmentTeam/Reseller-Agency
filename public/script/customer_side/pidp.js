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
$('.number_only').on('keypress', function (event) {
  var charCode = event.which || event.keyCode;
  var charStr = String.fromCharCode(charCode);

  var numberRegex = /^[0-9]+$/;

  if (!numberRegex.test(charStr)) {
    event.preventDefault();
  }
});
// END FOR VALIDATION INPUT

// ----------------------------------------------------------Validation for TAB/STEP------------------------------------------------------------------------------//
function validateStep(stepNumber) {
  const currentStep = document.querySelector('.step.active');
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step3 = document.getElementById('step3');
  const step4 = document.getElementById('step4');

  if (stepNumber === 1) {
    // Get all required fields and sort by position
    const fields = Array.from(step1.querySelectorAll('[required]'));
    fields.sort((a, b) => {
      const aRect = a.getBoundingClientRect();
      const bRect = b.getBoundingClientRect();
      return aRect.top - bRect.top;
    });

    // Check each field in order
    for (const field of fields) {
      if (!field.checkValidity()) {
        field.reportValidity();
        return false;
      }
    }

    // Validate checkbox selections
    var dlcode      = document.getElementById('dlcode');
    var restriction = document.getElementById('restriction');
    var text_error  = document.getElementById('choose');

    if (!dlcode.checked && !restriction.checked) {
      text_error.style.color = 'red';
      return false;
    }

    if (restriction.checked) {
      var restrictionsForm      = document.getElementById('restrictions');
      var restrictionCheckboxes = restrictionsForm.querySelectorAll('.restriction1');
      var isValid               = false;

      restrictionCheckboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          isValid = true;
        }
      });

      if (!isValid) {
        restrictionCheckboxes.forEach(function (checkbox) {
          checkbox.reportValidity();
        });
        return false;
      }
    }

    if (dlcode.checked) {
      var restrictionCheckboxes = document.querySelectorAll('.dl_restric');
      var isValid = false;

      restrictionCheckboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          isValid = true;
        }
      });

      if (!isValid) {
        restrictionCheckboxes.forEach(function (checkbox) {
          checkbox.reportValidity();
        });
        return false;
      }
    }

    // Validate other checkboxes and radio buttons
    var elements = {
      1: {
        checkbox: document.getElementById('restrictionCheckbox1'),
        radio: document.getElementById('clutchRadio1_1'),
        label: document.getElementById('clutch1_1')
      },
      2: {
        checkbox: document.getElementById('restrictionCheckbox2'),
        radios: [
          document.getElementById('clutchRadio2_1'),
          document.getElementById('clutchRadio2_2')
        ],
        labels: [
          document.getElementById('clutch2_1'),
          document.getElementById('clutch2_2')
        ]
      },
      3: {
        checkbox: document.getElementById('restrictionCheckbox3'),
        radios: [
          document.getElementById('clutchRadio3_1'),
          document.getElementById('clutchRadio3_2')
        ],
        labels: [
          document.getElementById('clutch3_1'),
          document.getElementById('clutch3_2')
        ]
      },
      4: {
        checkbox: document.getElementById('restrictionCheckbox4'),
        radios: [
          document.getElementById('clutchRadio4_1'),
          document.getElementById('clutchRadio4_2')
        ],
        labels: [
          document.getElementById('clutch4_1'),
          document.getElementById('clutch4_2')
        ]
      },
      5: {
        checkbox: document.getElementById('restrictionCheckbox5'),
        radio: document.getElementById('clutchRadio5_1'),
        label: document.getElementById('clutch5_1')
      }
    };

    // Validate single radio elements
    for (let id of [1, 5]) {
      if (elements[id].checkbox.checked && !elements[id].radio.checked) {
        elements[id].label.style.color = "red";
        return false;
      }
    }

    // Validate multiple radio elements
    for (let id of [2, 3, 4]) {
      if (elements[id].checkbox.checked &&
        !elements[id].radios.some(radio => radio.checked)) {
        elements[id].labels.forEach(label => label.style.color = "red");
        return false;
      }
    }

    // Check expiration and plan type
    const expirationInput = document.getElementById("expiration");
    const planTypeSelect = document.getElementById("plantype");

    if (expirationInput?.value) {
      const selectedDate = new Date(expirationInput.value);
      const today = new Date();
      const oneYear = new Date();
      oneYear.setFullYear(today.getFullYear() + 1);

      if (selectedDate <= oneYear) {
        Swal.fire({
          icon: 'warning',
          title: 'Notice',
          text: 'License expiration is less than a year.',
          confirmButtonText: 'Continue'
        });

        const planId = planTypeSelect?.value;
        if (planId && (planId === '9' || planId === '10')) {
          Swal.fire({
            icon: 'error',
            title: 'Invalid Plan Selection',
            text: 'Only Annual Year plan is available for licenses less than a year.',
            confirmButtonText: 'Okay'
          });
          return false;
        }
      }
    }
  }

  if (stepNumber === 2) {

    var yesradio               = document.getElementById('yesRadio');
    var noradio                = document.getElementById('noRadio');
    var option_border          = document.getElementById('japanoption');
    var yesDropdown            = document.getElementById('yesDropdown');
    var noDropdown             = document.getElementById('noDropdown');
    var members_purposetravel  = document.getElementById('members_purposetravel');
    var members_purposetravel1 = document.getElementById('members_purposetravel1');
    var japan_border           = document.getElementById('bordered1');
    var ofw_yes                = document.getElementById('ofw_yes');
    var ofw_no                 = document.getElementById('ofw_no');
    var ofww                   = document.getElementById('op_ofw');
    var ofw_yes1               = document.getElementById('ofw_yes1');
    var ofw_no1                = document.getElementById('ofw_no1');
    var ofww1                  = document.getElementById('op_ofw1');

    if (!yesradio.checked && !noradio.checked) {
      option_border.style.border = "2px solid red";
      return false;
    }

    option_border.style.border = "";

    if (noradio.checked) {
      if (members_purposetravel.value === 'Work') {
        if (!ofw_yes.checked && !ofw_no.checked) {
          ofww.style.color = "red";
          return false;
        }
        ofww.style.color = "";
      }
    } else if (yesradio.checked) {
      if (!yesDropdown.checked && !noDropdown.checked) {
        japan_border.style.border = "2px solid red";
        return false;
      }
      japan_border.style.border = "";

      if (members_purposetravel1.value === 'Work') {
        if (!ofw_yes1.checked && !ofw_no1.checked) {
          ofww1.style.color = "red";
          return false;
        }
        ofww.style.color = "";
      }
    }
    // Get all required fields and sort by position
    const fields = Array.from(step2.querySelectorAll('[required]'));
    fields.sort((a, b) => {
      const aRect = a.getBoundingClientRect();
      const bRect = b.getBoundingClientRect();
      return aRect.top - bRect.top;
    });

    // Check each field in order
    for (const field of fields) {
      if (!field.checkValidity()) {
        field.reportValidity();
        return false;
      }
    }

    const citizenship = step2.querySelector('#citizenship');
    const nationality = step2.querySelector('#nationality');
    if (citizenship?.value === 'foreigner' && nationality && !nationality.value.trim()) {
      nationality.required = true;
      nationality.focus();
      nationality.reportValidity();
      return false;
    }
  }

  if (stepNumber === 3) {
    // Get all required fields and sort by position
    const fields = Array.from(step3.querySelectorAll('[required]'));
    fields.sort((a, b) => {
      const aRect = a.getBoundingClientRect();
      const bRect = b.getBoundingClientRect();
      return aRect.top - bRect.top;
    });

    // Check each field in order
    for (const field of fields) {
      if (!field.checkValidity()) {
        field.reportValidity();
        return false;
      }
    }
    if ($('.error-msg').text().trim() !== "" || $('.validation-message_email').text().trim() !== "") {
      return false;
    }
  }

  if (stepNumber === 4) {
    // Get all required fields and sort by position
    const fields = Array.from(step4.querySelectorAll('[required]'));
    fields.sort((a, b) => {
      const aRect = a.getBoundingClientRect();
      const bRect = b.getBoundingClientRect();
      return aRect.top - bRect.top;
    });

    // Check each field in order
    for (const field of fields) {
      if (!field.checkValidity()) {
        field.reportValidity();
        return false;
      }
    }

    const vehicles = step4.querySelectorAll('.vehicle-item');
    if (vehicles.length === 0) {
      alert('At least one vehicle is required.');
      return false;
    }
  }
  gatherInputValues();
  return true;
}

function updateNavigationButtons() {
  const steps             = document.querySelectorAll('.form-step');
  const currentStep       = document.querySelector('.form-step.active');
  const currentStepNumber = parseInt(currentStep.id.replace('step', ''));
  const isLastStep        = currentStepNumber === steps.length;
  const isFirstStep       = currentStepNumber === 1;

  const existingNavArea = currentStep.querySelector('.nav-area');
  if (existingNavArea) {
    existingNavArea.remove();
  }

  const navArea           = document.createElement('div');
        navArea.className = 'nav-area d-flex justify-content-between mt-4 w-100';
  currentStep.appendChild(navArea);

  const leftNav            = document.createElement('div');
  const rightNav           = document.createElement('div');
        leftNav.className  = 'previous';
        rightNav.className = 'next';
  navArea.appendChild(leftNav);
  navArea.appendChild(rightNav);

  if (!isFirstStep) {
    const prevButton             = document.createElement('button');
          prevButton.type        = 'button';
          prevButton.className   = 'btn btn-secondary rounded';
          prevButton.textContent = 'Previous';
          prevButton.onclick     = previousStep;
    leftNav.appendChild(prevButton);
  }

  const nextButton             = document.createElement('button');
        nextButton.type        = 'button';                          // Changed to always be 'button' type
        nextButton.className   = 'btn btn-primary rounded';
        nextButton.textContent = isLastStep ? 'Submit' : 'Next';
        nextButton.onclick     = isLastStep ?
    () => {
      if (validateStep(currentStepNumber)) {
        Swal.fire({
          title: "Are you sure?",
          text: "Once submitted, you won't be able to edit the form.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, submit it!",
          cancelButtonText: "No, keep editing"
        }).then((result) => {
          if (result.isConfirmed) {
            document.querySelector('form').submit(); // Submits the actual form
          }
        });
      }
    } : 
    () => nextStep(currentStepNumber);
  rightNav.appendChild(nextButton);
}

function nextStep(currentStepNumber) {
  if (validateStep(currentStepNumber)) {
    const currentStep = document.querySelector(`#step${currentStepNumber}`);
    const nextStep    = document.querySelector(`#step${currentStepNumber + 1}`);

    if (currentStep && nextStep) {
      currentStep.classList.remove('active');
      nextStep.classList.add('active');

      const progress             = document.querySelector('.progress-bar');
            progress.style.width = `${currentStepNumber * 25}%`;

      updateBreadcrumb(currentStepNumber + 1);
      updateNavigationButtons();

      if (currentStepNumber + 1 === 5) {
        gatherInputValues();
      }
    }
  }
}

function previousStep() {
  const currentStep = document.querySelector('.form-step.active');
  const stepNumber = parseInt(currentStep.id.replace('step', ''));

  if (stepNumber > 1) {
    currentStep.classList.remove('active');
    const previousStep = document.querySelector(`#step${stepNumber - 1}`);
    previousStep.classList.add('active');

    const progress = document.querySelector('.progress-bar');
    progress.style.width = `${(stepNumber - 2) * 25}%`;

    updateBreadcrumb(stepNumber - 1);
    updateNavigationButtons();
  }
}

function updateBreadcrumb(stepNumber) {
  const steps = document.getElementsByClassName('breadcrumb-item');
  Array.from(steps).forEach((step, index) => {
    step.classList.toggle('active', index === stepNumber - 1);
  });
}

// Initialize form
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', (e) => e.preventDefault());

    // Handle nationality field visibility
    const citizenship          = document.querySelector('#citizenship');
    const nationalityContainer = document.querySelector('#add_info');
    const nationality          = document.querySelector('#nationality');

    if (citizenship && nationalityContainer) {
      citizenship.addEventListener('change', function () {
        nationalityContainer.style.display = this.value === 'foreigner' ? '' : 'none';
        if (nationality) {
          nationality.required = this.value === 'foreigner';
          if (!this.value === 'foreigner') {
            nationality.value = '';
          }
        }
      });
    }
  }

  updateNavigationButtons();
  toggleRequiredAttributes();
});

$('#yesRadio').change(function () {
  if (this.checked) {
    $('#japanoption').css('border', 'none');
  }
});
$('#noRadio').change(function () {
  if (this.checked) {
    $('#japanoption').css('border', 'none');
  }
});
$('#yesDropdown').change(function () {
  if (this.checked) {
    $('#bordered1').css('border', 'none');
  }
});
$('#noDropdown').change(function () {
  if (this.checked) {
    $('#bordered1').css('border', 'none');
  }
});

$('#ofw_yes, #ofw_no').change(function () {
  if ($('#ofw_yes').is(':checked') || $('#ofw_no').is(':checked')) {
    $('#op_ofw').css('color', '');
  }
});

$('#ofw_yes1, #ofw_no1').change(function () {
  if ($('#ofw_yes1').is(':checked') || $('#ofw_no1').is(':checked')) {
    $('#op_ofw1').css('color', '');
  }
});

$('#dlcode, #restriction').change(function () {
  if ($('#dlcode').is(':checked') || $('#restriction').is(':checked')) {
    $('#choose').css('color', '');
  }
});

$('#clutchRadio1_1').change(function () {
  if ($('#clutchRadio1_1').is(':checked')) {
    $('#clutch1_1').css('color', '');
  }
});
$('#clutchRadio2_1, #clutchRadio2_2').change(function () {
  if ($('#clutchRadio2_1').is(':checked') || $('#clutchRadio2_2').is(':checked')) {
    $('#clutch2_1').css('color', '');
    $('#clutch2_2').css('color', '');
  }
});
$('#clutchRadio3_1, #clutchRadio3_2').change(function () {
  if ($('#clutchRadio3_1').is(':checked') || $('#clutchRadio3_2').is(':checked')) {
    $('#clutch3_1').css('color', '');
    $('#clutch3_2').css('color', '');

  }
});
$('#clutchRadio4_1, #clutchRadio4_2').change(function () {
  if ($('#clutchRadio4_1').is(':checked') || $('#clutchRadio4_2').is(':checked')) {
    $('#clutch4_1').css('color', '');
    // $('#clutch4_2').css('color', '');
  }
});
$('#clutchRadio5_1').change(function () {
  if ($('#clutchRadio5_1').is(':checked')) {
    $('#clutch5_1').css('color', '');
  }
});
// ----------------------------------------------------------Validation for TAB/STEP-----------------------------------------------------------------//

// ----------------------------------------------------------LICENSE DETAILS FUNCTION----------------------------------------------------------//

$(document).ready(function () {
  $('.license_no').mask('AAA-AA-AAAAAA', {
    translation: {
      'A': { pattern: /[A-Za-z0-9]/ }
    }
  });
});

// EXPIRATION DATE FUNCTION
document.addEventListener("DOMContentLoaded", function () {
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
    onChange: function (selectedDates, dateStr, instance) {
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
  input.addEventListener('input', function (e) {
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
  input.addEventListener('keydown', function (e) {
    if (e.key === 'Backspace' || e.key === 'Delete') {
      if (this.value.length === 0) {
        datePicker.clear();
        input.classList.remove('error');
      }
    }
  });
});


// FOR DL AND RESTRICTION HIDE AND SHOW WITH CLEAR VALUE
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

// THIS RESTRICTION THAT PUSH THE VALUE IN HIDDEN DIV(WHERE VALUE DISPLAY RESTRICTION)
$(document).ready(function () {
  function updateRestriction() {
    var checkedValues = [];
    $('input[name="restriction[]"]:checked').each(function () {
      checkedValues.push($(this).val());
    });
    $('#restric').val(checkedValues.join(', '));

    if (typeof updateRestrictionLabels === 'function') {
      updateRestrictionLabels();
    }
  }

  updateRestriction();

  $('input[name="restriction[]"]').on('change', updateRestriction);
});

// THIS DL CODE THAT PUSH THE VALUE IN HIDDEN DIV(WHERE VALUE DISPLAY FOR DL CODE)
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

var noRadio = document.getElementById('noRadio');
var yesRadio = document.getElementById('yesRadio');
var yesDropdown = document.getElementById('yesDropdown');
var noDropdown = document.getElementById('noDropdown');
var destinationInput1 = document.getElementById('destinationOut');
var destinationInput2 = document.getElementById('destinationIn');
var purposetravel = document.getElementById('members_purposetravel');
var purposetravel1 = document.getElementById('members_purposetravel1');
var check_waiver1 = document.getElementById('checkbox_waiver1');
var check_waiver2 = document.getElementById('checkbox_waiver2');
var checkbox1 = document.getElementById('checkbox1');
var checkbox2 = document.getElementById('checkbox22');
var checkbox3 = document.getElementById('checkbox');
var checkbox4 = document.getElementById('checkbox21');

noRadio.addEventListener('change', updateRequiredAttribute);
yesRadio.addEventListener('change', updateRequiredAttribute);
yesDropdown.addEventListener('change', updateRequiredAttribute);
noDropdown.addEventListener('change', updateRequiredAttribute);

function updateRequiredAttribute() {
  destinationInput1.required = noRadio.checked || yesDropdown.checked;
  purposetravel.required = noRadio.checked;
  purposetravel1.required = yesDropdown.checked || noDropdown.checked;

  if (yesRadio.checked) {
    destinationInput1.removeAttribute('required');
    purposetravel.removeAttribute('required');
    yesDropdown.required = true;
    noDropdown.required = true;
    checkbox4.required = false;
  } else {
    yesDropdown.required = false;
    noDropdown.required = false;
  }
  if (yesRadio.checked && yesDropdown.checked) {
    destinationInput1.removeAttribute('required');
    purposetravel.removeAttribute('required');
    check_waiver2.removeAttribute('required');
    checkbox1.removeAttribute('required');
    checkbox4.required = false;
  } else {
    destinationInput1.required = true;
    purposetravel.required = true;
    checkbox1.required = true;
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
  var ofwDiv = document.querySelector('.ofw');
  var date_pDiv = document.querySelector('.date_p');
  var radioButtons = ofwDiv.querySelectorAll('input[type="radio"]');

  if (this.value === 'Work') {
    ofwDiv.style.display = 'block';
    date_pDiv.style.display = 'block';
  } else {
    ofwDiv.style.display = 'none';
    date_pDiv.style.display = 'block';
    radioButtons.forEach(function (radio) {
      radio.checked = false;
    });
  }
});
document.getElementById('members_purposetravel1').addEventListener('change', function () {
  var ofwDiv = document.querySelector('.ofw1');
  var date_departDiv = document.querySelector('.date_depart1');
  var radioButtons = ofwDiv.querySelectorAll('input[type="radio"]');
  if (this.value === 'Work') {
    ofwDiv.style.display = 'block';
    date_departDiv.style.display = 'block';
  } else {
    ofwDiv.style.display = 'none';
    date_departDiv.style.display = 'block';
    radioButtons.forEach(function (radio) {
      radio.checked = false;
    });
  }
});

// WAIVER MODAL --------------------
const checkBox1 = document.getElementById('checkbox');
const checkBox2 = document.getElementById('checkbox1');
const waiverModal = document.getElementById('waiverModal');
const waiver1 = document.getElementById('waiver1');
const waiver2 = document.getElementById('waiver2');
const checkbox_waiver1 = document.getElementById('checkbox_waiver1');
const checkbox_waiver2 = document.getElementById('checkbox_waiver2');

checkBox1.addEventListener('change', function () {
  if (this.checked) {
    waiver1.style.display = 'block';
    waiver2.style.display = 'none';
    waiverModal.style.display = 'block';
  } else {
    waiverModal.style.display = 'none';
    waiver1.style.display = 'none';
  }
});

checkBox2.addEventListener('change', function () {
  if (this.checked) {
    waiver1.style.display = 'none';
    waiver2.style.display = 'block';
    waiverModal.style.display = 'block';
    checkbox_waiver2.required = true;
  } else {
    waiverModal.style.display = 'none';
    checkbox_waiver2.required = false;
  }
});


var closeBtn = document.getElementsByClassName("closeBtn")[0];
closeBtn.onclick = function () {
  if (waiver1.style.display === 'block') {
    if (checkbox_waiver1.type === "checkbox" && checkbox_waiver1.hasAttribute("required") && !checkbox_waiver1.checked) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "You must agree to the terms before proceeding."
      });
      return false;
    } else {
      waiverModal.style.display = "none";
    }
  } else if (waiver2.style.display === 'block') {
    if (checkbox_waiver2.type === "checkbox" && checkbox_waiver2.hasAttribute("required") && !checkbox_waiver2.checked) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "You must agree to the terms before proceeding."
      });
      return false;
    } else {
      waiverModal.style.display = "none";
    }
  } else {

  }
}


// ----------------------------------------------------------PERSONAL INFORMATION  FUNCTION----------------------------------------------------------//

// File upload handling
function FileUploads() {
  const fileInputs = document.querySelectorAll('input[type="file"]');
  fileInputs.forEach(input => {
    input.addEventListener('change', function () {
      handleFileUpload(this,
        this.id === 'orcrAttachment' ? 'orcr' : 'valid_id',
        this.id === 'orcrAttachment' ? 'orcrFeedback' : 'idFeedback'
      );
    });
  });
}


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
document.getElementById('title').addEventListener('change', function () {
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

  const maxDate = new Date();
  maxDate.setFullYear(maxDate.getFullYear() - 18);

  datePicker = flatpickr("#birthdate", {
    dateFormat: "m/d/Y",
    allowInput: true,
    maxDate: maxDate,
    formatDate: (date) => {
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const day = date.getDate().toString().padStart(2, '0');
      return `${month}/${day}/${date.getFullYear()}`;
    },
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        const formattedDate = instance.formatDate(selectedDates[0], "m/d/Y");
        input.value = formattedDate;
        lastValue = formattedDate;
      }
    }
  });

  input.addEventListener('input', function (e) {
    let v = this.value;

    if (v.length < lastValue.length) {
      lastValue = v;
      if (v.length === 0) datePicker.clear();
      return;
    }

    if (v.length > lastValue.length) {
      if (v.match(/^\d{2}$/) !== null) {
        let month = parseInt(v);
        v = v.padStart(2, '0');
        v = (month > 12 ? '12' : v) + '/';
      }
      else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
        let [month, day] = v.split('/').map(num => parseInt(num));
        v = month.toString().padStart(2, '0') + '/' +
          (day > 31 ? '31' : day.toString().padStart(2, '0')) + '/';
      }
      else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
        let [month, day, year] = v.split('/').map(num => parseInt(num));
        let dateStr = `${month.toString().padStart(2, '0')}/${day.toString().padStart(2, '0')}/${year}`;
        let date = new Date(dateStr);

        if (!isNaN(date.getTime()) && date <= maxDate) {
          datePicker.setDate(date, true);
        } else {
          this.value = lastValue;
          return;
        }
      }

      this.value = v;
      lastValue = v;
    }
  });

  input.addEventListener('keydown', function (e) {
    if ((e.key === 'Backspace' || e.key === 'Delete') && this.value.length === 0) {
      datePicker.clear();
    }
  });
});
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
  var telephoneNumber        = document.getElementById('telephoneNumber');

  // Function to set or remove the required attribute for the specified fields
  function updateRequiredFields(required) {
    street1.required         = required;
    town1.required           = required;
    city1.required           = required;
    province1.required       = required;
    zcode1.required          = required;
    comname.required         = required;
    telephoneNumber.required = required;
  }

  mailingAddressDropdown.addEventListener('change', function () {
    if (mailingAddressDropdown.value === 'OFFICE ADDRESS') {
      officeAddressSection.style.display = 'block';
      updateRequiredFields(true);
    } else {
      officeAddressSection.style.display = 'none';
      street1.value = "";
      town1.value = "";
      city1.value = "";
      province1.value = "";
      zcode1.value = "";
      comname.value = "";
      telephoneNumber.value = "";
      updateRequiredFields(false);
    }
  });
});

function toggleRequiredAttributes() {
  const phoneInput = document.getElementById('mobileNumber');
  const emailInput = document.getElementById('emailAddress');

  // Add listener for phone input
  phoneInput.addEventListener('input', function () {
    if (this.value.trim() !== '') {
      emailInput.removeAttribute('required');
    } else {
      emailInput.setAttribute('required', 'required');
    }
  });

  // Add listener for email input
  emailInput.addEventListener('input', function () {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const isEmailValid = emailRegex.test(this.value.trim());

    if (isEmailValid) {
      phoneInput.removeAttribute('required');
    } else {
      phoneInput.setAttribute('required', 'required');
    }
  });
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

function updateLabeldyna(checkedId, uncheckedId) {
  const checkedCheckbox            = document.getElementById(checkedId);
  const uncheckedCheckbox          = document.getElementById(uncheckedId);
        uncheckedCheckbox.disabled = false;
        uncheckedCheckbox.checked  = false;
        checkedCheckbox.disabled   = true;

  const vehicleNum = checkedId.match(/\d+$/)?.[0] || '';
  const platenumId = vehicleNum ? `platenum${vehicleNum}` : 'platenum';
  const cstickerId = vehicleNum ? `csticker${vehicleNum}` : 'csticker';

  const platenumInput = document.getElementById(platenumId);
  const platenumLabel = document.querySelector(`label[for="${platenumId}"]`);
  const var_csticker  = document.getElementById(cstickerId);

  $(platenumInput).unmask();

  if (checkedCheckbox.value == 1) {
    platenumLabel.textContent       = "Conduction Sticker";
    platenumInput.placeholder       = "Enter conduction sticker";
    platenumInput.dataset.inputType = 'conduction';
    $(platenumInput).mask('AAAAAA');
  } else {
    platenumLabel.textContent       = "Plate No";
    platenumInput.placeholder       = "Enter plate no";
    platenumInput.dataset.inputType = 'plate';
    $(platenumInput).mask('AAAAAAAA', {
      translation: {
        'A': {
          pattern: /[A-Za-z0-9\s-]/,
          transform: function (val) {
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
  var_csticker.value  = checkedCheckbox.value;
}

document.addEventListener('DOMContentLoaded', function () {
  // Initial vehicle plate mask
  const initialPlateInput = document.getElementById('platenum');
  if (initialPlateInput) {
    applyPlateMask(initialPlateInput);
  }

  // Observer for dynamic vehicles
  const observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      mutation.addedNodes.forEach(function (node) {
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
        transform: function (val) {
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
// GET INPUTS VALUE -------------------------------------------------------
function gatherInputValues() {

  //Personal Information
  const title       = document.getElementById("title").value.toUpperCase();
  const firstName   = document.getElementById("firstName").value.toUpperCase();
  const middleName  = document.getElementById("middleName").value.toUpperCase();
  const lastName    = document.getElementById("lastName").value.toUpperCase();
  const birthdate   = document.getElementById("birthdate").value;
  const birthPlace  = document.getElementById("birthplace").value.toUpperCase();
  const gender      = document.getElementById("gender").value.toUpperCase();
  const occupation  = document.getElementById("occupation").value.toUpperCase();
  const status      = document.getElementById("civilStatus").value.toUpperCase();
  const citizenship = document.getElementById("citizenship").value.toUpperCase();
    // Additional Information
  const nationality = document.getElementById("nationality").value || "";


  // Contact Information
  const mailingAddress = document.getElementById("mail").value.toUpperCase();
    // Home Address
  const street                = document.getElementById("street").value.toUpperCase();
  const town                  = document.getElementById("town").value.toUpperCase();
  const city                  = document.getElementById("city").value.toUpperCase();
  const province              = document.getElementById("province").value.toUpperCase();
  const zipCode               = document.getElementById("zcode").value;
  const mobileNo              = document.getElementById("mobileNumber").value;
  const alternateMobileNo     = document.getElementById("alternateMobile").value;
  const emailAddress          = document.getElementById("emailAddress").value;
  const alternateEmailAddress = document.getElementById("alternateEmail").value;
    // Office Address
  const street1     = document.getElementById("street1").value.toUpperCase();
  const town1       = document.getElementById("town1").value.toUpperCase();
  const city1       = document.getElementById("city1").value.toUpperCase();
  const province1   = document.getElementById("province1").value.toUpperCase();
  const zipCode1    = document.getElementById("zcode1").value;
  const CompanyName = document.getElementById("comname").value.toUpperCase();
  const OfficeTel   = document.getElementById("telephoneNumber").value;

  // License Details.
  const licenseNo      = document.getElementById("license").value;
  const expirationDate = document.getElementById("expiration").value;
  const cardType       = document.getElementById("card-type").value.toUpperCase();
  const licenseType    = document.getElementById("license-type").value.toUpperCase();

    // DL CODE
  // const selectedCheckboxes     = document.querySelectorAll('.restrictions input[type="checkbox"]:checked');
  // const selectedCheckboxValues = [];
  // selectedCheckboxes.forEach((checkbox) => {
  //   selectedCheckboxValues.push(checkbox.value);
  // });
  // const restrictionNumberValue = document.getElementById('restrictionNumberValue').innerText;
  // const clutch                 = restrictionNumberValue.split(',').map(item => item.trim());

  // if (clutch[0] === "") {
  //   document.getElementById('restrictionNumberValue').innerText = '';
  // } else {
  //   const restriction_no       = document.getElementById('dlcodearray');
  //         restriction_no.value = JSON.stringify(clutch);
  // }
    // RESTRICTION
  const restriction = document.getElementById("restric").value;
  const dlcode = document.getElementById("dlcodearray").value;


  // DISPLAY INPUTS VALUE ON TABLE
    //PERSONAL
  document.getElementById("echoTitle").innerHTML       = "<strong>Title: </strong>" + title;
  document.getElementById("echoFirstName").innerHTML   = "<strong>First Name: </strong>" + firstName;
  document.getElementById("echoLastName").innerHTML    = "<strong>Last Name: </strong>" + lastName;
  document.getElementById("echoMiddleName").innerHTML  = "<strong>Middle Name: </strong>" + middleName;
  document.getElementById("echoBirthdate").innerHTML   = "<strong>Birthdate: </strong>" + birthdate;
  document.getElementById("echoBirthPlace").innerHTML  = "<strong>Birth Place: </strong>" + birthPlace;
  document.getElementById("echoGender").innerHTML      = "<strong>Gender: </strong>" + gender;
  document.getElementById("echoCitizenship").innerHTML = "<strong>Citizenship: </strong>" + citizenship;
  document.getElementById("echoStatus").innerHTML      = "<strong>Status: </strong>" + status;
  document.getElementById("echoOccupation").innerHTML  = "<strong>Occupation: </strong>" + occupation;

    //CONTACT 
  document.getElementById("echoHomeAddress").innerHTML        = "<strong>Home Address: </strong>" + street + " " + town + " " + city + " " + province + " " + zipCode;
  document.getElementById("echocomname").innerHTML            = "<strong>Company Name: </strong>" + CompanyName;
  document.getElementById("echoOfficeAddress").innerHTML      = "<strong>Company Address: </strong>" + street1 + " " + town1 + " " + city1 + " " + province1 + " " + zipCode1;
  document.getElementById("echoOfficeMobileNo").innerHTML     = "<strong>Company Phone: </strong>" + OfficeTel;
  document.getElementById("echoMailingPreference").innerHTML  = "<strong>Mailing Preference: </strong>" + mailingAddress;
  document.getElementById("echomobilenum").innerHTML          = "<strong>Mobile No: </strong>" + mobileNo;
  document.getElementById("echoalternatemobilenum").innerHTML = "<strong>Alternate Mobile No: </strong>" + alternateMobileNo;
  document.getElementById("echoemailadd").innerHTML           = "<strong>Email Address: </strong>" + emailAddress;
  document.getElementById("echoalternateemailadd").innerHTML  = "<strong>Alternate Email Address: </strong>" + alternateEmailAddress;

  document.getElementById("echolicensenum").innerHTML        = "<strong>License No: </strong>" + licenseNo;
  document.getElementById("echolicenseexpiration").innerHTML = "<strong>License Expiration Date: </strong>" + expirationDate;
  document.getElementById("echocardtype").innerHTML          = "<strong>Card Type: </strong>" + cardType;
  document.getElementById("echolicensetype").innerHTML       = "<strong>License Type: </strong>" + licenseType;
  document.getElementById('echodl').innerHTML                = "<strong>DL Code: </strong>" + dlcode;
  document.getElementById('echorestriction').innerHTML       = "<strong>Restriction: </strong>" + restriction;
}
// -------------------------------------- END INFORMATION SUMMARY FUNCTION-------------------------------------------- //