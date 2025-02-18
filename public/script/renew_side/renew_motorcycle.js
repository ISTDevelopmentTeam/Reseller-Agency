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
  
// Beneficiaries 

// Insured 1
$('.fullname').on('input', function(event) {
  var inputValue = $(this).val();
  var letterRegex = /^[a-zA-ZñÑ\s.]*$/;

  if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s.]/g, ''));
      $('.validation-message_fullname').text("Only Letters Allowed");
  } else {
      $('.validation-message_fullname').text("");
  }
});

// Insured 2
$('.fullname1').on('input', function(event) {
  var inputValue = $(this).val();
  var letterRegex = /^[a-zA-ZñÑ\s.]*$/;

  if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s.]/g, ''));
      $('.validation-message_fullname1').text("Only Letters Allowed");
  } else {
      $('.validation-message_fullname1').text("");
  }
});

// Insured 3
$('.fullname2').on('input', function(event) {
  var inputValue = $(this).val();
  var letterRegex = /^[a-zA-ZñÑ\s.]*$/;

  if (!letterRegex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^a-zA-ZñÑ\s.]/g, ''));
      $('.validation-message_fullname2').text("Only Letters Allowed");
  } else {
      $('.validation-message_fullname2').text("");
  }
});

// END Beneficiaries

  
  // ----------------------------------------------------------Validation for TAB/STEP------------------------------------------------------------------------------//
  // Form validation and submission handling
  document.addEventListener('DOMContentLoaded', function() {
    const resellerForm   = document.getElementById('resellerForm');
    const submitBtn      = document.getElementById('submit_btn');
    const mobileInput    = document.getElementById('mobileNumber');
    const errorMsg       = document.getElementById('error-msg-1');
    const validationMsg1 = document.getElementById('validationMessage');
    const validationMsg2 = document.getElementById('validationMessage2');
    const validationMsg3 = document.getElementById('validationMessage3');

    // Function to check if all required fields are filled and valid
    function isFormValid() {
        // Check required fields
        const requiredElements = resellerForm.querySelectorAll('[required]');
        for (const element of requiredElements) {
            if (!element.value.trim()) {
                // For radio buttons, check if any in the group is selected
                if (element.type === 'radio') {
                    const radioGroup = resellerForm.querySelectorAll(`input[name="${element.name}"]`);
                    const isAnyChecked = Array.from(radioGroup).some(radio => radio.checked);
                    if (!isAnyChecked) {
                        return {
                            valid: false,
                            message: 'Please select either Yes or No for updating personal information'
                        };
                    }
                } else {
                    return {
                        valid: false,
                        message: 'Please fill in all required fields'
                    };
                }
            }

            // Special check for file inputs
            if (element.type === 'file' && !element.files.length) {
                return {
                    valid: false,
                    message: 'Please upload all required files'
                };
            }

            // Special check for select elements
            if (element.tagName === 'SELECT' && element.value === '') {
                return {
                    valid: false,
                    message: 'Please select all required options'
                };
            }
        }

        // Check if mobile number has error message displayed
        if (!errorMsg.classList.contains('hide')) {
            return {
                valid: false,
                message: 'Please enter a valid mobile number'
            };
        }

        // Check for birthdate validation messages
        if (validationMsg1.textContent || 
            validationMsg2.textContent || 
            validationMsg3.textContent) {
            return {
                valid: false,
                message: 'Please check the beneficiaries birthdates for errors'
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
                title: 'Validation Error',
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
});
  
  document.addEventListener('DOMContentLoaded', function () {
    // manageFieldDisabling();
    // updateNavigationButtons();
    // VehicleHandling();
    FileUploads();
    // toggleRequiredAttributes();
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
//   document.getElementById('title').addEventListener('change', function() {
//       const title = this.value;
//       const genderSelect = document.getElementById('gender');
  
//       switch (title) {
//           case 'MR':
//               genderSelect.value = 'MALE';
//               break;
//           case 'MS':
//           case 'MRS':
//               genderSelect.value = 'FEMALE';
//               break;
//           case 'ATTY':
//           case 'DR':
//           case 'ENGR':
//               genderSelect.value = '';
//               break;
//           default:
//               genderSelect.value = '';
//       }
//   });
  
  // Start Citizenship Dropdown-------------------
//   document.addEventListener('DOMContentLoaded', function () {
//     var citizenshipDropdown = document.getElementById('citizenship');
//     var addInfoSection = document.getElementById('add_info');
  
//     citizenshipDropdown.addEventListener('change', function () {
//       if (citizenshipDropdown.value === 'foreigner') {
//         addInfoSection.style.display = 'block';
//         setRequiredForeigner(true);
  
//       } else {
//         addInfoSection.style.display = 'none';
//         setRequiredForeigner(false);
//         nationality.value = "";
//       }
//     });
//   });
  
//   function setRequiredForeigner(isRequired) {
//     var nationality = document.getElementById("nationality");
//     nationality.required = isRequired;
//   }
  // END Citizenship Dropdown
  
  
  // FLAT Picker FOR BIRTHDATE
//   document.addEventListener("DOMContentLoaded", function () {
//     const input = document.getElementById("birthdate");
//     let datePicker;
//     let lastValue = "";
  
//     // Calculate the maximum allowed date (18 years ago from today)
//     const maxDate = new Date();
//     maxDate.setFullYear(maxDate.getFullYear() - 18);
  
//     // Initialize Flatpickr
//     datePicker = flatpickr("#birthdate", {
//       dateFormat: "m/d/Y",
//       allowInput: true,
//       maxDate: maxDate, // Set the maximum allowed date
//       onChange: function (selectedDates, dateStr, instance) {
//         if (selectedDates.length > 0) {
//           input.value = dateStr;
//           lastValue = dateStr;
//         }
//       }
//     });
  
//     // Add input event listener for manual typing
//     input.addEventListener('input', function (e) {
//       let v = this.value;
  
//       // Handle backspace/delete - allow normal deletion
//       if (v.length < lastValue.length) {
//         lastValue = v;
//         if (v.length === 0) {
//           datePicker.clear();
//         }
//         return;
//       }
  
//       // Only proceed with formatting if we're adding characters
//       if (v.length > lastValue.length) {
//         // Handle MM/ format
//         if (v.match(/^\d{2}$/) !== null) {
//           let month = parseInt(v);
//           v = (month > 12 ? 12 : month) + '/';
//         }
//         // Handle MM/DD/ format
//         else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
//           let parts = v.split('/');
//           let month = parseInt(parts[0]);
//           let day = parseInt(parts[1]);
//           v = (month > 12 ? 12 : month) + '/' + (day > 31 ? 31 : day) + '/';
//         }
//         // Handle complete date format MM/DD/YYYY
//         else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
//           let parts = v.split('/');
//           let month = parseInt(parts[0]);
//           let day = parseInt(parts[1]);
//           let year = parseInt(parts[2]);
  
//           // Create a date object and update the calendar
//           let dateStr = `${month}/${day}/${year}`;
//           let date = new Date(dateStr);
  
//           // Only update if it's a valid date and at least 18 years ago
//           if (!isNaN(date.getTime()) && date <= maxDate) {
//             datePicker.setDate(date, true);
//           } else {
//             // If the date is not valid or not at least 18 years ago, clear the input
//             this.value = lastValue;
//             return;
//           }
//         }
  
//         this.value = v;
//         lastValue = v;
//       }
//     });
  
//     // Add keydown listener for better backspace handling
//     input.addEventListener('keydown', function (e) {
//       if (e.key === 'Backspace' || e.key === 'Delete') {
//         if (this.value.length === 0) {
//           datePicker.clear();
//         }
//       }
//     });
//   });
  // END OF FLAT PICKER
  
  // ---------------------------------------------------END FUNCTION FOR PERSONAL INFORMATION------------------------------------------------ //
  
  
  // ---------------------------------------------------CONTACT INFORMATION FUNCTION-------------------------------------------------------- //
//   document.addEventListener('DOMContentLoaded', function () {
//     var mailingAddressDropdown = document.getElementById('mail');
//     var officeAddressSection   = document.getElementById('officeAddress');
//     var street1                = document.getElementById('street1');
//     var town1                  = document.getElementById('town1');
//     var city1                  = document.getElementById('city1');
//     var province1              = document.getElementById('province1');
//     var zcode1                 = document.getElementById('zcode1');
//     var comname                = document.getElementById('comname');
  
//       // Function to set or remove the required attribute for the specified fields
//     function updateRequiredFields(required) {
//       street1.required   = required;
//       town1.required     = required;
//       city1.required     = required;
//       province1.required = required;
//       zcode1.required    = required;
//       comname.required   = required;
//     }
  
//     mailingAddressDropdown.addEventListener('change', function () {
//       if (mailingAddressDropdown.value === 'OFFICE ADDRESS') {
//         officeAddressSection.style.display = 'block';
//         updateRequiredFields(true);
//       } else {
//         officeAddressSection.style.display = 'none';
//         street1.value                      = "";
//         town1.value                        = "";
//         city1.value                        = "";
//         province1.value                    = "";
//         zcode1.value                       = "";
//         comname.value                      = "";
//         updateRequiredFields(false);
//       }
//     });
//   });
  
//   function toggleRequiredAttributes() {
//     const phoneInput = document.getElementById('mobileNumber');
//     const emailInput = document.getElementById('emailAddress');
  
//     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
//     const isEmailValid = emailRegex.test(emailInput.value.trim());
  
//     phoneInput.addEventListener('input', function() {
//       if (this.value.trim() !== '') {
//         emailInput.removeAttribute('required');
//       } else {
//         emailInput.setAttribute('required', 'required');
//       }
//     });
  
//     if (isEmailValid) {
//       phoneInput.removeAttribute('required');
//     } else {
//       phoneInput.setAttribute('required', 'required');
//     }
//   }

  function maskTelNo(id) {
    $("#" + id).mask("9-999-9999");
  }

// ---------------------------------------------------Motorcycle Insured FUNCTION-------------------------------------------------------- //
let beneficiaryCount = 1;
let removedBeneficiaries = new Set();

function showNextBeneficiary() {
  if (beneficiaryCount >= 3) return;
  
  beneficiaryCount++;
  let nextNum = removedBeneficiaries.size > 0 
    ? Math.min(...removedBeneficiaries) 
    : beneficiaryCount;
    
  const nextSection = document.querySelector(`.insured${nextNum}`);
  if (nextSection) {
    nextSection.style.display = "block";
    nextSection.classList.add("animated-moveDown");
    nextSection.classList.remove("animated-moveUpExit");
    document.getElementById(`hide${nextNum-1}`).style.display = "block";
    setFieldsRequired(nextNum, true);
    removedBeneficiaries.delete(nextNum);
  }

  document.getElementById("addBeneficiaryBtn").style.display = 
    beneficiaryCount >= 3 ? "none" : "block";
}

function removeBeneficiary(num) {
  if (beneficiaryCount <= 1) return;

  const section = document.querySelector(`.insured${num}`);
  if (section) {
    section.classList.remove("animated-moveDown");
    section.classList.add("animated-moveUpExit");
    setTimeout(() => {
      section.style.display = "none";
    }, 250);
    clearFields(num);
    setFieldsRequired(num, false);
    beneficiaryCount--;
    removedBeneficiaries.add(num);
  }

  document.getElementById("addBeneficiaryBtn").style.display = "block";
}

function setFieldsRequired(num, required) {
  const fields = [
    `insuredBenefiaries${num}`,
    `insuredName${num}`,
    `relationship${num}`,
    `insuredBirthDate${num}`
  ];
  
  fields.forEach(id => {
    const element = document.getElementById(id);
    if (element) element.required = required;
  });
}

function clearFields(num) {
  const fields = {
    [`insuredBenefiaries${num}`]: 0,
    [`insuredName${num}`]: "",
    [`relationship${num}`]: "",
    [`insuredBirthDate${num}`]: "",
    [`validationMessage${num}`]: "",
    [`fullname${num-1}`]: ""
  };

  Object.entries(fields).forEach(([id, value]) => {
    const element = document.getElementById(id);
    if (!element) return;
    
    if (element.tagName === 'SELECT') {
      element.selectedIndex = value;
    } else {
      element.value = value;
    }
    if (id.startsWith('validationMessage') || id.startsWith('fullname')) {
      element.textContent = value;
    }
  });
}
// FUNCTION & VALIDATION FOR BIRTHDATE(BENEFICIARIES)
document.addEventListener('DOMContentLoaded', function() {
  class DatePickerManager {
    constructor(elementId, options = {}) {
      this.element = document.getElementById(elementId);
      this.lastValue = "";
      this.datePicker = null;
      this.ageId = options.ageId || `#age${elementId.slice(-1)}`;
      this.init();
    }

    init() {
      const maxDate = new Date();
      maxDate.setFullYear(maxDate.getFullYear() - 18);

      this.datePicker = flatpickr(`#${this.element.id}`, {
        dateFormat: "m/d/Y",
        allowInput: true,
        maxDate: maxDate,
        formatDate: (date) => {
          const month = (date.getMonth() + 1).toString().padStart(2, '0');
          const day = date.getDate().toString().padStart(2, '0');
          return `${month}/${day}/${date.getFullYear()}`;
        },
        onChange: (selectedDates, dateStr, instance) => {
          if (selectedDates.length > 0) {
            const formattedDate = instance.formatDate(selectedDates[0], "m/d/Y");
            this.element.value = formattedDate;
            this.lastValue = formattedDate;
            this.calculateAge(selectedDates[0]);
          }
        }
      });

      this.element.addEventListener('input', this.handleInput.bind(this));
      this.element.addEventListener('keydown', this.handleKeydown.bind(this));
    }

    calculateAge(selectedDate) {
      const today = new Date();
      let age = today.getFullYear() - selectedDate.getFullYear();
      const m = today.getMonth() - selectedDate.getMonth();
      
      if (m < 0 || (m === 0 && today.getDate() < selectedDate.getDate())) {
        age--;
      }

      const ageElement = document.querySelector(this.ageId);
      if (ageElement) {
        ageElement.value = age;
      }
    }

    handleInput(e) {
      let v = e.target.value;

      if (v.length < this.lastValue.length) {
        this.lastValue = v;
        if (v.length === 0) {
          this.datePicker.clear();
        }
        return;
      }

      if (v.length > this.lastValue.length) {
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
          
          const maxDate = new Date();
          maxDate.setFullYear(maxDate.getFullYear() - 18);

          if (!isNaN(date.getTime()) && date <= maxDate) {
            this.datePicker.setDate(date, false);
            this.calculateAge(date);
          } else {
            e.target.value = this.lastValue;
            return;
          }
        }
        
        e.target.value = v;
        this.lastValue = v;
      }
    }

    handleKeydown(e) {
      if ((e.key === 'Backspace' || e.key === 'Delete') && e.target.value.length === 0) {
        this.datePicker.clear();
      }
    }
  }

  const dateInputs = {
    insuredBirthDate1: new DatePickerManager('insuredBirthDate1', { ageId: '#age' }),
    insuredBirthDate2: new DatePickerManager('insuredBirthDate2', { ageId: '#age2' }),
    insuredBirthDate3: new DatePickerManager('insuredBirthDate3', { ageId: '#age3' })
  };
});
  
  // ---------------------------------------------------VEHICLE DETAILS FUNCTION-------------------------------------------------------- //
  
  // FUNCTION FOR DIPLOMAT 
  function update_diplomat(checkedId, uncheckedId) {
    const checkedCheckbox            = document.getElementById(checkedId);
    const uncheckedCheckbox          = document.getElementById(uncheckedId);
          uncheckedCheckbox.disabled = false;
          uncheckedCheckbox.checked  = false;
          checkedCheckbox.disabled   = true;
  
    if (checkedCheckbox.id == 'is_diplomat_1' || checkedCheckbox.id == 'is_diplomat_1') {
      var_actofnature       = document.getElementById("is_diplomat_1");
      var_actofnature.value = checkedCheckbox.value
    } else {
      var_actofnature       = document.getElementById("is_diplomat_" + checkedCheckbox.id.slice(-1));
      var_actofnature.value = checkedCheckbox.value
    }
  }

  function updateLabeldyna(checkedId, uncheckedId) {
    const checkedCheckbox = document.getElementById(checkedId);
    const uncheckedCheckbox = document.getElementById(uncheckedId);
    uncheckedCheckbox.disabled = false;
    uncheckedCheckbox.checked = false;
    checkedCheckbox.disabled = true;

    let platenumLabel, platenumInput, var_csticker;

    if (checkedCheckbox.id === 'csticker_yes' || checkedCheckbox.id === 'csticker_no') {
        platenumLabel = document.querySelector('label[for="platenum"]');
        platenumInput = document.getElementById("platenum");
        var_csticker = document.getElementById("csticker");
    } else {
        platenumLabel = document.querySelector('label[for="platenum' + checkedCheckbox.id.slice(-1) + '"]');
        platenumInput = document.getElementById("platenum" + checkedCheckbox.id.slice(-1));
        var_csticker = document.getElementById("csticker" + checkedCheckbox.id.slice(-1));
    }

    // Clear any existing mask
    $(platenumInput).unmask();
    
    if (checkedCheckbox.value == 1) {
        platenumLabel.textContent = "Conduction Sticker";
        platenumInput.placeholder = "Enter conduction sticker";
        platenumInput.dataset.inputType = 'conduction'; // Set input type
        $(platenumInput).mask('AAAA-AAAAAAAA');
        platenumInput.value = "";
        var_csticker.value = 1;
    } else {
        platenumLabel.textContent = "Plate No";
        platenumInput.placeholder = "Enter plate no";
        platenumInput.dataset.inputType = 'plate'; // Set input type
        applyPlateMask(platenumInput);
        platenumInput.value = "";
        var_csticker.value = 0;
    }
}

// Function to apply plate number mask
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

// Modified focus handler
$(document).on('focus', '.platenum', function() {
    if (this.dataset.inputType === 'plate') {
        applyPlateMask(this);
    } else if (this.dataset.inputType === 'conduction') {
        $(this).mask('AAAA-AAAAAAAA');
    }
});
