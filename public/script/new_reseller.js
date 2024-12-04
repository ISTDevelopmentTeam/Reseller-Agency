// Step 1 Validation
$('#nextBtn').on('click', function() {

    // TextField Validation
    var inputs = [
        '#activationDate',
        '#pinCode', 
        '#paInsurance'
    ];
    
    // Loop through each input and check if it is empty
    for (var i = 0; i < inputs.length; i++) {
        var inputValue = $(inputs[i]).val();
        if (inputValue === null || inputValue.trim() === '') {
            Swal.fire({
                title: "Missing Info",
                text: "Please Make Sure You Have Inputted all of the textfields",
                icon: "error"
            }); 
            return; // Stop the loop if an empty input is found
        }
    }
    
    // File Upload Validation
    var fileInputs = ['#orcrAttachment', '#idAttachment'];
    
    for (var j = 0; j < fileInputs.length; j++) {
        var fileInput = $(fileInputs[j])[0].files[0]; // Get the selected file for each input
    
        if (!fileInput) {
            Swal.fire({
                title: "Missing Images",
                text: "Please Upload the required image",
                icon: "error"
            });
            return; // Stop if a file is not selected
        }
    }
    
    nextStep(); // Proceed to next step
    
    }); 
    
    
    
    // End of Step 1
    
    
    
    // Step 2 Validation
    $('#step_2_button').on('click', function() {
    
    // TextField Validation
    var inputs = [
        '#firstName',
        '#lastName',
        '#birthdate',
        '#birthplace',  
        '#citizenship', 
        '#nationality', 
        '#acrNo', 
        '#occupation', 
        '#mobileNumber', 
        '#emailAddress'
    ];
    
    // Loop through each input and check if it is empty
    for (var i = 0; i < inputs.length; i++) {
        var inputValue = $(inputs[i]).val();
        if (inputValue === null || inputValue.trim() === '') {
            Swal.fire({
                title: "Missing Info",
                text: "Please Make Sure You Have Inputted all of the textfields",
                icon: "error"
            }); 
            return; // Stop the loop if an empty input is found
        }
    }
    
    nextStep(); // Proceed to next step
    
    }); 
    
    
    
    // End of Step 2
    
    
    
    
    
    // Step 3 Validation
    $('#step_3_button').on('click', function() {
    
    // TextField Validation
    var inputs = [
        '#searchOfficeTown',
        '#companyName',
        '#street',
        '#town',  
        '#city', 
        '#province', 
        '#zcode'
    ];
    
    // Loop through each input and check if it is empty
    for (var i = 0; i < inputs.length; i++) {
        var inputValue = $(inputs[i]).val();
        if (inputValue === null || inputValue.trim() === '') {
            Swal.fire({
                title: "Missing Info",
                text: "Please Make Sure You Have Inputted all of the textfields",
                icon: "error"
            }); 
            return; // Stop the loop if an empty input is found
        }
    }
    
    nextStep(); // Proceed to next step
    
    }); 
    
    
    
    // End of Step 3
    
    
    
    
    // Step 4 Validation
    $('#step_4_button').on('click', function() {
    
    // TextField Validation
    var inputs = [
        '#plate_number',
        '#car_make',
        '#car_model',
        '#vechile_type',  
        '#car_year_model', 
        '#sub_model', 
        '#color'
    ];
    
    // Loop through each input and check if it is empty
    for (var i = 0; i < inputs.length; i++) {
        var inputValue = $(inputs[i]).val();
        if (inputValue === null || inputValue.trim() === '') {
            Swal.fire({
                title: "Missing Info",
                text: "Please Make Sure You Have Inputted all of the textfields",
                icon: "error"
            }); 
            return; // Stop the loop if an empty input is found
        }
    }
    
    nextStep(); // Proceed to next step
    
    });
    
    //Step 5
    function summary_fetch() {
    nextStep(); // Proceed to next step
    
    // Step 1 Values
    var membershipType     = $('#membership_type').val();
    var plan_type          = $('#plan_type').val();
    var pin_code           = $('#pinCode').val();
    var paInsurance        = $('#paInsurance').val();
    var activationDate     = $('#activationDate').val();
    var applicationType     = $('#applicationType').val();
    
    
    // Step 2 Values
    var first_name   = $('#firstName').val();
    var last_name    = $('#lastName').val();
    var full_name    = first_name+ ' ,'+ last_name;
    var gender       = $('#gender').val();
    var birthdate    = $('#birthdate').val();
    var birthplace   = $('#birthplace').val();
    var citizenship  = $('#citizenship').val();
    var nationality  = $('#nationality').val();
    var acrNo        = $('#acrNo').val();
    var occupation   = $('#occupation').val();
    var mobileNumber = $('#mobileNumber').val();
    var emailAddress = $('#emailAddress').val();
    var occupation   = $('#occupation').val();
    var civilStatus  = $('#civilStatus').val();
    
    
    
    // Step 3 Values
    var searchOfficeTown    = $('#searchOfficeTown').val();
    var companyName         = $('#companyName').val();
    var street              = $('#street').val();
    var town                = $('#town').val();
    var city                = $('#city').val();
    var province            = $('#province').val();
    var zcode               = $('#zcode').val();
    var address             = street + ' ' + town + ' ' + city + ' ' + province + ' ' + zcode + ' ';
    
    
    // Summary Fields
    document.getElementById('summaryApplicationType').textContent   = applicationType;
    document.getElementById('summaryMembershipType').textContent    = membershipType;
    document.getElementById('summaryPlanType').textContent          = plan_type;
    document.getElementById('summaryActivationDate').textContent    = activationDate;
    document.getElementById('summaryFullName').textContent          = full_name;
    document.getElementById('summaryGender').textContent            = gender;
    document.getElementById('summaryBirthdate').textContent         = birthdate;
    document.getElementById('summaryCivilStatus').textContent       = civilStatus;
    document.getElementById('summaryEmail').textContent             = emailAddress;
    document.getElementById('summaryMobile').textContent            = mobileNumber;
    document.getElementById('summaryCompanyName').textContent       = companyName;
    document.getElementById('summaryAddress').textContent           = address;
    document.getElementById('summaryMailingPreference').textContent = 'TEST';
    document.getElementById('summaryMagazine').textContent          = 'TEST';
    
    
    } 
    // End of Step 5

