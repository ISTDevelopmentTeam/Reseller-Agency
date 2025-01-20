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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('style/new_reseller.css') }}">
</head>

<body>
    @include("layout.sidebar");
    @include("layout.nav");


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


                        <form id="resellerForm" action="{{ route('reseller.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hiddenFormData" name="form_data" value="">
                            @foreach ($errors->all() as $key => $error)
                                <p style="color: red">{{ $key }} : {{ $error }}</p>
                            @endforeach

                            <!-- Step 1:  Membership Application -->
                            <div class="form-step tab active" id="step1">
                                <button class="btn btn-primary customer-fillout-btn"
                                    onclick="window.open('{{ route('customer_qr') }}', '_blank')">
                                    <i class="fas fa-qrcode me-2"></i>"Customer/Client Form QR"  
                                </button>
                                <h5 class="card-title mb-4">Membership Application</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="applicationType" class="form-label">Type of Application</label>
                                        <select class="form-select" id="applicationType" required>
                                            <option value="NEW" selected>NEW</option>
                                            <!-- <option value="RENEWAL" selected>RENEWAL</option> -->

                                        </select>
                                    </div>


                                    <!--- Step 1 of Input textfield -->

                                    <div class="col-md-3 mb-3">
                                        <label for="membershiptype" class="form-label">Type of
                                            Membership</label>
                                        <select class="form-select" id="membershiptype" name="personal_info[membership_type]" required>
                                            <option value="" selected disabled>Select Type of Membership </option>
                                            @foreach ($packages['members'] as $members_type)
                                                <option value="{{ $members_type->membership_name }}" 
                                                        data-membership="{{ $members_type->membership_id }}"
                                                        data-vehicle_num="{{ $members_type->vehicle_num }}">
                                                    {{ $members_type->membership_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="plantype" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plan_type]" required>
                                            <option value="" selected disabled>Select Plan Type</option>
                                            @foreach ($packages['plantype'] as $plan)
                                                <option value="{{ $plan->plan_name }}"
                                                    data-membership="{{ $plan->membership_id }}"
                                                    data-plan-id="{{ $plan->plan_id}}" style="display: none;">
                                                    {{ $plan->plan_name }} - ₱ {{ $plan->plan_amount }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="personal_info[plantype_id]" id="selected_plan_id">
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

                                    <!-- Attachment fields -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="orcrAttachment" class="form-label">ORCR Image (Upload a clear
                                                image of the ORCR)</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="orcrAttachment" name="orcr_image" onchange="handleFileUpload(this, 'orcr', 'orcrFeedback')" required>
                                                <label class="input-group-text" for="orcrAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            <div id="orcrFeedback" class="text-danger"></div>
                                            <img id="orcr" src="" alt="Image orcr"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="idAttachment" class="form-label">ID Image (Upload a valid
                                                government ID)</label>
                                            <div class="input-group">
                                            <input type="file" class="form-control" id="idAttachment" name="idpicture" onchange="handleFileUpload(this, 'valid_id', 'idFeedback')" required>
                                                <label class="input-group-text" for="idAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            <div id="idFeedback" class="text-danger"></div>
                                            <img id="valid_id" src="" alt="Image valid_id"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <div class="navigation-buttons"></div>
                                    </div>
                                </div>
                            </div>
                            <!--- End of Step 1 -->




                            <!-- Step 2: Personal Information -->
                            <div class="form-step tab" id="step2">
                                <h5 class="mb-4">Personal Information</h5>

                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="title" class="form-label">Title</label>
                                        <select class="form-select" id="title" name="personal_info[members_title]" required>
                                            <option value="MR">MR.</option>
                                            <option value="MS">MS.</option>
                                            <option value="MRS">MRS.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="personal_info[members_firstname]" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="personal_info[members_middlename]">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="personal_info[members_lastname]" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="personal_info[members_gender]" required>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" name="personal_info[members_birthdate]" id="birthdate" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthplace" class="form-label">Birth Place</label>
                                        <input type="text" class="form-control" name="personal_info[members_birthplace]" id="birthplace" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="citizenship" class="form-label">Citizenship</label>
                                        <select type="text" class="form-control" name="personal_info[citizenship]" id="citizenship" required>
                                        <option value="" selected disabled>Select Citizenship</option>
                                        <option value="filipino" @if (old('personal_info.citizenship') == 'filipino') {{ 'selected' }} @endif> FILIPINO</option>
                                        <option value="foreigner" @if (old('personal_info.citizenship') == 'foreigner') {{ 'selected' }} @endif> FOREIGNER</option>    
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="personal_info[nationality]" id="nationality">
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label for="acrNo" class="form-label">ACR No.</label>
                                        <input type="text" class="form-control" name="" id="acrNo">
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" id="civilStatus" name="personal_info[members_civilstatus]" required>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="DIVORCED">DIVORCED</option>
                                            <option value="WIDOWED">WIDOWED</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" name="personal_info[occupation_name]" id="occupation" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control" name="personal_info[members_mobileno]" id="mobileNumber" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="emailAddress" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="personal_info[members_emailaddress]" id="emailAddress" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="telephoneNumber" class="form-label">Telephone
                                            Number</label>
                                        <input type="tel" class="form-control" name="personal_info[members_alternate_tel]" id="telephoneNumber">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="alternateMobile" class="form-label">Alternate Mobile
                                            Number</label>
                                        <input type="tel" class="form-control" name="personal_info[members_alternate_mobileno]" id="alternateMobile">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="alternateEmail" class="form-label">Alternate Email
                                            Address</label>
                                        <input type="email" class="form-control" name="personal_info[members_alternate_emailaddress]" id="alternateEmail">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="navigation-buttons"></div>
                                </div>
                            </div>

                            <!-- End of Step 2 -->


                            <!-- Step 3: Contact Information Section -->
                            <div class="form-step tab" id="step3">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="mail" class="form-label">Mailing Preference</label>
                                        <select class="form-select" name="personal_info[mailing_preference]" id="mail" required>
                                            <option value="HOME">HOME</option>
                                            <option value="OFFICE">OFFICE</option>
                                        </select>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-3">Home Address</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="street" class="form-label">Building No. / Street</label>
                                        <input type="text" class="form-control" name="personal_info[street]" id="street" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="town" class="form-label">Barangay / Towns</label>
                                        <input type="text" class="form-control" name="personal_info[town]" id="town" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="city" class="form-label">City/Municipality</label>
                                        <input type="text" class="form-control" name="personal_info[city]" id="city" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="province" class="form-label">Province</label>
                                        <input type="text" class="form-control" name="personal_info[province]" id="province" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="zcode" class="form-label">Zip</label>
                                        <input type="text" class="form-control" name="personal_info[zcode]" id="zcode" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                                        <select class="form-select" name="personal_info[availMagazine]" id="availMagazine" required>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pt-5" id="officeAddress" style="display: none;">
                                <h5 class="mt-4 mb-3">Office Address</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="companyName" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" name="personal_info[comname]" id="comname">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="street" class="form-label">Building No. / Street</label>
                                            <input type="text" class="form-control" name="personal_info[street1]" id="street1">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="town" class="form-label">Barangay / Towns</label>
                                            <input type="text" class="form-control" name="personal_info[town1]" id="town1">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city" class="form-label">City/Municipality</label>
                                            <input type="text" class="form-control" name="personal_info[city1]" id="city1">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="province" class="form-label">Province</label>
                                            <input type="text" class="form-control" name="personal_info[province1]" id="province1">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zcode" class="form-label">Zip</label>
                                            <input type="text" class="form-control" name="personal_info[zcode1]" id="zcode1">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="officePhone" class="form-label">Office Phone
                                                Number</label>
                                            <input type="tel" class="form-control" name="personal_info[officePhone]" id="officePhone">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="navigation-buttons"></div>
                                </div>
                            </div>
                            <!-- End of Step 3 -->

                            <!-- Step 4: Vehicle Information -->
                            <div class="form-step tab" id="step4">
                                <h5 class="mb-4">Vehicle Details</h5>
                                <div id="vehicleFields">
                                    <!-- Initial Vehicle Form -->
                                    <div class="vehicle-item border rounded p-3 mb-3">
                                        <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                        <div class="row g-3">
                                            <!-- First Row -->
                                            <div class="col-md-3">
                                                <label class="form-label">Conduction Sticker</label>
                                                <select class="form-select" name="is_cs[]">
                                                    <option value="0">NO</option>
                                                    <option value="1">YES</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Plate Number</label>
                                                <input type="text" id="plate_number" name="vehicle_plate[]" class="form-control"
                                                    placeholder="Enter plate number">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Car Make</label>
                                                <select class="form-control form-control-sm select2_notdynamic" id="make" name="vehicle_make[]"
                                                    required>
                                                    <option value="" selected>Car Make</option>
                                                    @foreach ($carMake as $row2)
                                                        <option value="{{ $row2['brand'] }}">{{ strtoupper($row2['brand']) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Car Models</label>
                                                <select class="form-control select2_notdynamic" id="model" name="vehicle_model[]">
                                                <option value="" selected>Car Model</option>
                                                </select>
                                            </div>

                                            <!-- Second Row -->
                                            <div class="col-md-3">
                                                <label class="form-label">Vehicle Type</label>
                                                <select class="form-control select2_notdynamic" id="vehicle_type" name="vehicle_type[]">
                                                    <option value="" selected>Vehicle Type</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Year</label>
                                                <input type="number" id="year" name="vehicle_year[]" class="form-control"
                                                    placeholder="Enter year">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Sub model</label>
                                                <input type="text" id="submodel" name="submodel[]" class="form-control"
                                                    placeholder="Enter sub model">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Color</label>
                                                <input type="text" id="color" name="vehicle_color[]" class="form-control"
                                                    placeholder="Enter color">
                                            </div>

                                            <!-- Third Row -->
                                            <div class="col-md-6">
                                                <label class="form-label">Fuel Type</label>
                                                <select class="form-select" name="vehicle_fuel[]">
                                                    <option value="GAS">GAS</option>
                                                    <option value="DIESEL">DIESEL</option>
                                                    <option value="ELECTRIC">ELECTRIC</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Transmission Type</label>
                                                <select class="form-select" name="vehicle_transmission[]">
                                                    <option value="AUTOMATIC">AUTOMATIC</option>
                                                    <option value="MANUAL">MANUAL</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Vehicle Button -->
                                <button type="button" class="btn btn-primary mt-3" id="addVehicle">
                                    <i class="bi bi-plus-circle me-2"></i>Add Item
                                </button>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="navigation-buttons"></div>
                                </div>
                            </div>


                            <!-- Step 5: Information Summary -->
                            <div class="form-step tab" id="step5">
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
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Title</p>
                                                <p class="fw-bold" id="summaryTitle">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">First Name</p>
                                                <p class="fw-bold" id="summaryFirstname">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Last Name</p>
                                                <p class="fw-bold" id="summaryLastname">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Middle Name</p>
                                                <p class="fw-bold" id="summaryMiddlename">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Gender</p>
                                                <p class="fw-bold" id="summaryGender">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Birthdate</p>
                                                <p class="fw-bold" id="summaryBirthdate">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Birthplace</p>
                                                <p class="fw-bold" id="summaryBirthplace">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Civil Status</p>
                                                <p class="fw-bold" id="summaryCivilstatus">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Citizenship</p>
                                                <p class="fw-bold" id="summaryCitizenship">-</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="text-muted mb-1">Occupation</p>
                                                <p class="fw-bold" id="summaryOccupation">-</p>
                                            </div>
                                        </div>
                                        <!-- <div class="row g-3">
                                           
                                        </div>
                                        <div class="row g-3">
                                            
                                        </div> -->
                                    </div>
                                </div>

                                <!-- Contact Information Summary -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Contact Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <!-- <div class="col-md-6">
                                                <p class="text-muted mb-1">Company Name</p>
                                                <p class="fw-bold" id="summaryCompanyName">-</p>
                                            </div> -->
                                            <div class="col-md-12">
                                                <p class="text-muted mb-1">Home Address</p>
                                                <p class="fw-bold" id="summaryhomeaddress">-</p>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-8">
                                                <p class="text-muted mb-1">Office Address</p>
                                                <p class="fw-bold" id="summaryofficeaddress">-</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-muted mb-1">Company Name</p>
                                                <p class="fw-bold" id="summaryCompanyName">-</p>
                                            </div>
                                        </div>
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-8">
                                                <p class="text-muted mb-1">Mailing Preference</p>
                                                <p class="fw-bold" id="summaryMailingPreference">-</p>
                                            </div>
                                            <div class="col-md-4">
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

                                <div>
                                    <div class="previous">
                                        <!-- Previous button will be inserted here -->
                                    </div>
                                    <div class="next">
                                        <!-- Next button will be inserted here -->
                                    </div>
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
<script src="/script/reg_reseller.js"></script>
<script src="/script/sidebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    <script>
$(document).ready(function() {
    $('.select2_notdynamic').select2({
        placeholder: 'Search...',
        searchable: true
    });
});


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