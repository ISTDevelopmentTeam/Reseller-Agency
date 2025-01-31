<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseller</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/pidp.css') }}">
</head>

<body>
    @include('layout.sidebar')
    @include('layout.nav')
    <style>
.error-label {
            color: #dc3545 !important; /* Added !important to ensure style takes precedence */
            transition: color 0.3s ease;
        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-11"> <!-- Adjusted column width -->
                <div class="card-header custom-header mb-3 text-center">
                    <h2 class="header-title mb-0 typewriter">New PIDP Form</h2>
                    <p class="header-subtitle text-muted">Please provide your details below to complete the process</p>
                </div>
                <form id="resellerForm" action="{{ route('new_pidp.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $key => $error)
                        <p style="color: red">{{ $key }} : {{ $error }}</p>
                    @endforeach
                    <!-- Card 1: License Details -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">License Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license" class="label">License No</label>
                                    <input name="personal_info[members_licenseno]" type="text"
                                        class="text-input form-control form-control-sm license_no"
                                        style='text-transform:uppercase' id="license" autocomplete="off"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="13" placeholder="###-##-######" required>
                                    <div class="validation-message_license" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiration" class="Select-label">License Expiration Date</label>
                                    <div class="input-group">
                                        <input name="personal_info[members_licenseexpirationdate]" type="text"
                                            class="Select-input form-control form-control-sm" autocomplete="off" id="expiration"
                                            placeholder="DD/MM/YYYY" required>
                                    </div>
                                    <div id="expiration-message" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Card Type -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="card-type" class="form-label">Card Type</label>
                                        <select name="personal_info[members_licensecard]"
                                            class="form-control form-control-sm" id="card-type" required>
                                            <option disabled selected value="">Select Card Type</option>
                                            <option value="NON-CARD">NON CARD</option>
                                            <option value="CARD">CARD</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <!-- License Type -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="license-type" class="form-label">License Type</label>
                                        <select name="personal_info[members_licensetype]"
                                            class="form-control form-control-sm" id="license-type" required>
                                            <option disabled selected value="">Select License Type</option>
                                            <option value="NON PROFESSIONAL">NON PROFESSIONAL</option>
                                            <option value="PROFESSIONAL">PROFESSIONAL</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <!-- ID Image -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idLicense" class="form-label">Please upload front & back of
                                            license as one image only.</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control form-control-sm" id="idLicense"
                                                name="imglicense"
                                                onchange="handleGeneralFileUpload(this, 'license_id', 'licenseFeedback')"
                                                required>
                                            <label class="input-group-text" for="idLicense">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                        <div id="licenseFeedback" class="text-danger"></div>
                                        <img id="license_id" src="" alt="Image license_id"
                                            style="max-width: 200px; display: none; margin-top: 10px;">
                                    </div>
                                </div>

                                <!-- Hidden Fields -->
                                <div class="col-md-4" >
                                    <div class="form-group" hidden>
                                        <label for="dlcodearray" class="form-label">DL Code</label>
                                        <input value="" name="dlcodearray" type="text"
                                            class="form-control form-control-sm" id="dlcodearray" autocomplete="off"
                                            placeholder="DL Code">
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                </div>
                                <div class="col-md-4" hidden>
                                    <div class="form-group">
                                        <label for="restric" class="form-label">Restriction</label>
                                        <input value="" name="restric" type="text" class="form-control form-control-sm"
                                            id="restric" autocomplete="off" placeholder="Restriction">
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row align-items-center mt-3">
                                    <div class="col-auto">
                                        <label for="" id='choose'>Please Select:</label>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="selection"
                                                id="dlcode" value="dlcode">
                                            <label class="custom-control-label fw-bold" for="dlcode">DL Codes</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="selection"
                                                id="restriction" value="restriction">
                                            <label class="custom-control-label fw-bold" for="restriction">Restriction</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div id="selection-error" style="display: none; color: red;">Please select an
                                    option</div> --}}
                                    <div class="col-8">
                                        <div id="restrictions" style="display:none;">
                                            <label for="" id="restrictionLabel" class="fw-bold">Restriction:</label><br>
                                            <div class="restriction-checkboxes d-flex gap-5">
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="1" value="1">
                                                    <label class="custom-control-label fw-bold" for="1">1</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="2" value="2">
                                                    <label class="custom-control-label fw-bold" for="2">2</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="3" value="3">
                                                    <label class="custom-control-label fw-bold" for="3">3</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="4" value="4">
                                                    <label class="custom-control-label fw-bold" for="4">4</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="5" value="5">
                                                    <label class="custom-control-label fw-bold" for="5">5</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="6" value="6">
                                                    <label class="custom-control-label fw-bold" for="6">6</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="7" value="7">
                                                    <label class="custom-control-label fw-bold" for="7">7</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline checkboxes">
                                                    <input class="checkbox-btn custom-control-input restriction1" type="checkbox" name="restriction[]" id="8" value="8">
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
                                        <div id="restrictionNumberValue" hidden></div>
                                        <div class="checkbox-container d-flex">
                                            <div class="custom-card">
                                                <input
                                                    class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                    type="checkbox" id="restrictionCheckbox1" value="A, A1">
                                                <label class="custom-control-label fw-bold"
                                                    for="restrictionCheckbox1">A, A1</label>
                                                <div class="clutchRadioOptionsGroup" id="clutchRadioOptionsGroup1"
                                                    style="display: none;">
                                                    <h6>Clutch</h6>
                                                    <div class="radio-buttons-row d-flex">
                                                        <div
                                                            class="custom-control custom-radio custom-control-inline radios">
                                                            <input class="sub_dl radio-btn custom-control-input"
                                                                type="radio" name="clutchRadioOptions1"
                                                                id="clutchRadio1_1" value="option1">
                                                            <label class="custom-control-label fw-bold" id='clutch1_1'
                                                                for="clutchRadio1_1">MT/AT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="radio-btn custom-control-input" type="radio"
                                                                name="clutchRadioOptions3" id="clutchRadio1_2"
                                                                value="option2" disabled>
                                                            <label class="custom-control-label fw-bold"
                                                                for="clutchRadio1_2" data-toggle="tooltip"
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
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="sub_dl radio-btn custom-control-input"
                                                                type="radio" name="clutchRadioOptions2"
                                                                id="clutchRadio2_1" value="option1">
                                                            <label class="custom-control-label fw-bold" id='clutch2_1'
                                                                for="clutchRadio2_1">MT/AT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
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
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="sub_dl radio-btn custom-control-input"
                                                                type="radio" name="clutchRadioOptions3"
                                                                id="clutchRadio3_1" value="option1">
                                                            <label class="custom-control-label fw-bold" id='clutch3_1'
                                                                for="clutchRadio3_1">MT/AT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
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
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="sub_dl radio-btn custom-control-input"
                                                                type="radio" name="clutchRadioOptions4"
                                                                id="clutchRadio4_1" value="option1">
                                                            <label class="custom-control-label fw-bold" id='clutch4_1'
                                                                for="clutchRadio4_1">MT/AT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="radio-btn custom-control-input" type="radio"
                                                                name="clutchRadioOptions4" id="clutchRadio4_2"
                                                                value="option2" disabled>
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
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="sub_dl radio-btn custom-control-input"
                                                                type="radio" name="clutchRadioOptions5"
                                                                id="clutchRadio5_1" value="option1">
                                                            <label class="custom-control-label fw-bold" id='clutch5_1'
                                                                for="clutchRadio5_1">MT/AT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="radio-btn custom-control-input" type="radio"
                                                                name="clutchRadioOptions5" id="clutchRadio5_2"
                                                                value="option2" disabled>
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
                        <br>

                    </div>

                    <!-- Card 2: Personal Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <!-- Are you going to JAPAN? -->
                        <div class="row p-0">
                            <div class="col-md-6 japanRadio travel-card" id="travel_card" style="text-align: center;">
                                <div class="bordered1" id='japanoption'>
                                    <label class="japanLabel">Are you going to JAPAN?</label>
                                    <div class="radioGroup d-flex" style="justify-content: center;">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="option1"
                                                id="yesRadio" value="yes">
                                            <label class="custom-control-label japanLabel" for="yesRadio">YES</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                            <input class="custom-control-input" type="radio" name="option1" id="noRadio"
                                                value="no">
                                            <label class="custom-control-label japanLabel" for="noRadio">NO</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3" style="display: none">
                                        <label for="membershiptype" class="form-label">Type of Membership</label>
                                        <select class="form-select" id="membershiptype" name="personal_info[membership_type]" required>
                                            @if($selectedMembership)
                                                <option value="{{ $selectedMembership->membership_name }}" 
                                                        data-vehicle_num="{{ $selectedMembership->vehicle_num }}" 
                                                        selected>
                                                    {{ $selectedMembership->membership_name }}
                                                </option>
                                            @else
                                                <option value="" selected disabled>Select Plan Type</option>
                                            @endif
                                        </select>
                                        @error('personal_info.membership_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12" id="japanNoPlan" style="text-align: left; display: none;">
                                        <label for="plantype" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plantype_id]"
                                            required>
                                            @if($selectedPlan)
                                                <option value="{{ $selectedPlan->plan_id }}" selected>
                                                    {{ $selectedPlan->plan_name }} - {{ $selectedPlan->plan_amount }}
                                                </option>
                                            @else
                                                <option value="" selected disabled>Select Plan Type</option>
                                            @endif
                                        </select>
                                        {{-- THIS CONDITION IS FOR WARNING TEXT IF THE PLANTYPE IS NOT ANNUAL PLAN  --}}
                                        @if($selectedPlan && ($selectedPlan->plan_id == 9 || $selectedPlan->plan_id == 10))
                                        <small style="color: orange !important; margin-top: 10px; display: block;">Most countries permit only a one-year duration, and Japan offers only an Annual Year.
                                        </small>
                                        @endif
                                        {{-- THIS JUST FOR HIDDEN PLAN TYPE THAT GET PLAN TYPE ID --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="collapsibleYesJapan" style="display: none; text-align: center;">
                                <div class="bordered1 mt-1" id="bordered1">
                                    <label class="japanLabel">Are you going to another country aside JAPAN?</label>
                                    <div class="radioGroup d-flex" style="justify-content: center;">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="option2"
                                                id="yesDropdown" value="yes">
                                            <label for="yesDropdown" class="custom-control-label japanLabel">YES</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                            <input class="custom-control-input" type="radio" name="option2"
                                                id="noDropdown" value="no" style="margin-left: 1rem;">
                                            <label for="noDropdown" class="custom-control-label japanLabel">NO</label>
                                        </div>
                                    </div>
                                    <p><b style="color:red;">NOTE: </b>Additional ₱ 600.00 for multiple PIDP.</p>
                                    <input value="JAPAN" name="japan_only" type="text" class="text-input form-control form-control-sm" id="auto_japan" autocomplete="off"
                                    placeholder=" Enter occupation" hidden>
                                    <div class="p-2" id="travelDestination1" style="display: none; text-align: left;">
                                        <label class="m-1" for="destinationIn">Destination</label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Enter Destination" name="destinationIn" id="destinationIn">
                                        <div class="invalid-feedback"></div>
                                        <br>
                                        <div id="dremarks" style="color:red;"></div>
                                    </div>
                                    <div class="p-2" style="text-align: left;" id="purpose_ofw">
                                        <label for="members_purposetravel1" class="Select-label">Purpose of
                                            Travel</label>
                                        <select name="purposetravel" class="form-control form-control-sm"
                                            id="members_purposetravel1">
                                            <option value="" selected disabled> Select Purpose</option>
                                            <option value="Tourism">Tourism</option>
                                            <option value="Work">Work</option>
                                        </select>
                                        <div class="invalid-feedback">This field is required</div>
                                        <div class="ofw1" style="display:none; text-align:center; margin-top:1rem;"
                                            id='option_ofw1'>
                                            <label for="ofw_yes1">Are you an OFW?</label>
                                            <div class="text-center justify-content-center d-flex" id="op_ofw1">
                                                <!-- <div class="text-center justify-content-center d-flex"> -->
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="ofw"
                                                        id="ofw_yes1" value="yes">
                                                    <label for="ofw_yes1" class="custom-control-label"
                                                        id="ofww1">YES</label>
                                                </div>
                                                <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                                    <input class="custom-control-input" type="radio" name="ofw"
                                                        id="ofw_no1" value="no">
                                                    <label for="ofw_no1" class="custom-control-label"
                                                        id="ofww11">NO</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="date_depart1" style="display:none;" id="optional_date1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="Select-label mt-3">Departure Date (OPTIONAL)</label>
                                                    <input type="text" name="departure_date1" id="departure_date1"
                                                        class="form-control form-control-sm" maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        inputmode="numeric" autocomplete="off"
                                                        placeholder="MM/DD/YYYY" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="Select-label mt-3">Return Date (OPTIONAL)</label>
                                                    <input type="text" name="return_date1" id="return_date1"
                                                        class="form-control form-control-sm" maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        inputmode="numeric" autocomplete="off"
                                                        placeholder="MM/DD/YYYY" />
                                                </div>
                                            </div>
                                            <p id="note_depart_return" style="color: orange;">Note: For Marketing
                                                Purposes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="nojapan">
                                <div class="bordered1 p-3 form-group" id="travelDestination" style="display: none;">
                                    <label class="m-1" for="destinationOut"
                                        style="text-align: left;">Destination</label>
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="Enter Destination" name="destinationOut" id="destinationOut">
                                    <br>
                                    <div id="dremarks1" style="color:red;"></div>
                                    <div class="form-group mt-1">
                                        <label for="members_purposetravel" class="Select-label">Purpose of
                                            Travel</label>
                                        <select name="purposetravel" class="form-control form-control-sm"
                                            id="members_purposetravel">
                                            <option value="" selected disabled> Select Purpose</option>
                                            <option value="Tourism">Tourism</option>
                                            <option value="Work">Work</option>
                                        </select>
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <div class="ofw" style="display:none; text-align:center; margin-top:1rem;"
                                        id='option_ofw'>
                                        <label for="ofw_yes">Are you an OFW?</label>
                                        <div id="op_ofw">
                                            <div class="text-center justify-content-center d-flex">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="ofw"
                                                        id="ofw_yes" value="yes">
                                                    <label for="ofw_yes" class="custom-control-label japanLabel"
                                                        id="ofww">YES</label>
                                                </div>
                                                <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                                    <input class="custom-control-input" type="radio" name="ofw"
                                                        id="ofw_no" value="no">
                                                    <label for="ofw_no" class="custom-control-label japanLabel"
                                                        id="ofww">NO</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="date_p" style="display:none;" id="optional_date">
                                        <!-- <label class="Select-label mt-3">Departure and Return Date (OPTIONAL)</label> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="Select-label mt-3">Departure(OPTIONAL)</label>
                                                <input type="text" name="departure_date" id="departure_date"
                                                    class="form-control form-control-sm" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                    inputmode="numeric" autocomplete="off" placeholder="MM/DD/YYYY" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="Select-label mt-3">Return Date (OPTIONAL)</label>
                                                <input type="text" name="return_date" id="return_date"
                                                    class="form-control form-control-sm" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                    inputmode="numeric" autocomplete="off" placeholder="MM/DD/YYYY" />
                                            </div>
                                        </div>
                                        <p id="note_depart_return" style="color: orange;">Note: For Marketing Purposes
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- NO 1 Checkbox -->
                                <div class="container mt-5" id="Nojapan" style="display: none; text-align: justify;">
                                    <div class="col-12 bordered1" id="no_japan">
                                        <div class="formCheck d-flex">
                                            <input name="hereby3" value="1" class="check-input" type="checkbox" id="checkbox21">
                                            <label class="form-check-label p-3" for="checkbox21">
                                                I hereby declare that I have read and understood the additional
                                                information about
                                                this country. I also fully acknowledge the contents of the WAIVER,
                                                RELEASE and
                                                CONSENT (link to waiver). Furthermore, I voluntarily and willingly
                                                execute the
                                                WAIVER, RELEASE and QUITCLAIM with full knowledge of my rights under the
                                                law.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- YES 2 Checkbox -->
                                <div class="container mt-5" id="dropDownYes" style="display: none; text-align: justify;">
                                    <div class="col-12 mb-3 bordered1" id="japan_other_country">
                                        <div class="formCheck d-flex" id="gc2">
                                            <input name="hereby4" class="check-input" type="checkbox" id="checkbox22">
                                            <label class="form-check-label p-3" for="checkbox22">
                                                I hereby declare that I have read and understood the additional
                                                information about
                                                this country. I also fully acknowledge the contents of the WAIVER,
                                                RELEASE and
                                                CONSENT (link to waiver). Furthermore, I voluntarily and willingly
                                                execute the
                                                WAIVER, RELEASE and QUITCLAIM with full knowledge of my rights under the
                                                law.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- YES JAPAN AND OTHER COUNTRY-->
                                <div class="form-check" id="dropDownYes1" style="display: none;">
                                    <div class="col-12 mb-3 bordered1" id="japan_other_country1">
                                        <div class="formCheck d-flex" id="gc1">
                                            <input name="hereby2" class="check-input" value="1" type="checkbox" id="checkbox">
                                            <label class="form-check-label p-3" for="checkbox">
                                                I hereby declare that I have read the and have fully understood its
                                                contents. I
                                                further declare that I voluntarily and willingly executed the full
                                                knowledge of my
                                                rights under the law.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- YES NO JAPAN-->
                                <div class="form-check" id="dropDownNo" style="display: none;">
                                    <div class="col-12 mb-3 bordered1" id="japan_only">
                                        <div class="formCheck d-flex" id="gc1">
                                            <input name="hereby1" class="check-input" value="1" type="checkbox" id="checkbox1">
                                            <label class="form-check-label p-3" for="checkbox1"
                                                style="font-weight: 400;">I
                                                hereby declare that I
                                                have read the and have fully
                                                understood its contents. I further declare that I voluntarily and
                                                willingly executed
                                                the WAIVER, RELEASE and QUITCLAIM full knowledge of my rights under the
                                                law.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Agreement -->
                                <div id="waiverModal" class="modal">
                                    <!--waiver content -->
                                    <div class="waiver-content">
                                        <h2 class="waiver-title">WAIVER AND RELEASE</h2>
                                        <p>In consideration of renewing my Philippine International Driving Permit
                                            (PIDP) from the
                                            Automobile
                                            Association Philippines (AAP) here and after referred to as “The
                                            Association”, I agree
                                            to the following:</p>
                                        <p>I have been fully informed that the Japanese Government prohibits the use of
                                            International Driving Permit
                                            (IDP) for more than one (1) year within Japan. If an IDP expires, the holder
                                            will be
                                            required to stay outside of
                                            Japan for at least three (3) months before his/her new IDP will be honored
                                            as a valid
                                            driving permit in Japan.</p>
                                        <p>That I have been informed of the inherent risk of using my Philippine
                                            International
                                            Driving Permit (PIDP) in
                                            Japan in connection with the above-stated provisions or laws of the Japanese
                                            Government.
                                        </p>
                                        <p>That I <b>WAIVE AND RELEASE </b> to the fullest extent permitted by law the
                                            Association
                                            and/or its employees from
                                            all liability whatsoever, from any claims or causes of action that I, my
                                            estate, heirs,
                                            executors or assigns may
                                            have for personal injury or otherwise, including any direct and/or
                                            consequential
                                            damages, which result or
                                            arise from the issuance or renewal of Philippine International Driving
                                            Permit (PIDP),
                                            whether caused by the
                                            negligence or fault of either the Association or its employees, or otherwise
                                        </p>
                                        <p>The Association has given me the full opportunity to ask any and all
                                            questions about the
                                            renewal of my
                                            Philippine International Driving Permit (PIDP) and all of my questions have
                                            been
                                            answered to my total
                                            satisfaction.</p>
                                        <p>I agree to reimburse the Association for any Attorney’s fees and cost
                                            incurred in any
                                            legal action to bring
                                            against either the Association or its employees and in which either the
                                            Association or
                                            its employees is the
                                            prevailing party.</p>
                                        <p>I acknowledge that I have been given adequate opportunity to read and
                                            understand and that
                                            it was not
                                            presented to me at the last minute, nor was I in duress or unlawful
                                            influence when
                                            agreeing, and I understand
                                            that I am agreeing to a legal contract waiving certain rights to recover
                                            against the
                                            Association and its
                                            employees</p>
                                        <p>I hereby declare that I have read this Waiver and Release and have fully
                                            understood its
                                            contents. I further
                                            declare that I am of legal age and competent to consent to this agreement.
                                            Furthermore,
                                            I declare that I
                                            voluntarily and willingly executed the RELEASE, WAIVER and QUITCLAIM with
                                            full knowledge
                                            of my rights
                                            under the law.</p>
                                        <div class="row" id="waiver1">
                                            <div class="col-12">
                                                <div class="formCheck d-flex align-items-center" id="pidp_waiver">
                                                    <input class="check-input" type="checkbox" id="checkbox_waiver1">
                                                    <label class="form-check-label p-3" for="checkbox_waiver1">By
                                                        clicking I AGREE,
                                                        I hereby agree to all the terms and conditions stated in this
                                                        Waiver and
                                                        Release.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="waiver2">
                                            <div class="col-12">
                                                <div class="formCheck d-flex align-items-center" id="pidp_waiver">
                                                    <input class="check-input" type="checkbox" id="checkbox_waiver2">
                                                    <label class="form-check-label p-3" for="checkbox_waiver2">By
                                                        clicking I AGREE,
                                                        I hereby agree to all the terms and conditions stated in this
                                                        Waiver and
                                                        Release.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-danger closeBtn">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="title" class="form-label">Title</label>
                                    <select class="form-select" id="title" name="personal_info[members_title]" required>
                                        <option value="" {{ !old('personal_info.members_title') ? 'selected' : '' }} disabled>Select Title</option>
                                        @foreach(['MR', 'MS', 'MRS', 'ATTY', 'DR', 'ENGR'] as $title)
                                            <option value="{{ $title }}" {{ old('personal_info.members_title') == $title ? 'selected' : '' }}>
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('personal_info.members_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="firstName" class="form-label letters_only_fname">First Name</label>
                                    <input type="text" class="form-control letters_only_fname" id="firstName"
                                       name="personal_info[members_firstname]"
                                       value="{{ old('personal_info.members_firstname') }}" required>
                                    @error('personal_info.members_firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="validation-message_fname" style="color: red;"></div>
                                </div>
                                <div class="col-md-3">
                                    <label for="middleName" class="form-label letters_only_mname">Middle Name</label>
                                    <input type="text" class="form-control letters_only_mname" id="middleName"
                                       name="personal_info[members_middlename]"
                                       value="{{ old('personal_info.members_middlename') }}">
                                    @error('personal_info.members_middlename')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                <div class="validation-message_mname" style="color: red;"></div>
                                </div>
                                <div class="col-md-3">
                                    <label for="lastName" class="form-label letters_only_lname">Last Name</label>
                                    <input type="text" class="form-control letters_only_lname" id="lastName"
                                       name="personal_info[members_lastname]"
                                       value="{{ old('personal_info.members_lastname') }}" required>
                                    @error('personal_info.members_lastname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="validation-message_lname" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="personal_info[members_gender]" required>
                                        <option value="" {{ !old('personal_info.members_gender') ? 'selected' : '' }} disabled>Select a Gender</option>
                                        <option value="MALE" {{ old('personal_info.members_gender') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                        <option value="FEMALE" {{ old('personal_info.members_gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                    </select>
                                    @error('personal_info.members_gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input type="text" class="form-control" name="personal_info[members_birthdate]"
                                       id="birthdate" autocomplete="off" placeholder="MM/DD/YYYY" maxlength="10"
                                       value="{{ old('personal_info.members_birthdate') }}" required>
                                    @error('personal_info.members_birthdate')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="birthplace" class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" name="personal_info[members_birthplace]"
                                       id="birthplace" value="{{ old('personal_info.members_birthplace') }}" required>
                                    @error('personal_info.members_birthplace')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" name="personal_info[occupation_name]"
                                       id="occupation" value="{{ old('personal_info.occupation_name') }}" required>
                                @error('personal_info.occupation_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="civilStatus" class="form-label">Civil Status</label>
                                    <select class="form-select" id="civilStatus" name="personal_info[members_civilstatus]" required>
                                        <option value="" {{ !old('personal_info.members_civilstatus') ? 'selected' : '' }} disabled>Select Civil Status</option>
                                        @foreach(['SINGLE', 'MARRIED', 'WIDOWED'] as $status)
                                            <option value="{{ $status }}" {{ old('personal_info.members_civilstatus') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('personal_info.members_civilstatus')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="citizenship" class="form-label">Citizenship</label>
                                    <select class="form-select" name="personal_info[citizenship]" id="citizenship" required>
                                        <option value="" {{ !old('personal_info.citizenship') ? 'selected' : '' }} disabled>Select Citizenship</option>
                                        <option value="filipino" {{ old('personal_info.citizenship') == 'filipino' ? 'selected' : '' }}>FILIPINO</option>
                                        <option value="foreigner" {{ old('personal_info.citizenship') == 'foreigner' ? 'selected' : '' }}>FOREIGNER</option>
                                    </select>
                                    @error('personal_info.citizenship')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3" id="add_info"
                                    style="{{ old('personal_info.citizenship') == 'foreigner' ? '' : 'display: none;' }}">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <input type="text" class="form-control" name="personal_info[nationality]"
                                       id="nationality" value="{{ old('personal_info.nationality') }}">
                                    @error('personal_info.nationality')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="idAttachment" class="form-label">ID Image (Upload a valid
                                        government ID)</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="idAttachment" name="idpicture"
                                            onchange="handleGeneralFileUpload(this, 'valid_id', 'idFeedback')" required>
                                        <label class="input-group-text" for="idAttachment">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <div id="idFeedback" class="text-danger"></div>
                                    <img id="valid_id" src="" alt="Image valid_id"
                                        style="max-width: 200px; display: none; margin-top: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Card 3: Contact Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-2">Contact Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="mail" class="form-label">Mailing Preference</label>
                                <select class="form-select" name="personal_info[mailing_preference]" id="mail" required>
                                    <option value="" {{ !old('personal_info.mailing_preference') ? 'selected' : '' }} disabled>Select Mailing Address</option>
                                    <option value="HOUSE ADDRESS" {{ old('personal_info.mailing_preference') == 'HOUSE ADDRESS' ? 'selected' : '' }}>HOUSE ADDRESS</option>
                                    <option value="OFFICE ADDRESS" {{ old('personal_info.mailing_preference') == 'OFFICE ADDRESS' ? 'selected' : '' }}>OFFICE ADDRESS</option>
                                </select>
                                @error('personal_info.mailing_preference')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mt-2 mb-2">Home Address</h5>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="street" class="form-label">Building No. / Street</label>
                                <input type="text" class="form-control" name="personal_info[members_haddress1]"
                                    id="street" value="{{ old('personal_info.members_haddress1') }}" required>
                                    @error('personal_info.members_haddress1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="town" class="form-label">Barangay / Towns</label>
                                <input type="text" class="form-control" name="personal_info[members_haddress2]"
                                    id="town" value="{{ old('personal_info.members_haddress2') }}" required>
                                    @error('personal_info.members_haddress2')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City/Municipality</label>
                                <input type="text" class="form-control" name="personal_info[members_housecity]"
                                    id="city" value="{{ old('personal_info.members_housecity') }}" required>
                                    @error('personal_info.members_housecity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" name="personal_info[members_housedistrict]"
                                    id="province" value="{{ old('personal_info.members_housedistrict') }}" required>
                                @error('personal_info.members_housedistrict')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="zcode" class="form-label">Zip</label>
                                <input type="text" class="form-control number_only" maxlength="4" name="personal_info[members_housezipcode]"
                                    id="zcode" value="{{ old('personal_info.members_housezipcode') }}" required>
                                @error('personal_info.members_housezipcode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                                <select class="form-select" name="personal_info[is_aq]" id="availMagazine"
                                    required>
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="mobileNumber" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control phone-input"
                                    name="personal_info[members_mobileno]" id="mobileNumber"
                                    data-error-container="error-msg-1" data-valid-container="valid-msg-1"
                                    data-code-input="ccode-1" value="{{ old('personal_info.members_mobileno') }}"
                                    required>
                                <span id="valid-msg-1" class="hide valid-msg"></span>
                                <span id="error-msg-1" class="hide error-msg"></span>
                                @error('personal_info.members_mobileno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="alternateMobile" class="form-label">Alternate Mobile
                                    Number</label>
                                    <input type="tel" class="form-control phone-input"
                                    name="personal_info[members_alternate_mobileno]" id="alternateMobile"
                                    data-error-container="error-msg-2" data-valid-container="valid-msg-2"
                                    data-code-input="ccode-2"
                                    value="{{ old('personal_info.members_alternate_mobileno') }}">
                                <span id="valid-msg-2" class="hide valid-msg"></span>
                                <span id="error-msg-2" class="hide error-msg"></span>
                                @error('personal_info.members_alternate_mobileno')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="personal_info[members_emailaddress]"
                                    id="emailAddress" value="{{ old('personal_info.members_emailaddress') }}" required>
                                @error('personal_info.members_emailaddress')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="alternateEmail" class="form-label">Alternate Email
                                    Address</label>
                                    <input type="email" class="form-control"
                                    name="personal_info[members_alternate_emailaddress]" id="alternateEmail"
                                    value="{{ old('personal_info.members_alternate_emailaddress') }}">
                                @error('personal_info.members_alternate_emailaddress')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="pt-5" id="officeAddress" style="display: none;">
                            <h5 class="mt-4 mb-3">Office Address</h5>
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <label for="street" class="form-label">Building No. / Street</label>
                                    <input type="text" class="form-control" name="personal_info[members_oaddress1]"
                                        id="street1" value="{{ old('personal_info.members_oaddress1') }}">
                                    @error('personal_info.members_oaddress1')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="town" class="form-label">Barangay / Towns</label>
                                    <input type="text" class="form-control" name="personal_info[members_oaddress2]"
                                    id="town1" value="{{ old('personal_info.members_oaddress2') }}">
                                @error('personal_info.members_oaddress2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="city" class="form-label">City/Municipality</label>
                                    <input type="text" class="form-control" name="personal_info[members_officecity]"
                                        id="city1" value="{{ old('personal_info.members_officecity') }}">
                                    @error('personal_info.members_officecity')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" name="personal_info[members_officedistrict]"
                                        id="province1" value="{{ old('personal_info.members_officedistrict') }}">
                                    @error('personal_info.members_officedistrict')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="zcode" class="form-label">Zip</label>
                                    <input type="text" class="form-control number_only" name="personal_info[members_officezipcode]"
                                        id="zcode1" maxlength="4" value="{{ old('personal_info.members_officezipcode') }}">
                                    @error('personal_info.members_officezipcode')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="companyName" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="personal_info[members_businessname]"
                                        id="comname" value="{{ old('personal_info.members_businessname') }}">
                                    @error('personal_info.members_businessname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="telephoneNumber" class="form-label">Telephone
                                        Number</label>
                                        <input type="tel" class="form-control number_only" name="personal_info[tele_num]"
                                        id="telephoneNumber" onkeyup="maskTelNo(this.id)" value="{{ old('personal_info.tele_num') }}">
                                    @error('personal_info.tele_num')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Vehicle Details -->
                    <div class="card bordered">
                        <h5 class="mb-4">Vehicle Details</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="vehicle-ownership-container p-2 mb-3"
                                    style="
                                    background-color: #f0f8ff;
                                    border: 2px solid #4682b4;
                                    border-radius: 8px;
                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                    margin-bottom: 20px;
                                    text-align: center;
                                ">
                                    <h2
                                        style="
                                        font-size: 1.2rem;
                                        font-weight: bold;
                                        color: #00008b;
                                    ">
                                        Vehicle Ownership
                                    </h2>
                                    <div class="form-group">
                                        <label for="vehicleOwnership" style="font-size: medium;">Do you have a vehicle here in the Philippines?</label>
                                        <div class="d-flex justify-content-center">
                                            <input type="hidden" id="with_vehicle" name="with_vehicle" value="no">
                                            <div class="form-check mr-3">
                                                <input class="form-check-input" type="radio" name="vehicleOwnership"
                                                    id="vehicleOwnershipYes" value="yes" onchange="toggleVehicleDetails(this)">
                                                <label class="form-check-label" for="vehicleOwnershipYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="vehicleOwnership"
                                                    id="vehicleOwnershipNo" value="no" onchange="toggleVehicleDetails(this)">
                                                <label class="form-check-label" for="vehicleOwnershipNo">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="vehicleFields" class="vehicle-entry" style="display: none;">
                            <!-- Initial Vehicle Form -->
                            <div class="vehicle-item border rounded p-3 mb-3">
                                <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                <div class="row g-3">
                                    <!-- First Row -->
                                    <div class="col-md-4 centered-content">
                                        <label class="label" style="font-size: medium;">
                                            Is Conduction Sticker Available?
                                        </label>
                                        <input type="hidden" id="csticker" name="is_cs[]"
                                            value="{{ old('is_cs.0', '0') }}">
                                        <div>
                                            <div class="options-container">
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="csticker_yes" value="1" {{ old('is_cs.0') == '1' ? 'checked' : '' }}
                                                        onchange="updateLabeldyna('csticker_yes', 'csticker_no')">
                                                    <span class="checkmark"></span>
                                                    YES
                                                </label>
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="csticker_no" value="0" {{ old('is_cs.0') == '0' ? 'checked' : '' }}
                                                        onchange="updateLabeldyna('csticker_no', 'csticker_yes')" {{ old('is_cs.0') == '1' ? '' : 'checked disabled' }} checked
                                                        disabled>
                                                    <span class="checkmark"></span>
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                        @error('is_cs.*')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="platenum" class="label">Plate No</label>
                                        <input name="vehicle_plate[]" type="text"
                                            class="text-input form-control form-control-sm platenum @error('vehicle_plate.*') is-invalid @enderror"
                                            id="platenum" value="{{ old('vehicle_plate.0') }}" autocomplete="off"
                                            placeholder="Enter Plate No" style="text-transform: uppercase;" 
                                            data-input-type="plate"> <!-- Added data attribute to track input type -->
                                        @error('vehicle_plate.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="validation-message_plateno" style="color: red;"></div>
                                    </div>

                                    <div class="col-md-3 centered-content">
                                        <label class="label" style="font-size: medium;">
                                            Is Diplomat?
                                        </label>
                                        <input type="hidden" id="is_diplomat_1" name="is_diplomat[]"
                                            value="{{ old('is_diplomat.0', '0') }}">
                                        <div>
                                            <div class="options-container">
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="is_diplomat_yes_1" value="1" {{ old('is_diplomat.0') == '1' ? 'checked' : '' }}
                                                        onchange="update_diplomat('is_diplomat_yes_1', 'is_diplomat_no_1')">
                                                    <span class="checkmark"></span>
                                                    YES
                                                </label>
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="is_diplomat_no_1" value="0" {{ old('is_diplomat.0') == '0' ? 'checked' : '' }}
                                                        onchange="update_diplomat('is_diplomat_no_1', 'is_diplomat_yes_1')"
                                                        {{ old('is_diplomat.0') == '1' ? '' : 'checked disabled' }}>
                                                    <span class="checkmark"></span>
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Car Make</label>
                                        <select
                                            class="form-control form-control-sm select2 @error('vehicle_make.*') is-invalid @enderror"
                                            id="make1" name="vehicle_make[]" >
                                            <option value="" selected>Car Make</option>
                                            @foreach ($carMake as $row2)
                                                <option value="{{ $row2['brand'] }}" {{ old('vehicle_make.0') == $row2['brand'] ? 'selected' : '' }}>
                                                    {{ strtoupper($row2['brand']) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_make.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Car Models</label>
                                        <select
                                            class="form-control select2 @error('vehicle_model.*') is-invalid @enderror"
                                            id="model1" name="vehicle_model[]" >
                                            <option value="" selected>Car Model</option>
                                            <!-- Models will be populated via JavaScript -->
                                            @if (old('vehicle_model.0'))
                                                <option value="{{ old('vehicle_model.0') }}" selected>
                                                    {{ old('vehicle_model.0') }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('vehicle_model.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Second Row -->
                                    <div class="col-md-3">
                                        <label class="form-label">Vehicle Type</label>
                                        <select
                                            class="form-control select2 @error('vehicle_type.*') is-invalid @enderror"
                                            id="vehicle_type1" name="vehicle_type[]" >
                                            <option value="" selected>Vehicle Type</option>
                                            <!-- Vehicle types will be populated via JavaScript -->
                                            @if (old('vehicle_type.0'))
                                                <option value="{{ old('vehicle_type.0') }}" selected>
                                                    {{ old('vehicle_type.0') }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('vehicle_type.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" id="year1" name="vehicle_year[]" maxlength="4"
                                            class="form-control number_only @error('vehicle_year.*') is-invalid @enderror"
                                            value="{{ old('vehicle_year.0') }}" placeholder="Enter year" >
                                        @error('vehicle_year.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Sub model</label>
                                        <input type="text" id="submodel1" name="submodel[]"
                                            class="form-control @error('submodel.*') is-invalid @enderror"
                                            value="{{ old('submodel.0') }}" placeholder="Enter sub model" >
                                        @error('submodel.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" id="color" name="vehicle_color[]"
                                            class="form-control @error('vehicle_color.*') is-invalid @enderror"
                                            value="{{ old('vehicle_color.0') }}" placeholder="Enter color" >
                                        @error('vehicle_color.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Third Row -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fuel Type</label>
                                        <select class="form-select @error('vehicle_fuel.*') is-invalid @enderror"
                                            name="vehicle_fuel[]" >
                                            <option disabled selected value="">Fuel Type</option>
                                            @foreach (['GAS', 'DIESEL', 'ELECTRIC'] as $fuel)
                                                <option value="{{ $fuel }}" {{ old('vehicle_fuel.0') == $fuel ? 'selected' : '' }}>
                                                    {{ $fuel }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_fuel.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Transmission Type</label>
                                        <select
                                            class="form-select @error('vehicle_transmission.*') is-invalid @enderror"
                                            name="vehicle_transmission[]" >
                                            <option disabled selected value="">Select Transmission Type</option>
                                            @foreach (['AUTOMATIC', 'MANUAL'] as $transmission)
                                                <option value="{{ $transmission }}" {{ old('vehicle_transmission.0') == $transmission ? 'selected' : '' }}>
                                                    {{ $transmission }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_transmission.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="orAttachment" class="form-label">Upload: Official
                                                Receipt</label>
                                            <div class="input-group">
                                                <input type="file"
                                                    class="form-control @error('or_image.*') is-invalid @enderror"
                                                    id="orAttachment" name="or_image[]"
                                                    onchange="handleVehicleFileUpload(this, 'or', 'orFeedback')" >
                                                <label class="input-group-text" for="orAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            @error('or_image.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div id="orFeedback" class="text-danger"></div>
                                            <img id="or" src="" alt="Image or"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="crAttachment" class="form-label">Upload: Certificate of
                                                Registration</label>
                                            <div class="input-group">
                                                <input type="file"
                                                    class="form-control @error('cr_image.*') is-invalid @enderror"
                                                    id="crAttachment" name="cr_image[]"
                                                    onchange="handleVehicleFileUpload(this, 'cr', 'crFeedback')" >
                                                <label class="input-group-text" for="crAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            @error('cr_image.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div id="crFeedback" class="text-danger"></div>
                                            <img id="cr" src="" alt="Image cr"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-primary" id="addVehicle">
                                <i class="bi bi-plus-circle me-2"></i>Add another vehicle
                            </button>
                            <button type="submit" class="btn btn-primary rounded" id="submit_btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('script/reseller_side/pidp.js') }}"></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    @include('countrycode')
    @include('flatpickr_date')
    <script>
        $(document).ready(function () {
            $('.license_no').mask('AAA-AA-AAAAAA', {
                translation: {
                    'A': { pattern: /[A-Za-z0-9]/ }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var towns = @json($towns);
            $("#town").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    var term = request.term;
                    var filteredTowns = towns.filter(function (town) {
                        return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -
                            1;
                    });
                    var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                    response(limitedTowns.map(function (town) {
                        return {
                            label: town.az_barangay + " - " + town.city_name + ", " + town
                                .district_name,
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
    <!-- AutoComplete Office Address(Brg/Town) -->
    <script>
        var towns = @json($towns);

        $("#town1").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var term = request.term;
                var filteredTowns = towns.filter(function (town) {
                    return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                response(limitedTowns.map(function (town) {
                    return {
                        label: town.az_barangay + " - " + town.city_name + ", " + town
                            .district_name,
                        value: town.az_barangay
                    };
                }));
            },
            select: function (event, ui) {
                var selectedTown = towns.find(function (town) {
                    return town.az_barangay === ui.item.value;
                });
                if (selectedTown) {
                    $("#town1").val(decodeHtml(selectedTown.az_barangay));
                    $("#city1").val(decodeHtml(selectedTown.city_name));
                    $("#province1").val(decodeHtml(selectedTown.district_name));
                    $("#zcode1").val(decodeHtml(selectedTown.az_zipcode));
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

        // AutoComplete Home Address (Municipality/City)
        $("#city1").autocomplete({
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
                    $("#city1").val(decodeHtml(selectedCity.city_name));
                    $("#province1").val(decodeHtml(selectedCity.district_name));
                    $("#zcode1").val(decodeHtml(selectedCity.az_zipcode));
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
    <script>
        var destinations = @json($destinations);

        $("#destinationIn").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var term = request.term;
                var filteredDestinations = destinations.filter(function (destination) {
                    return destination.ad_name.toLowerCase().indexOf(term.toLowerCase()) !== -1 && destination.ad_name.toLowerCase().indexOf("japan") === -1;
                });
                var limitedDestinations = filteredDestinations.slice(0, 10);
                response(limitedDestinations.map(function (destination) {
                    return {
                        label: destination.ad_name,
                        value: destination.ad_id,
                        destination: destination.ad_name,
                        remarks: destination.ad_remarks
                    };
                }));
            },
            select: function (event, ui) {
                $("#destinationIn").val(decodeHtml(ui.item.destination));
                $("#dremarks").text(decodeHtml(ui.item.remarks));
                if (ui.item.remarks) {
                    $('#dropDownYes').show();
                    $('#checkbox, #checkbox22').prop('required', true);
                } else {
                    $('#dropDownYes').hide();
                    $('#checkbox, #checkbox22').prop('required', false);
                }

                $('#checkbox').change(function () {
                    if (this.checked) {
                        // $('#waiver2').hide();
                        $('#checkbox_waiver1').prop('required', true);
                    } else {
                        $('#checkbox_waiver1').prop('required', false);
                    }
                });

                $("input").trigger("select");
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .attr("data-value", item.value)
                .append(item.label)
                .appendTo(ul);
        };

        var destinations = @json($destinations);

        $("#destinationOut").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var term = request.term;
                var filteredDestinations = destinations.filter(function (destination) {
                    return destination.ad_name.toLowerCase().indexOf(term.toLowerCase()) !== -1 && destination.ad_name.toLowerCase().indexOf("japan") === -1;
                });
                var limitedDestinations = filteredDestinations.slice(0, 10);
                response(limitedDestinations.map(function (destination) {
                    return {
                        label: destination.ad_name,
                        value: destination.ad_id,
                        destination: destination.ad_name,
                        remarks: destination.ad_remarks
                    };
                }));
            },
            select: function (event, ui) {
                $("#destinationOut").val(decodeHtml(ui.item.destination));
                $("#dremarks1").text(decodeHtml(ui.item.remarks));
                if (ui.item.remarks) {
                    $('#Nojapan').show();
                    $('#checkbox21').prop('required', true);
                } else {
                    $('#Nojapan').hide();
                    $('#checkbox21').prop('required', false);
                }
                $("input").trigger("select");
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .attr("data-value", item.value)
                .append(item.label)
                .appendTo(ul);
        };
    </script>
</body>


</html>