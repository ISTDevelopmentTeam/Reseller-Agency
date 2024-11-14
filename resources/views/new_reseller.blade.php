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
    <link rel="stylesheet" href="/link/jquery-ui.css">
    <link rel="stylesheet" href="/style/new_reseller.css">
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
                                        <!--Step 1:  Membership Application -->
                                        <div class="form-step active" id="step1">
                                            <button class="btn btn-primary customer-fillout-btn"
                                                onclick="window.open('{{ route('customer_qr') }}', '_blank')">
                                                <i class="fas fa-user-edit me-2"></i>Customer Fill-out
                                            </button>
                                            <h5 class="card-title mb-4">Membership Application</h5>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="applicationType" class="form-label">Type of
                                                        Application</label>
                                                    <select class="form-select" id="applicationType" required>
                                                        <option value="NEW" selected>NEW</option>
                                                        <option value="RENEWAL" selected>RENEWAL</option>

                                                    </select>
                                                </div>


                                                <!--- Step 1 of Input textfield -->

                                                <div class="col-md-3 mb-3">
                                                    <label for="membership_type" class="form-label">Type of
                                                        Membership</label>
                                                    <select class="form-select" id="membership_type"
                                                        name="membership_id">
                                                        <option value="" selected disabled>Select Type of Membership
                                                        </option>
                                                        @foreach ($packages['members'] as $members_type)
                                                            <option value="{{ $members_type->membership_id }}"
                                                                data-vehicle_num="{{ $members_type->vehicle_num }}">
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
                                                            <option value="{{ $plan->plan_name }}"
                                                                data-membership="{{ $plan->membership_id }}"
                                                                style="display: none;">
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
                                                    <label for="activationDate" class="form-label">Activation
                                                        Date</label>
                                                    <input type="date" class="form-control" id="activationDate"
                                                        required>
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

                                                <!-- Attachment fields -->
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="orcrAttachment" class="form-label">ORCR
                                                            Image</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="orcrAttachment" 
                                                            name="orcr_image" accept="image/png, image/jpeg, image/jpg" required>
                                                            <label class="input-group-text" for="orcrAttachment">
                                                                <i class="fas fa-upload"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-text">Upload a clear image of the ORCR</div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="idAttachment" class="form-label">ID Image</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="idAttachment"
                                                                name="id_image" accept="image/png, image/jpeg, image/jpg" required>
                                                            <label class="input-group-text" for="idAttachment">
                                                                <i class="fas fa-upload"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-text">Upload a valid government ID</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end mt-4">
                                                    <button type="button" class="btn btn-primary" id="step_1_button"
                                                        >Next</button>
                                                </div>
                                            </div>
                                        </div>
                                                <!--- End of Step 1 -->




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
                                                    <label for="telephoneNumber" class="form-label">Telephone
                                                        Number</label>
                                                    <input type="tel" class="form-control" id="telephoneNumber">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="alternateMobile" class="form-label">Alternate Mobile
                                                        Number</label>
                                                    <input type="tel" class="form-control" id="alternateMobile">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="alternateEmail" class="form-label">Alternate Email
                                                        Address</label>
                                                    <input type="email" class="form-control" id="alternateEmail">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="officePhone" class="form-label">Office Phone
                                                        Number</label>
                                                    <input type="tel" class="form-control" id="officePhone">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" id="step_2_button">Next</button>
                                            </div>
                                        </div>

                                        <!-- End of Step 2 -->






                                        <!-- Step 3: Contact Information Section -->
                                        <div class="form-step" id="step3">
                                            <h5 class="mt-4 mb-3">Office Address</h5>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="searchOfficeTown" class="form-label">Search Town</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="searchOfficeTown"
                                                            placeholder="Search town...">
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
                                                    <label for="street" class="form-label">Building No. / Street</label>
                                                    <input type="text" class="form-control" id="street" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="town" class="form-label">Barangay / Towns</label>
                                                    <input type="text" class="form-control" id="town" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="city" class="form-label">City/Municipality</label>
                                                    <input type="text" class="form-control" id="city" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">

                                                <div class="col-md-3">
                                                    <label for="province" class="form-label">Province</label>
                                                    <input type="text" class="form-control" id="province" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="zcode" class="form-label">Zip</label>
                                                    <input type="text" class="form-control" id="zcode" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mailingPreference" class="form-label">Mailing
                                                        Preference</label>
                                                    <select class="form-select" id="mailingPreference" required>
                                                        <option value="HOME">HOME</option>
                                                        <option value="OFFICE">OFFICE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="availMagazine" class="form-label">Avail Online AQ
                                                        Magazine</label>
                                                    <select class="form-select" id="availMagazine" required>
                                                        <option value="YES">YES</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="previousStep()">Previous</button>
                                                <button type="button" id="step_3_button" class="btn btn-primary">Next</button>
                                            </div>
                                        </div>
                                        <!-- End of Step 3 -->





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
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="previousStep()">Previous</button>
                                                <button type="button" class="btn btn-primary" onclick="summary_fetch()">Next</button>
                                            </div>
                                        </div>

                                        <!-- Vehicle Template (hidden) -->
                                        <template id="vehicleTemplate">
                                            <div class="vehicle-item border rounded p-3 mb-3">
                                                <h6 class="mb-3">Vehicle<span class="vehicle-number">1</span></h6>
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
                                                        <input type="text" id="plate_number" class="form-control"
                                                            placeholder="Enter plate number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Car Make</label>
                                                        <input type="text" id="car_make" class="form-control"
                                                            placeholder="Enter car make">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Car Models</label>
                                                        <input type="text" id="car_model" class="form-control"
                                                            placeholder="Enter car model">
                                                    </div>

                                                    <!-- Second Row -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">Vehicle Type</label>
                                                        <input type="text" id="vechile_type" class="form-control"
                                                            placeholder="Enter vehicle type">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Year</label>
                                                        <input type="number" id="car_year_model" class="form-control"
                                                            placeholder="Enter year">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sub model</label>
                                                        <input type="text" id="sub_model" class="form-control"
                                                            placeholder="Enter sub model">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Color</label>
                                                        <input type="text" id="color" class="form-control"
                                                            placeholder="Enter color">
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
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="previousStep()">Previous</button>
                                                <button type="submit" class="btn btn-primary">Submit
                                                    Application</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="footer-text">
                    Copyright © 2024 Automobile Association of the Philippines
                    </div>
                </footer>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="/script/new_reseller.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
