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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('link/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('style/customer_form/membership.css') }}">
</head>

<body>

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
                                <li class="breadcrumb-item active" data-step="1">Personal Information</li>
                                <li class="breadcrumb-item" data-step="2">Contact Information</li>
                                <li class="breadcrumb-item" data-step="3">Vehicle Details</li>
                                <li class="breadcrumb-item" data-step="4">Information Summary</li>
                            </ol>
                        </nav>


                        <form id="resellerForm" action="{{ route('new_membership.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hiddenFormData" name="form_data" value="">
                            @foreach ($errors->all() as $key => $error)
                                <p style="color: red">{{ $key }} : {{ $error }}</p>
                            @endforeach

                            <!-- Step 1:  Membership Application -->
                            <div class="form-step tab active" id="step1">
                                <h5 class="card-title mb-4">Personal Information</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="membershiptype" class="form-label">Type of Membership</label>
                                        <select class="form-select" id="membershiptype"
                                            name="personal_info[membership_type]" required>
                                            @if($selectedMembership)
                                                <option value="{{ $selectedMembership->membership_name }}"
                                                    data-vehicle_num="{{ $selectedMembership->vehicle_num }}" selected>
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

                                    <div class="col-md-4 mb-3">
                                        <label for="plantype" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plan_type]"
                                            required>
                                            @if($selectedPlan)
                                                <option value="{{ $selectedPlan->plan_name }}" selected>
                                                    {{ $selectedPlan->plan_name }} - {{ $selectedPlan->plan_amount }}
                                                </option>

                                            @else
                                                <option value="" selected disabled>Select Plan Type</option>
                                            @endif
                                        </select>
                                        @error('personal_info.plan_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if($selectedPlan)
                                        <input type="hidden" name="personal_info[plantype_id]"
                                            value="{{$selectedPlan->plan_id}}" id="selected_plan_id">
                                    @endif

                                    <div class="col-md-4 mb-3">
                                        <label for="idAttachment" class="form-label">Upload Image: 2x2 or passport size
                                            id picture</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="idAttachment" name="idpicture"
                                                onchange="handleGeneralFileUpload(this, 'valid_id', 'idFeedback')"
                                                required>
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

                                <div class="row mb-3">
                                    <div class="col-md-2">
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

                                    <div class="col-md-4">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control letters_only_fname" id="firstName"
                                            name="personal_info[members_firstname]"
                                            value="{{ old('personal_info.members_firstname') }}" required>
                                        @error('personal_info.members_firstname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="validation-message_fname" style="color: red;"></div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control letters_only_mname" id="middleName"
                                            name="personal_info[members_middlename]"
                                            value="{{ old('personal_info.members_middlename') }}">
                                        @error('personal_info.members_middlename')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="validation-message_mname" style="color: red;"></div>
                                    </div>

                                    <div class="col-md-3">
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

                                <div class="row mb-3">
                                    <div class="col-md-2">
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

                                    <div class="col-md-3">
                                        <label class="form-label">Birthdate</label>
                                        <input type="text" class="form-control" name="personal_info[members_birthdate]"
                                            id="birthdate" autocomplete="off" placeholder="MM/DD/YYYY" maxlength="10"
                                            value="{{ old('personal_info.members_birthdate') }}" required>
                                        @error('personal_info.members_birthdate')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="birthplace" class="form-label">Birth Place</label>
                                        <input type="text" class="form-control" name="personal_info[members_birthplace]"
                                            id="birthplace" value="{{ old('personal_info.members_birthplace') }}"
                                            required>
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

                                    <div class="col-md-3">
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

                                    <div class="col-md-3" id="add_info"
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
                            <!--- End of Step 1 -->

                            <!-- Step 2: Contact Information Section -->
                            <div class="form-step tab" id="step2">
                                <h5 class="card-title mb-4">Contact Information</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
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
                                <h5 class="mt-4 mb-3">Home Address</h5>
                                <div class="row mb-3">
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
                                        <input type="text" class="form-control"
                                            name="personal_info[members_housedistrict]" id="province"
                                            value="{{ old('personal_info.members_housedistrict') }}" required>
                                        @error('personal_info.members_housedistrict')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="zcode" class="form-label">Zip</label>
                                        <input type="text" class="form-control number_only" maxlength="4"
                                            name="personal_info[members_housezipcode]" id="zcode"
                                            value="{{ old('personal_info.members_housezipcode') }}" required>
                                        @error('personal_info.members_housezipcode')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                        <input type="tel" class="form-control phone-input"
                                            name="personal_info[members_mobileno]" id="mobileNumber"
                                            data-error-container="error-msg-1" data-valid-container="valid-msg-1"
                                            data-code-input="ccode-1"
                                            value="{{ old('personal_info.members_mobileno') }}" required>
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
                                        <input type="email" class="form-control"
                                            name="personal_info[members_emailaddress]" id="emailAddress"
                                            value="{{ old('personal_info.members_emailaddress') }}" required>
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
                                            <input type="text" class="form-control"
                                                name="personal_info[members_oaddress1]" id="street1"
                                                value="{{ old('personal_info.members_oaddress1') }}">
                                            @error('personal_info.members_oaddress1')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label for="town" class="form-label">Barangay / Towns</label>
                                            <input type="text" class="form-control"
                                                name="personal_info[members_oaddress2]" id="town1"
                                                value="{{ old('personal_info.members_oaddress2') }}">
                                            @error('personal_info.members_oaddress2')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label for="city" class="form-label">City/Municipality</label>
                                            <input type="text" class="form-control"
                                                name="personal_info[members_officecity]" id="city1"
                                                value="{{ old('personal_info.members_officecity') }}">
                                            @error('personal_info.members_officecity')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label for="province" class="form-label">Province</label>
                                            <input type="text" class="form-control"
                                                name="personal_info[members_officedistrict]" id="province1"
                                                value="{{ old('personal_info.members_officedistrict') }}">
                                            @error('personal_info.members_officedistrict')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="zcode" class="form-label">Zip</label>
                                            <input type="text" class="form-control number_only"
                                                name="personal_info[members_officezipcode]" id="zcode1" maxlength="4"
                                                value="{{ old('personal_info.members_officezipcode') }}">
                                            @error('personal_info.members_officezipcode')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-9">
                                            <label for="comname" class="form-label">Company Name</label>
                                            <input type="text" class="form-control"
                                                name="personal_info[members_businessname]" id="comname"
                                                value="{{ old('personal_info.members_businessname') }}">
                                            @error('personal_info.members_businessname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
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
                            <!-- End of Step 2 -->

                            <!-- Step 3: Vehicle Information -->
                        <div class="form-step tab" id="step3">
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

                            <!-- Add Vehicle Button -->
                            <button type="button" class="btn btn-primary mt-3" id="addVehicle">
                                <i class="bi bi-plus-circle me-2"></i>Add Item
                            </button>

                            <div class="d-flex justify-content-between mt-4">
                                <div class="navigation-buttons"></div>
                            </div>
                        </div>



                        <!-- Step 4: Information Summary -->
                        <div class="form-step tab" id="step4">
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
    <script src="{{ asset('script/customer_side/membership.js') }}"></script>
    <script src="{{ asset('script/sidebar.js')}}"></script>
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