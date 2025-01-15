<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dashboard</title>
    <link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/pidp.css') }}">
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
                                <li class="breadcrumb-item active" data-step="1">License Details</li>
                                <li class="breadcrumb-item" data-step="2">Personal Information</li>
                                <li class="breadcrumb-item" data-step="3">Contact Information</li>
                                <li class="breadcrumb-item" data-step="4">Vehicle Details</li>
                                <li class="breadcrumb-item" data-step="5">Information Summary</li>
                            </ol>
                        </nav>


                        <form id="resellerForm" action="{{ route('new_pidp.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hiddenFormData" name="form_data" value="">
                            @foreach ($errors->all() as $key => $error)
                                <p style="color: red">{{ $key }} : {{ $error }}</p>
                            @endforeach

                            <!-- Step 1:  Membership Application -->
                            <div class="form-step tab active" id="step1">
                                <h5 class="card-title mb-4">License Details</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="license" class="label">License No</label>
                                            <input name="license_details[members_licenseno]" type="text"
                                                class="text-input form-control form-control-sm license_no"
                                                style='text-transform:uppercase' id="license" required>
                                            <div class="validation-message_license" style="color: red;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="expiration" class="Select-label">License Expiration Date</label>
                                            <div class="input-group">
                                                <input name="license_details[members_licenseexpirationdate]" type="date"
                                                    class="Select-input form-control form-control-sm" id="expiration"
                                                    placeholder="DD/MM/YYYY" required>
                                            </div>
                                            <div id="expiration-message" class="text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="card-type" class="Select-label">Card Type</label>
                                            <select name="license_details[members_licensecard]"
                                                class=" form-control form-control-sm " id="card-type" required>
                                                <option disabled selected value="">Select Card Type</option>
                                                <option value="NON-CARD">NON CARD</option>
                                                <option value="CARD">CARD</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="license-type" class="Select-label">License Type</label>
                                            <select name="license_details[members_licensetype]"
                                                class=" form-control form-control-sm " id="license-type" required>
                                                <option disabled selected value="">Select License Type</option>
                                                <option value="NON PROFESSIONAL">NON PROFESSIONAL</option>
                                                <option value="PROFESSIONAL">PROFESSIONAL</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="orcrAttachment" class="form-label">Upload(front and back driver's license) in a single image file.</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="orcrAttachment"
                                                    name="orcr_image"
                                                    onchange="handleFileUpload(this, 'orcr', 'orcrFeedback')" required>
                                                <label class="input-group-text" for="orcrAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            <div id="orcrFeedback" class="text-danger"></div>
                                            <img id="orcr" src="" alt="Image orcr"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="dlcodearray" class="label"></label>
                                            <input value="" name="dlcodearray" type="text"
                                                class="text-input form-control form-control-sm" id="dlcodearray"
                                                autocomplete="off" placeholder=" DLCode" hidden>
                                            <div class="invalid-feedback">This field is</div>
                                        </div>
                                    </div>
                                    <div hidden>
                                        <div class="form-group">
                                            <label for="restric" class="label"></label>
                                            <input value="" name="restric" type="text"
                                                class="text-input form-control form-control-sm" id="restric"
                                                autocomplete="off" placeholder="restric">
                                            <div class="invalid-feedback">This field is</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <label for="" id='choose'>Please Select:</label>
                                        </div>
                                        <div class="col-auto">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="selection" id="dlcode" value="dlcode">
                                                <label class="custom-control-label fw-bold" for="dlcode">DL Codes:</label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="selection" id="restriction" value="restriction">
                                                <label class="custom-control-label fw-bold" for="restriction">Restriction</label>
                                            </div>
                                        </div>
                                    </div>

                                        <div id="selection-error" style="display: none; color: red;">Please select an
                                            option</div>
                                        <div class="col-8">
                                            <div id="restrictions" style="display:none;">
                                                <label for="" class="fw-bold">Restriction:</label><br>
                                                <div class="restriction-checkboxes d-flex gap-5">
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="1" value="1">
                                                        <label class="custom-control-label fw-bold" for="1">1</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="2" value="2">
                                                        <label class="custom-control-label fw-bold" for="2">2</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="3" value="3">
                                                        <label class="custom-control-label fw-bold" for="3">3</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="4" value="4">
                                                        <label class="custom-control-label fw-bold" for="4">4</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="5" value="5">
                                                        <label class="custom-control-label fw-bold" for="5">5</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="6" value="6">
                                                        <label class="custom-control-label fw-bold" for="6">6</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="7" value="7">
                                                        <label class="custom-control-label fw-bold" for="7">7</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                        <input class="checkbox-btn custom-control-input restriction1"
                                                            type="checkbox" name="restriction[]" id="8" value="8">
                                                        <label class="custom-control-label fw-bold" for="8">8</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="dlcodes" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="d-flex fw-bold">DL Codes</label>
                                                <div class="checkbox-container d-flex">
                                                    <div class="custom-card">
                                                        <input
                                                            class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                            type="checkbox" id="restrictionCheckbox1" value="A, A1">
                                                        <label class="custom-control-label fw-bold"
                                                            for="restrictionCheckbox1">A, A1</label>
                                                        <div class="clutchRadioOptionsGroup"
                                                            id="clutchRadioOptionsGroup1" style="display: none;">
                                                            <h6>Clutch</h6>
                                                        <div class="radio-buttons-row d-flex">
                                                            <div class="custom-control custom-radio custom-control-inline radios">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions1"
                                                                    id="clutchRadio1_1" value="option1">
                                                                <label class="custom-control-label fw-bold" id='clutch1_1'
                                                                    for="clutchRadio1_1">MT/AT</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input class="radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions3"
                                                                    id="clutchRadio1_2" value="option2" disabled>
                                                                <label class="custom-control-label fw-bold" for="clutchRadio1_2"
                                                                    data-toggle="tooltip"
                                                                    title="Only MT/AT is permitted.">AT</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="custom-card">
                                                        <input
                                                            class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                            type="checkbox" id="restrictionCheckbox2" value="B, B1, B2">
                                                        <label class="custom-control-label fw-bold"
                                                            for="restrictionCheckbox2">B, B1, B2</label>
                                                        <div class="clutchRadioOptionsGroup" style="display: none;"
                                                            id="clutchRadioOptionsGroup2">
                                                            <h6>Clutch</h6>
                                                        <div class="radio-buttons-row d-flex">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions2"
                                                                    id="clutchRadio2_1" value="option1">
                                                                <label class="custom-control-label fw-bold" id='clutch2_1'
                                                                    for="clutchRadio2_1">MT/AT</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions2"
                                                                    id="clutchRadio2_2" value="option2">
                                                                <label class="custom-control-label fw-bold" id='clutch2_2'
                                                                    for="clutchRadio2_2">AT</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="custom-card">
                                                        <input
                                                            class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                            type="checkbox" id="restrictionCheckbox3" value="C, D">
                                                        <label class="custom-control-label fw-bold"
                                                            for="restrictionCheckbox3">C, D</label>
                                                        <div class="clutchRadioOptionsGroup" style="display: none;"
                                                            id="clutchRadioOptionsGroup3">
                                                            <h6>Clutch</h6>
                                                        <div class="radio-buttons-row d-flex">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions3"
                                                                    id="clutchRadio3_1" value="option1">
                                                                <label class="custom-control-label fw-bold" id='clutch3_1'
                                                                    for="clutchRadio3_1">MT/AT</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions3"
                                                                    id="clutchRadio3_2" value="option2">
                                                                <label class="custom-control-label fw-bold" id='clutch3_2'
                                                                    for="clutchRadio3_2">AT</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="custom-card">
                                                        <input
                                                            class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                            type="checkbox" id="restrictionCheckbox4" value="BE">
                                                        <label class="custom-control-label fw-bold"
                                                            for="restrictionCheckbox4">BE</label>
                                                        <div class="clutchRadioOptionsGroup" style="display: none;"
                                                            id="clutchRadioOptionsGroup4">
                                                            <h6>Clutch</h6>
                                                        <div class="radio-buttons-row d-flex">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions4"
                                                                    id="clutchRadio4_1" value="option1">
                                                                <label class="custom-control-label fw-bold" id='clutch4_1'
                                                                    for="clutchRadio4_1">MT/AT</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions4"
                                                                    id="clutchRadio4_2" value="option2" disabled>
                                                                <label class="custom-control-label fw-bold" id='clutch4_2'
                                                                    for="clutchRadio4_2" data-toggle="tooltip"
                                                                    title="Only MT/AT is permitted.">AT</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="custom-card">
                                                        <input class="dl_restric checkbox-btn custom-control-input"
                                                            type="checkbox" id="restrictionCheckbox5" value="CE">
                                                        <label class="custom-control-label fw-bold"
                                                            for="restrictionCheckbox5">CE</label>
                                                        <div class="clutchRadioOptionsGroup" style="display: none;"
                                                            id="clutchRadioOptionsGroup5">
                                                            <h6>Clutch</h6>
                                                        <div class="radio-buttons-row d-flex">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="sub_dl radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions5"
                                                                    id="clutchRadio5_1" value="option1">
                                                                <label class="custom-control-label fw-bold" id='clutch5_1'
                                                                    for="clutchRadio5_1">MT/AT</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input class="radio-btn custom-control-input"
                                                                    type="radio" name="clutchRadioOptions5"
                                                                    id="clutchRadio5_2" value="option2" disabled>
                                                                <label class="custom-control-label text-danger fw-bold"
                                                                    for="clutchRadio5_2" data-toggle="tooltip"
                                                                    title="Only MT/AT is permitted.">AT</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <div class="navigation-buttons"></div>
                                </div>
                            </div>
                            <!--- End of Step 1 -->




                            <!-- Step 2: Personal Information -->
                            <div class="form-step tab" id="step2" style="margin-left: 1rem; margin-right: 1rem; margin-bottom: 0.45rem; ">
                                <h5 class="card-title mb-4">Personal Information</h5>
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
                                        <label for="plantype" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plan_type]"
                                            required>
                                            @if($selectedPlan)
                                                <option value="{{ $selectedPlan->plan_id }}" selected>
                                                    {{ $selectedPlan->plan_name }} - {{ $selectedPlan->plan_amount }}
                                                </option>
                                            @else
                                                <option value="" selected disabled>Select Plan Type</option>
                                            @endif
                                        </select>
                                        <input type="hidden" name="personal_info[plantype_id]" id="selected_plan_id"
                                            value="{{ $selectedPlan ? $selectedPlan->plan_id : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="idAttachment" class="form-label">ID Image (Upload a valid
                                            government ID)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="idAttachment" name="idpicture"
                                                onchange="handleFileUpload(this, 'valid_id', 'idFeedback')" required>
                                            <label class="input-group-text" for="idAttachment">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                        <div id="idFeedback" class="text-danger"></div>
                                        <img id="valid_id" src="" alt="Image valid_id"
                                            style="max-width: 200px; display: none; margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="title" class="form-label">Title</label>
                                        <select class="form-select" id="title" name="personal_info[members_title]"
                                            required>
                                            <option value="MR">MR.</option>
                                            <option value="MS">MS.</option>
                                            <option value="MRS">MRS.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName"
                                            name="personal_info[members_firstname]" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName"
                                            name="personal_info[members_middlename]">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName"
                                            name="personal_info[members_lastname]" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="personal_info[members_gender]"
                                            required>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" name="personal_info[members_birthdate]"
                                            id="birthdate" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="birthplace" class="form-label">Birth Place</label>
                                        <input type="text" class="form-control" name="personal_info[members_birthplace]"
                                            id="birthplace" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="occupation" class="form-label">Occupation</label>
                                        <input type="text" class="form-control" name="personal_info[occupation_name]"
                                            id="occupation" required>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <!-- <div class="col-md-3">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="personal_info[nationality]" id="nationality">
                                    </div> -->
                                    <div class="col-md-3">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" id="civilStatus"
                                            name="personal_info[members_civilstatus]" required>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="DIVORCED">DIVORCED</option>
                                            <option value="WIDOWED">WIDOWED</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="citizenship" class="form-label">Citizenship</label>
                                        <select type="text" class="form-control" name="personal_info[citizenship]"
                                            id="citizenship" required>
                                            <option value="" selected disabled>Select Citizenship</option>
                                            <option value="filipino" @if (old('personal_info.citizenship') == 'filipino')
                                            {{ 'selected' }} @endif> FILIPINO</option>
                                            <option value="foreigner" @if (old('personal_info.citizenship') == 'foreigner') {{ 'selected' }} @endif>
                                                FOREIGNER</option>
                                        </select>
                                    </div>
                                    <!-- Are you going to JAPAN? -->
                                    <div class="col-md-3">
                                        <label class="form-label">Are you going to JAPAN?</label>
                                        <div>
                                            <input type="radio" id="goingToJapanYes" name="going_to_japan" value="YES"> <label for="goingToJapanYes">YES</label>
                                            <input type="radio" id="goingToJapanNo" name="going_to_japan" value="NO"> <label for="goingToJapanNo">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 toggle-container d-none" id="japanFields">
                                    
                                    <!-- Destination and Purpose of Travel -->
                                    
                                        <div class="col-md-4">
                                            <label for="destination" class="form-label">Destination</label>
                                            <input type="text" class="form-control" id="destination" name="travel_info[destination]">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="purpose" class="form-label">Purpose of Travel</label>
                                            <select class="form-select" id="purpose" name="travel_info[purpose]">
                                                <option value="">Select Purpose</option>
                                                <option value="Tourism and Work">Tourism and Work</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>


                                    <!-- Departure and Return Dates -->
                               
                                    <div class="col-md-4">
                                        <label for="departureDate" class="form-label">Departure Date</label>
                                        <input type="date" class="form-control" id="departureDate" name="travel_info[departure_date]">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="returnDate" class="form-label">Return Date</label>
                                        <input type="date" class="form-control" id="returnDate" name="travel_info[return_date]" >
                                    </div>


                                <!-- Are you going to another country aside JAPAN? -->
                                
                                    <div class="col-md-6">
                                        <label for="anotherCountry" class="form-label">Are you going to another country aside JAPAN?</label>
                                        <input type="text" class="form-control" id="anotherCountry" name="travel_info[another_country]">
                                    </div>
 

                                <!-- Notes -->

                                    <div class="col-md-12">
                                        <p id="noteTourism" class="text-danger d-none">Note: For Marketing Purposes Only</p>
                                        <p id="noteJapanFee" class="text-danger d-none">NOTE: Additional ₱600.00 for Multiple PIDP</p>
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
                                        <select class="form-select" name="personal_info[mailing_preference]" id="mail"
                                            required>
                                            <option value="HOME">HOME</option>
                                            <option value="OFFICE">OFFICE</option>
                                        </select>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-3">Home Address</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="street" class="form-label">Building No. / Street</label>
                                        <input type="text" class="form-control" name="personal_info[street]" id="street"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="town" class="form-label">Barangay / Towns</label>
                                        <input type="text" class="form-control" name="personal_info[town]" id="town"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="city" class="form-label">City/Municipality</label>
                                        <input type="text" class="form-control" name="personal_info[city]" id="city"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="province" class="form-label">Province</label>
                                        <input type="text" class="form-control" name="personal_info[province]"
                                            id="province" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="zcode" class="form-label">Zip</label>
                                        <input type="text" class="form-control" name="personal_info[zcode]" id="zcode"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                                        <select class="form-select" name="personal_info[availMagazine]"
                                            id="availMagazine" required>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control" name="personal_info[members_mobileno]"
                                            id="mobileNumber" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="alternateMobile" class="form-label">Alternate Mobile
                                            Number</label>
                                        <input type="tel" class="form-control"
                                            name="personal_info[members_alternate_mobileno]" id="alternateMobile">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="emailAddress" class="form-label">Email Address</label>
                                        <input type="email" class="form-control"
                                            name="personal_info[members_emailaddress]" id="emailAddress" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="alternateEmail" class="form-label">Alternate Email
                                            Address</label>
                                        <input type="email" class="form-control"
                                            name="personal_info[members_alternate_emailaddress]" id="alternateEmail">
                                    </div>
                                </div>
                                <div class="pt-5" id="officeAddress" style="display: none;">
                                    <h5 class="mt-4 mb-3">Office Address</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-7">
                                            <label for="street" class="form-label">Building No. / Street</label>
                                            <input type="text" class="form-control" name="personal_info[street1]"
                                                id="street1">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="town" class="form-label">Barangay / Towns</label>
                                            <input type="text" class="form-control" name="personal_info[town1]"
                                                id="town1">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label for="city" class="form-label">City/Municipality</label>
                                            <input type="text" class="form-control" name="personal_info[city1]"
                                                id="city1">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="province" class="form-label">Province</label>
                                            <input type="text" class="form-control" name="personal_info[province1]"
                                                id="province1">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="zcode" class="form-label">Zip</label>
                                            <input type="text" class="form-control" name="personal_info[zcode1]"
                                                id="zcode1">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-9">
                                            <label for="companyName" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" name="personal_info[comname]"
                                                id="comname">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="telephoneNumber" class="form-label">Telephone
                                                Number</label>
                                            <input type="tel" class="form-control"
                                                name="personal_info[members_alternate_tel]" id="telephoneNumber">
                                        </div>
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
                                                <input type="text" id="plate_number" name="vehicle_plate[]"
                                                    class="form-control" placeholder="Enter plate number">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Car Make</label>
                                                <select class="form-control form-control-sm select2_notdynamic"
                                                    id="make" name="vehicle_make[]" required>
                                                    <option value="" selected>Car Make</option>
                                                    @foreach ($carMake as $row2)
                                                        <option value="{{ $row2['brand'] }}">
                                                            {{ strtoupper($row2['brand']) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Car Models</label>
                                                <select class="form-control select2_notdynamic" id="model"
                                                    name="vehicle_model[]">
                                                    <option value="" selected>Car Model</option>
                                                </select>
                                            </div>

                                            <!-- Second Row -->
                                            <div class="col-md-3">
                                                <label class="form-label">Vehicle Type</label>
                                                <select class="form-control select2_notdynamic" id="vehicle_type"
                                                    name="vehicle_type[]">
                                                    <option value="" selected>Vehicle Type</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Year</label>
                                                <input type="number" id="year" name="vehicle_year[]"
                                                    class="form-control" placeholder="Enter year">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Sub model</label>
                                                <input type="text" id="submodel" name="submodel[]" class="form-control"
                                                    placeholder="Enter sub model">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Color</label>
                                                <input type="text" id="color" name="vehicle_color[]"
                                                    class="form-control" placeholder="Enter color">
                                            </div>

                                            <!-- Third Row -->
                                            <div class="col-md-3">
                                                <label class="form-label">Fuel Type</label>
                                                <select class="form-select" name="vehicle_fuel[]">
                                                    <option value="GAS">GAS</option>
                                                    <option value="DIESEL">DIESEL</option>
                                                    <option value="ELECTRIC">ELECTRIC</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Transmission Type</label>
                                                <select class="form-select" name="vehicle_transmission[]">
                                                    <option value="AUTOMATIC">AUTOMATIC</option>
                                                    <option value="MANUAL">MANUAL</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="orAttachment" class="form-label">Upload: Official Receipt</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="orAttachment"
                                                            name="upload_receipt"
                                                            onchange="handleFileUpload(this, 'or', 'orFeedback')"
                                                            required>
                                                        <label class="input-group-text" for="orAttachment">
                                                            <i class="fas fa-upload"></i>
                                                        </label>
                                                    </div>
                                                    <div id="orFeedback" class="text-danger"></div>
                                                    <img id="or" src="" alt="Image or" style="max-width: 200px; display: none; margin-top: 10px;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="crAttachment" class="form-label">Upload: Certificate of Registration</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="crAttachment"
                                                            name="cr_image" onchange="handleFileUpload(this, 'cr', 'crFeedback')" required>
                                                        <label class="input-group-text" for="crAttachment">
                                                            <i class="fas fa-upload"></i>
                                                        </label>
                                                    </div>
                                                    <div id="crFeedback" class="text-danger"></div>
                                                    <img id="cr" src="" alt="Image cr" style="max-width: 200px; display: none; margin-top: 10px;">
                                                </div>
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
    <script src="/script/pidp.js"></script>
    <script src="/script/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const applyButtons = document.querySelectorAll('.apply-now');
                const planTypeSelect = document.getElementById('plantype');
                const selectedPlanIdInput = document.getElementById('selected_plan_id');

                applyButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const planId = this.getAttribute('data-plan-id');
                        const planName = this.getAttribute('data-plan-name');

                        // Set the select dropdown to the corresponding plan
                        planTypeSelect.value = planId;

                        // Set the hidden input with the plan ID
                        selectedPlanIdInput.value = planId;
                    });
                });
            });
        </script>
    @endpush
    <script>
        $(document).ready(function () {
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


        //for are you going to japan
        document.addEventListener('DOMContentLoaded', function () {
        const goingToJapanYes = document.getElementById('goingToJapanYes');
        const goingToJapanNo = document.getElementById('goingToJapanNo');
        const japanFields = document.getElementById('japanFields');
        const destinationField = document.getElementById('destination').closest('.col-md-4');
        const purposeField = document.getElementById('purpose').closest('.col-md-4');
        const departureDateField = document.getElementById('departureDate').closest('.col-md-4');
        const returnDateField = document.getElementById('returnDate').closest('.col-md-4');
        const anotherCountryField = document.getElementById('anotherCountry').closest('.col-md-6');
        const noteJapanFee = document.getElementById('noteJapanFee');
        const noteTourism = document.getElementById('noteTourism');

        // Function to update visibility of fields
        function updateFormFields() {
            if (goingToJapanYes.checked) {
                // Show all fields if 'Yes' is selected
                japanFields.classList.remove('d-none');
                destinationField.classList.remove('d-none');
                purposeField.classList.remove('d-none');
                departureDateField.classList.remove('d-none');
                returnDateField.classList.remove('d-none');
                anotherCountryField.classList.remove('d-none');
                noteJapanFee.classList.remove('d-none');
                noteTourism.classList.add('d-none');  // Hide tourism note if not applicable
            } else if (goingToJapanNo.checked) {
                // Show only destination and purpose fields when 'No' is selected
                japanFields.classList.remove('d-none');
                destinationField.classList.remove('d-none');
                purposeField.classList.remove('d-none');
                departureDateField.classList.add('d-none'); // Hide departure date
                returnDateField.classList.add('d-none'); // Hide return date
                anotherCountryField.classList.add('d-none'); // Hide "another country" field
                noteJapanFee.classList.add('d-none'); // Hide Japan fee note
                noteTourism.classList.remove('d-none'); // Show tourism note for "No" (optional)
            }
        }

        // Event listeners to handle Yes/No selection changes
        goingToJapanYes.addEventListener('change', updateFormFields);
        goingToJapanNo.addEventListener('change', updateFormFields);

        // Initial state check (in case the page loads with 'No' selected)
        updateFormFields();
    });


    </script>
</body>

</html>