// Step 1 Validation
$('#step_1_button').on('click', function() {

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






        </script>




    <script>
        $(document).ready(function () {
            var towns = @json($towns);
            $("#town").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    var term = request.term;
                    var filteredTowns = towns.filter(function (town) {
                        return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                    });
                    var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                    response(limitedTowns.map(function (town) {
                        return {
                            label: town.az_barangay + " - " + town.city_name + ", " + town.district_name,
                            value: town.az_barangay
                        };
                    }));
                },
                select: function (event, ui) {
                    var selectedTown = towns.find(function (town) {
                        return town.az_barangay === ui.item.value;
                    });
                    $("#town").val(decodeHtml(selectedTown.az_barangay));
                    $("#city").val(decodeHtml(selectedTown.city_name));
                    $("#province").val(decodeHtml(selectedTown.district_name));
                    $("#zcode").val(decodeHtml(selectedTown.az_zipcode));
                    return false;
                }
            })
                .autocomplete("instance")._renderItem = function (ul, item) {
                    return $("<li>")
                        .attr("data-value", item.value)
                        .append(item.label)
                        .appendTo(ul);
                };
        });

        var citys = @json($citys);

        // AutoComplete Home Address (City)
        $("#city").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var term = request.term;
                var filteredCity = citys.filter(function (city) {
                    return city.city_name.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedCity = filteredCity.slice(0, 10); // Limiting to first 10 items
                response(limitedCity.map(function (city) {
                    return {
                        label: city.city_name + " - " + city.district_name,
                        value: city.city_name
                    };
                }));
            },
            select: function (event, ui) {
                var selectedCity = citys.find(function (city) {
                    return city.city_name === ui.item.value;
                });
                if (selectedCity) {
                    $("#city").val(decodeHtml(selectedCity.city_name));
                    $("#province").val(decodeHtml(selectedCity.district_name));
                    $("#zcode").val(decodeHtml(selectedCity.az_zipcode));
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .attr("data-value", item.value)
                .append(item.label)
                .appendTo(ul);
        };

        function decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }
    </script>
</body>

</html>