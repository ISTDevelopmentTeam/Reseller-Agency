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
// END FOR VALIDATION INPUT

// ----------------------------------------------------------Validation for TAB/STEP------------------------------------------------------------------------------//
// Function to handle validation for each step
// function validateStep(stepNumber) {
//   const currentStep = document.querySelector(`#step${stepNumber}`);
//   let isValid = true;

//   // Special handling for step 2
//   if (stepNumber === 2) {
//     toggleRequiredAttributes();
//     const emailInput = document.getElementById('emailAddress');
    
//     if (emailInput.hasAttribute('required')) {
//       isValid = emailInput.checkValidity();
//       if (!isValid) {
//         emailInput.reportValidity();
//       }
//     }
    
//     // Check existing error messages
//     if ($('.error-msg').text().trim() !== "" || $('.validation-message_email').text().trim() !== "") {
//       isValid = false;
//     }
//   }

//   // Special handling for vehicle step
//   if (stepNumber === 3) {
//     const vehicles = currentStep.querySelectorAll('.vehicle-item');
    
//     // Ensure at least one vehicle is present
//     if (vehicles.length === 0) {
//       isValid = false;
//       alert('At least one vehicle is required.');
//       return false;
//     }

//     // Validate each vehicle
//     vehicles.forEach((vehicle) => {
//       const requiredFields = vehicle.querySelectorAll('input[required], select[required]');
//       requiredFields.forEach(field => {
//         const isFieldValid = field.checkValidity();
//         if (!isFieldValid) {
//           isValid = false;
//           field.reportValidity();
//         }
//       });
//     });

//     return isValid;
//   }

//   // Standard validation for other steps
//   const requiredFields = currentStep.querySelectorAll('[required]');
//   requiredFields.forEach(field => {
//     const isFieldValid = field.checkValidity();
//     if (!isFieldValid) {
//       isValid = false;
//       field.reportValidity();
//     }
//   });

//   return isValid;
// }

function validateStep(stepNumber) {
  const currentStep = document.querySelector(`#step${stepNumber}`);
  let isValid = true;

  // Prevent form submission which would trigger default browser validation
  const form = currentStep.closest('form');
  if (form) {
      form.addEventListener('submit', (e) => e.preventDefault());
  }

  // Step 2: Email validation
  if (stepNumber === 2) {
      toggleRequiredAttributes();
      // const emailInput = document.getElementById('emailAddress');
      
      // if (emailInput && emailInput.hasAttribute('required')) {
      //     // Trigger validation immediately
      //     emailInput.focus();
      //     isValid = emailInput.checkValidity();
      //     if (!isValid) {
      //         emailInput.reportValidity();
      //         return false;
      //     }
      // }
      
      if ($('.error-msg').text().trim() !== "" || $('.validation-message_email').text().trim() !== "") {
          isValid = false;
      }
  }

  // Step 3: Vehicle validation
  if (stepNumber === 3) {
      const vehicles = currentStep.querySelectorAll('.vehicle-item');
      
      if (vehicles.length === 0) {
          isValid = false;
          alert('At least one vehicle is required.');
          return false;
      }

      // Validate each vehicle's required fields
      for (const vehicle of vehicles) {
          const requiredFields = vehicle.querySelectorAll('input[required], select[required]');
          for (const field of requiredFields) {
              field.focus(); // Focus each field to trigger validation
              if (!field.checkValidity()) {
                  field.reportValidity();
                  isValid = false;
                  return false; // Stop at first invalid field
              }
          }
      }

      return isValid;
  }

  // Standard validation for all other steps
  const requiredFields = currentStep.querySelectorAll('[required]');
  for (const field of requiredFields) {
      // Focus each field to trigger immediate validation
      field.focus();
      if (!field.checkValidity()) {
          field.reportValidity();
          isValid = false;
          return false; // Stop at first invalid field
      }
  }

  return isValid;
}

document.addEventListener('DOMContentLoaded', function() {
  // Add real-time validation as user types
  const form = document.querySelector('form');
  if (form) {
      const inputs = form.querySelectorAll('input, select, textarea');
      
      inputs.forEach(input => {
          // Validate on input change
          input.addEventListener('input', function() {
              if (this.hasAttribute('required')) {
                  this.checkValidity();
              }
          });

          // Validate immediately when field loses focus
          input.addEventListener('blur', function() {
              if (this.hasAttribute('required')) {
                  this.reportValidity();
              }
          });
      });
  }
});

