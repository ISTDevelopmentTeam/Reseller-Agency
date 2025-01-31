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
                            <div class="col-md-4 mb-3">
                                <label for="membershipType" class="form-label">Type of Membership:</label>
                                <select value="{{ old('personal_info.membership_type') }}" name="personal_info[membership_type]" class="form-control form-control-sm member" id="membershipType" required>
                                    <option value="" disabled>Select Type of Membership.</option>
                                    @foreach ($membership as $membership_type)
                                        <option value="{{ $membership_type->membership_name }}" data-vehicle_num="{{ $membership_type->vehicle_num }}"
                                            @if ($membership_type->membership_name == $records['result_record']['sponsor_name'])
                                                selected
                                            @endif
                                        >
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

                    <!-- Card 2: Contact Information -->
                    {{-- <div class="card bordered">
                        <h5 class="card-title mb-4">Contact Information</h5>
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
                                <select class="form-select" name="personal_info[availMagazine]" id="availMagazine"
                                    required>
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
                                    <label for="comname" class="form-label">Company Name</label>
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
                        <div class="d-flex justify-content-between mt-4">
                            <div class="navigation-buttons"></div>
                        </div>
                    </div> --}}
                    <!-- Card 3: Vehicle Details -->
                    <div class="card bordered">
                    @foreach($records['result_car'] as $item)
                        <h5 class="mb-4">Vehicle Details</h5>
                        <div id="vehicleFields">
                            <!-- Initial Vehicle Form -->
                            <div class="vehicle-item border rounded p-3 mb-3">
                                <h6 class="mb-3">Vehicle <span class="vehicle-number">{{$loop->index+1}}</span></h6>
                                <div class="row g-3">
                                    <!-- First Row -->
                                    <div class="col-md-3 centered-content">
                                        <label class="label" style="font-size: medium;">
                                            Update Vehicle Information?
                                        </label>
                                        <input type="hidden" id="is_vehicle_updated_{{$loop->index+1}}" name="is_vehicle_updated[]" value="0" >
                                        <div class="toggle-container mt-2">
                                            <input type="checkbox" 
                                                   id="updateVehicle" 
                                                   name="update_vehicle[]" 
                                                   class="vehicle-switch"
                                                   value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-3 centered-content">
                                        <label class="label" style="font-size: medium;">
                                            Is Conduction Sticker Available?
                                        </label>
                                        <input type="hidden" id="csticker{{$loop->index+1}}" name="is_cs[]" value="{{ $item['vehicleinfo_csticker'] }}">
                                        @if($item['vehicleinfo_csticker'] == 1)
                                            <div>
                                                <div class="options-container">
                                                    <label class="radio-checkbox">
                                                        <input type="checkbox" id="csticker_yes" value="1"
                                                        {{ old('is_cs', $records['result_car'][0]['vehicleinfo_csticker'] ?? '') == 1 ? 'checked' : '' }}
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
                                        @else
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
                                                        {{ old('is_cs', $records['result_car'][0]['vehicleinfo_csticker'] ?? '') == 0 ? 'checked' : '' }}
                                                            onchange="updateLabeldyna('csticker_no', 'csticker_yes')">
                                                        <span class="checkmark"></span>
                                                        NO
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        @error('is_cs.*')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="platenum" class="label">Plate No</label>
                                        <input name="vehicle_plate[]" type="text"
                                            class="text-input form-control form-control-sm platenum @error('vehicle_plate.*') is-invalid @enderror"
                                            id="platenum" 
                                            value="<?= $item['vehicleinfo_plateno']?>" 
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
                                        <input type="hidden" id="is_diplomat_1" name="is_diplomat[]">
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
                                                id="make1" name="vehicle_make[]" disabled
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
                                                id="model1" name="vehicle_model[]" disabled
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
                                                id="vehicle_type1" name="vehicle_type[]" disabled
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
                                            id="year1" 
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
                                            id="submodel1" 
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
                                            id="color" 
                                            name="vehicle_color[]" 
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
                                                name="vehicle_fuel[]" disabled
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
                                                name="vehicle_transmission[]" disabled
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
                            <i class="bi bi-plus-circle me-2"></i>+ Add another vehicle
                        </button>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary rounded" id="submit_btn">Submit</button>
                        </div>
                    @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('script/renew_side/renew_membership.js') }} "></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    @include('countrycode')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const updateVehicleSwitch = document.getElementById('updateVehicle');
    if (updateVehicleSwitch) {
        updateVehicleSwitch.addEventListener('change', function() {
            this.value = this.checked ? '1' : '0';
        });
    }
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