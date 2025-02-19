<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseller</title>
    <link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/renew_form/renew_pidp.css') }}">
</head>

<body>
    @include("layout.sidebar")
    @include("layout.nav")
    <style>
        /* Base container styling */
        .container-fluid {
            padding: 0 2rem;
            /* Add some padding on the sides */
        }

        /* Card styling */
        .card {
            width: 100%;
            margin-bottom: 2rem;
            background: #fff;
            border: none;
        }

        /* First card specific styling */
        .card:first-of-type {
            margin-top: 6rem;
        }

        /* Bordered card style */
        .bordered {
            border: 1px solid rgb(0, 0, 97);
            border-top: 10px solid rgb(0, 0, 89);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Form control styling */
        .form-control,
        .form-select {
            height: 38px;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }

        /* Label styling */
        .form-label {
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        /* Card title styling */
        .card-title {
            color: #000;
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Row gap */
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 1rem;
        }
        
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-11"> <!-- Adjusted column width -->
                <div class="card-header custom-header mb-3 text-center">
                    <h2 class="header-title mb-0 typewriter">Renew Membership Form</h2>
                    <p class="header-subtitle text-muted">Please provide your details below to complete the process</p>
                </div>
                <form id="resellerForm" action="{{ route('renew_pidp.store', ['id' => $records['result_info'][0]['members_pincode'], 'vehicle' => $records['result_record']['vehicleinfohead_id']]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <!-- Are you going to JAPAN? -->
                        <h5 class="card-title mb-4">License Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="license" class="label">License No</label>
                                    <input name="license_info[members_licenseno]" type="text"
                                        class="text-input form-control form-control-sm license_no"
                                        style='text-transform:uppercase' id="license" autocomplete="off"
                                        value="<?= $records['result_info'][0]['members_licenseno'] ?>"
                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                        maxlength="13" placeholder="###-##-######" required>
                                    <div class="validation-message_license" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiration" class="Select-label">License Expiration Date</label>
                                    <?php
                                        $date = $records['result_info'][0]['members_licenseexpirationdate'];
                                        $formattedDate = date('Y-m-d', strtotime($date));
                                    ?>
                                    <div class="input-group">
                                        <input name="license_info[members_licenseexpirationdate]" type="text"
                                            class="Select-input form-control form-control-sm" style=" content: '';" autocomplete="off" id="expiration"
                                            placeholder="DD/MM/YYYY" value="<?= $date ?>" inputmode="numeric" required>
                                    </div>
                                    <div id="expiration-message" class="text-danger"></div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Card Type -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="card-type" class="form-label">Card Type</label>
                                        <select name="license_info[members_licensecard]"
                                            class="form-control form-control-sm" id="card-type" required>
                                            <option disabled selected value="">Select Card Type</option>
                                            @foreach($card as $c)
                                                        <option value="{{ $c }}" {{ $records['result_info'][0]['pidp_cardtype'] == $c
                                                ? 'selected' : '' }}>
                                                            {{ $c }}
                                                        </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <!-- License Type -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license-type" class="form-label">License Type</label>
                                        <select name="license_info[members_licensetype]"
                                            class="form-control form-control-sm" id="license-type" required>
                                            <option disabled selected value="">Select License Type</option>
                                            <option value="NON PROFESSIONAL">NON PROFESSIONAL</option>
                                            <option value="PROFESSIONAL">PROFESSIONAL</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
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
                                        <label for="membershipType" class="form-label">Type of Membership:</label>
                                        <select value="{{ old('personal_info.membership_type') }}" name="personal_info[membership_type]" class="form-control form-control-sm" id="membershipType" required>
                                            <option value="" disabled>Select Type of Membership.</option>
                                            @foreach ($membership as $membership_type)
                                                <option value="{{ $membership_type->membership_name }}" data-vehicle_num="{{ $membership_type->vehicle_num }}"
                                                    @if ($membership_type->membership_name == $records['result_record']['sponsor_name'])
                                                        selected
                                                    @endif>
                                                    {{ $membership_type->membership_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                    <div class="col-md-12" id="japanNoPlan" style="text-align: left; display: none;">
                                        <label for="planType" class="form-label">Plan Type:</label>
                                        <select value="{{ old('personal_info.plan_type') }}" name="personal_info[plan_type]" class="form-control form-control-sm" id="planType">
                                            <option value="" selected disabled>Select Plan Type</option>
                                            @foreach ($members as $pidp)
                                                <option value="{{ $pidp->plan_id }}" data-plan-id="{{ $pidp->plan_id }}">{{ $pidp->plan_name }} - ₱ {{ $pidp->plan_amount }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">This field is required</div>
                                        <small id="planMessage" style="color: orange !important; margin-top: 10px; display: none;">
                                            Most countries permit only a one-year duration, and Japan offers only an Annual Year.
                                        </small>
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
                        </div>
                    </div>
                    <!-- Card 3: Vehicle Details -->
                    <div class="card bordered">
                        <h5 class="mb-4">Vehicle Details</h5>
                        @if(empty($records['result_car']))
                            <div id="vehicleFields">
                                <!-- Initial Vehicle Form -->
                                <div class="vehicle-item border rounded p-3 mb-3">
                                    <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                    <div class="row g-3">
                                        <!-- First Row -->
                                        <div class="col-md-4 centered-content">
                                            <label class="label" style="font-size: medium;">
                                                Is Conduction Sticker Available?
                                            </label>
                                            <input type="hidden" id="csticker" name="is_cs[]" value="{{ old('is_cs.0', '0') }}">
                                            <div>
                                                <div class="options-container">
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="csticker_yes" value="1"
                                                            {{ old('is_cs.0') == '1' ? 'checked' : '' }}
                                                            onchange="updateLabeldyna('csticker_yes', 'csticker_no')">
                                                        <span class="checkmark"></span>
                                                        YES
                                                    </label>
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="csticker_no" value="0"
                                                            {{ old('is_cs.0') == '0' ? 'checked' : '' }}
                                                            onchange="updateLabeldyna('csticker_no', 'csticker_yes')"
                                                            {{ old('is_cs.0') == '1' ? '' : 'checked disabled' }}>
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
                                                id="platenum" 
                                                value="{{ old('vehicle_plate.0') }}" 
                                                autocomplete="off"
                                                placeholder="Enter Plate No" 
                                                style="text-transform: uppercase;" 
                                                required
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
                                            <input type="hidden" id="is_diplomat_1" name="is_diplomat[]" value="{{ old('is_diplomat.0', '0') }}">
                                            <div>
                                                <div class="options-container">
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="is_diplomat_yes_1" value="1"
                                                            {{ old('is_diplomat.0') == '1' ? 'checked' : '' }}
                                                            onchange="update_diplomat('is_diplomat_yes_1', 'is_diplomat_no_1')">
                                                        <span class="checkmark"></span>
                                                        YES
                                                    </label>
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="is_diplomat_no_1" value="0"
                                                            {{ old('is_diplomat.0') == '0' ? 'checked' : '' }}
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
                                            <select class="form-control form-control-sm select2 @error('vehicle_make.*') is-invalid @enderror" 
                                                    id="make1"
                                                    name="vehicle_make[]" 
                                                    required>
                                                <option value="" selected>Car Make</option>
                                                @foreach ($carMake as $row2)
                                                    <option value="{{ $row2['brand'] }}" 
                                                            {{ old('vehicle_make.0') == $row2['brand'] ? 'selected' : '' }}>
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
                                            <select class="form-control select2 @error('vehicle_model.*') is-invalid @enderror" 
                                                    id="model1"
                                                    name="vehicle_model[]" 
                                                    required>
                                                <option value="" selected>Car Model</option>
                                                <!-- Models will be populated via JavaScript -->
                                                @if(old('vehicle_model.0'))
                                                    <option value="{{ old('vehicle_model.0') }}" selected>{{ old('vehicle_model.0') }}</option>
                                                @endif
                                            </select>
                                            @error('vehicle_model.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Second Row -->
                                        <div class="col-md-3">
                                            <label class="form-label">Vehicle Type</label>
                                            <select class="form-control select2 @error('vehicle_type.*') is-invalid @enderror" 
                                                    id="vehicle_type1"
                                                    name="vehicle_type[]" 
                                                    required>
                                                <option value="" selected>Vehicle Type</option>
                                                <!-- Vehicle types will be populated via JavaScript -->
                                                @if(old('vehicle_type.0'))
                                                    <option value="{{ old('vehicle_type.0') }}" selected>{{ old('vehicle_type.0') }}</option>
                                                @endif
                                            </select>
                                            @error('vehicle_type.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Year</label>
                                            <input type="text" 
                                                id="year1" 
                                                name="vehicle_year[]" 
                                                maxlength="4" 
                                                class="form-control number_only @error('vehicle_year.*') is-invalid @enderror"
                                                value="{{ old('vehicle_year.0') }}"
                                                placeholder="Enter year" 
                                                required>
                                            @error('vehicle_year.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Sub model</label>
                                            <input type="text" 
                                                id="submodel1" 
                                                name="submodel[]" 
                                                class="form-control @error('submodel.*') is-invalid @enderror"
                                                value="{{ old('submodel.0') }}"
                                                placeholder="Enter sub model" 
                                                required>
                                            @error('submodel.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Color</label>
                                            <input type="text" 
                                                id="color" 
                                                name="vehicle_color[]" 
                                                class="form-control @error('vehicle_color.*') is-invalid @enderror"
                                                value="{{ old('vehicle_color.0') }}"
                                                placeholder="Enter color" 
                                                required>
                                            @error('vehicle_color.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Third Row -->
                                        <div class="col-md-3">
                                            <label class="form-label">Fuel Type</label>
                                            <select class="form-select @error('vehicle_fuel.*') is-invalid @enderror" 
                                                    name="vehicle_fuel[]" 
                                                    required>
                                                <option disabled selected value="">Fuel Type</option>
                                                @foreach(['GAS', 'DIESEL', 'ELECTRIC'] as $fuel)
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
                                            <select class="form-select @error('vehicle_transmission.*') is-invalid @enderror" 
                                                    name="vehicle_transmission[]" 
                                                    required>
                                                <option disabled selected value="">Select Transmission Type</option>
                                                @foreach(['AUTOMATIC', 'MANUAL'] as $transmission)
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
                                                <label for="orAttachment" class="form-label">Upload: Official Receipt</label>
                                                <div class="input-group">
                                                    <input type="file" 
                                                        class="form-control @error('or_image.*') is-invalid @enderror" 
                                                        id="orAttachment"
                                                        name="or_image[]"
                                                        onchange="handleVehicleFileUpload(this, 'or', 'orFeedback')" 
                                                        required>
                                                    <label class="input-group-text" for="orAttachment">
                                                        <i class="fas fa-upload"></i>
                                                    </label>
                                                </div>
                                                @error('or_image.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="orFeedback" class="text-danger"></div>
                                                <img id="or" src="" alt="Image or" style="max-width: 200px; display: none; margin-top: 10px;">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="crAttachment" class="form-label">Upload: Certificate of Registration</label>
                                                <div class="input-group">
                                                    <input type="file" 
                                                        class="form-control @error('cr_image.*') is-invalid @enderror" 
                                                        id="crAttachment"
                                                        name="cr_image[]"
                                                        onchange="handleVehicleFileUpload(this, 'cr', 'crFeedback')" 
                                                        required>
                                                    <label class="input-group-text" for="crAttachment">
                                                        <i class="fas fa-upload"></i>
                                                    </label>
                                                </div>
                                                @error('cr_image.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="crFeedback" class="text-danger"></div>
                                                <img id="cr" src="" alt="Image cr" style="max-width: 200px; display: none; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else

                        @foreach($records['result_car'] as $item)
                            <div id="vehicleFields">
                                <!-- Initial Vehicle Form -->
                                <div class="vehicle-item border rounded p-3 mb-3">
                                    <h6 class="mb-3">Vehicle <span class="vehicle-number">{{$loop->index+1}}</span></h6>
                                    <div class="row g-3">
                                        <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                                            <label class="label" style="font-size: medium;color:red">
                                            Do you want to remove this vehicle to your membership?
                                            </label>
                                            <input type="hidden" id="is_vehicle_removed_{{$loop->index+1}}" name="is_vehicle_removed[]" value="0">
                                            <div>
                                                <div class="options-container mb-4">
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="is_vehicle_removed_yes_{{$loop->index+1}}" value="1"
                                                            onchange="remove_vehicle('is_vehicle_removed_yes_{{$loop->index+1}}', 'is_vehicle_removed_no_{{$loop->index+1}}')">
                                                        <span class="checkmark"></span>
                                                        YES
                                                    </label>
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="is_vehicle_removed_no_{{$loop->index+1}}" value="0"
                                                            onchange="remove_vehicle('is_vehicle_removed_no_{{$loop->index+1}}', 'is_vehicle_removed_yes_{{$loop->index+1}}')"
                                                            checked disabled>
                                                        <span class="checkmark"></span>
                                                        NO
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <!-- First Row -->
                                        <div class="col-md-3 centered-content">
                                            <label class="label" style="font-size: medium;">
                                                Update Vehicle Information?
                                            </label>
                                            <input type="hidden" id="is_vehicle_updated_{{$loop->index+1}}" name="is_vehicle_updated[]" value="0">
                                            <label class="toggle-container mt-2">
                                                <input type="checkbox"
                                                    id="updateVehicle_{{$loop->index+1}}"
                                                    name="update_vehicle[]"
                                                    class="vehicle-switch">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <!-- For renewal form -->
                                        <div class="col-md-3 centered-content">
                                            <label class="label" style="font-size: medium;">
                                                Is Conduction Sticker Available?
                                            </label>
                                            <input type="hidden" class="cs-value" name="is_cs[]" value="{{ $item['vehicleinfo_csticker'] }}">
                                            <div>
                                                <div class="options-container">
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" 
                                                            class="cs-checkbox cs-yes" 
                                                            value="1"
                                                            {{ $item['vehicleinfo_csticker'] == 1 ? 'checked disabled' : '' }}
                                                            onchange="updateLabelDyna(this, 'yes')">
                                                        <span class="checkmark"></span>
                                                        YES
                                                    </label>
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" 
                                                            class="cs-checkbox cs-no" 
                                                            value="0"
                                                            {{ $item['vehicleinfo_csticker'] == 0 ? 'checked disabled' : '' }}
                                                            onchange="updateLabelDyna(this, 'no')">
                                                        <span class="checkmark"></span>
                                                        NO
                                                    </label>
                                                </div>
                                            </div>
                                            @error('is_cs.*')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="platenum" class="label">Plate No</label>
                                            <input name="vehicle_plate[]" type="text"
                                                class="text-input form-control form-control-sm platenum @error('vehicle_plate.*') is-invalid @enderror"
                                                id="platenum{{$loop->index+1}}" maxlength="8" onchange="updateVehicleSummary()"
                                                value="<?= $item['vehicleinfo_plateno']?>" 
                                                autocomplete="off"
                                                placeholder="Enter Plate No" 
                                                style="text-transform: uppercase;" disabled
                                                required
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
                                            <input type="hidden" id="is_diplomat_{{$loop->index+1}}" name="is_diplomat[]">
                                                <div>
                                                    <div class="options-container">
                                                        <label class="radio-checkbox">
                                                            <input type="checkbox" id="is_diplomat_yes_{{$loop->index+1}}" value="1"
                                                                {{ old('is_diplomat.0') == '1' ? 'checked' : '' }}
                                                                onchange="update_diplomat('is_diplomat_yes_1', 'is_diplomat_no_1')">
                                                            <span class="checkmark"></span>
                                                            YES
                                                        </label>
                                                        <label class="radio-checkbox">
                                                            <input type="checkbox" id="is_diplomat_no_{{$loop->index+1}}" value="0"
                                                                {{ old('is_diplomat.0') == '0' ? 'checked' : '' }}
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
                                            <select class="form-control form-control-sm select2 @error('vehicle_make.*') is-invalid @enderror" 
                                                    id="make{{$loop->index+1}}" name="vehicle_make[]" disabled
                                                    required>
                                                <option value="">Car Make</option>
                                                @foreach ($carMake as $row2)
                                                    <option value="{{ $row2['brand'] }}" 
                                                            {{ (old('vehicle_make.0') == $row2['brand'] || $item['vehiclebrand_name'] == $row2['brand']) ? 'selected' : '' }}>
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
                                            <select class="form-control select2 @error('vehicle_model.*') is-invalid @enderror" 
                                                    id="model{{$loop->index+1}}" name="vehicle_model[]" disabled
                                                    required>
                                                <option value="">Car Model</option>
                                                @if(old('vehicle_model.0'))
                                                    <option value="{{ old('vehicle_model.0') }}" selected>{{ old('vehicle_model.0') }}</option>
                                                @elseif($item['vehiclemodel_name'])
                                                    <option value="{{ $item['vehiclemodel_name'] }}" selected>{{ $item['vehiclemodel_name'] }}</option>
                                                @endif
                                                <!-- Models will be populated via JavaScript -->
                                            </select>
                                            @error('vehicle_model.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Second Row -->
                                        <div class="col-md-3">
                                            <label class="form-label">Vehicle Type</label>
                                            <select class="form-control select2 @error('vehicle_type.*') is-invalid @enderror" 
                                                    id="vehicle_type{{$loop->index+1}}" name="vehicle_type[]" disabled
                                                    required>
                                                <option value="" selected>Vehicle Type</option>
                                                <!-- Vehicle types will be populated via JavaScript -->
                                                @if(old('vehicle_type.0'))
                                                    <option value="{{ old('vehicle_type.0') }}" selected>{{ old('vehicle_type.0') }}</option>
                                                @elseif($item['bodytype_name'])
                                                    <option value="{{ $item['bodytype_name'] }}" selected>{{ $item['bodytype_name'] }}</option>
                                                @endif
                                            </select>
                                            @error('vehicle_type.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Year</label>
                                            <input type="text" 
                                                id="year{{$loop->index+1}}" 
                                                name="vehicle_year[]" 
                                                maxlength="4" 
                                                class="form-control number_only @error('vehicle_year.*') is-invalid @enderror"
                                                value="{{ old('vehicle_year.0', $item['vehicleinfo_year']) }}"
                                                placeholder="Enter year" disabled
                                                required>
                                            @error('vehicle_year.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Sub model</label>
                                            <input type="text" 
                                                id="submodel{{$loop->index+1}}" 
                                                name="submodel[]" 
                                                class="form-control @error('submodel.*') is-invalid @enderror"
                                                value="{{ old('submodel.0', $item['submodel_name']) }}"
                                                placeholder="Enter sub model" disabled
                                                required>
                                            @error('submodel.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Color</label>
                                            <input type="text" 
                                                id="color{{$loop->index+1}}" 
                                                name="vehicle_color[]" onchange="updateVehicleSummary()"
                                                class="form-control @error('vehicle_color.*') is-invalid @enderror"
                                                value="{{ old('vehicle_color.0', $item['vehiclecolor_name']) }}"
                                                placeholder="Enter color" disabled
                                                required>
                                            @error('vehicle_color.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Third Row -->
                                        <div class="col-md-3">
                                            <label class="form-label">Fuel Type</label>
                                            <select class="form-select @error('vehicle_fuel.*') is-invalid @enderror" 
                                                    name="vehicle_fuel[]" onchange="updateVehicleSummary()" disabled
                                                    required>
                                                <option disabled selected value="">Fuel Type</option>
                                                @foreach(['GAS', 'DIESEL', 'ELECTRIC'] as $fuel)
                                                    <option value="{{ $fuel }}" {{ (old('vehicle_fuel.0') == $fuel || $item['vehiclefuel_name'] == $fuel) ? 'selected' : '' }}>
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
                                            <select class="form-select @error('vehicle_transmission.*') is-invalid @enderror" 
                                                    name="vehicle_transmission[]" onchange="updateVehicleSummary()" disabled
                                                    required>
                                                <option disabled selected value="">Select Transmission Type</option>
                                                @foreach(['AUTOMATIC', 'MANUAL'] as $transmission)
                                                    <option value="{{ $transmission }}" {{ (old('vehicle_transmission.0') == $transmission || $item['transmission'] == $transmission) ? 'selected' : '' }}>
                                                        {{ $transmission }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('vehicle_transmission.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            <!-- Add Vehicle Button -->
                            <button type="button" class="btn btn-primary mt-3" id="addVehicle">
                                <i class="bi bi-plus-circle me-2"></i>+ Add another vehicle
                            </button>
                        @endif
                    </div>
                    <div class="card bordered">
                        <div class="justify-content-right"></div>
                        <div class="row col-md-12">
                            <table class="table table-bordered">
                                {{-- <input type="text" name="personal_info[reference_number]" id="reference_number" value hidden> --}}
                                <input type="text" name="personal_info[pincode]"
                                    value="<?= $records['result_info'][0]['members_pincode'] ?>" hidden>
                                <input type="text" name="personal_info[members_lastname]"
                                    value="<?= $records['result_info'][0]['members_lastname'] ?>" hidden>
                                <input type="text" name="personal_info[members_firstname]"
                                    value="<?= $records['result_info'][0]['members_firstname'] ?>" hidden>
                                <input type="text" name="personal_info[members_middlename]"
                                    value="<?= $records['result_info'][0]['members_middlename'] ?>" hidden>
                    
                                <input type="text" name="personal_info[members_birthdate]"
                                    value="<?= $records['result_info'][0]['members_birthdate'] ?>" hidden>
                    
                                <input type="text" name="personal_info[nationality]"
                                    value="<?= $records['result_info'][0]['nationality_name'] ?>" hidden>
                    
                                <input type="text" name="personal_info[mailing_preference]"
                                    value="<?= $records['result_info'][0]['members_mailingpreference'] ?>" hidden>
                    
                                {{-- <input type="text" name="license_info[members_licenseno]"
                                    value="<?= $records['result_info'][0]['members_licenseno'] ?>" hidden>
                                <input type="text" name="license_info[members_licensetype]"
                                    value="<?= $records['result_info'][0]['pidp_licensetype'] ?>" hidden>
                                <input type="text" name="license_info[members_licensecard]"
                                    value="<?= $records['result_info'][0]['pidp_cardtype'] ?>" hidden>
                                <input type="text" name="license_info[members_licenserest]"
                                    value="<?= htmlspecialchars($records['result_info'][0]['pidp_restriction'], ENT_QUOTES, 'UTF-8') ?>"
                                    hidden>
                                <input type="text" name="license_info[members_licenseexpirationdate]"
                                    value="<?= $records['result_info'][0]['members_licenseexpirationdate'] ?>" hidden> --}}
                    
                                <thead>
                                    
                                    <tr>
                                        <th colspan="5" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">
                                            PERSONAL INFORMATION
                                            <i class="fas fa-edit personal edit_icon" style="cursor: pointer; position: absolute; right: 3rem;" hidden></i>
                                            <i class="fas fa-x personal hidden_icon" style="cursor: pointer; position: absolute; right: 3rem; display: none;"></i>
                                        </th>
                                    </tr>
                                </thead>
                    
                                <tbody>
                                    <tr>
                    
                                        <td><strong>Title:</strong> <?= $records['result_info'][0]['members_title'] ?>
                                            <input type="text" name="personal_info[members_title]"
                                                value="<?= $records['result_info'][0]['members_title'] ?>" hidden>
                                            <br>
                                            {{-- <label class="update_personal"><strong>Change
                                                    to: </strong></label> --}}
                                            <br>
                                            <select id="uptitle" style="width:100%;" class="update_personal text-input form-control"
                                                name="uptitle">
                                                <option value="<?= $records['result_info'][0]['members_title'] ?>">
                                                    <?= $records['result_info'][0]['members_title'] ?></option>
                                                <option value="MR.">MR</option>
                                                <option value="MS.">MS</option>
                                                <option value="MRS.">MRS</option>
                                                <option value="ATTY.">ATTY</option>
                                                <option value="DR.">DR</option>
                                                <option value="ENGR.">ENGR</option>
                                            </select>
                                        </td>
                    
                                        <td name="personal_info[members_lastname]" id="echoLastName"><strong>Last Name:</strong>
                                            <?= $records['result_info'][0]['members_lastname'] ?></td>
                                        <td name="personal_info[members_firstname]" id="echoFirstName"><strong>First Name:</strong>
                                            <?= $records['result_info'][0]['members_firstname'] ?></td>
                                        <td name="personal_info[members_middlename]" id="echoMiddleName"><strong>Middle Name:</strong>
                                            <?= $records['result_info'][0]['members_middlename'] ?></td>
                                    </tr>
                                    <tr>
                                        <td id="echoBirthdate"><strong>Birth Date:</strong>
                                            <?= $records['result_info'][0]['members_birthdate'] ?></td>
                                        <td colspan="2"><strong>Birth Place:</strong><?= $records['result_info'][0]['members_birthplace'] ?>
                                            <input type="text" name="personal_info[members_birthplace]" value="<?= $records['result_info'][0]['members_birthplace'] ?>" hidden>
                                            <br>
                                            <br>
                                            <input name="upbirthplace" id="upbirthplace" type="text"
                                                class="update_personal text-input form-control w-100"
                                                value="<?= $records['result_info'][0]['members_birthplace'] ?>" style="width: 350px;">
                                        </td>
                                        <td name="personal_info[members_gender]" id="echoGender"><strong>Gender: </strong><?= $records['result_info'][0]['members_gender'] ?>
                                            <input type="text" name="personal_info[members_gender]" value="<?= $records['result_info'][0]['members_gender'] ?>" hidden>
                                            <br>
                                            <br>
                                            <select id="upgender" name="upgender" class="update_personal text-input form-control">
                                                <option value="<?= $records['result_info'][0]['members_gender'] ?>">
                                                    <?= $records['result_info'][0]['members_gender'] ?></option>
                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>
                                            </select>
                                        </td>
                                    </tr>
                    
                                    <tr>
                                        <td id="echoCitizenship"><strong>Citizenship:</strong>
                                            <?= $records['result_info'][0]['nationality_name'] ?><br>
                                            <input type="text" name="personal_info[citizenship]"
                                                value="<?= $records['result_info'][0]['nationality_name'] ?>" hidden>
                                            {{-- <label
                                                        class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <select id="ctzen_membership" name="ctzen_membership"
                                                class="update_personal text-input form-control">
                                                <option value="<?= $records['result_info'][0]['nationality_name'] ?>">
                                                    <?= $records['result_info'][0]['nationality_name'] ?></option>
                                                <option value="FILIPINO">FILIPINO</option>
                                                <option value="FOREIGNER">FOREIGNER</option>
                                            </select>
                                            <br>
                                            <label class="label" hidden="hidden" id="nationality1">Nationality</label>
                                            <input type="text" name="nationality" id="nationality" class="text-input form-control"
                                                value="<?= $records['result_info'][0]['othercitizenship'] ?>" hidden>
                                        </td>
                                        <td id="echoStatus"><strong>Status:</strong>
                                            <?= $records['result_info'][0]['members_civilstatus'] ?><br>
                                            <input type="text" name="personal_info[members_civilstatus]"
                                                value="<?= $records['result_info'][0]['members_civilstatus'] ?>" hidden>
                                            {{-- <label
                                                        class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <select id="upstatus" name="upstatus" class="update_personal text-input form-control">
                                                <option value="<?= $records['result_info'][0]['members_civilstatus'] ?>">
                                                    <?= $records['result_info'][0]['members_civilstatus'] ?></option>
                                                <option value="SINGLE">SINGLE</option>
                                                <option value="MARRIED">MARRIED</option>
                                                <option value="WIDOWED">WIDOWED</option>
                                            </select>
                                        </td>
                                        <td colspan="2" id="echoOccupation"><strong>Occupation:</strong>
                                            <?= $records['result_info'][0]['occupation_name'] ?>
                                            <input type="text" name="personal_info[occupation_name]"
                                                value="<?= $records['result_info'][0]['occupation_name'] ?>" hidden>
                                            <br>
                                            {{-- <label
                                                        class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" id="upoccupation" name="upoccupation"
                                                value="<?= $records['result_info'][0]['occupation_name'] ?>"
                                                class="update_personal text-input form-control w-100" style="width: 300px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    
                    
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">
                                            CONTACT INFORMATION
                                            <i class="fas fa-edit contact edit_icon" style="cursor: pointer; position: absolute; right: 3rem;" hidden></i>
                                            <i class="fas fa-x contact hidden_icon" style="cursor: pointer; position: absolute; right: 3rem; display: none;"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" id="echoHomeAddress"><strong>Home
                                                Address:</strong>
                                            <?= utf8_decode($records['result_info'][0]['members_haddress1']) . ' ' . mb_convert_encoding($records['result_info'][0]['members_haddress2'], 'UTF-8') . ' ' . utf8_decode($records['result_info'][0]['house_city_name']) . ' ' . utf8_decode($records['result_info'][0]['house_district_name']) . ' ' . $records['result_info'][0]['members_housezipcode'] ?>
                                            <br>
                                            <br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <table class="update_contact" style="border: none;">
                                                <tr style="border: none;">
                                                    <td style="border: none;"><label class="update_contact"><strong>Building
                                                                No./Street</strong></label>
                                                        <input type="text" name="personal_info[members_haddress1]"
                                                            value="<?= $records['result_info'][0]['members_haddress1'] ?>" hidden>
                                                        <input class="text-input form-control" type="text" name="street"
                                                            value="<?= $records['result_info'][0]['members_haddress1'] ?>" id="street">
                                                    </td>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>Barangay/Town</strong></label>
                                                        <input class="text-input form-control" type="text" name="town"
                                                            value="<?= $records['result_info'][0]['members_haddress2'] ?>" id="town">
                    
                                                        <input type="text" name="personal_info[members_haddress2]"
                                                            value="<?= $records['result_info'][0]['members_haddress2'] ?>" hidden>
                    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>City/Municipality</strong></label>
                                                        <input type="text" name="personal_info[members_housecity]"
                                                            value="<?= $records['result_info'][0]['house_city_name'] ?>" hidden>
                    
                                                        <input class="text-input form-control" type="text" name="city"
                                                            value="<?= $records['result_info'][0]['house_city_name'] ?>" id="city">
                                                    </td>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>Province</strong></label>
                                                        <input type="text" name="personal_info[members_housedistrict]"
                                                            value="<?= $records['result_info'][0]['house_district_name'] ?>" hidden>
                                                        <input class="text-input form-control" type="text" id="province"
                                                            value="<?= $records['result_info'][0]['house_district_name'] ?>"
                                                            name="province">
                                                    </td>
                                                    <td style="border: none;"><label class="update_contact"><strong>Zip
                                                                Code</strong></label>
                                                        <input type="text" name="personal_info[members_housezipcode]"
                                                            value="<?= $records['result_info'][0]['members_housezipcode'] ?>" hidden>
                                                        <input class="text-input form-control numb" type="text" id="zcode"
                                                            name="zcode" maxlength="4" inputmode="numeric" style="width: 130px"
                                                            value="<?= $records['result_info'][0]['members_housezipcode'] ?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" id="echocomname"><strong>Company
                                                Name:</strong> <?= $records['result_info'][0]['members_businessname'] ?><br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" name="personal_info[members_businessname]"
                                                value="<?= $records['result_info'][0]['members_businessname'] ?>" hidden>
                                            <input type="text" name="company" id="company"
                                                class="update_contact text-input form-control"
                                                value="<?= $records['result_info'][0]['members_businessname'] ?>">
                    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" id="echoOfficeAddress"><strong>Company
                                                Address:</strong>
                                            <?= utf8_decode($records['result_info'][0]['members_oaddress1']) . ' ' . utf8_decode($records['result_info'][0]['members_oaddress2']) . ' ' . utf8_decode($records['result_info'][0]['office_city_name']) . ' ' . utf8_decode($records['result_info'][0]['office_district_name']) . ' ' . $records['result_info'][0]['members_officezipcode'] ?>
                                            <br>
                                            <br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <table class="update_contact" style="border: none;">
                                                <tr style="border: none;">
                                                    <td style="border: none;"><label class="update_contact"><strong>Building
                                                                No./Street</strong></label>
                                                        <input type="text" name="personal_info[members_oaddress1]"
                                                            value="<?= $records['result_info'][0]['members_oaddress1'] ?>" hidden>
                                                        <input class="text-input form-control" type="text" name="street1"
                                                            value="<?= $records['result_info'][0]['members_oaddress1'] ?>" id="street1">
                                                    </td>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>Barangay/Town</strong></label>
                                                        <input type="text" name="personal_info[members_oaddress2]"
                                                            value="<?= $records['result_info'][0]['members_oaddress2'] ?>" hidden>
                                                        <input class="text-input form-control"
                                                            value="<?= $records['result_info'][0]['members_oaddress2'] ?>" type="text"
                                                            name="town1" id="town1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>City/Municipality</strong></label>
                                                        <input type="text" name="personal_info[members_officecity]"
                                                            value="<?= $records['result_info'][0]['office_city_name'] ?>" hidden>
                                                        <input class="text-input form-control"
                                                            value="<?= $records['result_info'][0]['office_city_name'] ?>" type="text"
                                                            name="city1" id="city1">
                                                    </td>
                                                    <td style="border: none;"><label
                                                            class="update_contact"><strong>Province</strong></label>
                                                        <input type="text" name="personal_info[members_officedistrict]"
                                                            value="<?= $records['result_info'][0]['office_district_name'] ?>" hidden>
                                                        <input class="text-input form-control" type="text" id="province1"
                                                            value="<?= $records['result_info'][0]['office_district_name'] ?>"
                                                            name="province1">
                                                    </td>
                                                    <td style="border: none;"><label class="update_contact"><strong>Zip
                                                                Code</strong></label>
                                                        <input type="text" name="personal_info[members_officezipcode]"
                                                            value="<?= $records['result_info'][0]['members_officezipcode'] ?>" hidden>
                                                        <input class="text-input form-control numb" type="text" id="zcode1"
                                                            value="<?= $records['result_info'][0]['members_officezipcode'] ?>"
                                                            name="zcode1" maxlength="4" inputmode="numeric" style="width: 130px">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" id="echoMailingPreference"><strong>Mailing
                                                Preference:</strong><?= $records['result_info'][0]['members_mailingpreference'] ?><br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" name="personal_info[mailing_preference]"
                                                value="<?= $records['result_info'][0]['members_mailingpreference'] ?>" hidden>
                                            <select id="upaddress" name="upaddress" class="update_contact text-input form-control">
                                                <option value="<?= $records['result_info'][0]['members_mailingpreference'] ?>">
                                                    <?= $records['result_info'][0]['members_mailingpreference'] ?></option>
                                                <option value="HOUSE ADDRESS" id="home">HOUSE
                                                    ADDRESS</option>
                                                <option value="OFFICE ADDRESS" id="office">OFFICE
                                                    ADDRESS</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="echoHomeMobileNo"><strong>Home
                                                Phone:</strong><br> <?= $records['result_info'][0]['members_housephoneno'] ?><br>
                                            <br>
                                            <input type="text" name="personal_info[members_housephoneno]"
                                                value="<?= $records['result_info'][0]['members_housephoneno'] ?>" hidden>
                                            <input type="text" id="uphousephone" name="uphousephone"
                                                value="<?= $records['result_info'][0]['members_housephoneno'] ?>"
                                                class="update_contact text-input form-control numb" onkeyup="maskTelNo(this.id)"
                                                style="width: 250px;" inputmode="numeric">
                                        </td>
                                        <td id="echoOfficeMobileNo"><strong>Company
                                                Phone:</strong><br> <?= $records['result_info'][0]['members_officephoneno'] ?><br>
                                            {{-- <label class="update_contact"><strong>Change to: </strong></label> --}}
                                            <br>
        
                                            <input type="text" id="upofficephoneno" name="upofficephoneno"
                                                onkeyup="maskTelNo(this.id)" class="update_contact text-input form-control numb"
                                                style="width: 250px;" inputmode="numeric">
                                        </td>
                                        <td id="echomobilenum"><strong>Mobile No:</strong><br>
                                            <?= $records['result_info'][0]['members_mobileno'] ?><br>
                                            <br>
                                            <input type="text" name="personal_info[members_mobileno]"
                                                value="<?= $records['result_info'][0]['members_mobileno'] ?>" hidden>
                                            <input type="tel" id="upmobileno" name="upmobileno"
                                                value="<?= $records['result_info'][0]['members_mobileno'] ?>"
                                                class="update_contact text-input form-control numb phone-input"
                                                style="width: 250px;" inputmode="numeric"
                                                data-error-container="error-msg-1"
                                                data-valid-container="valid-msg-1">
                                            <span id="valid-msg-1" class="hide valid-msg"></span>
                                            <span id="error-msg-1" class="hide error-msg"></span>
                                        </td>
                                    </tr>
                                    <tr id="echocontactfield">
                                        <td id="echoalternatemobilenum"><strong>Alternate Mobile No:</strong><br>
                                            <?= $records['result_info'][0]['members_alternate_mobileno'] ?><br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" name="personal_info[members_alternate_mobileno]"
                                                value="<?= $records['result_info'][0]['members_alternate_mobileno'] ?>" hidden>
                                            <input type="text" id="upaltmobileno" name="upaltmobileno"
                                                value="<?= $records['result_info'][0]['members_alternate_mobileno'] ?>"
                                                class="update_contact text-input form-control numb phone-input" style="width: 250px;" inputmode="numeric"
                                                data-error-container="error-msg-2"
                                                data-valid-container="valid-msg-2">
                                            <span id="valid-msg-2" class="hide valid-msg"></span>
                                            <span id="error-msg-2" class="hide error-msg"></span>
                                        </td>
                                        <td id="echoemailadd"><strong>Email
                                                Address:</strong><br> <?= $records['result_info'][0]['members_emailaddress'] ?><br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" name="personal_info[members_emailaddress]"
                                                value="<?= $records['result_info'][0]['members_emailaddress'] ?>" hidden>
                                            <input type="email" id="upemail" name="upemail"
                                                value="<?= $records['result_info'][0]['members_emailaddress'] ?>"
                                                class="update_contact text-input form-control" style="width: 250px;">
                                        </td>
                                        <td id="echoalternateemailadd"><strong>Alternate
                                                Email Address:</strong><br>
                                            <?= $records['result_info'][0]['members_alternate_emailaddress'] ?><br>
                                            {{-- <label
                                                        class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                            <br>
                                            <input type="text" name="personal_info[members_alternate_emailaddress]"
                                                value="<?= $records['result_info'][0]['members_alternate_emailaddress'] ?>" hidden>
                                            <input type="email" id="upaltemail" name="upaltemail"
                                                value="<?= $records['result_info'][0]['members_alternate_emailaddress'] ?>"
                                                class="update_contact text-input form-control" style="width: 250px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th colspan="6" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">VEHICLE
                                            DETAILS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records['result_car']))
                                        @foreach ($records['result_car'] as $key => $r)
                                            <tr>
                                                <td rowspan="2" style="text-align: center; vertical-align: middle;">
                                                    <h3 class="text-center">{{ $loop->iteration }}</h3>
                                                </td>
                                                <td><strong>Update:</strong><br><input type="checkbox" id="v{{ $key + 1 }}"
                                                        name="v{{ $key + 1 }}" class="check" onclick="updateV{{ $key + 1 }}()"
                                                        disabled></td>
                                                <?php
                                                if($r['vehicleinfo_csticker']== 1){ ?>
                                                <td><strong>Conduction
                                                        Sticker:&nbsp;</strong><br><br><input type="checkbox" id="csticker"
                                                        name="csticker" value="csticker" checked disabled></td>
                                                <?php
                                                }else
                                                { ?>
                                                <td><strong>Conduction Sticker:&nbsp;</strong><input type="checkbox" id="csticker"
                                                        name="csticker" value="csticker" disabled></td>
                                                <?php
                                                }
                                                ?>
                                                <td colspan="2" id="echoplatenum"><strong>Plate
                                                        No:</strong>
                                                    <?= isset($r['vehicleinfo_plateno']) ? $r['vehicleinfo_plateno'] : '' ?></td>
                                                <td id="echomake"><strong>Make:</strong>
                                                    <?= isset($r['vehiclebrand_name']) ? $r['vehiclebrand_name'] : '' ?></td>
                                            </tr>
                                            <tr>
                                                <td id="echomodel"><strong>Model:</strong>
                                                    <?= isset($r['vehiclemodel_name']) ? $r['vehiclemodel_name'] : '' ?></td>
                                                <td id="echoymodel"><strong>Year Model:</strong>
                                                    <?= isset($r['vehicleinfo_year']) ? $r['vehicleinfo_year'] : '' ?></td>
                                                <td id="echocolor"><strong>Color:</strong>
                                                    <?= isset($r['vehiclecolor_name']) ? $r['vehiclecolor_name'] : '' ?></td>
                                                <td id="echoftype"><strong>Fuel Type:</strong>
                                                    <?= isset($r['vehiclefuel_name']) ? $r['vehiclefuel_name'] : '' ?></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No vehicle details available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                    
                    
                            <h4 class="mt-3 text-dark">Update my personal information?</h4>
                            <div class="pradio mb-5 mt-3 options-container">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="uyes" name="uradio" value="1" required>
                                    <label class="custom-control-label" for="uyes" style="font-size:16px;"
                                        id="yesLabel">YES</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="uno" name="uradio" value="0" required>
                                    <label class="custom-control-label" for="uno" style="font-size:16px;" id="noLabel">NO</label>
                                </div>
                            </div>
                            <div class="row" style="text-align: justify;">
                                <div class="col-12">
                                    <div class="formCheck d-flex">
                                        <input class="check-input" type="checkbox" id="aq" name="aq" value="1"
                                            checked>
                                        <p class="form-check-label p-2" for="summarycheck1">I would like to receive AQ
                                            Magazine via email.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('script/renew_side/renew_pidp.js') }} "></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>

    @include('renew_form/renew_dynamic_vehicle')
    @include('renew_form/renew_countrycode')
    @include('address')
    @include('update_info')
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
                $('#checkbox_waiver1').prop('required', true);
            } else {
                $('#checkbox_waiver1').prop('required', false);
            }
        });

        // Change this line to only target the destination input
        $("#destinationIn").trigger("select");
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
        // Change this line to only target the destination input
        $("#destinationOut").trigger("select");
        return false;
    }
}).data("ui-autocomplete")._renderItem = function (ul, item) {
    return $("<li>")
        .attr("data-value", item.value)
        .append(item.label)
        .appendTo(ul);
};

    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const yesRadio = document.getElementById('uyes');
    const noRadio  = document.getElementById('uno');
    const editIcons = document.querySelectorAll('.edit_icon');

    yesRadio.addEventListener('change', function() {
        if (yesRadio.checked) {
            editIcons.forEach(icon => icon.removeAttribute('hidden'));
        }
    });

    noRadio.addEventListener('change', function() {
        if (noRadio.checked) {
            editIcons.forEach(icon => icon.setAttribute('hidden', ''));
        }
    });
});
        </script>
</body>

</html>