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

  // END FOR VALIDATION INPUT
  
  // ----------------------------------------------------------Validation for TAB/STEP------------------------------------------------------------------------------//
  function validateStep(stepNumber) {
    const currentStep = document.querySelector(`#step${stepNumber}`);
    let isValid = true;
  
      // Special validation for citizenship/nationality
      if (stepNumber === 1) {
        const citizenship = currentStep.querySelector('#citizenship');
        const nationality = currentStep.querySelector('#nationality');
        if (citizenship?.value === 'foreigner' && nationality && !nationality.value.trim()) {
          nationality.required = true;
          nationality.focus();
          nationality.reportValidity();
          return false;
        }
      }
  
      if(stepNumber === 2){
        // Check if there are existing error messages
        if ($('.error-msg').text().trim() !== "" ||
        $('.validation-message_email').text().trim() !== "") {
        isValid = false;
      }
      if (isValid) {
        validateStep(stepNumber + 1);
          } else {
            console.log('Validation failed');
          }
      }
  
  
    // Validate vehicle section for step 3
    if (stepNumber === 4) {
      const vehicles = currentStep.querySelectorAll('.vehicle-item');
      if (vehicles.length === 0) {
        alert('At least one vehicle is required.');
        return false;
      }
    }
  
    // Use native form validation for required fields
    const requiredFields = currentStep.querySelectorAll('[required]:invalid');
    if (requiredFields.length > 0) {
      requiredFields[0].focus();
      requiredFields[0].reportValidity();
      return false;
    }
  
    gatherInputValues();
  
    return isValid;
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
      const nextStep = document.querySelector(`#step${currentStepNumber + 1}`);
  
      if (currentStep && nextStep) {
        currentStep.classList.remove('active');
        nextStep.classList.add('active');
  
        const progress = document.querySelector('.progress-bar');
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
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
      form.addEventListener('submit', (e) => e.preventDefault());
  
      // Handle nationality field visibility
      const citizenship = document.querySelector('#citizenship');
      const nationalityContainer = document.querySelector('#add_info');
      const nationality = document.querySelector('#nationality');
      
      if (citizenship && nationalityContainer) {
        citizenship.addEventListener('change', function() {
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
  
    // Add listener for phone input
    phoneInput.addEventListener('input', function() {
      if (this.value.trim() !== '') {
        emailInput.removeAttribute('required');
      } else {
        emailInput.setAttribute('required', 'required');
      }
    });
  
    // Add listener for email input
    emailInput.addEventListener('input', function() {
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
      nextSection.style.display = "table";
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
      section.style.display = "none";
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
  }
  // -------------------------------------- END INFORMATION SUMMARY FUNCTION-------------------------------------------- //