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
    const submitBtn    = document.getElementById('submit_btn');
    const mobileInput  = document.getElementById('mobileNumber');
    const errorMsg     = document.getElementById('error-msg-1');

    // Function to check if radio buttons are selected
    function isRadioSelected() {
        const radioButtons = document.querySelectorAll('input[name="uradio"]');
        return Array.from(radioButtons).some(radio => radio.checked);
    }

    // Function to check if all required fields are filled and valid
    function isFormValid() {
        // Check radio button selection
        if (!isRadioSelected()) {
            return {
                valid: false,
                message: 'Please select Yes or No for updating personal information'
            };
        }

        // Check required fields
        const requiredElements = resellerForm.querySelectorAll('[required]');
        for (const element of requiredElements) {
            if (!element.value.trim()) {
                return {
                    valid: false,
                    message: 'Please fill in all required fields'
                };
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

    // Mobile number validation example
    // mobileInput.addEventListener('input', function() {
    //     const phonePattern = /^[0-9]{10}$/;
    //     if (!phonePattern.test(this.value)) {
    //         errorMsg.textContent = 'Please enter a valid 10-digit mobile number';
    //         errorMsg.classList.remove('hide');
    //     } else {
    //         errorMsg.classList.add('hide');
    //     }
    // });
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
  
  // Membership type and Plan type----------------------

$(document).ready(function () {
    var line = $("#planType option").hide();
    // console.log(line);
    $("#membershipType").change(function () {
      var selectedMembershipType = $(this).val();
  
      // Show options based on the selected membership type
      if (selectedMembershipType === "REGULAR INDIVIDUAL") {
        $("#planType").val("");
        $("#planType option[value='ANNUAL FEE (REGULAR)']").show();
        $("#planType option[value='THREE YEAR FEE (REGULAR)']").show();
        $("#planType option[value='ANNUAL FEE (ASSOCIATE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ASSOCIATE) ']").hide();
        $("#planType option[value='ANNUAL FEE (MEMBERSHIP LITE)']").hide();
        $("#planType option[value='ANNUAL FEE (ELITE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ELITE)']").hide();
      }
      else if (selectedMembershipType === "ASSOCIATE INDIVIDUAL") {
        $("#planType").val("");
        $("#planType option[value='ANNUAL FEE (REGULAR)']").hide();
        $("#planType option[value='THREE YEAR FEE (REGULAR)']").hide();
        $("#planType option[value='ANNUAL FEE (ASSOCIATE)']").show();
        $("#planType option[value='THREE YEAR FEE (ASSOCIATE) ']").show();
        $("#planType option[value='ANNUAL FEE (MEMBERSHIP LITE)']").hide();
        $("#planType option[value='ANNUAL FEE (ELITE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ELITE)']").hide();
      }
      else if (selectedMembershipType === "MEMBERSHIP LITE") {
        $("#planType").val("");
        $("#planType option[value='ANNUAL FEE (REGULAR)']").hide();
        $("#planType option[value='THREE YEAR FEE (REGULAR)']").hide();
        $("#planType option[value='ANNUAL FEE (ASSOCIATE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ASSOCIATE) ']").hide();
        $("#planType option[value='ANNUAL FEE (MEMBERSHIP LITE)']").show();
        $("#planType option[value='ANNUAL FEE (ELITE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ELITE)']").hide();
      }
      else if (selectedMembershipType === "ELITE") {
        $("#planType").val("");
        $("#planType option[value='ANNUAL FEE (REGULAR)']").hide();
        $("#planType option[value='THREE YEAR FEE (REGULAR)']").hide();
        $("#planType option[value='ANNUAL FEE (ASSOCIATE)']").hide();
        $("#planType option[value='THREE YEAR FEE (ASSOCIATE) ']").hide();
        $("#planType option[value='ANNUAL FEE (MEMBERSHIP LITE)']").hide();
        $("#planType option[value='ANNUAL FEE (ELITE)']").show();
        $("#planType option[value='THREE YEAR FEE (ELITE)']").show();
      }
    });
  });
  
  $(document).ready(function () {
    $("#planType").change(function () {
      var selectedPlanType = $(this).val();
  
      // Show options based on the selected planType
      if (selectedPlanType === "ANNUAL FEE (REGULAR)" || "THREE YEAR FEE (REGULAR)") {
        $("#planType option[value='regular']").show();
        $("#planType option[value='associate']").hide();
        $("#planType option[value='lite']").hide();
        $("#planType option[value='elite']").hide();
      }
      else if (selectedPlanType === "ANNUAL FEE (ASSOCIATE)" || "THREE YEAR FEE (ASSOCIATE)") {
        $("#planType option[value='regular']").hide();
        $("#planType option[value='associate']").show();
        $("#planType option[value='lite']").hide();
        $("#planType option[value='elite']").hide();
      }
      else if (selectedPlanType === "ANNUAL FEE (MEMBERSHIP LITE)") {
        $("#planType option[value='regular']").hide();
        $("#planType option[value='associate']").hide();
        $("#planType option[value='lite']").show();
        $("#planType option[value='elite']").hide();
      }
      else if (selectedPlanType === "ANNUAL FEE (ELITE)" || "THREE YEAR FEE (ELITE)") {
        $("#planType option[value='regular']").hide();
        $("#planType option[value='associate']").hide();
        $("#planType option[value='lite']").hide();
        $("#planType option[value='elite']").show();
      }
    });
  });

  
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
  
  
  // function handleGeneralFileUpload(input, imageId, feedbackId) {
  //   const file = input.files && input.files[0];
  //   if (!file) {
  //       return;
  //   }
  
  //   const feedback = document.getElementById(feedbackId);
  //   const imagePreview = document.getElementById(imageId);
  
  //   const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
  //   const maxSizeInBytes = 8 * 1024 * 1024; // 8MB
  
  //   // Reset previous feedback and preview
  //   feedback.textContent = '';
  //   imagePreview.style.display = 'none';
  //   imagePreview.src = '';
  
  //   // Validate file type
  //   if (!allowedTypes.includes(file.type)) {
  //       feedback.textContent = 'Invalid file type. Please select a JPG, JPEG, PNG, or GIF file.';
  //       input.value = '';
  //       return;
  //   }
  
  //   // Validate file size
  //   if (file.size > maxSizeInBytes) {
  //       feedback.textContent = 'File size exceeds 8MB limit.';
  //       input.value = '';
  //       return;
  //   }
  
  //   // Create preview
  //   const reader = new FileReader();
  //   reader.onload = function (e) {
  //       imagePreview.src = e.target.result;
  //       imagePreview.style.display = 'block';
  //   };
  //   reader.readAsDataURL(file);
  // }
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
  // document.addEventListener('DOMContentLoaded', function () {
  //   var citizenshipDropdown = document.getElementById('citizenship');
  //   var addInfoSection = document.getElementById('add_info');
  
  //   citizenshipDropdown.addEventListener('change', function () {
  //     if (citizenshipDropdown.value === 'foreigner') {
  //       addInfoSection.style.display = 'block';
  //       setRequiredForeigner(true);
  
  //     } else {
  //       addInfoSection.style.display = 'none';
  //       setRequiredForeigner(false);
  //       nationality.value = "";
  //     }
  //   });
  // });
  
  // function setRequiredForeigner(isRequired) {
  //   var nationality = document.getElementById("nationality");
  //   nationality.required = isRequired;
  // }
  // END Citizenship Dropdown
  
  
  // FLAT Picker FOR BIRTHDATE
  // document.addEventListener("DOMContentLoaded", function () {
  //   const input = document.getElementById("birthdate");
  //   let datePicker;
  //   let lastValue = "";
  
  //   const maxDate = new Date();
  //   maxDate.setFullYear(maxDate.getFullYear() - 18);
  
  //   datePicker = flatpickr("#birthdate", {
  //     dateFormat: "m/d/Y",
  //     allowInput: true,
  //     maxDate: maxDate,
  //     formatDate: (date) => {
  //       const month = (date.getMonth() + 1).toString().padStart(2, '0');
  //       const day = date.getDate().toString().padStart(2, '0');
  //       return `${month}/${day}/${date.getFullYear()}`;
  //     },
  //     onChange: function (selectedDates, dateStr, instance) {
  //       if (selectedDates.length > 0) {
  //         const formattedDate = instance.formatDate(selectedDates[0], "m/d/Y");
  //         input.value = formattedDate;
  //         lastValue = formattedDate;
  //       }
  //     }
  //   });
  
  //   input.addEventListener('input', function (e) {
  //     let v = this.value;
  
  //     if (v.length < lastValue.length) {
  //       lastValue = v;
  //       if (v.length === 0) datePicker.clear();
  //       return;
  //     }
  
  //     if (v.length > lastValue.length) {
  //       if (v.match(/^\d{2}$/) !== null) {
  //         let month = parseInt(v);
  //         v = v.padStart(2, '0');
  //         v = (month > 12 ? '12' : v) + '/';
  //       }
  //       else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
  //         let [month, day] = v.split('/').map(num => parseInt(num));
  //         v = month.toString().padStart(2, '0') + '/' + 
  //             (day > 31 ? '31' : day.toString().padStart(2, '0')) + '/';
  //       }
  //       else if (v.match(/^\d{2}\/\d{2}\/\d{4}$/) !== null) {
  //         let [month, day, year] = v.split('/').map(num => parseInt(num));
  //         let dateStr = `${month.toString().padStart(2, '0')}/${day.toString().padStart(2, '0')}/${year}`;
  //         let date = new Date(dateStr);
  
  //         if (!isNaN(date.getTime()) && date <= maxDate) {
  //           datePicker.setDate(date, true);
  //         } else {
  //           this.value = lastValue;
  //           return;
  //         }
  //       }
  
  //       this.value = v;
  //       lastValue = v;
  //     }
  //   });
  
  //   input.addEventListener('keydown', function (e) {
  //     if ((e.key === 'Backspace' || e.key === 'Delete') && this.value.length === 0) {
  //       datePicker.clear();
  //     }
  //   });
  // });
  // END OF FLAT PICKER
  
  // ---------------------------------------------------END FUNCTION FOR PERSONAL INFORMATION------------------------------------------------ //
  
  
  // ---------------------------------------------------CONTACT INFORMATION FUNCTION-------------------------------------------------------- //
  // document.addEventListener('DOMContentLoaded', function () {
  //   var mailingAddressDropdown = document.getElementById('mail');
  //   var officeAddressSection   = document.getElementById('officeAddress');
  //   var street1                = document.getElementById('street1');
  //   var town1                  = document.getElementById('town1');
  //   var city1                  = document.getElementById('city1');
  //   var province1              = document.getElementById('province1');
  //   var zcode1                 = document.getElementById('zcode1');
  //   var comname                = document.getElementById('comname');
  
  //     // Function to set or remove the required attribute for the specified fields
  //   function updateRequiredFields(required) {
  //     street1.required   = required;
  //     town1.required     = required;
  //     city1.required     = required;
  //     province1.required = required;
  //     zcode1.required    = required;
  //     comname.required   = required;
  //   }
  
  //   mailingAddressDropdown.addEventListener('change', function () {
  //     if (mailingAddressDropdown.value === 'OFFICE ADDRESS') {
  //       officeAddressSection.style.display = 'block';
  //       updateRequiredFields(true);
  //     } else {
  //       officeAddressSection.style.display = 'none';
  //       street1.value                      = "";
  //       town1.value                        = "";
  //       city1.value                        = "";
  //       province1.value                    = "";
  //       zcode1.value                       = "";
  //       comname.value                      = "";
  //       updateRequiredFields(false);
  //     }
  //   });
  // });
  
  // function toggleRequiredAttributes() {
  //   const phoneInput = document.getElementById('mobileNumber');
  //   const emailInput = document.getElementById('emailAddress');
  
  //   const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //   const isEmailValid = emailRegex.test(emailInput.value.trim());
  
  //   phoneInput.addEventListener('input', function() {
  //     if (this.value.trim() !== '') {
  //       emailInput.removeAttribute('required');
  //     } else {
  //       emailInput.setAttribute('required', 'required');
  //     }
  //   });
  
  //   if (isEmailValid) {
  //     phoneInput.removeAttribute('required');
  //   } else {
  //     phoneInput.setAttribute('required', 'required');
  //   }
  // }
  
  function maskTelNo(id) {
    $("#" + id).mask("9-999-9999");
  }
  
  // ---------------------------------------------------VEHICLE DETAILS FUNCTION-------------------------------------------------------- //
  
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
  
// Helper function to apply mask based on type
// Place these functions at the top of your script file
function applyMaskBasedOnType(input, label, isConduction) {
  if ($(input).data('mask')) {
      $(input).unmask();
  }

  if (isConduction) {
      label.textContent = "Conduction Sticker";
      input.placeholder = "Enter conduction sticker";
      input.dataset.inputType = 'conduction';

      $(input).mask('AAAAAA', {
          translation: {
              'A': {
                  pattern: /[A-Za-z0-9]/,
                  transform: function(val) {
                      return val.toUpperCase();
                  }
              }
          },
          placeholder: "",
          clearIfNotMatch: true
      });
  } else {
      label.textContent = "Plate No";
      input.placeholder = "Enter plate no";
      input.dataset.inputType = 'plate';

      $(input).mask('AAAAAAAA', {
          translation: {
              'A': {
                  pattern: /[A-Za-z0-9\s-]/,
                  transform: function(val) {
                      let currentVal = $(input).val();
                      if (currentVal.replace(/[-\s]/g, '').length >= 7 && val !== '-' && val !== ' ') {
                          return '';
                      }
                      return val.toUpperCase();
                  }
              }
          },
          placeholder: "",
          clearIfNotMatch: true
      });
  }
}

// Function to handle checkbox changes
function updateLabelDyna(checkbox, type) {
  const vehicleContainer = checkbox.closest('.vehicle-item');
  if (!vehicleContainer) return;

  const otherCheckbox = vehicleContainer.querySelector(type === 'yes' ? '.cs-no' : '.cs-yes');
  const hiddenInput = vehicleContainer.querySelector('.cs-value');
  const plateInput = vehicleContainer.querySelector('input[name="vehicle_plate[]"]');
  const plateLabel = vehicleContainer.querySelector('.label:not([style])');

  if (!otherCheckbox || !hiddenInput || !plateInput || !plateLabel) {
      console.error("Required elements not found");
      return;
  }

  otherCheckbox.disabled = false;
  otherCheckbox.checked = false;
  checkbox.disabled = true;
  plateInput.value = '';
  hiddenInput.value = checkbox.value;

  applyMaskBasedOnType(plateInput, plateLabel, type === 'yes');
}

// Function to initialize a vehicle
function initializeVehicle(vehicle) {
  const csYesCheckbox = vehicle.querySelector('.cs-yes');
  const csNoCheckbox = vehicle.querySelector('.cs-no');
  const plateInput = vehicle.querySelector('input[name="vehicle_plate[]"]');
  const plateLabel = vehicle.querySelector('.label:not([style])');

  if (csYesCheckbox && csNoCheckbox && plateInput && plateLabel) {
      // Apply initial mask
      applyMaskBasedOnType(plateInput, plateLabel, csYesCheckbox.checked);

      // Add event listeners
      csYesCheckbox.addEventListener('change', function() {
          updateLabelDyna(this, 'yes');
      });

      csNoCheckbox.addEventListener('change', function() {
          updateLabelDyna(this, 'no');
      });
  }
}
  // --------------------------------------INFORMATION SUMMARY FUNCTION-------------------------------------------- //
  
  // -------------------------------------- END INFORMATION SUMMARY FUNCTION-------------------------------------------- //