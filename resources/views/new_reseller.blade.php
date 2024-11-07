<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #002B5B;
            width: 16rem;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            margin: 0.2rem 0;
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .stat-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            background-color: #FFB800;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .user-profile {
            cursor: pointer;
        }

        .dropdown-menu {
            min-width: 200px;
            padding: 8px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.2s ease;
            color: #333;
        }

 
        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
            color: #0d6efd;
        }


        .dropdown-item:active {
            background-color: #e9ecef;
            color: #0d6efd;
        }


        .user-profile {
            cursor: pointer;
        }

        .dropdown-divider {
            margin: 8px 0;
        }

        .dropdown-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        #imagePreview img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .btn-close {
            background-color: white;
            padding: 0.25rem;
            border-radius: 50%;
        }

        .modal-blur {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
        }

        .form-step {
        display: none;
        }

        .form-step.active {
            display: block;
        }

        .form-step {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .form-step.active {
            opacity: 1;
        }
        
        .breadcrumb-item {
            cursor: pointer;
        }
        .progress {
            height: 2px;
            margin-bottom: 20px;
        }
        .scrollable-card {
            max-height: 70vh;
            overflow-y: auto;
        }
        .card-body {
            position: relative;
        }
        .progress-container {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1000;
            padding-top: 1rem;
        }

        .vehicle-item {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .vehicle-item:hover {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }

        .customer-fillout-btn {
            position: absolute;
            top: 10px;
            right: 15px;
        }

        .option-button:hover {
            background-color: #f8f9fa;
        }


        .option-button.selected {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layout/sidebar')

            <!-- Main Content -->
            <div class="col main-content p-4">
                @include('layout/nav')
                
                <!-- Profile Modal -->
                @include('layout/profile')
                                              
                <div class="row g-4">
                    <!-- Today's Today's New Reseller -->
                    <div class="col-12 col-md-4">
                        <div class="stat-card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Today's Today's New Reseller</h6>
                                    <h2 class="mb-0">0</h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly New Reseller -->
                    <div class="col-12 col-md-4">
                        <div class="stat-card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Monthly New Reseller</h6>
                                    <h2 class="mb-0">0</h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Reseller Applicants -->
                    <div class="col-12 col-md-4">
                        <div class="stat-card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Weekly Reseller Applicants</h6>
                                    <h2 class="mb-0">0</h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-user-times text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="row justify-content-center mt-5">
                        <div class="col-12 col-md-10">
                            <div class="scrollable-card card shadow-lg">
                                <div class="card-body">

                                    <button class="btn btn-primary customer-fillout-btn" onclick="window.open('{{ route('customer_qr') }}', '_blank')">
                                        <i class="fas fa-user-edit me-2"></i>Customer Fill-out
                                    </button>

                                    <!-- Progress bar -->
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 33%"></div>
                                    </div>
            
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" data-step="1">Personal Information</li>
                                            <li class="breadcrumb-item" data-step="2">Vehicle Details</li>
                                            <li class="breadcrumb-item" data-step="3">Attachment</li>
                                            <li class="breadcrumb-item" data-step="4">Other Details</li>
                                        </ol>
                                    </nav>
            
                                    <form id="resellerForm">
                                        <!-- Step 1: Personal Information -->
                                        <div class="form-step active" id="step1">
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-md-8 d-flex justify-content-center gap-4">
                                                <div class="card shadow-sm px-4 py-3 text-center option-button" style="min-width: 200px; cursor: pointer;">
                                                    <i class="bi bi-person fs-4"></i>
                                                    <div>Personal</div>
                                                </div>
                                                <div class="card shadow-sm px-4 py-3 text-center option-button" style="min-width: 200px; cursor: pointer;">
                                                    <i class="bi bi-people fs-4"></i>
                                                    <div>Authorized Representative</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main Form -->
                                        <div class="row">
                                            <!-- Branch Selection -->
                                            <div class="col-md-4 mb-3">
                                                <label for="branch" class="form-label">Branch</label>
                                                <select class="form-select" id="branch">
                                                    <option value="ALABANG">ALABANG</option>
                                                    <option value="MAKATI">MAKATI</option>
                                                    <option value="Baliwag">ORTIGAS</option>
                                                    <option value="Main">QUEZON CITY</option>
                                                </select>
                                            </div>
                                            
                                            <!-- Type of Membership -->
                                            <div class="col-md-4 mb-3">
                                                <label for="membershipType" class="form-label">Type of Membership</label>
                                                <select class="form-select" id="membershipType">
                                                    <option selected>Select Type of Membership.</option>
                                                    <option>Type 1</option>
                                                    <option>Type 2</option>
                                                    <option>Type 3</option>
                                                </select>
                                            </div>

                                            <!-- Plan Type -->
                                            <div class="col-md-4 mb-3">
                                                <label for="planType" class="form-label">Plan Type</label>
                                                <select class="form-select" id="planType">
                                                    <option selected>Select Plan Type.</option>
                                                    <option>Plan 1</option>
                                                    <option>Plan 2</option>
                                                    <option>Plan 3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Title -->
                                            <div class="col-md-3 mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <select class="form-select" id="title">
                                                    <option selected>Select Title.</option>
                                                    <option>Mr.</option>
                                                    <option>Ms.</option>
                                                    <option>Mrs.</option>
                                                </select>
                                            </div>

                                            <!-- First Name -->
                                            <div class="col-md-3 mb-3">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
                                            </div>

                                            <!-- Middle Name -->
                                            <div class="col-md-3 mb-3">
                                                <label for="middleName" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="middleName" placeholder="Enter Middle Name">
                                            </div>

                                            <!-- Last Name -->
                                            <div class="col-md-3 mb-3">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Birth Month -->
                                            <div class="col-md-3 mb-3">
                                                <label for="birthMonth" class="form-label">Birth Month</label>
                                                <select class="form-select" id="birthMonth">
                                                    <option selected>Select Birth Month.</option>
                                                    <option>January</option>
                                                    <option>February</option>
                                                    <!-- Add other months -->
                                                </select>
                                            </div>

                                            <!-- Birth Day -->
                                            <div class="col-md-3 mb-3">
                                                <label for="birthDay" class="form-label">Birth Day</label>
                                                <select class="form-select" id="birthDay">
                                                    <option selected>Select a Day</option>
                                                    <!-- Add days 1-31 -->
                                                </select>
                                            </div>

                                            <!-- Birth Year -->
                                            <div class="col-md-2 mb-3">
                                                <label for="birthYear" class="form-label">Birth Year</label>
                                                <select class="form-select" id="birthYear">
                                                    <option selected>Select a Year</option>
                                                    <!-- Add years -->
                                                </select>
                                            </div>

                                            <!-- Birth Place -->
                                            <div class="col-md-4 mb-3">
                                                <label for="birthPlace" class="form-label">Birth Place</label>
                                                <input type="text" class="form-control" id="birthPlace" placeholder="Enter Birth Place">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Gender -->
                                            <div class="col-md-3 mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" id="gender">
                                                    <option selected>Select a Gender.</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>

                                            <!-- Occupation -->
                                            <div class="col-md-3 mb-3">
                                                <label for="occupation" class="form-label">Occupation</label>
                                                <input type="text" class="form-control" id="occupation" placeholder="Enter Occupation">
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-3 mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status">
                                                    <option selected>Please Select Civil Status.</option>
                                                    <option>Single</option>
                                                    <option>Married</option>
                                                    <option>Divorced</option>
                                                    <option>Widowed</option>
                                                </select>
                                            </div>

                                            <!-- Citizenship -->
                                            <div class="col-md-3 mb-3">
                                                <label for="citizenship" class="form-label">Citizenship</label>
                                                <select class="form-select" id="citizenship">
                                                    <option selected>Select Citizenship.</option>
                                                    <!-- Add citizenship options -->
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                            </div>
                                        </div>
            
                                           
                                        </div>
            
                                        <!-- Step 2: Contact Information -->
                                        <div class="form-step" id="step2">
                                            <h5 class="mb-4">Contact Information</h5>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Mailing Address</label>
                                                <select class="form-select">
                                                    <option selected>Select Mailing Address</option>
                                                    <option value="home">Home Address</option>
                                                    <option value="office">Office Address</option>
                                                </select>
                                            </div>

                                            <div class="card p-4 mb-4">
                                                <h6 class="mb-3">Home Address</h6>
                                                <div class="row g-3">
                                                    <!-- Building and Barangay -->
                                                    <div class="col-md-6">
                                                        <label class="form-label">Building No./Street</label>
                                                        <input type="text" class="form-control" placeholder="Enter Building No./Street">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Barangay/Town</label>
                                                        <input type="text" class="form-control" placeholder="Enter Barangay/Town">
                                                    </div>

                                                    <!-- City, Province, ZIP -->
                                                    <div class="col-md-4">
                                                        <label class="form-label">City/Municipality</label>
                                                        <input type="text" class="form-control" placeholder="Enter City/Municipality">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Province</label>
                                                        <input type="text" class="form-control" placeholder="Enter Province">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">ZIP Code</label>
                                                        <input type="text" class="form-control" placeholder="Enter ZIP Code">
                                                    </div>

                                                    <!-- Contact Information -->
                                                    <div class="col-md-6">
                                                        <label class="form-label">Mobile No.</label>
                                                        <input type="tel" class="form-control" placeholder="(0999) 999-9999">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Alternate Mobile No. (Optional)</label>
                                                        <input type="tel" class="form-control" placeholder="Enter Alternate Mobile No.">
                                                    </div>

                                                    <!-- Email Addresses -->
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Enter Email Address">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Alternate Email Address (Optional)</label>
                                                        <input type="email" class="form-control" placeholder="Enter Alternate Email Address">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-warning" onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                            </div>
                                        </div>
                                        
                                        <!-- Step 3: Vehicle Information -->
                                        <div class="form-step" id="step3">
                                        <div class="container mt-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <form>
                                                        <div class="row mb-3">
                                                            <!-- Conduction Sticker -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Is Conduction Sticker Available?</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="conductionSticker" id="conductionYes">
                                                                        <label class="form-check-label" for="conductionYes">YES</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="conductionSticker" id="conductionNo" checked>
                                                                        <label class="form-check-label" for="conductionNo">NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Plate Number -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Plate No.</label>
                                                                <input type="text" class="form-control" placeholder="ENTER PLATE NO.">
                                                            </div>
                                                            
                                                            <!-- Diplomat -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Is Diplomat?</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="diplomat" id="diplomatYes">
                                                                        <label class="form-check-label" for="diplomatYes">YES</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="diplomat" id="diplomatNo" checked>
                                                                        <label class="form-check-label" for="diplomatNo">NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <!-- Make -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Make</label>
                                                                <select class="form-select">
                                                                    <option selected>Car Make</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Car Model -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Car Model</label>
                                                                <select class="form-select">
                                                                    <option selected>Car Model</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Vehicle Type -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Vehicle Type</label>
                                                                <select class="form-select">
                                                                    <option selected>Vehicle Type</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Year Model -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Year Model</label>
                                                                <input type="text" class="form-control" placeholder="Year Model">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <!-- Sub-Model -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Sub-Model</label>
                                                                <input type="text" class="form-control" placeholder="Variant">
                                                            </div>
                                                            
                                                            <!-- No. of Person -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">No. of Person</label>
                                                                <input type="number" class="form-control" placeholder="No. of Person">
                                                            </div>
                                                            
                                                            <!-- Color -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Color</label>
                                                                <input type="text" class="form-control" placeholder="Enter Car Color">
                                                            </div>
                                                            
                                                            <!-- Fuel Type -->
                                                            <div class="col-md-3">
                                                                <label class="form-label">Fuel Type</label>
                                                                <select class="form-select">
                                                                    <option selected>Fuel Type</option>
                                                                    <option>Gasoline</option>
                                                                    <option>Diesel</option>
                                                                    <option>Electric</option>
                                                                    <option>Hybrid</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <!-- Transmission Type -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Transmission Type</label>
                                                                <select class="form-select">
                                                                    <option selected>Select transmission type</option>
                                                                    <option>Manual</option>
                                                                    <option>Automatic</option>
                                                                    <option>CVT</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <!-- Acts of Nature -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Acts of Nature?</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="actsOfNature" id="actsYes">
                                                                        <label class="form-check-label" for="actsYes">YES</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="actsOfNature" id="actsNo" checked>
                                                                        <label class="form-check-label" for="actsNo">NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Mortgaged -->
                                                            <div class="col-md-4">
                                                                <label class="form-label">Mortgaged?</label>
                                                                <div class="d-flex gap-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="mortgaged" id="mortgagedYes">
                                                                        <label class="form-check-label" for="mortgagedYes">YES</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="mortgaged" id="mortgagedNo" checked>
                                                                        <label class="form-check-label" for="mortgagedNo">NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Add Another Vehicle Button -->
                                                        <div class="mb-3">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="bi bi-plus"></i> Add another vehicle
                                                            </button>
                                                        </div>

                                                <!--Step 4 -->

                                                        <!-- Navigation Buttons -->
                                                        <div class="d-flex justify-content-between mt-4">
                                                            <button type="button" class="btn btn-warning" onclick="previousStep()">Previous</button>
                                                            <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="small text-muted mt-4 text-center">
                    Copyright © 2024 Automobile Association of the Philippines
            </div>
    </div>
</div>
</div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
const totalSteps = 4;

function updateProgress() {
    // Update progress bar
    const progress = (currentStep / totalSteps) * 100;
    document.querySelector('.progress-bar').style.width = `${progress}%`;
    
    // Update breadcrumb
    document.querySelectorAll('.breadcrumb-item').forEach((item, index) => {
        if (index + 1 === currentStep) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(el => {
        el.classList.remove('active');
    });
    
    // Show current step
    const currentStepElement = document.getElementById(`step${step}`);
    if (currentStepElement) {
        currentStepElement.classList.add('active');
    }
    
    updateProgress();
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

function submitForm() {

    alert('Form submitted successfully!');
}

// Enable breadcrumb navigation
document.querySelectorAll('.breadcrumb-item').forEach(item => {
    item.addEventListener('click', function() {
        const step = parseInt(this.dataset.step);
        if (step <= Math.max(currentStep, 1)) { 
            currentStep = step;
            showStep(step);
        }
    });
});

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
    updateProgress();
});


document.querySelectorAll('.option-button').forEach(button => {
    button.addEventListener('click', function() {

        document.querySelectorAll('.option-button').forEach(btn => btn.classList.remove('selected'));
 
        this.classList.add('selected');
    });
});
    </script>
</body>
</html>