function updateNavigationButtons() {
  const steps = document.querySelectorAll('.form-step');
  const currentStep = document.querySelector('.form-step.active');
  const currentStepNumber = parseInt(currentStep.id.replace('step', ''));
  const isLastStep = currentStepNumber === steps.length;
  const isFirstStep = currentStepNumber === 1;

  const existingNavArea = currentStep.querySelector('.nav-area');
  if (existingNavArea) {
    existingNavArea.remove();
  }

  const navArea = document.createElement('div');
  navArea.className = 'nav-area d-flex justify-content-between mt-4 w-100';
  currentStep.appendChild(navArea);

  const leftNav = document.createElement('div');
  leftNav.className = 'previous';
  navArea.appendChild(leftNav);

  const rightNav = document.createElement('div');
  rightNav.className = 'next';
  navArea.appendChild(rightNav);

  if (!isFirstStep) {
    const prevButton = document.createElement('button');
    prevButton.type = 'button';
    prevButton.className = 'btn btn-secondary rounded';
    prevButton.textContent = 'Previous';
    prevButton.onclick = previousStep;
    leftNav.appendChild(prevButton);
  }

  const nextButton = document.createElement('button');
  nextButton.type = isLastStep ? 'submit' : 'button';
  nextButton.className = 'btn btn-primary rounded';

  if (isLastStep) {
    nextButton.textContent = 'Submit Application';
    nextButton.onclick = () => {
      if (validateStep(currentStepNumber)) {
        submitForm();
      }
    };
  } else {
    nextButton.textContent = 'Next';
    nextButton.onclick = () => nextStep(currentStepNumber);
  }
  rightNav.appendChild(nextButton);
}


