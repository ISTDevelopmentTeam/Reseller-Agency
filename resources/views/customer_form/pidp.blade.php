<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Pidp</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/pidp.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/pidp_branch.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/animation.css') }}">
</head>

<body style="background-image: url({{ asset('images/bg-pidp3.webp') }});">
    <div class="container-xl p-0 d-flex flex-column main-container shadow rounded-4 overflow-hidden">
        <div class="container-fluid p-4 progress-container" style="background-image: url({{ asset('images/wave-1.svg') }});">
            <div class="d-flex gap-2 align-items-center form-title-container">
                <!-- Logo -->
                <div class="sm-logo-container">
                    <img class="img-fluid" src="{{ asset('images/aap_logo.png') }}" alt="Logo" class="logo">
                </div>
                <!-- Title -->
                <h3 class="text-white">PIDP Application</h3>
            </div>
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb position-relative gap-4" style="--bs-breadcrumb-divider: none; --bs-breadcrumb-item-padding-x: 0;">
                    <!-- Progress bar -->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"></div>
                    </div>
                    <div class="progress-car-container">
                        <div class="progress-car-indicator" role="progressbar">
                            <div class="progress-car">
                                <img class="p-car" src="{{ asset('images/car.svg') }}" alt="car">
                                <img class="p-smoke hide" src="{{ asset('images/smokeart-12.svg') }}" alt="smoke">
                            </div>
                        </div>
                    </div>
                    <li class="breadcrumb-item position-relative ps-0 active" data-step="1">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-id-card"></i></span>
                        <h6>License Details</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="2">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-user"></i></span>
                        <h6>Personal Information</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="3">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-address-book"></i></span>
                        <h6>Contact Information</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="4">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-car"></i></span>
                        <h6>Vehicle Details</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="5">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-list"></i></span>
                        <h6>Information Summary</h6>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Form Card -->
        <div class="container-fluid ps-5 pe-5 pb-5 flex-grow-1 position-relative" id="formContainer">
            <div class="card-body">
                <form id="resellerForm" action="{{ route('pidp.storing', ['token' => $token]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="hiddenFormData" name="form_data" value="">
                    @foreach ($errors->all() as $key => $error)
                        <p style="color: red">{{ $key }} : {{ $error }}</p>
                    @endforeach

                    <!-- Step 1:  Membership Application -->
                    <div class="form-step tab active licensez" id="step1">
                        <div>
                            <div class="step-title-container pt-4">
                                <div class="mb-3">
                                    <h5 class="card-title mb-2">Step 1&#58; <span class="fw-normal">Enter your driver&apos;s license information to begin the permit application process.</span></h5>
                                </div>
                                <hr />
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="license" class="form-label">License Number</label>
                                        <input name="personal_info[members_licenseno]" type="text"
                                            class="text-input form-control license_no"
                                            style='text-transform:uppercase' id="license" autocomplete="off"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="13" placeholder="###-##-######" required
                                            value="{{ old('personal_info.members_licenseno') }}">
                                        <div class="validation-message_license" style="color: red;">
                                            @error('personal_info.members_licenseno')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="expiration" class="form-label">License Expiration Date</label>
                                        <div class="input-group">
                                            <input name="personal_info[members_licenseexpirationdate]" type="text"
                                                class="Select-input form-control" autocomplete="off" id="expiration"
                                                placeholder="MM/DD/YYYY" required
                                                value="{{ old('personal_info.members_licenseexpirationdate') }}">
                                        </div>
                                        <div id="expiration-message" class="text-danger">
                                            @error('personal_info.members_licenseexpirationdate')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6 p-0">
                                        <div class="row ms-0 mt-0 me-0 mb-2">
                                            <!-- Card Type -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="card-type" class="form-label">Card Type</label>
                                                    <select name="personal_info[members_licensecard]"
                                                        class="form-select" id="card-type" required>
                                                        <option disabled selected value="">Select Card Type</option>
                                                        <option value="NON-CARD" {{ old('personal_info.members_licensecard') == 'NON-CARD' ? 'selected' : '' }}>NON CARD</option>
                                                        <option value="CARD" {{ old('personal_info.members_licensecard') == 'CARD' ? 'selected' : '' }}>CARD</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        @error('personal_info.members_licensecard')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <!-- License Type -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label for="license-type" class="form-label">License Type</label>
                                                    <select name="personal_info[members_licensetype]"
                                                        class="form-select" id="license-type" required>
                                                        <option disabled selected value="">Select License Type</option>
                                                        <option value="NON PROFESSIONAL" {{ old('personal_info.members_licensetype') == 'NON PROFESSIONAL' ? 'selected' : '' }}>NON PROFESSIONAL</option>
                                                        <option value="PROFESSIONAL" {{ old('personal_info.members_licensetype') == 'PROFESSIONAL' ? 'selected' : '' }}>PROFESSIONAL</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        @error('personal_info.members_licensetype')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid mb-4 mb-lg-0" style="padding: 0 12px;">
                                            <div>
                                                <label for="" id='choose' class="form-label">Type of License Code&#58; </label>
                                            </div>
                                            <div class="row ms-0 mt-0 me-0 mb-2">
                                                <div class="col-sm-6 pe-sm-2 px-0 pb-2 py-sm-0">
                                                    <label id="dlcode-label" class="p-2 rounded cursor-pointer custom-control custom-radio custom-control-inline w-100 hover-g-300">
                                                        <div class="d-flex gap-2 align-items-baseline w-100">
                                                            <input class="custom-control-input custom-radio-btn" type="radio" name="selection" id="dlcode" value="dlcode" {{ old('selection') == 'dlcode' ? 'checked' : '' }}>
                                                            <div>
                                                                <span class="fw-bold">DL Codes</span><br /><span class="text-secondary">Issued on January 2021 onwards.</span>
                                                            </div>
                                                        </div>
                                                        <div id="dlcodes" class="mt-2" style="display:none;">
                                                            <div class="w-100">
                                                                    <div id="restrictionNumberValue" hidden></div>
                                                                    <div class="checkbox-container d-grid ms-4 mb-1 gap-2">
                                                                        <div class="p-2 custom-card cursor-pointer hover-g-300 rounded">
                                                                            <label class="w-100">
                                                                                <input
                                                                                class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                                                type="checkbox" id="restrictionCheckbox1" value="A, A1" {{ in_array('A, A1', old('dl_restric', [])) ? 'checked' : '' }}>
                                                                                <span class="custom-control-label fw-semibold">A, A1</span>
                                                                            </label>
                                                                            <div class="gap-2 ms-3 mt-2 clutchRadioOptionsGroup" id="clutchRadioOptionsGroup1" style="display: none;">
                                                                                    <div class="custom-control custom-radio custom-control-inline radios">
                                                                                        <hr class="mt-0 mb-2 w-100 mx-auto"/>
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions1"
                                                                                            id="clutchRadio1_1" value="option1" {{ old('clutchRadioOptions1') == 'option1' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch1_1'
                                                                                            for="clutchRadio1_1">MT/AT</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input class="radio-btn custom-control-input" type="radio"
                                                                                            name="clutchRadioOptions3" id="clutchRadio1_2"
                                                                                            value="option2" disabled>
                                                                                        <label class="custom-control-label text-secondary fw-normal"
                                                                                            for="clutchRadio1_2" data-toggle="tooltip"
                                                                                            title="Only MT/AT is permitted.">AT</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-2 custom-card cursor-pointer hover-g-300 rounded">
                                                                            <label class="w-100">
                                                                                <input
                                                                                class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                                                type="checkbox" id="restrictionCheckbox2" value="B, B1, B2" {{ in_array('B, B1, B2', old('dl_restric', [])) ? 'checked' : '' }}>
                                                                                <span class="custom-control-label fw-semibold">B, B1, B2</span>
                                                                            </label>
                                                                            <div class="gap-2 ms-3 mt-2 clutchRadioOptionsGroup" style="display: none;"
                                                                                id="clutchRadioOptionsGroup2">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <hr class="mt-0 mb-2 w-100 mx-auto"/>
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions2"
                                                                                            id="clutchRadio2_1" value="option1" {{ old('clutchRadioOptions2') == 'option1' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch2_1'
                                                                                            for="clutchRadio2_1">MT/AT</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions2"
                                                                                            id="clutchRadio2_2" value="option2" {{ old('clutchRadioOptions2') == 'option2' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch2_2'
                                                                                            for="clutchRadio2_2">AT</label>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="p-2 custom-card cursor-pointer hover-g-300 rounded">
                                                                            <label class="w-100">
                                                                                <input
                                                                                class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                                                type="checkbox" id="restrictionCheckbox3" value="C, D" {{ in_array('C, D', old('dl_restric', [])) ? 'checked' : '' }}>
                                                                                <span class="custom-control-label fw-semibold">C, D</span>
                                                                            </label>
                                                                            <div class="gap-2 ms-3 mt-2 clutchRadioOptionsGroup" style="display: none;"
                                                                                id="clutchRadioOptionsGroup3">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <hr class="mt-0 mb-2 w-100 mx-auto"/>
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions3"
                                                                                            id="clutchRadio3_1" value="option1" {{ old('clutchRadioOptions3') == 'option1' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch3_1'
                                                                                            for="clutchRadio3_1">MT/AT</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions3"
                                                                                            id="clutchRadio3_2" value="option2" {{ old('clutchRadioOptions3') == 'option2' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch3_2'
                                                                                            for="clutchRadio3_2">AT</label>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="p-2 custom-card cursor-pointer hover-g-300 rounded">
                                                                            <label class="w-100">
                                                                                <input
                                                                                class="dl_restric custom-control custom-checkbox checkbox-btn custom-control-input"
                                                                                type="checkbox" id="restrictionCheckbox4" value="BE" {{ in_array('BE', old('dl_restric', [])) ? 'checked' : '' }}>
                                                                                <span class="custom-control-label fw-semibold">BE</span>
                                                                            </label>
                                                                            <div class="gap-2 ms-3 mt-2 clutchRadioOptionsGroup" style="display: none;"
                                                                                id="clutchRadioOptionsGroup4">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <hr class="mt-0 mb-2 w-100 mx-auto"/>
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions4"
                                                                                            id="clutchRadio4_1" value="option1" {{ old('clutchRadioOptions4') == 'option1' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch4_1'
                                                                                            for="clutchRadio4_1">MT/AT</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input class="radio-btn custom-control-input" type="radio"
                                                                                            name="clutchRadioOptions4" id="clutchRadio4_2"
                                                                                            value="option2" disabled>
                                                                                        <label class="custom-control-label text-secondary fw-normal" id='clutch4_2'
                                                                                            for="clutchRadio4_2" data-toggle="tooltip"
                                                                                            title="Only MT/AT is permitted.">AT</label>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-2 custom-card cursor-pointer hover-g-300 rounded">
                                                                            <label class="w-100">
                                                                                <input class="dl_restric checkbox-btn custom-control-input"
                                                                                type="checkbox" id="restrictionCheckbox5" value="CE" {{ in_array('CE', old('dl_restric', [])) ? 'checked' : '' }}>
                                                                                <span class="custom-control-label fw-semibold">CE</span>
                                                                            </label>
                                                                            <div class="gap-2 ms-3 mt-2 clutchRadioOptionsGroup" style="display: none;"
                                                                                id="clutchRadioOptionsGroup5">
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <hr class="mt-0 mb-2 w-100 mx-auto"/>
                                                                                        <input class="sub_dl radio-btn custom-control-input"
                                                                                            type="radio" name="clutchRadioOptions5"
                                                                                            id="clutchRadio5_1" value="option1" {{ old('clutchRadioOptions5') == 'option1' ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label fw-normal" id='clutch5_1'
                                                                                            for="clutchRadio5_1">MT/AT</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input class="radio-btn custom-control-input" type="radio"
                                                                                            name="clutchRadioOptions5" id="clutchRadio5_2"
                                                                                            value="option2" disabled>
                                                                                        <label class="custom-control-label text-secondary fw-normal"
                                                                                            for="clutchRadio5_2" data-toggle="tooltip"
                                                                                            title="Only MT/AT is permitted.">AT</label>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-sm-6 ps-sm-2 px-0 pt-2 py-sm-0">
                                                    <label id="restriction-label" class="p-2 rounded cursor-pointer custom-control custom-radio custom-control-inline w-100 hover-g-300">
                                                        <div class="d-flex gap-2 align-items-baseline w-100">
                                                            <input class="custom-control-input custom-radio-btn" type="radio" name="selection"
                                                            id="restriction" value="restriction" {{ old('selection') == 'restriction' ? 'checked' : '' }}>
                                                            <div>
                                                                <span class="fw-bold">Restriction</span><br /><span class="text-secondary">Older type of license code.</span>
                                                            </div>
                                                        </div>
                                                        <div id="restrictions" class="mt-3" style="display:none;">
                                                            <div class="restriction-checkboxes d-grid ms-4 mb-1 gap-3">
                                                                @for ($i = 1; $i <= 8; $i++)
                                                                    <label class="px-2 py-1 rounded custom-control custom-checkbox custom-control-inline checkboxes custom-control-label fw-semibold cursor-pointer hover-g-300">
                                                                        <input class="checkbox-btn custom-control-input restriction1 cursor-pointer" type="checkbox" name="restriction[]" id="{{ $i }}" value="{{ $i }}" {{ in_array($i, old('restriction', [])) ? 'checked' : '' }}>
                                                                        <span>{{ $i }}</span>
                                                                        {{-- <label class="" for="{{ $i }}">{{ $i }}</label> --}}
                                                                    </label>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-0">
                                        <div class="row ms-0 mt-0 me-0 mb-2">
                                            <!-- ID Image -->
                                            <div class="col-md-12 mb-4">
                                                <div class="form-group">
                                                    <label for="idLicense" class="form-label">Please upload front & back of
                                                        license as one image only.</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="idLicense"
                                                            name="imglicense"
                                                            onchange="handleGeneralFileUpload(this, 'license_id', 'licenseFeedback')"
                                                            required>
                                                        <label class="input-group-text" for="idLicense">
                                                            <i class="fas fa-upload"></i>
                                                        </label>
                                                    </div>
                                                    <div class="id_container">
                                                        <img id="license_id" class="img-fluid" src="" alt="Image license_id">
                                                    </div>
                                                    <div id="licenseFeedback" class="text-danger">
                                                        @error('imglicense')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <!-- Hidden Fields -->
                                    <div class="col-md-4" hidden>
                                        <div class="form-group">
                                            <label for="dlcodearray" class="form-label">DL Code</label>
                                            <input value="{{ old('dlcodearray') }}" name="dlcodearray" type="text"
                                                class="form-control" id="dlcodearray" autocomplete="off"
                                                placeholder="DL Code">
                                            <div class="invalid-feedback">
                                                @error('dlcodearray')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" hidden>
                                        <div class="form-group">
                                            <label for="restric" class="form-label">Restriction</label>
                                            <input value="{{ old('restric') }}" name="restric" type="text" class="form-control"
                                                id="restric" autocomplete="off" placeholder="Restriction">
                                            <div class="invalid-feedback">
                                                @error('restric')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>

                    <!--- End of Step 1 -->

                    <!-- Step 2: Personal Information -->
                    <div class="form-step tab" id="step2">
                        <div class="step-title-container pt-4">
                            <div class="mb-3">
                                <h5 class="card-title mb-2">Step 2&#58; <span class="fw-normal">Provide essential identifying details about yourself, including your name, date of birth, and citizenship.</span></h5>
                            </div>
                            <hr />
                        </div>
                        <div class="text note mb-4 p-3 rounded-3">
                            <div class="note-ribbon">
                                <div class="note-front">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                </div>
                                <div class="note-mid"></div>
                                <div class="note-back"></div>
                            </div>
                            <div class="note-content gap-2 ms-4">
                                <div>
                                    <p class="p1 mb-0">Please make sure that you check the local driving laws at your chosen destination. Keep in mind that countries and states may vary in their acceptance of the IDP.</p>
                                </div>
                            </div>
                        </div>
                         <!-- Are you going to JAPAN? -->
                         <div class="container-fluid japan-container mb-2 px-0">
                            
                            <div class="row justify-content-center hide">
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
                            </div>
                            <div class="row justify-content-center">
                                {{-- <div class="japan-substeps col-md-9 p-4 rounded-2" style="display: none;">
                                    
                                </div> --}}
                                <div class="japanRadio col-md-6 my-3" id="travel_card" style="text-align: center;">
                                    <div id='japanoption' class="bordered1">
                                        <div class="japanRadio-container m-auto">
                                            <h5 class="japanLabel fw-normal">Are you going to JAPAN?</h5>
                                            <div class="radioGroup d-flex justify-content-evenly" style="justify-content: center;">
                                                <label class="custom-control-label japanRadioBtn cursor-pointer p-2">
                                                    <input class="custom-control-input" type="radio" name="option1"
                                                        id="yesRadio" value="yes">
                                                    <span>YES</span>
                                                </label>
                                                <label class="custom-control-label japanRadioBtn cursor-pointer p-2">
                                                    <input class="custom-control-input" type="radio" name="option1" id="noRadio"
                                                        value="no">
                                                    <span>NO</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid p-0 mb-4" id="japanNoPlan" style="text-align: left; display: none;">
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
                                <div class="col-md-6" id="collapsibleYesJapan" style="display: none; text-align: center;">
                                    <div class="other-country-container bordered1 m-auto" id="bordered1">
                                        <label class="japanLabel">Are you going to another country aside JAPAN?</label>
                                        <div class="radioGroup d-flex gap-3 justify-content-center mb-3">
                                            {{-- <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="option2"
                                                    id="yesDropdown" value="yes">
                                                <label for="yesDropdown" class="custom-control-label japanLabel">YES</label>
                                            </div> --}}
                                            <label class="custom-control-label japanRadioBtn2nd cursor-pointer p-1">
                                                <input class="custom-control-input" type="radio" name="option2"
                                                    id="yesDropdown" value="yes">
                                                <span>YES</span>
                                            </label>
                                            {{-- <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                                <input class="custom-control-input" type="radio" name="option2"
                                                    id="noDropdown" value="no" style="margin-left: 1rem;">
                                                <label for="noDropdown" class="custom-control-label japanLabel">NO</label>
                                            </div> --}}
                                            <label class="custom-control-label japanRadioBtn2nd cursor-pointer p-1">
                                                <input class="custom-control-input" type="radio" name="option2" id="noDropdown"
                                                    value="no">
                                                <span>NO</span>
                                            </label>
                                        </div>
                                        <p><b style="color:red;">NOTE: </b>Additional &#8369; 600.00 for multiple PIDP.</p>
                                    </div>
                                    <div class="japan-substeps2nd mt-3 mb-4 p-3 bordered1" style="display: none;">
                                        <input value="JAPAN" name="japan_only" type="text" class="text-input form-control" id="auto_japan" autocomplete="off"
                                        placeholder=" Enter occupation" hidden>

                                        <div id="travelDestination1" class="mb-4" style="display: none; text-align: left;">
                                            <label class="form-label" for="destinationIn">Destination</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Destination" name="destinationIn" id="destinationIn">
                                            <div class="invalid-feedback"></div>
                                            <div id="dremarks" style="color:red;"></div>
                                        </div>

                                        <div style="text-align: left;" id="purpose_ofw">
                                            <label for="members_purposetravel1" class="Select-label form-label">Purpose of
                                                Travel</label>
                                            <select name="purposetravel" class="form-control"
                                                id="members_purposetravel1">
                                                <option value="" selected disabled> Select Purpose</option>
                                                <option value="Tourism">Tourism</option>
                                                <option value="Work">Work</option>
                                            </select>
                                            <div class="invalid-feedback">This field is required</div>
                                            <div class="ofw1 my-5" style="display:none; text-align:center; margin-top:1rem;"
                                                id='option_ofw1'>
                                                <label class="form-label" for="ofw_yes1">Are you an OFW?</label>
                                                <div class="text-center justify-content-center d-flex gap-2" id="op_ofw1">
                                                    <!-- <div class="text-center justify-content-center d-flex"> -->
                                                    {{-- <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="ofw"
                                                            id="ofw_yes1" value="yes">
                                                        <label for="ofw_yes1" class="custom-control-label"
                                                            id="ofww1">YES</label>
                                                    </div> --}}
                                                    <label id="ofww1" class="custom-control-label japanRadioBtn3rd cursor-pointer p-1">
                                                        <input class="custom-control-input" type="radio" name="ofw" id="ofw_yes1"
                                                            value="yes">
                                                        <span>YES</span>
                                                    </label>
                                                    {{-- <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                                        <input class="custom-control-input" type="radio" name="ofw"
                                                            id="ofw_no1" value="no">
                                                        <label for="ofw_no1" class="custom-control-label"
                                                            id="ofww11">NO</label>
                                                    </div> --}}
                                                    <label id="ofww11" class="custom-control-label japanRadioBtn3rd cursor-pointer p-1">
                                                        <input class="custom-control-input" type="radio" name="ofw" id="ofw_no1"
                                                            value="no">
                                                        <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="date_depart1" style="display:none;" id="optional_date1">
                                                <div class="row mb-1 mt-4">
                                                    <div class="col-md-6 mb-mobile">
                                                        <label class="Select-label form-label">Departure Date (OPTIONAL)</label>
                                                        <input type="text" name="departure_date1" id="departure_date1"
                                                            class="form-control" maxlength="10"
                                                            oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                            inputmode="numeric" autocomplete="off"
                                                            placeholder="MM/DD/YYYY" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="Select-label form-label">Return Date (OPTIONAL)</label>
                                                        <input type="text" name="return_date1" id="return_date1"
                                                            class="form-control" maxlength="10"
                                                            oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                            inputmode="numeric" autocomplete="off"
                                                            placeholder="MM/DD/YYYY" />
                                                    </div>
                                                </div>
                                                <p id="note_depart_return" class="m-0"><em>Note: For Marketing Purposes</em></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="nojapan" style="display: none;">
                                    <div class="form-group bordered1 p-4" id="travelDestination" style="display: none;">
                                        <label class="form-label" for="destinationOut"
                                            style="text-align: left;">Destination</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Destination" name="destinationOut" id="destinationOut">
                                        <br>
                                        <div id="dremarks1" style="color:red;"></div>
                                        <div class="form-group">
                                            <label for="members_purposetravel" class="form-label">Purpose of
                                                Travel</label>
                                            <select name="purposetravel" class="form-select"
                                                id="members_purposetravel">
                                                <option value="" selected disabled> Select Purpose</option>
                                                <option value="Tourism">Tourism</option>
                                                <option value="Work">Work</option>
                                            </select>
                                            <div class="invalid-feedback">This field is required</div>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                        <div class="ofw my-5" style="display:none; text-align:center; margin-top:1rem;"
                                            id='option_ofw'>
                                            <label class="form-label" for="ofw_yes">Are you an OFW?</label>
                                            <div id="op_ofw">
                                                <div class="text-center justify-content-center d-flex gap-2">
                                                    {{-- <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="ofw"
                                                            id="ofw_yes" value="yes">
                                                        <label for="ofw_yes" class="custom-control-label japanLabel"
                                                            id="ofww">YES</label>
                                                    </div> --}}
                                                    <label class="custom-control-label japanRadioBtn3rd cursor-pointer p-1">
                                                        <input class="custom-control-input" type="radio" name="ofw"
                                                            id="ofw_yes" value="yes">
                                                        <span>YES</span>
                                                    </label>
                                                    {{-- <div class="custom-control custom-radio" style="margin-left: 1rem;">
                                                        <input class="custom-control-input" type="radio" name="ofw"
                                                            id="ofw_no" value="no">
                                                        <label for="ofw_no" class="custom-control-label japanLabel"
                                                            id="ofww">NO</label>
                                                    </div> --}}
                                                    <label class="custom-control-label japanRadioBtn3rd cursor-pointer p-1">
                                                        <input class="custom-control-input" type="radio" name="ofw" id="ofw_no"
                                                            value="no">
                                                        <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="date_p" style="display:none;" id="optional_date">
                                            <!-- <label class="Select-label mt-3">Departure and Return Date (OPTIONAL)</label> -->
                                            <div class="row mt-3 mb-1">
                                                <div class="col-md-6">
                                                    <label class="form-label">Departure (OPTIONAL)</label>
                                                    <input type="text" name="departure_date" id="departure_date"
                                                        class="form-control" maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        inputmode="numeric" autocomplete="off" placeholder="MM/DD/YYYY" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Return Date (OPTIONAL)</label>
                                                    <input type="text" name="return_date" id="return_date"
                                                        class="form-control" maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        inputmode="numeric" autocomplete="off" placeholder="MM/DD/YYYY" />
                                                </div>
                                            </div>
                                            <p id="note_depart_return m-0"><em>Note: For Marketing Purposes</em></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid p-0">
                                    <!-- YES JAPAN AND OTHER COUNTRY-->
                                    <div class="form-check p-2" id="dropDownYes1" style="display: none;">
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
                                    <div class="form-check p-2" id="dropDownNo" style="display: none;">
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
                                            {{-- <div class="formCheck d-flex" id="gc1">
                                                <input name="hereby1" class="check-input" value="1" type="checkbox" id="checkbox">
                                                <label class="form-check-label p-3" for="checkbox">
                                                    I hereby declare that I have read the and have fully understood its
                                                    contents. I
                                                    further declare that I voluntarily and willingly executed the full
                                                    knowledge of my
                                                    rights under the law.
                                                </label>
                                            </div> --}}
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
                        <hr>
                        <div class="row p-0">
                            <div class="row mb-2">
                                <div class="col-md-3 mb-4">
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
                                <div class="col-md-3 mb-4">
                                    <label for="firstName" class="form-label letters_only_fname">First Name</label>
                                    <input type="text" class="form-control letters_only_fname" id="firstName"
                                    name="personal_info[members_firstname]"
                                    value="{{ old('personal_info.members_firstname') }}" required>
                                    @error('personal_info.members_firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="validation-message_fname" style="color: red;"></div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="middleName" class="form-label letters_only_mname">Middle Name</label>
                                    <input type="text" class="form-control letters_only_mname" id="middleName"
                                    name="personal_info[members_middlename]"
                                    value="{{ old('personal_info.members_middlename') }}">
                                    @error('personal_info.members_middlename')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                <div class="validation-message_mname" style="color: red;"></div>
                                </div>
                                <div class="col-md-3 mb-4">
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
                            <div class="row mb-2">
                                <div class="col-md-3 mb-4">
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
                                <div class="col-md-3 mb-4">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input type="text" class="form-control" name="personal_info[members_birthdate]"
                                    id="birthdate" autocomplete="off" placeholder="MM/DD/YYYY" maxlength="10"
                                    value="{{ old('personal_info.members_birthdate') }}" required>
                                    @error('personal_info.members_birthdate')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="birthplace" class="form-label">Birth Place</label>
                                    <input type="text" class="form-control" name="personal_info[members_birthplace]"
                                    id="birthplace" value="{{ old('personal_info.members_birthplace') }}" required>
                                    @error('personal_info.members_birthplace')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" name="personal_info[occupation_name]"
                                    id="occupation" value="{{ old('personal_info.occupation_name') }}" required>
                                @error('personal_info.occupation_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-4">
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
                                <div class="col-md-3 mb-4">
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
                                <div class="col-md-3 mb-4" id="add_info"
                                    style="{{ old('personal_info.citizenship') == 'foreigner' ? '' : 'display: none;' }}">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <input type="text" class="form-control" name="personal_info[nationality]"
                                    id="nationality" value="{{ old('personal_info.nationality') }}">
                                    @error('personal_info.nationality')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4 d-grid flex-grow-1" style="place-items: center;">
                                    <label for="idAttachment" class="form-label" style="place-self: start;">ID Image &lpar;Upload a valid
                                        government ID&rpar;</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="idAttachment" name="idpicture"
                                            onchange="handleGeneralFileUpload(this, 'valid_id', 'idFeedback')" required>
                                        <label class="input-group-text" for="idAttachment">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <div id="valid_id_dropdown" class="w-100 hide">
                                        <div id="valid_id_container" class="pt-1 pb-1">
                                            <img id="valid_id" class="img-fluid m-auto" src="{{ asset('images/image-placeholder.png') }}" alt="Image valid_id" style="object-fit: contain;">
                                        </div>
                                        <button id="id_dropdown_btn" type="button" class="w-100 p-0 btn bg-dark-subtle"><i class="bi bi-caret-down-fill dark-gray"></i></button>
                                    </div>
                                    <div id="idFeedback" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="navigation-buttons"></div>
                        </div>
                    </div>

                    <!-- End of Step 2 -->


                    <!-- Step 3: Contact Information Section -->
                    <div class="form-step tab" id="step3">
                        <div>
                            <div class="step-title-container pt-4">
                                <div class="mb-3">
                                    <h5 class="card-title mb-2">Step 3&#58; <span class="fw-normal">Enter your primary contact information, including your mailing address, telephone number, and email address.</span></h5>
                                </div>
                                <hr />
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <label for="mail" class="form-label">Mailing Preference</label>
                                    <select class="form-select" name="personal_info[mailing_preference]" id="mail"
                                        required>
                                        <option value="" {{ !old('personal_info.mailing_preference') ? 'selected' : '' }} disabled>Select Mailing Address</option>
                                        <option value="HOUSE ADDRESS" {{ old('personal_info.mailing_preference') == 'HOUSE ADDRESS' ? 'selected' : '' }}>HOUSE ADDRESS</option>
                                        <option value="OFFICE ADDRESS" {{ old('personal_info.mailing_preference') == 'OFFICE ADDRESS' ? 'selected' : '' }}>OFFICE ADDRESS</option>
                                    </select>
                                    @error('personal_info.mailing_preference')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-100 mb-4">
                                <h5 class="mt-1 mb-3">Home Address</h5>
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-4">
                                        <label for="street" class="form-label">Building No. / Street</label>
                                        <input type="text" class="form-control" name="personal_info[members_haddress1]"
                                            id="street" value="{{ old('personal_info.members_haddress1') }}" required>
                                        @error('personal_info.members_haddress1')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="town" class="form-label">Barangay / Towns</label>
                                        <input type="text" class="form-control" name="personal_info[members_haddress2]"
                                            id="town" value="{{ old('personal_info.members_haddress2') }}" required>
                                        @error('personal_info.members_haddress2')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <label for="city" class="form-label">City/Municipality</label>
                                        <input type="text" class="form-control" name="personal_info[members_housecity]"
                                            id="city" value="{{ old('personal_info.members_housecity') }}" required>
                                        @error('personal_info.members_housecity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <label for="province" class="form-label">Province</label>
                                        <input type="text" class="form-control"
                                            name="personal_info[members_housedistrict]" id="province"
                                            value="{{ old('personal_info.members_housedistrict') }}" required>
                                        @error('personal_info.members_housedistrict')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2pt4 mb-4">
                                        <label for="zcode" class="form-label">ZIP Code</label>
                                        <input type="text" class="form-control number_only" maxlength="4"
                                            name="personal_info[members_housezipcode]" id="zcode"
                                            value="{{ old('personal_info.members_housezipcode') }}" 
                                            placeholder="e.g. 1234" 
                                            required>
                                        @error('personal_info.members_housezipcode')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3pt6 mb-4">
                                        <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                                        <select class="form-select" name="personal_info[is_aq]"
                                            id="availMagazine" required>
                                            <option value="1">YES</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-3 col-md-6 mb-4 with-number">
                                    <label for="mobileNumber" class="form-label d-flex justify-content-between">Mobile No.
                                        <span id="valid-msg-1" class="hide valid-msg"></span>
                                        <span id="error-msg-1" class="hide error-msg"></span>
                                    </label>
                                    <input type="tel" class="form-control phone-input"
                                        name="personal_info[members_mobileno]" id="mobileNumber"
                                        data-error-container="error-msg-1" data-valid-container="valid-msg-1"
                                        data-code-input="ccode-1"
                                        value="{{ old('personal_info.members_mobileno') }}" required>
                                    @error('personal_info.members_mobileno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3pt6 col-md-6 mb-4 with-number">
                                    <label for="alternateMobile" class="form-label d-flex justify-content-between">Alternate Mobile No.
                                        <span id="valid-msg-2" class="hide valid-msg"></span>
                                        <span id="error-msg-2" class="hide error-msg"></span>
                                    </label>
                                    <input type="tel" class="form-control phone-input"
                                        name="personal_info[members_alternate_mobileno]" id="alternateMobile"
                                        data-error-container="error-msg-2" data-valid-container="valid-msg-2"
                                        data-code-input="ccode-2"
                                        value="{{ old('personal_info.members_alternate_mobileno') }}">
                                    @error('personal_info.members_alternate_mobileno')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-2pt4 col-md-6 mb-4">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <input type="email" class="form-control"
                                        name="personal_info[members_emailaddress]" id="emailAddress"
                                        value="{{ old('personal_info.members_emailaddress') }}" 
                                        placeholder="example@email.com" 
                                        required>
                                    @error('personal_info.members_emailaddress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <label for="alternateEmail" class="form-label">Alternate Email
                                        Address</label>
                                    <input type="email" class="form-control"
                                        name="personal_info[members_alternate_emailaddress]" id="alternateEmail"
                                        value="{{ old('personal_info.members_alternate_emailaddress') }}" 
                                        placeholder="alt_example@email.com">
                                    @error('personal_info.members_alternate_emailaddress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="pt-5" id="officeAddress" style="display: none;">
                            <h5 class="mt-1 mb-3">Office Address</h5>
                            <div class="row mb-2">
                                <div class="col-md-9 mb-4">
                                    <label for="street1" class="form-label">Building No. / Street</label>
                                    <input type="text" class="form-control"
                                        name="personal_info[members_oaddress1]" id="street1"
                                        value="{{ old('personal_info.members_oaddress1') }}">
                                    @error('personal_info.members_oaddress1')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="town1" class="form-label">Barangay / Towns</label>
                                    <input type="text" class="form-control"
                                        name="personal_info[members_oaddress2]" id="town1"
                                        value="{{ old('personal_info.members_oaddress2') }}">
                                    @error('personal_info.members_oaddress2')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 mb-4">
                                    <label for="city1" class="form-label">City/Municipality</label>
                                    <input type="text" class="form-control"
                                        name="personal_info[members_officecity]" id="city1"
                                        value="{{ old('personal_info.members_officecity') }}">
                                    @error('personal_info.members_officecity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="province1" class="form-label">Province</label>
                                    <input type="text" class="form-control"
                                        name="personal_info[members_officedistrict]" id="province1"
                                        value="{{ old('personal_info.members_officedistrict') }}">
                                    @error('personal_info.members_officedistrict')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="zcode1" class="form-label">Zip</label>
                                    <input type="text" class="form-control number_only"
                                        name="personal_info[members_officezipcode]" id="zcode1" maxlength="4"
                                        value="{{ old('personal_info.members_officezipcode') }}">
                                    @error('personal_info.members_officezipcode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-7 mb-4">
                                    <label for="comname" class="form-label">Company Name</label>
                                    <input type="text" class="form-control"
                                        name="personal_info[members_businessname]" id="comname"
                                        value="{{ old('personal_info.members_businessname') }}">
                                    @error('personal_info.members_businessname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="telephoneNumber" class="form-label">Telephone
                                        Number</label>
                                    <input type="tel" class="form-control number_only"
                                        name="personal_info[tele_num]" id="telephoneNumber"
                                        onkeyup="maskTelNo(this.id)"
                                        value="{{ old('personal_info.tele_num') }}">
                                    @error('personal_info.tele_num')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="navigation-buttons"></div>
                        </div>
                    </div>
                    <!-- End of Step 3 -->

                    <!-- Step 4: Vehicle Information -->
                    <div class="form-step tab position-relative" id="step4">
                        <div>
                            <div id="vehicleOwnershipTitle" class="title-overlay text-center d-flex justify-content-center align-items-center flex-column pt-3 mb-3">
                                <div class="vehicleOwnershipContainer px-5 gap-2">
                                    <label for="vehicleOwnership" id="own_vehicle_phil" class="mb-4"><h4 class="m-0"><span class="stepNum">Step 4&#58;&nbsp;</span><span class="stepDesc fw-normal">Before proceeding, do you have a vehicle in the Philippines?</span></h4></label>
                                    <div class="ownRadio-container d-flex justify-content-center align-items-center gap-3">
                                        <input type="hidden" id="with_vehicle" name="with_vehicle" value="no">
                                        <label class="ownership-radio">
                                            <input class="" type="radio" name="vehicleOwnership"
                                                id="vehicleOwnershipYes" value="yes" onchange="toggleVehicleDetails(this)">
                                            <span>Yes</span>
                                        </label>
                                        <label class="ownership-radio">
                                            <input class="" type="radio" name="vehicleOwnership"
                                                id="vehicleOwnershipNo" value="no" onchange="toggleVehicleDetails(this)">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- <button type="button" class="btn-top-skip px-3">
                                <h6 class="m-0">Skip step&nbsp;<i class="fa-solid fa-angles-right"></i></h6>
                            </button> --}}

                            <div id="vehicleFields" class="gap-5 mb-4 vehicle-entry" style="display: none;">
                                <!-- Initial Vehicle Form -->
                                <div class="vehicle-item border rounded p-3 animated-moveDown">
                                    <div class="vehicle-title mb-4">
                                        <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                    </div>
                                    <div class="row g-4 mt-0">
                                        <!-- First Row -->
                                        <div class="w-100 mt-1 psd-container">
                                            <div class="col-md-4 pt-0 pb-0 ps-0 pe-3 centered-content c-sticker-container">
                                                <label class="label" style="font-size: medium;">
                                                    Is Conduction Sticker Available?
                                                </label>
                                                <input type="hidden" id="csticker" name="is_cs[]"
                                                    value="{{ old('is_cs.0', '0') }}">
                                                <div>
                                                    <div class="options-container">
                                                        <label class="p-1 radio-checkbox">
                                                            <input type="checkbox" id="csticker_yes" value="1" {{ old('is_cs.0') == '1' ? 'checked' : '' }}
                                                                onchange="updateLabeldyna('csticker_yes', 'csticker_no')">
                                                            <span class="checkmark"></span>
                                                            YES
                                                        </label>
                                                        <label class="p-1 radio-checkbox cbox-no">
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

                                            <div class="col-md-4 p-0 platenum-container">
                                                <label for="platenum" class="label">Plate Number</label>
                                                <input name="vehicle_plate[]" type="text"
                                                    class="text-input form-control platenum @error('vehicle_plate.*') is-invalid @enderror"
                                                    id="platenum" value="{{ old('vehicle_plate.0') }}" autocomplete="off"
                                                    placeholder="Enter Plate No." style="text-transform: uppercase;" 
                                                    data-input-type="plate"> <!-- Added data attribute to track input type -->
                                                @error('vehicle_plate.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="validation-message_plateno" style="color: red;"></div>
                                            </div>

                                            <div class="col-md-4 pt-0 pb-0 ps-3 pe-0 centered-content is-diplomat-container">
                                                <label class="label" style="font-size: medium;">
                                                    Is Diplomat?
                                                </label>
                                                <input type="hidden" id="is_diplomat_1" name="is_diplomat[]"
                                                    value="{{ old('is_diplomat.0', '0') }}">
                                                <div>
                                                    <div class="options-container">
                                                        <label class="p-1 radio-checkbox">
                                                            <input type="checkbox" id="is_diplomat_yes_1" value="1" {{ old('is_diplomat.0') == '1' ? 'checked' : '' }}
                                                                onchange="update_diplomat('is_diplomat_yes_1', 'is_diplomat_no_1')">
                                                            <span class="checkmark"></span>
                                                            YES
                                                        </label>
                                                        <label class="p-1 radio-checkbox cbox-no">
                                                            <input type="checkbox" id="is_diplomat_no_1" value="0" {{ old('is_diplomat.0') == '0' ? 'checked' : '' }}
                                                                onchange="update_diplomat('is_diplomat_no_1', 'is_diplomat_yes_1')"
                                                                {{ old('is_diplomat.0') == '1' ? '' : 'checked disabled' }}>
                                                            <span class="checkmark"></span>
                                                            NO
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-md-3 d-flex flex-column with-select2">
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
    
                                        <div class="col-md-3 d-flex flex-column with-select2">
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
                                        <div class="col-md-3 d-flex flex-column with-select2">
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
                                                <div class="or-container">
                                                    <img id="or" class="img-fluid" src="" alt="Image or">
                                                </div>
                                                <div id="orFeedback" class="text-danger"></div>
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
                                                <div class="cr-container">
                                                    <img id="cr" class="img-fluid" src="" alt="Image cr">
                                                </div>
                                                <div id="crFeedback" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Vehicle Button -->
                            <button type="button" class="btn btn-primary mt-3" id="addVehicle" style="display: none;">
                                <i class="bi bi-plus-circle me-2"></i>Add Item
                            </button>
                        </div>
                    </div>
                    <!-- Step 5: Information Summary -->
                    <div class="form-step tab" id="step5">
                        <div>
                            <div class="step-title-container pt-4">
                                <div class="mb-3">
                                    <h5 class="card-title mb-2">Step 5&#58; <span class="fw-normal">Before submitting your application, carefully review and confirm all the information you've entered across the preceding steps.</span></h5>
                                </div>
                                <hr />
                            </div>
                            <div class="justify-content-right"></div>

                            <div class="container-fluid">
                                <div class="mb-4">
                                    <div class="row text-center text-light dark-blue-bg p-2">
                                        <h6 class="m-0">PERSONAL INFORMATION</h6>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoTitle">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoLastName">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoFirstName">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoMiddleName">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoBirthdate">N/A</div>
                                        <div class="col-md-6 p-2 light-border-subtle" id="echoBirthPlace">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoGender">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoCitizenship">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoStatus">N/A</div>
                                        <div class="col-md-6 p-2 light-border-subtle" id="echoOccupation">N/A</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="row text-center text-light dark-blue-bg p-2">
                                        <h6 class="m-0">CONTACT INFORMATION</h6>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-12 p-2 light-border-subtle" id="echoHomeAddress">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-12 p-2 light-border-subtle" id="echocomname">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-12 p-2 light-border-subtle" id="echoOfficeAddress">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-3 p-2 light-border-subtle" id="echomobilenum">N/A</div>
                                        <div class="col-md-3 p-2 light-border-subtle" id="echoOfficeMobileNo">N/A</div>
                                        <div class="col-md-6 p-2 light-border-subtle" id="echoMailingPreference">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-4 p-2 light-border-subtle" id="echoalternatemobilenum">N/A</div>
                                        <div class="col-md-4 p-2 light-border-subtle" id="echoemailadd">N/A</div>
                                        <div class="col-md-4 p-2 light-border-subtle" id="echoalternateemailadd">N/A</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="row text-center text-light dark-blue-bg p-2">
                                        <h6 class="m-0">LICENSE DETAILS</h6>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-6 p-2 light-border-subtle" id="echolicensenum">N/A</div>
                                        <div class="col-md-6 p-2 light-border-subtle" id="echolicenseexpiration">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-6 p-2 light-border-subtle" id="echocardtype">N/A</div>
                                        <div class="col-md-6 p-2 light-border-subtle" id="echolicensetype">N/A</div>
                                    </div>
                                    <div class="row centered-text">
                                        <div class="col-md-12 p-2 light-border-subtle" id="echodl-or-restriction">N/A</div>
                                        {{-- <div class="col-md-6 p-2 light-border-subtle" id="echorestriction">N/A</div> --}}
                                    </div>
                                </div>

                                <div class="mb-3" id="myTable">
                                    <div class="row text-center text-light dark-blue-bg p-2">
                                        <h6 class="m-0">VEHICLE DETAILS</h6>
                                    </div>
                                    <div id="tbodyid"></div>
                                </div>
                            </div>
                        </div>
                        

                            {{-- <div class="row col-md-12">
                              <table class="table table-bordered ">
                                <thead>
                                  <tr>
                                    <th colspan="5" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">PERSONAL INFORMATION</th>
                                  </tr>
                                </thead>
                                <tbody> --}}
                                  {{-- <tr>
                                    <td id="echoTitle"></td>
                                    <td id="echoLastName"></td>
                                    <td id="echoFirstName"></td>
                                    <td id="echoMiddleName"></td>
                                  </tr> --}}
                                  {{-- <tr>
                                    <td id="echoBirthdate"></td>
                                    <td colspan="2" id="echoBirthPlace"></td>
                                    <td id="echoGender"></td>
                                  </tr> --}}
                                  {{-- <tr>
                                    <td id="echoCitizenship"></td>
                                    <td id="echoStatus"></td>
                                    <td colspan="2" id="echoOccupation"></td>
                                  </tr> --}}
                                  <!-- Add more rows as needed -->
                                {{-- </tbody>
                              </table> --}}
                        
                              {{-- <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th colspan="4" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">CONTACT INFORMATION</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td colspan="4" id="echoHomeAddress"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" id="echocomname"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" id="echoOfficeAddress"></td>
                                  </tr>
                                  <tr>
                                    <!-- <td id="echoHomeMobileNo"></td> -->
                                    <td id="echomobilenum"></td>
                                    <td id="echoOfficeMobileNo"></td>
                                    <td colspan="2" id="echoMailingPreference"></td>
                                  </tr>
                                  <tr>
                                    <td id="echoalternatemobilenum"></td>
                                    <td id="echoemailadd"></td>
                                    <td id="echoalternateemailadd"></td>
                                  </tr>
                                </tbody>
                              </table> --}}
                              {{-- <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">LICENSE DETAILS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="echolicensenum"></td>
                                        <td colspan="2" id="echolicenseexpiration"></td>
                                    </tr>
                                    <tr>
                                        <td id="echocardtype"></td>
                                        <td colspan="2" id="echolicensetype"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" id="echodl"></td>
                                        <td id="echorestriction"></td>
                                    </tr>
                                </tbody>
                                </table> --}}
                                  {{-- <table class="table table-bordered" id="myTable">
                                    <thead>
                                      <tr>
                                        <th colspan="5" class="text-center text-light" style="background-color: rgba(21, 24, 72, 0.836);">VEHICLE DETAILS</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tbodyid">
                                    </tbody>
                                
                                  </table> --}}
                                {{-- </div> --}}

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
                    </div>
                </form>
                <div class="xl-road-container">
                    <img class="img-fluid" src="{{ asset('images/world-road.webp') }}" alt="Road at night">
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row g-4">
        <!-- Form Card -->
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-10">
                <div class="scrollable-card card shadow-lg">

                    <div class="card-body">

                        


                        
                </div>
            </div>
        </div>
    </div>

    </div> --}}
    <footer class="footer container-fluid">
        <div class="footer-text">
            Copyright © 2024 Automobile Association of the Philippines
        </div>
    </footer>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('script/customer_side/pidp.js') }}"></script>
<script src="{{ asset('script/customer_side/pidp_branch.js') }}"></script>
<script src="{{ asset('script/sidebar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

{{-- @include('vehicle_autocomp') --}}
@include('dynamic_vehicle')
@include('countrycode')
@include('flatpickr_date')
    <script>
        $(document).ready(function () {
            var towns = @json($towns);
            $("#town").autocomplete({
                appendTo: "#formContainer",
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
            appendTo: "#formContainer",
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
            appendTo: "#formContainer",
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
            appendTo: "#formContainer",
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
            appendTo: "#formContainer",
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
            appendTo: "#formContainer",
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