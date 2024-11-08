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