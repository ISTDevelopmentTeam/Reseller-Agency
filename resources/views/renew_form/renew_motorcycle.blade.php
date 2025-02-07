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
    <link rel="stylesheet" href="{{ asset('style/renew_membership.css') }}">
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
                    <h2 class="header-title mb-0 typewriter">New Membership Form</h2>
                    <p class="header-subtitle text-muted">Please provide your details below to complete the process</p>
                </div>
                <form id="resellerForm" action="{{ route('new_membership.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Card 1: Personal Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 15px; font-weight: bold;">I would like to renew
                                    my membership to:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3" hidden>
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
                            <div class="col-md-4 mb-4">
                                <label for="planType" class="form-label">Plan Type:</label>
                                <select value="{{ old('personal_info.plan_type') }}" name="personal_info[plan_type]" class="form-control form-control-sm" id="planType" required>
                                    <option value="" selected disabled>Select Plan Type</option>
                                    @foreach ($packages as $pidp)
                                        <option value="{{ $pidp->plan_name }}">{{ $pidp->plan_name }} - ₱ {{ $pidp->plan_amount }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">This field is required</div>
                            </div>
                        </div>

                        <div class="row">
                            <input type="text" id="record_no" value="<?= $records['result_record']['vehicleinfohead_order']?>"
                                hidden>
                            <input type="text"  id="record_id" value="<?= $records['result_record']['vehicleinfohead_id']?>"
                                hidden>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Record No:</label>
                                    <input value="<?= $records['result_record']['vehicleinfohead_order']?>"  type="text"
                                        class="text-input form-control form-control-sm" id="recordno" autocomplete="off"
                                        placeholder=" Enter occupation" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Type of Membership:</label>
                                    <input value="<?= $records['result_record']['sponsor_name']?>" name="membership_type" type="text"
                                        class="text-input form-control form-control-sm" id="membership_type" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Plan Type:</label>
                                    <input value="<?= $records['result_record']["fee_name"]?>" name="plan_type" type="text" class="text-input
                                        form-control form-control-sm" id="plan_type" autocomplete="off" placeholder=" Enter occupation"
                                        disabled>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Initiator:</label>
                                    <input value="<?= $records['result_record']["membershipinitiator_name"] ?>" type="text"
                                        class="text-input form-control form-control-sm" id="initiator" autocomplete="off" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Category:</label>
                                    <input value="<?= $records['result_record']["category_name"]
                                            ?>"  type="text" class="text-input form-control form-control-sm" id="category"
                                        autocomplete="off" disabled>
                                </div>
                            </div>
                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Status:</label>
                                    <input value="<?= $records['result_record']['vehicleinfohead_status'] ?>" name="status" type="text"
                                        class="text-input form-control form-control-sm" id="status" autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Activation Date:</label>
                                    <input value="<?= $records['result_record']['vehicleinfohead_activedate'] ?>" name="activation_date"
                                        type="text" class="text-input form-control form-control-sm" id="activation_date" autocomplete="off"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Expiration Date:</label>
                                    <input value="<?= $records['result_record']['vehicleinfohead_expiredate'] ?>" name="expiration_date"
                                        type="text" class="text-input form-control form-control-sm" id="expiration_date" autocomplete="off"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Adv. Renewal Activation:</label>
                                    <input value="<?= $records['result_record']['adv_activedate']?>" name="advance_renewal_activation"
                                        type="text" class="text-input form-control form-control-sm" id="advance_renewal_activation"
                                        autocomplete="off" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Adv. Renewal Expiration:</label>
                                    <input value="<?= $records['result_record']['adv_expiredate'] ?>" name="advance_renewal_expiration"
                                        type="text" class="text-input form-control form-control-sm" id="advance_renewal_expiration"
                                        autocomplete="off" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Beneficiaries -->
                    <div class="card bordered">
                        <div class="text">
                            <p class="p1"><b>Note: </b>If Married, OTHER BENEFICIARIES pertains to spouse not more
                                than
                                60
                                years old &
                                unmarried
                                children
                                between ages 1-23 years.</p>
                            <p class="p2">If Single, OTHER BENEFICIARIES refers to parents below 60 years old and
                                unmarried
                                brothers &
                                sisters
                                between ages
                                1-23 years.</p>
                        </div>
                        <div class="insured1">
                            <div class="insured0 bordered">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insuredBenefiaries1" class="form-label">Beneficiaries</label>
                                            <select name="personal_info[insured1]"
                                                class="form-control form-control-sm " id="insuredBenefiaries1"
                                                required>
                                                <!-- <option value="" selected disabled>Select Beneficiaries.</option> -->
                                                <option value="beneficiaries"
                                                    @if (old('personal_info.insured1') == 'beneficiaries') {{ 'selected' }} @endif>
                                                    BENEFICIARIES</option>
                                            </select>
                                            @error('personal_info.insured1')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insuredName1" class="form-label">Name</label>
                                            <input value="{{ old('personal_info.beneficiary1') }}" type="text"
                                                class="form-control form-control-sm fullname"
                                                placeholder="Enter Full Name" name="personal_info[beneficiary1]"
                                                id="insuredName1" autocomplete="off" required>
                                            <div class="validation-message_fullname" style="color: red;"></div>
                                            @error('personal_info.beneficiary1')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="relationship1" class="form-label">Relationship</label>
                                            <input value="{{ old('personal_info.relation1') }}" type="text"
                                                class="form-control form-control-sm" placeholder="Enter Relationship"
                                                name="personal_info[relation1]" id="relationship1" autocomplete="off"
                                                required>
                                            @error('personal_info.relation1')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insuredBirthDate1" class="form-label">Birth Date</label>
                                            <div class="input-group">
                                                <input name="personal_info[bday_insured1]" type="text"
                                                    class="Select-input form-control form-control-sm"
                                                    id="insuredBirthDate1" autocomplete="off" maxlength="10"
                                                    value="{{ old('personal_info.bday_insured1') }}"
                                                    oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                    pattern="[0-9/]*" placeholder="MM/DD/YYYY" inputmode="numeric"
                                                    required>
                                            </div>
                                            <div id="validationMessage" style="color: red;"></div>
                                            <input name="age" type="text" id="age" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--insured 2------------->
                            <div id="add_insured1">
                                <div class="insured2 bordered mt-3" style="display: none; width: 100%;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredBenefiaries2"
                                                    class="form-label">Beneficiaries</label>
                                                <select name="personal_info[insured2]"
                                                    class="form-control form-control-sm " id="insuredBenefiaries2">
                                                    <option value="beneficiaries"
                                                        @if (old('personal_info.insured2') == 'beneficiaries') {{ 'selected' }} @endif>
                                                        BENEFICIARIES</option>
                                                </select>
                                                @error('personal_info.insured2')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredName2" class="form-label">Name</label>
                                                <input value="{{ old('personal_info.beneficiary2') }}" type="text"
                                                    class="form-control form-control-sm fullname1"
                                                    placeholder="Enter Full Name" name="personal_info[beneficiary2]"
                                                    id="insuredName2" autocomplete="off">
                                                <div class="validation-message_fullname1" id="fullname1"
                                                    style="color: red;"></div>
                                                @error('personal_info.beneficiary2')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="relationship2" class="form-label">Relationship</label>
                                                <input value="{{ old('personal_info.relationship2') }}"
                                                    type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Relationship" name="personal_info[relation2]"
                                                    id="relationship2" autocomplete="off">
                                                @error('personal_info.relationship2')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredBirthDate2" class="form-label">Birth Date</label>
                                                <div class="input-group">
                                                    <input value="{{ old('personal_info.bday_insured2') }}"
                                                        type="text" class="form-control form-control-sm"
                                                        placeholder="MM/DD/YYYY" name="personal_info[bday_insured2]"
                                                        id="insuredBirthDate2" maxlength="10"
                                                        value="{{ old('personal_info.bday_insured2') }}"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        pattern="[0-9/]*" inputmode="numeric" autocomplete="off">
                                                </div>
                                                <div id="validationMessage2" style="color: red;"></div>
                                                <input name="age2" type="text" id="age2" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="button" onclick="hidex()" class="btn btn-danger"
                                            id="hide1"
                                            style="margin: auto; padding: .3rem 1.4rem; border-radius: .3rem;">Remove
                                            this insured
                                            information</button>
                                    </div>
                                </div>
                                <button type="button" onclick="show7()" class="btn btn-primary mt-3" id="add1"
                                    style="padding: .3rem 1.4rem; border-radius: .3rem;">+ Add Another
                                    Beneficiaries</button>
                            </div>

                            <!--insured 3--------->
                            <div id="add_insured2">
                                <div class="insured3 bordered mt-3" style="display: none; width: 100%;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredBenefiaries3"
                                                    class="form-label">Beneficiaries</label>
                                                <select name="personal_info[insured3]"
                                                    class="form-control form-control-sm " id="insuredBenefiaries3">
                                                    <!-- <option value="" selected disabled>Select Beneficiaries.</option> -->
                                                    <option value="beneficiaries"
                                                        @if (old('personal_info.insured3') == 'beneficiaries') {{ 'selected' }} @endif>
                                                        BENEFICIARIES</option>
                                                </select>
                                                @error('personal_info.insured3')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredName3" class="form-label">Name</label>
                                                <input value="{{ old('personal_info.beneficiary3') }}" type="text"
                                                    class="form-control form-control-sm fullname2"
                                                    placeholder="Enter Full Name" name="personal_info[beneficiary3]"
                                                    id="insuredName3" autocomplete="off">
                                                <div class="validation-message_fullname2" id="fullname2"
                                                    style="color: red;"></div>
                                                @error('personal_info.beneficiary3')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="relationship3" class="form-label">Relationship</label>
                                                <input value="{{ old('personal_info.relation3') }}" type="text"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Relationship" name="personal_info[relation3]"
                                                    id="relationship3" autocomplete="off">
                                                @error('personal_info.relation3')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="insuredBirthDate3" class="form-label">Birth Date</label>
                                                <div class="input-group">
                                                    <input value="{{ old('personal_info.bday_insured3') }}"
                                                        type="text" class="form-control form-control-sm"
                                                        placeholder="MM/DD/YYYY" name="personal_info[bday_insured3]"
                                                        id="insuredBirthDate3" autocomplete="off"
                                                        oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                                        pattern="[0-9/]*" inputmode="numeric" maxlength="10">
                                                </div>
                                                <div id="validationMessage3" style="color: red;"></div>
                                                <input name="age3" type="text" id="age3" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button type="button" onclick="hidey()" class="btn btn-danger"
                                            id="hide2"
                                            style="margin: auto; padding: .3rem 1.4rem; border-radius: .3rem;">Remove
                                            this insured
                                            information</button>
                                    </div>
                                </div>

                                <button type="button" onclick="show8()" class="btn btn-primary mt-3" id="add2"
                                    style="display: none; padding: .3rem 1.4rem; border-radius: .3rem;">+ Add Another
                                    Beneficiaries</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Summary Information -->
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
                    
                                <input type="text" name="license_info[members_licenseno]"
                                    value="<?= $records['result_info'][0]['members_licenseno'] ?>" hidden>
                                <input type="text" name="license_info[members_licensetype]"
                                    value="<?= $records['result_info'][0]['pidp_licensetype'] ?>" hidden>
                                <input type="text" name="license_info[members_licensecard]"
                                    value="<?= $records['result_info'][0]['pidp_cardtype'] ?>" hidden>
                                <input type="text" name="license_info[members_licenserest]"
                                    value="<?= htmlspecialchars($records['result_info'][0]['pidp_restriction'], ENT_QUOTES, 'UTF-8') ?>"
                                    hidden>
                                <input type="text" name="license_info[members_licenseexpirationdate]"
                                    value="<?= $records['result_info'][0]['members_licenseexpirationdate'] ?>" hidden>
                    
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
                                    <input type="radio" class="custom-control-input" id="uyes" name="uradio" value="1">
                                    <label class="custom-control-label" for="uyes" style="font-size:16px;"
                                        id="yesLabel">YES</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="uno" name="uradio" value="0">
                                    <label class="custom-control-label" for="uno" style="font-size:16px;" id="noLabel">NO</label>
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
    <script src="{{ asset('script/renew_side/renew_motorcycle.js') }} "></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>

    @include('renew_form/renew_countrycode')
    @include('address')
    @include('update_info')
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