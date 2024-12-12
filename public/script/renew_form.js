// Function to handle validation for each step
function validateStep(stepNumber) {
    const currentStep = document.querySelector(`#step${stepNumber}`);
    let isValid = true;

    // Special handling for vehicle step
    if (stepNumber === 4) {
        const vehicles = currentStep.querySelectorAll('.vehicle-item');
        
        // Ensure at least one vehicle is present
        if (vehicles.length === 0) {
            isValid = false;
            alert('At least one vehicle is required.');
            return false;
        }

        // Validate each vehicle
        vehicles.forEach((vehicle) => {
            const requiredFields = vehicle.querySelectorAll('input[required], select[required]');
            requiredFields.forEach(field => {
                const existingError = field.parentNode.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }

                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback error-message';
                    errorDiv.textContent = 'This field is required';
                    field.parentNode.appendChild(errorDiv);
                } else {
                    field.classList.remove('is-invalid');
                }
            });
        });

        return isValid;
    }

    // Standard validation for other steps
    const requiredFields = currentStep.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');

            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback error-message';
            errorDiv.textContent = 'This field is required';
            field.parentNode.appendChild(errorDiv);
        } else {
            if (field.type === 'email') {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(field.value)) {
                    isValid = false;
                    field.classList.add('is-invalid');

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback error-message';
                    errorDiv.textContent = 'Please enter a valid email address';
                    field.parentNode.appendChild(errorDiv);
                }
            }

            if ((field.type === 'tel' || field.id.toLowerCase().includes('phone') || field.id.toLowerCase().includes('mobile'))) {
                const phonePattern = /^\+?[\d\s-]{10,}$/;
                if (!phonePattern.test(field.value)) {
                    isValid = false;
                    field.classList.add('is-invalid');

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback error-message';
                    errorDiv.textContent = 'Please enter a valid phone number';
                    field.parentNode.appendChild(errorDiv);
                }
            }
        }
    });

    return isValid;
}

// // Vehicle form handling
// function VehicleHandling() {
//     // Select the container where all vehicles will be added
//     const vehicleContainer = document.querySelector('#step4');
//     const addVehicleBtn = document.getElementById('addVehicle');
//     let vehicleCount = 1;

//     // Create the vehicle template by cloning the first vehicle
//     const vehicleTemplate = document.querySelector('.vehicle-item').cloneNode(true);

//     function createRemoveButton() {
//         const removeBtn = document.createElement('button');
//         removeBtn.type = 'button';
//         removeBtn.className = 'btn btn-danger mt-3';
//         removeBtn.innerHTML = '<i class="bi bi-trash me-2"></i>Remove';
//         removeBtn.onclick = function() {
//             if (document.querySelectorAll('.vehicle-item').length > 1) {
//                 this.closest('.vehicle-item').remove();
//                 updateVehicleNumbers();
//             } else {
//                 alert('At least one vehicle is required.');
//             }
//         };
//         return removeBtn;
//     }

//     function updateVehicleNumbers() {
//         document.querySelectorAll('.vehicle-item').forEach((item, index) => {
//             const vehicleNumber = item.querySelector('.vehicle-number');
//             if (vehicleNumber) {
//                 vehicleNumber.textContent = index + 1;
//             }
//         });
//     }

//     function resetFormValues(element) {
//         element.querySelectorAll('input').forEach(input => {
//             input.value = '';
//             input.classList.remove('is-invalid');
//         });
//         element.querySelectorAll('select').forEach(select => {
//             select.selectedIndex = 0;
//             select.classList.remove('is-invalid');
//         });
//         element.querySelectorAll('.error-message').forEach(error => error.remove());
//     }

//     addVehicleBtn.addEventListener('click', () => {
//         vehicleCount++;
        
//         // Clone the template
//         const newVehicle = vehicleTemplate.cloneNode(true);
        
//         // Reset form values
//         resetFormValues(newVehicle);
        
//         // Update vehicle number
//         const vehicleNumber = newVehicle.querySelector('.vehicle-number');
//         if (vehicleNumber) {
//             vehicleNumber.textContent = vehicleCount;
//         }
        
//         // Add remove button to the new vehicle
//         const removeBtn = createRemoveButton();
//         newVehicle.querySelector('.row').insertAdjacentElement('afterend', removeBtn);
        
//         // Insert the new vehicle before the Add Item button
//         addVehicleBtn.insertAdjacentElement('beforebegin', newVehicle);

//         // Enable fields if the form step is active
//         if (newVehicle.closest('.form-step').classList.contains('active')) {
//             const fields = newVehicle.querySelectorAll('input, select');
//             fields.forEach(field => field.removeAttribute('disabled'));
//         }
//     });

