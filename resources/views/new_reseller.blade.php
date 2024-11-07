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
            background-color: #d0e1f1;
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

                    <!-- Form Card -->
                    <div class="row justify-content-center mt-5">
                        <div class="col-12 col-md-10">
                            <div class="scrollable-card card shadow-lg">
                            
                                <div class="card-body">

                                    <!-- Progress bar -->
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 33%"></div>
                                    </div>
            
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" data-step="1">Membership Application</li>
                                            <li class="breadcrumb-item" data-step="2">Personal Information</li>
                                            <li class="breadcrumb-item" data-step="3">Contact Information</li>
                                            <li class="breadcrumb-item" data-step="4">Vehicle Details</li>
                                            <li class="breadcrumb-item" data-step="5">Information Summary</li>
                                        </ol>
                                    </nav>
                                    

                                    <form id="resellerForm">
                                    @csrf
                                        <!--Step 1:  Membership Application -->
                                        <div class="form-step active" id="step1">
                                            <button class="btn btn-primary customer-fillout-btn" onclick="window.open('{{ route('customer_qr') }}', '_blank')">
                                                <i class="fas fa-user-edit me-2"></i>Customer Fill-out
                                            </button>
                                            <h5 class="card-title mb-4">Membership Application</h5>
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="applicationType" class="form-label">Type of Application</label>
                                                        <input type="text" class="form-control" id="applicationType" value="NEW" disabled>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="membership_type" class="form-label">Type of Membership</label>
                                                        <select class="form-select" id="membership_type" name="membership_id">
                                                            <option value="" selected disabled>Select Type of Membership</option>
                                                            @foreach ($packages['members'] as $members_type)
                                                                <option value="{{ $members_type->membership_id }}" data-vehicle_num="{{ $members_type->vehicle_num }}">
                                                                    {{ $members_type->membership_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="plan_type" class="form-label">Plan Type</label>
                                                        <select class="form-select" id="plan_type" name="plan_type">
                                                            <option value="" selected disabled>Select Plan Type</option>
                                                            @foreach ($packages['plantype'] as $plan)
                                                                <option value="{{ $plan->plan_name }}" data-membership="{{ $plan->membership_id }}" style="display: none;">
                                                                    {{ $plan->plan_name }} - ₱ {{ $plan->plan_amount }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="pidpPlanType" class="form-label">PIDP Plan Type</label>
                                                        <input type="text" class="form-control" id="pidpPlanType">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="activationDate" class="form-label">Activation Date</label>
                                                        <input type="date" class="form-control" id="activationDate" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="pinCode" class="form-label">PIN Code</label>
                                                        <input type="text" class="form-control" id="pinCode" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="initiator" class="form-label">Initiator</label>
                                                        <select class="form-select" id="initiator" required>
                                                            <option value="REGULAR" selected>REGULAR</option>
                                                            <option value="PREMIUM">PREMIUM</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="paInsurance" class="form-label">PA Insurance</label>
                                                        <input type="text" class="form-control" id="paInsurance">
                                                    </div>

                                                    <div class="d-flex justify-content-end mt-4">
                                                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                                    </div>
                                                </div>
                                        </div>         
                                        <!-- Step 2: Personal Information -->
                                        <div class="form-step" id="step2">
                                            <h5 class="mb-4">Personal Information</h5>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-2">
                                                    <label for="title" class="form-label">Title</label>
                                                    <select class="form-select" id="title" required>
                                                        <option value="MR">MR.</option>
                                                        <option value="MS">MS.</option>
                                                        <option value="MRS">MRS.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="firstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="middleName" class="form-label">Middle Name</label>
                                                    <input type="text" class="form-control" id="middleName">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName" required>
                                                </div>
                                            </div>
            
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-select" id="gender" required>
                                                        <option value="MALE">MALE</option>
                                                        <option value="FEMALE">FEMALE</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="birthdate" class="form-label">Birthdate</label>
                                                    <input type="date" class="form-control" id="birthdate" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="birthplace" class="form-label">Birthplace</label>
                                                    <input type="text" class="form-control" id="birthplace" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="citizenship" class="form-label">Citizenship</label>
                                                    <input type="text" class="form-control" id="citizenship" required>
                                                </div>
                                            </div>
            
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="nationality" class="form-label">Nationality</label>
                                                    <input type="text" class="form-control" id="nationality" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="acrNo" class="form-label">ACR No.</label>
                                                    <input type="text" class="form-control" id="acrNo">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="civilStatus" class="form-label">Civil Status</label>
                                                    <select class="form-select" id="civilStatus" required>
                                                        <option value="SINGLE">SINGLE</option>
                                                        <option value="MARRIED">MARRIED</option>
                                                        <option value="DIVORCED">DIVORCED</option>
                                                        <option value="WIDOWED">WIDOWED</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="occupation" class="form-label">Occupation</label>
                                                    <input type="text" class="form-control" id="occupation" required>
                                                </div>
                                            </div>
            
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                                                    <input type="tel" class="form-control" id="mobileNumber" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="emailAddress" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailAddress" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="telephoneNumber" class="form-label">Telephone Number</label>
                                                    <input type="tel" class="form-control" id="telephoneNumber">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="alternateMobile" class="form-label">Alternate Mobile Number</label>
                                                    <input type="tel" class="form-control" id="alternateMobile">
                                                </div>
                                            </div>
            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="alternateEmail" class="form-label">Alternate Email Address</label>
                                                    <input type="email" class="form-control" id="alternateEmail">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="officePhone" class="form-label">Office Phone Number</label>
                                                    <input type="tel" class="form-control" id="officePhone">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                            </div>
                                        </div>

                                        <!-- Step 3: Contact Information Section -->
                                        <div class="form-step" id="step3">
                                            <h5 class="mt-4 mb-3">Office Address</h5>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="searchOfficeTown" class="form-label">Search Town</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="searchOfficeTown" placeholder="Search town...">
                                                        <button class="btn btn-secondary" type="button">Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="companyName" class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" id="companyName" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="officeBuildingStreet" class="form-label">Building No. / Street</label>
                                                    <input type="text" class="form-control" id="officeBuildingStreet" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="officeBarangay" class="form-label">Barangay / Towns</label>
                                                    <input type="text" class="form-control" id="officeBarangay" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="officeCityMunicipality" class="form-label">City/Municipality</label>
                                                    <input type="text" class="form-control" id="officeCityMunicipality" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                               
                                                <div class="col-md-3">
                                                    <label for="officeProvince" class="form-label">Province</label>
                                                    <input type="text" class="form-control" id="officeProvince" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="officeZipCode" class="form-label">Zip</label>
                                                    <input type="text" class="form-control" id="officeZipCode" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mailingPreference" class="form-label">Mailing Preference</label>
                                                    <select class="form-select" id="mailingPreference" required>
                                                        <option value="HOME">HOME</option>
                                                        <option value="OFFICE">OFFICE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                                                    <select class="form-select" id="availMagazine" required>
                                                        <option value="YES">YES</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                            </div>
                                        </div>
                                      
            
                                        <!-- Step 4: Vehicle Information -->
                                        <div class="form-step" id="step4">
                                            <h5 class="mb-4">Vehicle Details</h5>
                                            
                                            <div id="vehicleContainer">
                                                <!-- Vehicle form template will be cloned here -->
                                            </div>

                                            <button type="button" class="btn btn-primary mt-3" id="addVehicle">
                                                <i class="bi bi-plus-circle me-2"></i>Add Item
                                            </button>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                            </div>
                                        </div>

                                        <!-- Vehicle Template (hidden) -->
                                        <template id="vehicleTemplate">
                                            <div class="vehicle-item border rounded p-3 mb-3">
                                                <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                                <div class="row g-3">
                                                    <!-- First Row -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">Conduction Sticker</label>
                                                        <select class="form-select">
                                                            <option value="NO">NO</option>
                                                            <option value="YES">YES</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Plate Number</label>
                                                        <input type="text" class="form-control" placeholder="Enter plate number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Car Make</label>
                                                        <input type="text" class="form-control" placeholder="Enter car make">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Car Model</label>
                                                        <input type="text" class="form-control" placeholder="Enter car model">
                                                    </div>

                                                    <!-- Second Row -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">Vehicle Type</label>
                                                        <input type="text" class="form-control" placeholder="Enter vehicle type">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Year</label>
                                                        <input type="number" class="form-control" placeholder="Enter year">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sub model</label>
                                                        <input type="text" class="form-control" placeholder="Enter sub model">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Color</label>
                                                        <input type="text" class="form-control" placeholder="Enter color">
                                                    </div>

                                                    <!-- Third Row -->
                                                    <div class="col-md-6">
                                                        <label class="form-label">Fuel Type</label>
                                                        <select class="form-select">
                                                            <option value="GAS">GAS</option>
                                                            <option value="DIESEL">DIESEL</option>
                                                            <option value="ELECTRIC">ELECTRIC</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Transmission Type</label>
                                                        <select class="form-select">
                                                            <option value="AUTOMATIC">AUTOMATIC</option>
                                                            <option value="MANUAL">MANUAL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger mt-3 remove-vehicle">
                                                    <i class="bi bi-trash me-2"></i>Remove
                                                </button>
                                            </div>
                                        </template>

                                             
                                        <!-- Step 5: Information Summary -->
                                        <div class="form-step" id="step5">
                                            <h5 class="mb-4">Information Summary</h5>
                                                      
                                                <!-- Membership Application Summary -->
                                                <div class="card mb-3">
                                                    <div class="card-header bg-light">
                                                        <h6 class="mb-0">Membership Application Details</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Application Type</p>
                                                                <p class="fw-bold" id="summaryApplicationType">-</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Membership Type</p>
                                                                <p class="fw-bold" id="summaryMembershipType">-</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Plan Type</p>
                                                                <p class="fw-bold" id="summaryPlanType">-</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Activation Date</p>
                                                                <p class="fw-bold" id="summaryActivationDate">-</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Personal Information Summary -->
                                                <div class="card mb-3">
                                                    <div class="card-header bg-light">
                                                        <h6 class="mb-0">Personal Information</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <p class="text-muted mb-1">Full Name</p>
                                                                <p class="fw-bold" id="summaryFullName">-</p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="text-muted mb-1">Gender</p>
                                                                <p class="fw-bold" id="summaryGender">-</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Birthdate</p>
                                                                <p class="fw-bold" id="summaryBirthdate">-</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="text-muted mb-1">Civil Status</p>
                                                                <p class="fw-bold" id="summaryCivilStatus">-</p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 mt-2">
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Email Address</p>
                                                                <p class="fw-bold" id="summaryEmail">-</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Mobile Number</p>
                                                                <p class="fw-bold" id="summaryMobile">-</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Contact Information Summary -->
                                                <div class="card mb-3">
                                                    <div class="card-header bg-light">
                                                        <h6 class="mb-0">Contact Information</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Company Name</p>
                                                                <p class="fw-bold" id="summaryCompanyName">-</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Complete Address</p>
                                                                <p class="fw-bold" id="summaryAddress">-</p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 mt-2">
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Mailing Preference</p>
                                                                <p class="fw-bold" id="summaryMailingPreference">-</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="text-muted mb-1">Online AQ Magazine</p>
                                                                <p class="fw-bold" id="summaryMagazine">-</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Vehicle Information Summary -->
                                                <div class="card mb-3">
                                                    <div class="card-header bg-light">
                                                        <h6 class="mb-0">Vehicle Information</h6>
                                                    </div>
                                                    <div class="card-body" id="vehicleSummaryContainer">
                                                        <!-- Vehicle summaries will be inserted here dynamically -->
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary" onclick="previousStep()">Previous</button>
                                                    <button type="submit" class="btn btn-primary">Submit Application</button>
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

    </script>
</body>
</html>