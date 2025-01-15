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
            <div class="col-md-10 col-lg-9"> <!-- Adjusted column width -->
                <form id="resellerForm" action="{{ route('new_motorcyle.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @foreach ($errors->all() as $key => $error)
                        <p style="color: red">{{ $key }} : {{ $error }}</p>
                    @endforeach
                    <!-- Card 1: License Details -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">License Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <div class="form-group">
                                    <label for="license" class="label">License No</label>
                                    <input name="license_details[members_licenseno]" type="text"
                                        class="text-input form-control form-control-sm license_no"
                                        style='text-transform:uppercase' id="license" required>
                                    <div class="validation-message_license" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="row">
                                <!-- Card Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="card-type" class="form-label">Card Type</label>
                                        <select name="license_details[members_licensecard]" class="form-control form-control-sm" id="card-type" required>
                                            <option disabled selected value="">Select Card Type</option>
                                            <option value="NON-CARD">NON CARD</option>
                                            <option value="CARD">CARD</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            
                                <!-- License Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="license-type" class="form-label">License Type</label>
                                        <select name="license_details[members_licensetype]" class="form-control form-control-sm" id="license-type" required>
                                            <option disabled selected value="">Select License Type</option>
                                            <option value="NON PROFESSIONAL">NON PROFESSIONAL</option>
                                            <option value="PROFESSIONAL">PROFESSIONAL</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            
                                <!-- ID Image -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idAttachment" class="form-label">ID Image (Upload a valid government ID)</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control form-control-sm" id="idAttachment" name="idpicture"
                                                onchange="handleFileUpload(this, 'valid_id', 'idFeedback')" required>
                                            <label class="input-group-text" for="idAttachment">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                        @error('idpicture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="idFeedback" class="text-danger"></div>
                                        <img id="valid_id" src="" alt="Image valid_id"
                                            style="max-width: 200px; display: none; margin-top: 10px;">
                                    </div>
                                </div>
                            
                                <!-- Hidden Fields -->
                                <div class="col-md-4" hidden>
                                    <div class="form-group">
                                        <label for="dlcodearray" class="form-label">DL Code</label>
                                        <input value="" name="dlcodearray" type="text" class="form-control form-control-sm" id="dlcodearray"
                                            autocomplete="off" placeholder="DL Code">
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                </div>
                                <div class="col-md-4" hidden>
                                    <div class="form-group">
                                        <label for="restric" class="form-label">Restriction</label>
                                        <input value="" name="restric" type="text" class="form-control form-control-sm" id="restric"
                                            autocomplete="off" placeholder="Restriction">
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
                        <br>

                    </div>

                    <!-- Card 2: Personal Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <!-- Are you going to JAPAN? -->
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <div class="card2" style="box-shadow: 0px 4px 2px rgba(0, 0, 0, 0.1); border-radius: 8px; border: 1px solid #ddd; padding: 15px; background-color: #fff; margin-bottom: 0;">
                                    <div class="card-body" style="padding: 10px; text-align: center;">
                                        <label class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px;">Are you going to JAPAN?</label>
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                                            <input type="radio" id="goingToJapanYes" name="going_to_japan" value="YES" required>
                                            <label for="goingToJapanYes" style="margin: 0;">YES</label>
                                            <input type="radio" id="goingToJapanNo" name="going_to_japan" value="NO" required>
                                            <label for="goingToJapanNo" style="margin: 0;">NO</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card3" id="card3" style="box-shadow: 0px 4px 2px rgba(0, 0, 0, 0.1); border-radius: 8px; border: 1px solid #ddd; padding: 15px; background-color: #fff; margin-bottom: 15px;">
                                    <div class="card-body" style="padding: 10px;">
                                        <label for="destination" class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px;">Destination</label>
                                        <input type="text" class="form-control" id="destination" name="travel_info[destination]" style="margin-bottom: 15px;">
                            
                                        <label for="purpose" class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px;">Purpose of Travel</label>
                                        <select class="form-select" id="purpose" name="travel_info[purpose]" style="margin-bottom: 10px;">
                                            <option value="">Select Purpose</option>
                                            <option value="Tourism and Work">Tourism and Work</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card4" id="card4" style="box-shadow: 0px 4px 2px rgba(0, 0, 0, 0.1); border-radius: 8px; border: 1px solid #ddd; padding: 15px; background-color: #fff; margin-bottom: 15px; display: none;">
                                    <div class="card-body" style="padding: 10px;">
                                        <label class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px; text-align: center; width: 100%;">Are you going to another country aside JAPAN?</label>

                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                                            <input type="radio" id="anotherCountryYes" name="another_country" value="YES">
                                            <label for="anotherCountryYes" style="margin: 0;">YES</label>
                                            <input type="radio" id="anotherCountryNo" name="another_country" value="NO">
                                            <label for="anotherCountryNo" style="margin: 0;">NO</label>
                                        </div>
                                        
                                        <label style="font-weight: bold; margin-bottom: 14px;">
                                            <span style="color: red;">NOTE:</span> <span style="color: black;">Additional ₱ 600.00 for multiple PIDP.</span>
                                        </label>
                                        
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                                            <label for="purpose" class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px;">Purpose of Travel</label>
                                            <select class="form-select" id="purpose" name="travel_info[purpose]" style="margin-bottom: 10px;">
                                                <option value="">Select Purpose</option>
                                                <option value="Tourism and Work">Tourism and Work</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center;">
                                            <label for="destination" class="form-label" style="display: block; font-weight: 400; margin-bottom: 10px;">Destination</label>
                                            <input type="text" class="form-control" id="destination" name="travel_info[destination]" style="margin-bottom: 15px;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Agreement -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- modal-lg added here for bigger size -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">WAIVER AND RELEASE</h5>
                                        </div>
                                        <div class="modal-body text-justify"> 
                                            <!-- text-justify class added here for justified text -->
                                            <p>In consideration of renewing my Philippine International Driving Permit (PIDP) from the Automobile Association Philippines (AAP), hereinafter referred to as “The Association,” I agree to the following:</p>
                                        
                                            <p>I have been fully informed that the Japanese Government prohibits the use of an International Driving Permit (IDP) for more than one (1) year within Japan. If an IDP expires, the holder will be required to stay outside of Japan for at least three (3) months before his/her new IDP will be honored as a valid driving permit in Japan.</p>
                                        
                                            <p>That I have been informed of the inherent risk of using my Philippine International Driving Permit (PIDP) in Japan in connection with the above-stated provisions or laws of the Japanese Government.</p>
                                        
                                            <p>That I <strong>WAIVE AND RELEASE</strong> to the fullest extent permitted by law the Association and/or its employees from all liability whatsoever, from any claims or causes of action that I, my estate, heirs, executors, or assigns may have for personal injury or otherwise, including any direct and/or consequential damages, which result or arise from the issuance or renewal of the Philippine International Driving Permit (PIDP), whether caused by the negligence or fault of either the Association or its employees, or otherwise.</p>
                                        
                                            <p>The Association has given me the full opportunity to ask any and all questions about the renewal of my Philippine International Driving Permit (PIDP), and all of my questions have been answered to my total satisfaction.</p>
                                        
                                            <p>I agree to reimburse the Association for any attorney’s fees and costs incurred in any legal action brought against either the Association or its employees, and in which either the Association or its employees is the prevailing party.</p>
                                        
                                            <p>I acknowledge that I have been given adequate opportunity to read and understand, and that it was not presented to me at the last minute, nor was I in duress or under unlawful influence when agreeing. I understand that I am agreeing to a legal contract waiving certain rights to recover against the Association and its employees.</p>
                                        
                                            <p>I hereby declare that I have read this Waiver and Release and have fully understood its contents. I further declare that I am of legal age and competent to consent to this agreement. Furthermore, I declare that I voluntarily and willingly executed the RELEASE, WAIVER, and QUITCLAIM with full knowledge of my rights under the law.</p>
                                        
                                            <p>By clicking "I AGREE," I hereby agree to all the terms and conditions stated in this Waiver and Release.</p>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            </div>
                           
                            <!-- NO 1 Checkbox -->
                            <div class="container mt-5">
                                <div class="form-check" id="declarationText">
                                    <input class="form-check-input" type="checkbox" id="exampleCheckbox">
                                    <label class="form-check-label" for="exampleCheckbox" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <strong>I hereby declare that I have read and have fully understood its contents. I further declare that I voluntarily and willingly executed the full knowledge of my rights under the law.</strong>
                                    </label>                                    
                                </div>
                            </div>
                            <!-- YES 2 Checkbox -->
                            <div class="container mt-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="exampleCheckbox">
                                    <label class="form-check-label" for="exampleCheckbox" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <strong>I hereby declare that I have read and have fully understood its contents. I further declare that I voluntarily and willingly executed the full knowledge of my rights under the law.</strong>
                                    </label>                                    
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="exampleCheckbox">
                                    <label class="form-check-label" for="exampleCheckbox">
                                        <strong>I hereby declare that I have read and understood the additional information about this country. I also fully acknowledge the contents of the WAIVER, RELEASE and CONSENT (link to waiver). Furthermore, I voluntarily and willingly execute the WAIVER, RELEASE and QUITCLAIM with full knowledge of my rights under the law.</strong>
                                    </label>                                    
                                </div>
                            </div>
                            <!-- NO NO JAPAN-->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="exampleCheckbox">
                                <label class="form-check-label" for="exampleCheckbox">
                                    <strong>I hereby declare that I have read and understood the additional information about this country. I also fully acknowledge the contents of the WAIVER, RELEASE and CONSENT (link to waiver). Furthermore, I voluntarily and willingly execute the WAIVER, RELEASE and QUITCLAIM with full knowledge of my rights under the law.</strong>
                                </label>                                    
                            </div>

                            
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="applicationType" class="form-label">Type of Application</label>
                                <select class="form-select" id="applicationType" required>
                                    <option value="NEW" selected>NEW</option>
                                    <!-- <option value="RENEWAL" selected>RENEWAL</option> -->
                                </select>
                            </div>
                            <!--- Step 1 of Input textfield -->
                            <div class="col-md-4 mb-3">
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
                            <div class="col-md-5 mb-3">
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
                           
                        </div>
                    </div>
                    

                    <!-- Card 3: Contact Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-2">Contact Information</h5>
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
                        <h5 class="mt-2 mb-2">Home Address</h5>
                        <div class="row mb-2">
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
                    </div>

                    <!-- Card 3: Vehicle Details -->
                    <div class="card bordered">
                        <h5 class="mb-4">Vehicle Details</h5>
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
                                        <input type="hidden" id="csticker" name="is_cs[]"
                                            value="{{ old('is_cs.0', '0') }}">
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
                                                        {{ old('is_cs.0') == '1' ? '' : 'checked disabled' }} checked
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
                                        <input type="hidden" id="is_diplomat_1" name="is_diplomat[]"
                                            value="{{ old('is_diplomat.0', '0') }}">
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
                                        <select
                                            class="form-control form-control-sm select2 @error('vehicle_make.*') is-invalid @enderror"
                                            id="make1" name="vehicle_make[]" required>
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
                                        <select
                                            class="form-control select2 @error('vehicle_model.*') is-invalid @enderror"
                                            id="model1" name="vehicle_model[]" required>
                                            <option value="" selected>Car Model</option>
                                            <!-- Models will be populated via JavaScript -->
                                            @if (old('vehicle_model.0'))
                                                <option value="{{ old('vehicle_model.0') }}" selected>
                                                    {{ old('vehicle_model.0') }}</option>
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
                                            id="vehicle_type1" name="vehicle_type[]" required>
                                            <option value="" selected>Vehicle Type</option>
                                            <!-- Vehicle types will be populated via JavaScript -->
                                            @if (old('vehicle_type.0'))
                                                <option value="{{ old('vehicle_type.0') }}" selected>
                                                    {{ old('vehicle_type.0') }}</option>
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
                                            value="{{ old('vehicle_year.0') }}" placeholder="Enter year" required>
                                        @error('vehicle_year.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Sub model</label>
                                        <input type="text" id="submodel1" name="submodel[]"
                                            class="form-control @error('submodel.*') is-invalid @enderror"
                                            value="{{ old('submodel.0') }}" placeholder="Enter sub model" required>
                                        @error('submodel.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" id="color" name="vehicle_color[]"
                                            class="form-control @error('vehicle_color.*') is-invalid @enderror"
                                            value="{{ old('vehicle_color.0') }}" placeholder="Enter color" required>
                                        @error('vehicle_color.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Third Row -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fuel Type</label>
                                        <select class="form-select @error('vehicle_fuel.*') is-invalid @enderror"
                                            name="vehicle_fuel[]" required>
                                            <option disabled selected value="">Fuel Type</option>
                                            @foreach (['GAS', 'DIESEL', 'ELECTRIC'] as $fuel)
                                                <option value="{{ $fuel }}"
                                                    {{ old('vehicle_fuel.0') == $fuel ? 'selected' : '' }}>
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
                                            name="vehicle_transmission[]" required>
                                            <option disabled selected value="">Select Transmission Type</option>
                                            @foreach (['AUTOMATIC', 'MANUAL'] as $transmission)
                                                <option value="{{ $transmission }}"
                                                    {{ old('vehicle_transmission.0') == $transmission ? 'selected' : '' }}>
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
                                                    onchange="handleFileUpload(this, 'or', 'orFeedback')" required>
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
                                                    onchange="handleFileUpload(this, 'cr', 'crFeedback')" required>
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
    <script src="/script/pidp.js"></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    @include('countrycode')
    <script>
        // $(document).ready(function() {
        //     $('.notdynamic').select2({
        //         theme: 'bootstrap4',
        //         width: '100%'
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            var towns = @json($towns);
            $("#town").autocomplete({
                    minLength: 1,
                    source: function(request, response) {
                        var term = request.term;
                        var filteredTowns = towns.filter(function(town) {
                            return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -
                            1;
                        });
                        var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                        response(limitedTowns.map(function(town) {
                            return {
                                label: town.az_barangay + " - " + town.city_name + ", " + town
                                    .district_name,
                                value: town.az_barangay
                            };
                        }));
                    },
                    select: function(event, ui) {
                        var selectedTown = towns.find(function(town) {
                            return town.az_barangay === ui.item.value;
                        });
                        $("#town").val(decodeHtml(selectedTown.az_barangay));
                        $("#city").val(decodeHtml(selectedTown.city_name));
                        $("#province").val(decodeHtml(selectedTown.district_name));
                        $("#zcode").val(decodeHtml(selectedTown.az_zipcode));
                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function(ul, item) {
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
            source: function(request, response) {
                var term = request.term;
                var filteredCity = citys.filter(function(city) {
                    return city.city_name.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedCity = filteredCity.slice(0, 10); // Limiting to first 10 items
                response(limitedCity.map(function(city) {
                    return {
                        label: city.city_name + " - " + city.district_name,
                        value: city.city_name
                    };
                }));
            },
            select: function(event, ui) {
                var selectedCity = citys.find(function(city) {
                    return city.city_name === ui.item.value;
                });
                if (selectedCity) {
                    $("#city").val(decodeHtml(selectedCity.city_name));
                    $("#province").val(decodeHtml(selectedCity.district_name));
                    $("#zcode").val(decodeHtml(selectedCity.az_zipcode));
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
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
            source: function(request, response) {
                var term = request.term;
                var filteredTowns = towns.filter(function(town) {
                    return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                response(limitedTowns.map(function(town) {
                    return {
                        label: town.az_barangay + " - " + town.city_name + ", " + town
                            .district_name,
                        value: town.az_barangay
                    };
                }));
            },
            select: function(event, ui) {
                var selectedTown = towns.find(function(town) {
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
        }).autocomplete("instance")._renderItem = function(ul, item) {
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
            source: function(request, response) {
                var term = request.term;
                var filteredCity = citys.filter(function(city) {
                    return city.city_name.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedCity = filteredCity.slice(0, 10); // Limiting to first 10 items
                response(limitedCity.map(function(city) {
                    return {
                        label: city.city_name + " - " + city.district_name,
                        value: city.city_name
                    };
                }));
            },
            select: function(event, ui) {
                var selectedCity = citys.find(function(city) {
                    return city.city_name === ui.item.value;
                });
                if (selectedCity) {
                    $("#city1").val(decodeHtml(selectedCity.city_name));
                    $("#province1").val(decodeHtml(selectedCity.district_name));
                    $("#zcode1").val(decodeHtml(selectedCity.az_zipcode));
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
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
const yesRadio = document.getElementById('goingToJapanYes');
const noRadio = document.getElementById('goingToJapanNo');
const card3 = document.getElementById('card3');
const card4 = document.getElementById('card4');

// For "Are you going to another country aside JAPAN?"
const anotherCountryYes = document.getElementById('anotherCountryYes');
const anotherCountryNo = document.getElementById('anotherCountryNo');

// Declaration text container
const declarationText = document.getElementById('declarationText'); // Make sure this ID matches your declaration container

// Function to update the visibility of cards
function updateCardsVisibility() {
    if (yesRadio.checked) {
        card3.style.display = 'none';
        card4.style.display = 'block';
    } else if (noRadio.checked) {
        card3.style.display = 'block';
        card4.style.display = 'none';
    } else {
        card3.style.display = 'none';
        card4.style.display = 'none';
    }
}

// Function to update the visibility of content in Card 4 and declaration text
function updateCard4ContentVisibility() {
    const card4ExtraContent = document.querySelector("#card4 .card-body > div:nth-child(4), #card4 .card-body > div:nth-child(5)");

    // Always hide declaration text by default
    declarationText.style.display = "none"; 

    if (anotherCountryYes.checked) {
        card4ExtraContent.style.display = "flex";
    } else if (anotherCountryNo.checked) {
        card4ExtraContent.style.display = "none";

        // Show declaration text if "NO" is selected
        declarationText.style.display = "block"; // Show declaration text when "NO" is selected
    }
}

// Add event listeners for the main "Japan" question
yesRadio.addEventListener('change', updateCardsVisibility);
noRadio.addEventListener('change', updateCardsVisibility);

// Add event listeners for the secondary question in Card 4
anotherCountryYes.addEventListener('change', updateCard4ContentVisibility);
anotherCountryNo.addEventListener('change', updateCard4ContentVisibility);

// Initialize visibility on page load
updateCardsVisibility();
updateCard4ContentVisibility();



    </script>
</body>


</html>