// Form state management
let currentStep = 1;
const totalSteps = 5;

// DOM Elements
const progressBar = document.querySelector('.progress-bar');
const formSteps = document.querySelectorAll('.form-step');
const breadcrumbItems = document.querySelectorAll('.breadcrumb-item');
const vehicleContainer = document.getElementById('vehicleContainer');
const vehicleTemplate = document.getElementById('vehicleTemplate');
const addVehicleButton = document.getElementById('addVehicle');

// Initialize form handling
document.addEventListener('DOMContentLoaded', function() {
    initializeForm();
    initializeVehicleHandling();
    attachBreadcrumbListeners();
});

// Form initialization and navigation
function initializeForm() {
    showStep(currentStep);
    updateProgressBar();
}

function updateProgressBar() {
    const progress = (currentStep / totalSteps) * 100;
    progressBar.style.width = `${progress}%`;
}

function showStep(step) {
    formSteps.forEach(el => el.classList.remove('active'));
    document.getElementById(`step${step}`).classList.add('active');
    
    breadcrumbItems.forEach((el, index) => {
        if (index + 1 === step) {
            el.classList.add('active');
        } else {
            el.classList.remove('active');
        }
    });
    
    updateProgressBar();
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
}

function previousStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

// Breadcrumb navigation
function attachBreadcrumbListeners() {
    breadcrumbItems.forEach(item => {
        item.addEventListener('click', function() {
            const step = parseInt(this.dataset.step);
            if (step <= currentStep) {
                currentStep = step;
                showStep(step);
            }
        });
    });
}

// Vehicle form handling
function initializeVehicleHandling() {
    let vehicleCount = 0;

    function addVehicle() {
        vehicleCount++;
        const clone = vehicleTemplate.content.cloneNode(true);
        
        // Update vehicle number
        clone.querySelector('.vehicle-number').textContent = vehicleCount;
        
        // Add remove functionality
        const removeButton = clone.querySelector('.remove-vehicle');
        removeButton.addEventListener('click', function() {
            this.closest('.vehicle-item').remove();
            updateVehicleNumbers();
        });
        
        vehicleContainer.appendChild(clone);
    }

    function updateVehicleNumbers() {
        const vehicles = vehicleContainer.querySelectorAll('.vehicle-item');
        vehicles.forEach((vehicle, index) => {
            vehicle.querySelector('.vehicle-number').textContent = index + 1;
        });
        vehicleCount = vehicles.length;
    }

    // Add first vehicle form by default
    addVehicle();

    // Add button click handler
    addVehicleButton.addEventListener('click', addVehicle);
}

// Make functions globally available
window.nextStep = nextStep;
window.previousStep = previousStep;

// FOR PLAN TYPE FILTER 
document.addEventListener('DOMContentLoaded', function() {
    const membershipSelect = document.getElementById('membership_type');
    const planTypeSelect = document.getElementById('plan_type');
    const planOptions = planTypeSelect.querySelectorAll('option[data-membership]');
    
    membershipSelect.addEventListener('change', function() {
        const selectedMembershipId = this.value;
        
        // Reset plan type select
        planTypeSelect.value = "";
        
        // Hide all plan options except the default one
        planOptions.forEach(option => {
            if (option.getAttribute('data-membership') === selectedMembershipId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    });
});


// For Image File
function handleFileUpload(input, imageId, feedbackId) {
    const feedback = document.getElementById(feedbackId);
    const preview = document.getElementById(imageId);
    const file = input.files[0];
    
    // Reset everything
    feedback.innerHTML = "";
    preview.style.display = 'none';
    
    if (file) {
        // Check file extension
        const fileName = file.name.toLowerCase();
        if (!fileName.match(/\.(jpg|jpeg|png|pdf)$/)) {
            feedback.innerHTML = "Please upload jpg, jpeg, png, or pdf file only";
            input.value = '';
            return;
        }
        
        // Check file size (8MB = 8 * 1024 * 1024)
        if (file.size > 8 * 1024 * 1024) {
            feedback.innerHTML = "File must be less than 8MB";
            input.value = '';
            return;
        }
        
        // Show preview for images
        if (fileName.match(/\.(jpg|jpeg|png)$/)) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
}

