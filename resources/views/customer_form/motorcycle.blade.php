<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Motorcycle</title>
    <link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/motorcycle.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/moto_branch.css') }}">
</head>

<body style="background-image: url({{ asset('images/bg-6-moto.webp') }});">
    <div class="container-xl p-0 d-flex flex-column main-container shadow rounded-4 overflow-hidden">
        <div class="container-fluid p-4 progress-container" style="background-image: url({{ asset('images/wave-1.svg') }});">
            <div class="d-flex gap-2 align-items-center form-title-container">
                <!-- Logo -->
                <div class="sm-logo-container">
                    <img class="img-fluid" src="{{ asset('images/aap_logo.png') }}" alt="Logo" class="logo">
                </div>
                <!-- Title -->
                <h3 class="text-white">Motorcycle Membership</h3>
            </div>
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb position-relative gap-4" style="--bs-breadcrumb-divider: none; --bs-breadcrumb-item-padding-x: 0;">
                    <!-- Progress bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar"></div>
                    </div>
                    <li class="breadcrumb-item position-relative ps-0 active" data-step="1">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-user"></i></span>
                        <h6>Personal Information</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="2">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-address-book"></i></span>
                        <h6>Contact Information</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="3">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-user-shield"></i></span>
                        <h6>Beneficiaries</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="4">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-motorcycle"></i></span>
                        <h6>Motorcycle Details</h6>
                    </li>
                    <li class="breadcrumb-item position-relative ps-0" data-step="5">
                        <span class="breadcrumb-icon position-relative z-2"><i class="fa-solid fa-list"></i></span>
                        <h6>Information Summary</h6>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Form Card -->
        <div class="container-fluid ps-5 pe-5 pb-5 flex-grow-1" id="formContainer">
                <div class="card-body">
                    <form id="resellerForm" action="{{ route('motorcycle.storing', ['token' => $token]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="hiddenFormData" name="form_data" value="">
                        @foreach ($errors->all() as $key => $error)
                            <p style="color: red">{{ $key }} : {{ $error }}</p>
                        @endforeach
                        <!-- Step 1:  Membership Application -->
                        <div class="form-step tab active" id="step1">
                            <div>
                                <div class="step-title-container pt-4">
                                    <div class="mb-3">
                                        <h5 class="card-title mb-2">Step 1&#58; <span class="fw-normal">Provide essential identifying details about yourself, including your name, date of birth, and citizenship.</span></h5>
                                    </div>
                                    <hr />
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-4">
                                        <label for="plantype" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plan_type]" required>
                                            @if ($selectedPlan)
                                                <option value="{{ $selectedPlan->plan_name }}" selected>
                                                    {{ $selectedPlan->plan_name }} - {{ $selectedPlan->plan_amount }}
                                                </option>
                                            @else
                                                <option value="" selected disabled>Select Plan Type</option>
                                            @endif
                                        </select>
                                        @if ($selectedPlan)
                                            <input type="hidden" name="personal_info[plantype_id]"
                                                value="{{ $selectedPlan->plan_id }}" id="selected_plan_id">
                                        @endif
                                        @error('personal_info.plan_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="idAttachment" class="form-label">Upload Image: 2x2 or passport size id picture</label>
                                        <div class="input-group z-2">
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
                                        @error('idpicture')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="idFeedback" class="text-danger"></div>
                                        {{-- <img id="valid_id" src="" alt="Image valid_id"
                                            style="max-width: 200px; display: none; margin-top: 10px;"> --}}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-4">
                                        <label for="title" class="form-label">Title</label>
                                        <select class="form-select" id="title" name="personal_info[members_title]"
                                            required>
                                            <option value="" {{ !old('personal_info.members_title') ? 'selected' : '' }}
                                                disabled>Select Title</option>
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
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control letters_only_fname" id="firstName"
                                            name="personal_info[members_firstname]"
                                            value="{{ old('personal_info.members_firstname') }}" required>
                                        @error('personal_info.members_firstname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="validation-message_fname" style="color: red;"></div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control letters_only_mname" id="middleName"
                                            name="personal_info[members_middlename]"
                                            value="{{ old('personal_info.members_middlename') }}">
                                        @error('personal_info.members_middlename')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="validation-message_mname" style="color: red;"></div>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <label for="lastName" class="form-label">Last Name</label>
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
                                        <select class="form-select" id="gender" name="personal_info[members_gender]"
                                            required>
                                            <option value="" {{ !old('personal_info.members_gender') ? 'selected' : '' }} disabled>Select a Gender</option>
                                            <option value="MALE" {{ old('personal_info.members_gender') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                            <option value="FEMALE" {{ old('personal_info.members_gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                        </select>
                                        @error('personal_info.members_gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <label class="form-label">Birthdate</label>
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
                                            id="birthplace" value="{{ old('personal_info.members_birthplace') }}"
                                            required>
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
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-4">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" id="civilStatus"
                                            name="personal_info[members_civilstatus]" required>
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
                                        <select class="form-select" name="personal_info[citizenship]" id="citizenship"
                                            required>
                                            <option value="" {{ !old('personal_info.citizenship') ? 'selected' : '' }}
                                                disabled>Select Citizenship</option>
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
                                </div>
                            </div>
                        </div>
                        <!--- End of Step 1 -->
                        <!-- Step 2: Contact Information Section -->
                        <div class="form-step tab" id="step2">
                            <div>
                                <div class="step-title-container pt-4">
                                    <div class="mb-3">
                                        <h5 class="card-title mb-2">Step 2&#58; <span class="fw-normal">Enter your primary contact information, including your mailing address, telephone number, and email address.</span></h5>
                                    </div>
                                    <hr />
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-4">
                                        <label for="mail" class="form-label">Mailing Preference</label>
                                        <select class="form-select" name="personal_info[mailing_preference]" id="mail"
                                            required>
                                            <option value=""
                                                {{ !old('personal_info.mailing_preference') ? 'selected' : '' }} disabled>
                                                Select Mailing Address</option>
                                            <option value="HOUSE ADDRESS"
                                                {{ old('personal_info.mailing_preference') == 'HOUSE ADDRESS' ? 'selected' : '' }}>
                                                HOUSE ADDRESS</option>
                                            <option value="OFFICE ADDRESS"
                                                {{ old('personal_info.mailing_preference') == 'OFFICE ADDRESS' ? 'selected' : '' }}>
                                                OFFICE ADDRESS</option>
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
                                            <select class="form-select" name="personal_info[is_aq]" id="availMagazine"
                                                required>
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
                                            data-code-input="ccode-1" value="{{ old('personal_info.members_mobileno') }}"
                                            required>
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
                                        <input type="email" class="form-control" name="personal_info[members_emailaddress]"
                                            id="emailAddress" value="{{ old('personal_info.members_emailaddress') }}"
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
                                <div id="officeAddress" style="display: none;">
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
                                            <label for="zcode1" class="form-label">ZIP Code</label>
                                            <input type="text" class="form-control number_only"
                                                name="personal_info[members_officezipcode]" id="zcode1" maxlength="4"
                                                value="{{ old('personal_info.members_officezipcode') }}"
                                                placeholder="e.g. 1234">
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
                                                value="{{ old('personal_info.members_businessname') }}"
                                                placeholder="e.g. ABC Corporation">
                                            @error('personal_info.members_businessname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="telephoneNumber" class="form-label">Telephone
                                                Number</label>
                                            <input type="tel" class="form-control number_only"
                                                name="personal_info[tele_num]" id="telephoneNumber"
                                                onkeyup="maskTelNo(this.id)" value="{{ old('personal_info.tele_num') }}"
                                                placeholder="(123) 456-7890">
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
                        </div>
                        <!-- End of Step 2 -->
                        <!-- Step 3: Beneficiaries -->
                        <div class="form-step tab" id="step3">
                            <div>
                                <div class="step-title-container pt-4">
                                    <div class="mb-3">
                                        <h5 class="card-title mb-2">Step 3&#58; <span class="fw-normal">Provide details for individuals who would be eligible to inherit or utilize your membership benefits in accordance with organization policies.</span></h5>
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
                                        {{-- <div>
                                            <p><b>Note:</b></p>
                                        </div> --}}
                                        <div>
                                            <p class="p1 mb-1"><em>If Married,</em> OTHER BENEFICIARIES pertains to spouse not more than 60 years old & unmarried children between ages 1-23 years.</p>
                                            <p class="p2 mb-0"><em>If Single,</em> OTHER BENEFICIARIES refers to parents below 60 years old and unmarried brothers & sisters between ages 1-23 years.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- First Beneficiary (Always visible) -->
                                <div class="insured insured-container">
                                    <div class="insured1 p-4 rounded-3 animated-moveDown">
                                        <div class="insured-num ps-2 pe-1 pt-1 pb-1"><h6 class="m-0">1</h6></div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBenefiaries1" class="form-label">Entity Type</label>
                                                    <select name="personal_info[insured1]" class="form-control" id="insuredBenefiaries1" required>
                                                        <option value="beneficiaries">BENEFICIARY</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredName1" class="form-label">Name</label>
                                                    <input type="text" class="form-control fullname" placeholder="Enter Full Name" name="personal_info[beneficiary1]" id="insuredName1" autocomplete="off" required>
                                                    <div class="validation-message_fullname" style="color: red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="relationship1" class="form-label">Relationship</label>
                                                    <input type="text" class="form-control" placeholder="Enter Relationship" name="personal_info[relation1]" id="relationship1" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBirthDate1" class="form-label">Birth Date</label>
                                                    <div class="input-group">
                                                        <input name="personal_info[bday_insured1]" type="text" class="form-control" id="insuredBirthDate1" autocomplete="off" maxlength="10" placeholder="MM/DD/YYYY" required>
                                                    </div>
                                                    <div id="validationMessage" style="color: red;"></div>
                                                    <input name="age" type="text" id="age" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Second Beneficiary (Initially Hidden) -->
                                    <div class="insured2 mt-4 p-4 rounded-3" style="display: none;">
                                        <div class="insured-num ps-2 pe-1 pt-1 pb-1"><h6 class="m-0">2</h6></div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBenefiaries2" class="form-label">Entity Type</label>
                                                    <select name="personal_info[insured2]" class="form-control" id="insuredBenefiaries2">
                                                        <option value="beneficiaries">BENEFICIARY</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredName2" class="form-label">Name</label>
                                                    <input type="text" class="form-control fullname1" placeholder="Enter Full Name" name="personal_info[beneficiary2]" id="insuredName2" autocomplete="off">
                                                    <div class="validation-message_fullname1" id="fullname1" style="color: red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="relationship2" class="form-label">Relationship</label>
                                                    <input type="text" class="form-control" placeholder="Enter Relationship" name="personal_info[relation2]" id="relationship2" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBirthDate2" class="form-label">Birth Date</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="MM/DD/YYYY" name="personal_info[bday_insured2]" id="insuredBirthDate2" maxlength="10" autocomplete="off">
                                                    </div>
                                                    <div id="validationMessage2" style="color: red;"></div>
                                                    <input name="age2" type="text" id="age2" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="removeBeneficiary(2)" class="btn btn-danger" style="display: none;" id="hide1"><i class="fa-regular fa-trash-can"></i> Remove</button>
                                    </div>
                                    <!-- Third Beneficiary (Initially Hidden) -->
                                    <div class="insured3 mt-4 p-4 rounded-3" style="display: none;">
                                        <div class="insured-num ps-2 pe-1 pt-1 pb-1"><h6 class="m-0">3</h6></div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBenefiaries3" class="form-label">Entity Type</label>
                                                    <select name="personal_info[insured3]" class="form-control" id="insuredBenefiaries3">
                                                        <option value="beneficiaries">BENEFICIARY</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredName3" class="form-label">Name</label>
                                                    <input type="text" class="form-control fullname2" placeholder="Enter Full Name" name="personal_info[beneficiary3]" id="insuredName3" autocomplete="off">
                                                    <div class="validation-message_fullname2" id="fullname2" style="color: red;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="relationship3" class="form-label">Relationship</label>
                                                    <input type="text" class="form-control" placeholder="Enter Relationship" name="personal_info[relation3]" id="relationship3" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insuredBirthDate3" class="form-label">Birth Date</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="MM/DD/YYYY" name="personal_info[bday_insured3]" id="insuredBirthDate3" maxlength="10" autocomplete="off">
                                                    </div>
                                                    <div id="validationMessage3" style="color: red;"></div>
                                                    <input name="age3" type="text" id="age3" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="removeBeneficiary(3)" class="btn btn-danger" style="display: none;" id="hide2"><i class="fa-regular fa-trash-can"></i> Remove</button>
                                    </div>
                                    <!-- Single Add Button -->
                                    <button type="button" onclick="showNextBeneficiary()" class="btn btn-primary mt-3 blue-bg" id="addBeneficiaryBtn"><i class="fa-solid fa-plus"></i> Add Another Beneficiary</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Beneficiaries End -->
                        <!-- Step 4: Vehicle Information -->
                        <div class="form-step tab" id="step4">
                            <div>
                                <div class="step-title-container pt-4">
                                    <div class="mb-3">
                                        <h5 class="card-title mb-2">Step 4&#58; <span class="fw-normal">Specify details about your vehicle&lpar;s&rpar;, including the make, model year, and license plate number.</span></h5>
                                    </div>
                                    <hr />
                                </div>

                                <div id="vehicleFields" class="gap-5 vehicle-entry">
                                    <!-- Initial Vehicle Form -->
                                    <div class="vehicle-item">
                                        {{-- <div class="vehicle-title mb-4">
                                            <h6>Vehicle <span class="vehicle-number">1</span></h6>
                                        </div> --}}
                                        <div class="row g-4 mt-0">
                                            <!-- First Row -->
                                            <div class="w-100 mt-1 psd-container">
                                                <div class="col-md-4 p-3 rounded-3 centered-content c-sticker-container">
                                                    <label class="label" style="font-size: medium;">
                                                        Is Conduction Sticker Available?
                                                    </label>
                                                    <input type="hidden" id="csticker" name="is_cs[]" value="{{ old('is_cs.0', '0') }}">
                                                    <div>
                                                        <div class="options-container">
                                                            <label class="p-1 radio-checkbox">
                                                                <input type="checkbox" id="csticker_yes" value="1"
                                                                    {{ old('is_cs.0') == '1' ? 'checked' : '' }}
                                                                    onchange="updateLabeldyna('csticker_yes', 'csticker_no')">
                                                                <span class="checkmark"></span>
                                                                YES
                                                            </label>
                                                            <label class="p-1 radio-checkbox cbox-no">
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
    
                                                <div class="col-md-4 ps-4 pe-4 platenum-container">
                                                    <label for="platenum" class="label">Plate Number</label>
                                                    <input name="vehicle_plate[]" type="text"
                                                        class="text-input form-control platenum @error('vehicle_plate.*') is-invalid @enderror"
                                                        id="platenum" 
                                                        value="{{ old('vehicle_plate.0') }}" 
                                                        autocomplete="off"
                                                        placeholder="Enter Plate No." 
                                                        style="text-transform: uppercase;" 
                                                        required
                                                        data-input-type="plate"> <!-- Added data attribute to track input type -->
                                                    @error('vehicle_plate.*')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="validation-message_plateno" style="color: red;"></div>
                                                </div>
    
                                                <div class="col-md-4 p-3 rounded-3 centered-content is-diplomat-container">
                                                    <label class="label" style="font-size: medium;">
                                                        Is Diplomat?
                                                    </label>
                                                    <input type="hidden" id="is_diplomat_1" name="is_diplomat[]" value="{{ old('is_diplomat.0', '0') }}">
                                                    <div>
                                                        <div class="options-container">
                                                            <label class="p-1 radio-checkbox">
                                                                <input type="checkbox" id="is_diplomat_yes_1" value="1"
                                                                    {{ old('is_diplomat.0') == '1' ? 'checked' : '' }}
                                                                    onchange="update_diplomat('is_diplomat_yes_1', 'is_diplomat_no_1')">
                                                                <span class="checkmark"></span>
                                                                YES
                                                            </label>
                                                            <label class="p-1 radio-checkbox cbox-no">
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
                                            </div>
                                            <!-- Second Row -->
                                            <div class="col-md-3 d-flex flex-column with-select2">
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
                                            <div class="col-md-3 d-flex flex-column with-select2">
                                                <label class="form-label">Vehicle Models</label>
                                                <select class="form-control select2 @error('vehicle_model.*') is-invalid @enderror" 
                                                        id="model1"
                                                        name="vehicle_model[]" 
                                                        required>
                                                    <option value="" selected>Vehicle Model</option>
                                                    <!-- Models will be populated via JavaScript -->
                                                    @if(old('vehicle_model.0'))
                                                        <option value="{{ old('vehicle_model.0') }}" selected>{{ old('vehicle_model.0') }}</option>
                                                    @endif
                                                </select>
                                                @error('vehicle_model.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-3 d-flex flex-column with-select2">
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
                                            <!-- Third Row -->
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
                                            <!-- Fourth Row -->
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
                                                    <div class="or-container">
                                                        <img id="or" class="img-fluid" src="" alt="Image or">
                                                    </div>
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
                                                    <div class="cr-container">
                                                        <img id="cr" class="img-fluid" src="" alt="Image cr">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoTitle"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoLastName"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoFirstName"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoMiddleName"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoBirthdate"></div>
                                            <div class="col-md-6 p-2 light-border-subtle" id="echoBirthPlace"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoGender"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoCitizenship"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoStatus"></div>
                                            <div class="col-md-6 p-2 light-border-subtle" id="echoOccupation"></div>
                                        </div>
                                    </div>
    
                                    <div class="mb-4">
                                        <div class="row text-center text-light dark-blue-bg p-2">
                                            <h6 class="m-0">CONTACT INFORMATION</h6>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-12 p-2 light-border-subtle" id="echoHomeAddress"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-12 p-2 light-border-subtle" id="echocomname"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-12 p-2 light-border-subtle" id="echoOfficeAddress"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-3 p-2 light-border-subtle" id="echomobilenum"></div>
                                            <div class="col-md-3 p-2 light-border-subtle" id="echoOfficeMobileNo"></div>
                                            <div class="col-md-6 p-2 light-border-subtle" id="echoMailingPreference"></div>
                                        </div>
                                        <div class="row centered-text">
                                            <div class="col-md-4 p-2 light-border-subtle" id="echoalternatemobilenum"></div>
                                            <div class="col-md-4 p-2 light-border-subtle" id="echoemailadd"></div>
                                            <div class="col-md-4 p-2 light-border-subtle" id="echoalternateemailadd"></div>
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
                            
                            <div>
                                <div class="previous">
                                    <!-- Previous button will be inserted here -->
                                </div>
                                <div class="next">
                                    <!-- Next button will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="xl-moto-container">
                    <img class="img-fluid" src="{{ asset('images/moto.webp') }}" alt="Motorcycle">
                </div>
        </div>
    </div>
    <footer class="footer container-fluid">
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
    <script src="{{ asset('script/customer_side/motorcycle.js') }}"></script>
    <script src="{{ asset('script/customer_side/common_branch.js') }}"></script>
    <script src="{{ asset('script/customer_side/moto_branch.js') }}"></script>
    <script src="{{ asset('script/sidebar.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    {{-- @include('vehicle_autocomp') --}}
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
                        label: town.az_barangay + " - " + town.city_name + ", " + town.district_name,
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
</body>

</html>