function nextStep(currentStepNumber) {
  if (validateStep(currentStepNumber)) {
    const currentStep = document.querySelector(`#step${currentStepNumber}`);
    const nextStep = document.querySelector(`#step${currentStepNumber + 1}`);

    if (currentStep && nextStep) {
      currentStep.classList.remove('active');
      nextStep.classList.add('active');

      const progress = document.querySelector('.progress-bar');
      progress.style.width = `${(currentStepNumber) * 25}%`;

      updateBreadcrumb(currentStepNumber + 1);
      // manageFieldDisabling();
      updateNavigationButtons();

      if (currentStepNumber + 1 === 5) {
        summary_fetch();
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
    // manageFieldDisabling();
    updateNavigationButtons();
  }
}

function updateBreadcrumb(stepNumber) {
  const steps = document.getElementsByClassName('breadcrumb-item');
  for (let i = 0; i < steps.length; i++) {
    steps[i].classList.remove("active");
  }
  steps[stepNumber - 1].classList.add("active");
}

// Handle input changes
// document.addEventListener('input', function (e) {
//   if (e.target.hasAttribute('required')) {
//     e.target.classList.remove('is-invalid');
//     const errorMessage = e.target.parentNode.querySelector('.error-message');
//     if (errorMessage) {
//       errorMessage.remove();
//     }
//   }
// });


document.addEventListener('DOMContentLoaded', function () {
  // manageFieldDisabling();
  updateNavigationButtons();
  // VehicleHandling();
  FileUploads();
});
// ----------------------------------------------------------Validation for TAB/STEP-----------------------------------------------------------------//



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


function handleFileUpload(input, imageId, feedbackId) {
  const file = input.files && input.files[0];
  if (!file) {
    return; // No file selected, exit the function
  }

  const feedback = document.getElementById(feedbackId);
  const imagePreview = document.getElementById(imageId);

  const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

  // Maximum file size (8MB)
  const maxSizeInBytes = 8 * 1024 * 1024; // 8MB

  // Reset previous feedback and preview
  feedback.textContent = '';
  imagePreview.style.display = 'none';
  imagePreview.src = '';

  // Validate file type
  if (!allowedTypes.includes(file.type)) {
    feedback.textContent = 'Invalid file type. Please select a JPG, JPEG, PNG, or GIF file.';
    input.value = ''; // Clear the input
    return;
  }

  // Validate file size
  if (file.size > maxSizeInBytes) {
    feedback.textContent = 'File size exceeds 8MB limit.';
    input.value = ''; // Clear the input
    return;
  }

  // If file passes validation, create preview
  const reader = new FileReader();
  reader.onload = function (e) {
    imagePreview.src = e.target.result;
    imagePreview.style.display = 'block';
  };
  reader.readAsDataURL(file);
}
// END FILE UPLOAD

// Start Title Gender-----------------
// document.getElementById('title').addEventListener('change', function() {
//     const title = this.value;
//     const genderSelect = document.getElementById('gender');

//     switch (title) {
//         case 'MR':
//             genderSelect.value = 'MALE';
//             break;
//         case 'MS':
//         case 'MRS':
//             genderSelect.value = 'FEMALE';
//             break;
//         case 'ATTY':
//         case 'DR':
//         case 'ENGR':
//             genderSelect.value = '';
//             break;
//         default:
//             genderSelect.value = '';
//     }
// });

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
    if (mailingAddressDropdown.value === 'OFFICE') {
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

// ---------------------------------------------------VEHICLE DETAILS FUNCTION-------------------------------------------------------- //

function updateLabeldyna(checkedId, uncheckedId) {

        const checkedCheckbox = document.getElementById(checkedId);
        const uncheckedCheckbox = document.getElementById(uncheckedId);
        uncheckedCheckbox.disabled = false;
        uncheckedCheckbox.checked = false;
        checkedCheckbox.disabled = true;

        if (checkedCheckbox.id == 'csticker_yes' || checkedCheckbox.id == 'csticker_no') {

          var platenumLabel = document.querySelector('label[for="platenum"]');
          var platenumInput = document.getElementById("platenum");
          var var_csticker = document.getElementById("csticker");

          if (checkedCheckbox.value == 1) {
            platenumLabel.textContent = "Conduction Sticker";
            platenumInput.placeholder = "Enter conduction sticker";
            $(platenumInput).mask('AAAAAA');
            platenumInput.value = "";
            var_csticker.value = 1

          } else {
            platenumLabel.textContent = "Plate No";
            platenumInput.placeholder = "Enter plate no";
            $(platenumInput).mask('AAAAAAAA', {
              translation: {
                'A': {
                  pattern: /[A-Za-z0-9\s-]/,
                  transform: function (val) {
                    let currentVal = this.el.val();
                    // Only allow 7 alphanumeric characters plus one separator (dash or space)
                    if (currentVal.replace(/[-\s]/g, '').length >= 7 && val !== '-' && val !== ' ') {
                      return '';
                    }
                    return val;
                  }
                }
              },
            });
            platenumInput.value = "";
            var_csticker.value = 0
          }
        } else {
          const radioButtons = document.querySelectorAll(
            `input[name="is_cs[]"][id^="csticker${checkedCheckbox.id.slice(-1)}"]`);
          var platenumLabel = document.querySelector('label[for="platenum' + checkedCheckbox.id.slice(-1) + '"]');
          var platenumInput = document.getElementById("platenum" + checkedCheckbox.id.slice(-1));
          var var_csticker = document.getElementById("csticker" + checkedCheckbox.id.slice(-1));

          if (checkedCheckbox.value == 1) {
            platenumLabel.textContent = "Conduction Sticker";
            platenumInput.placeholder = "Enter conduction sticker";
            $(platenumInput).mask('AAAAAA');
            platenumInput.value = "";
            var_csticker.value = 1
          } else {
            platenumLabel.textContent = "Plate No";
            platenumInput.placeholder = "Enter plate no";
            $(platenumInput).mask('AAAAAAAA', {
              translation: {
                'A': {
                  pattern: /[A-Za-z0-9\s-]/,
                  transform: function (val) {
                    let currentVal = this.el.val();
                    // Only allow 7 alphanumeric characters plus one separator (dash or space)
                    if (currentVal.replace(/[-\s]/g, '').length >= 7 && val !== '-' && val !== ' ') {
                      return '';
                    }
                    return val;
                  }
                }
              },
            });
            platenumInput.value = "";
            var_csticker.value = 0
          }
        }
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