//     // Make sure the initial vehicle doesn't have a remove button
//     const initialVehicle = document.querySelector('.vehicle-item');
//     const existingRemoveBtn = initialVehicle.querySelector('.btn-danger');
//     if (existingRemoveBtn) {
//         existingRemoveBtn.remove();
//     }
// }

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

// function manageFieldDisabling() {
//     const allSteps = document.querySelectorAll('.form-step');
//     const currentStep = document.querySelector('.form-step.active');
    
//     allSteps.forEach(step => {
//         const fields = step.querySelectorAll('input, select, textarea');
//         fields.forEach(field => {
//             if (step === currentStep) {
//                 field.removeAttribute('disabled');
//             } else {
//                 field.setAttribute('disabled', 'disabled');
//             }
//         });
//     });
// }

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
document.addEventListener('input', function(e) {
    if (e.target.hasAttribute('required')) {
        e.target.classList.remove('is-invalid');
        const errorMessage = e.target.parentNode.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
    }
});

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    // manageFieldDisabling();
    updateNavigationButtons();
    // VehicleHandling();
    FileUploads();
});

// FOR PLAN TYPE FILTER
document.addEventListener('DOMContentLoaded', function() {
    const membershipSelect = document.getElementById('membershiptype');
    const planTypeSelect = document.getElementById('plantype');
    const planOptions = planTypeSelect.querySelectorAll('option[data-membership]');
    const selectedPlanIdInput = document.getElementById('selected_plan_id');
    
    // Existing membership filter functionality
    membershipSelect.addEventListener('change', function() {
        const selectedMembershipId = this.selectedOptions[0].getAttribute('data-membership');
        console.log('Selected Membership ID:', selectedMembershipId);
        
        planTypeSelect.value = "";
        selectedPlanIdInput.value = ""; // Clear plan_id when membership changes
        
        planOptions.forEach(option => {
            if (option.getAttribute('data-membership') === selectedMembershipId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    });
    
    // New plan_id handler
    planTypeSelect.addEventListener('change', function() {
        const selectedOption = this.selectedOptions[0];
        if (selectedOption && selectedOption.value) {
            const planId = selectedOption.getAttribute('data-plan-id');
            selectedPlanIdInput.value = planId;
            console.log('Selected Plan ID:', planId);
        } else {
            selectedPlanIdInput.value = "";
        }
    });
});

// File upload handling
function FileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
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
    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

  //Contact Information Section---------------------------
// document.addEventListener('DOMContentLoaded', function () {
//     var mailingAddressDropdown = document.getElementById('mail');
//     var officeAddressSection   = document.getElementById('officeAddress');
//     var street1                = document.getElementById('street1');
//     var town1                  = document.getElementById('town1');
//     var city1                  = document.getElementById('city1');
//     var province1              = document.getElementById('province1');
//     var zcode1                 = document.getElementById('zcode1');
//     var comname                = document.getElementById('comname');
  
//     // Function to set or remove the required attribute for the specified fields
//     function updateRequiredFields(required) {
//       street1.required      = required;
//       town1.required        = required;
//       city1.required        = required;
//       province1.required    = required;
//       zcode1.required       = required;
//       comname.required      = required;
//     }
  
//     mailingAddressDropdown.addEventListener('change', function () {
//       if (mailingAddressDropdown.value === 'OFFICE') {
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

  function summary_fetch() {
    
    // Step 1 Values
    var membershipType     = $('#membership_type').val();
    var plan_type          = $('#plan_type').val();
    var pin_code           = $('#pinCode').val();
    var paInsurance        = $('#paInsurance').val();
    var activationDate     = $('#activationDate').val();
    var applicationType     = $('#applicationType').val();
    
    
    // Step 2 Values
    var title       = $('#title').val();
    var first_name  = $('#firstName').val();
    var last_name   = $('#lastName').val();
    var middle_name = $('#middleName').val();
      // var full_name    = first_name+ ' ,'+ last_name;
    var gender       = $('#gender').val();
    var birthdate    = $('#birthdate').val();
    var birthplace   = $('#birthplace').val();
    var citizenship  = $('#citizenship').val();
    var nationality  = $('#nationality').val();
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
    document.getElementById('summaryApplicationType').textContent   = applicationType;
    document.getElementById('summaryMembershipType').textContent    = membershipType;
    document.getElementById('summaryPlanType').textContent          = plan_type;
    document.getElementById('summaryActivationDate').textContent    = activationDate;

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