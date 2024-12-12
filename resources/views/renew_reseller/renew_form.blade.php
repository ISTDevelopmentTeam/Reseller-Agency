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
    <link rel="stylesheet" href="{{ asset('style/renew_reseller.css') }}">
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
                                <li class="breadcrumb-item" data-step="2">Vehicle Details</li>
                                <li class="breadcrumb-item" data-step="3">Information Summary</li>
                            </ol>
                        </nav>


                        <form id="resellerForm" action="{{ route('reseller.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hiddenFormData" name="form_data" value="">
                            @foreach ($errors->all() as $key => $error)
                                <p style="color: red">{{ $key }} : {{ $error }}</p>
                            @endforeach

                            <!-- Step 1:  Membership Application -->
                            <div class="form-step tab active" id="step1">
                                <button class="btn btn-primary customer-fillout-btn"
                                    onclick="window.open('{{ route('customer_qr') }}', '_blank')">
                                    <i class="fas fa-user-edit me-2"></i>Customer Fill-out
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
                                        <select class="form-select" id="membershiptype"
                                            name="personal_info[membership_type]" required>
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
                                        <label for="plan_type" class="form-label">Plan Type</label>
                                        <select class="form-select" id="plantype" name="personal_info[plan_type]"
                                            required>
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
                                </div>
                                <div class="row">
                                    <input type="text" name="record_no" id="record_no"
                                        value="<?= $records['result_record']['vehicleinfohead_order']?>" hidden>
                                    <input type="text" name="record_id" id="record_id"
                                        value="<?= $records['result_record']['vehicleinfohead_id']?>" hidden>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Record No:</label>
                                            <input value="<?= $records['result_record']['vehicleinfohead_order']?>"
                                                name="recordno" type="text"
                                                class="text-input form-control form-control-sm" id="recordno"
                                                autocomplete="off" placeholder=" Enter occupation" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Type of Membership:</label>
                                            <input value="<?= $records['result_record']['sponsor_name']?>"
                                                name="membership_type" type="text"
                                                class="text-input form-control form-control-sm" id="membership_type"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Plan Type:</label>
                                            <input value="<?= $records['result_record']["fee_name"]?>" name="plan_type"
                                                type="text" class="text-input
                                            form-control form-control-sm" id="plan_type" autocomplete="off" placeholder=" Enter occupation"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Initiator:</label>
                                            <input value="<?= $records['result_record']["membershipinitiator_name"] ?>"
                                                name="initiator" type="text"
                                                class="text-input form-control form-control-sm" id="initiator"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Category:</label>
                                            <input value="<?= $records['result_record']["category_name"]
                    ?>" name="category" type="text" class="text-input form-control form-control-sm" id="category"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Status:</label>
                                            <input value="<?= $records['result_record']['vehicleinfohead_status'] ?>"
                                                name="status" type="text"
                                                class="text-input form-control form-control-sm" id="status"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Activation Date:</label>
                                            <input
                                                value="<?= $records['result_record']['vehicleinfohead_activedate'] ?>"
                                                name="activation_date" type="text"
                                                class="text-input form-control form-control-sm" id="activation_date"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Expiration Date:</label>
                                            <input
                                                value="<?= $records['result_record']['vehicleinfohead_expiredate'] ?>"
                                                name="expiration_date" type="text"
                                                class="text-input form-control form-control-sm" id="expiration_date"
                                                autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Adv. Renewal Activation:</label>
                                            <input value="<?= $records['result_record']['adv_activedate']?>"
                                                name="advance_renewal_activation" type="text"
                                                class="text-input form-control form-control-sm"
                                                id="advance_renewal_activation" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="occupation" class="label">Adv. Renewal Expiration:</label>
                                            <input value="<?= $records['result_record']['adv_expiredate'] ?>"
                                                name="advance_renewal_expiration" type="text"
                                                class="text-input form-control form-control-sm"
                                                id="advance_renewal_expiration" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- End of Step 1 -->

                            <!-- Step 2: Vehicle Information -->
                            <div class="form-step tab" id="step2">
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
                                                <select class="form-control form-control-sm select2" id="make"
                                                    name="vehicle_make[]" required>
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
                                                <select class="form-control select2" id="model" name="vehicle_model[]">
                                                    <option value="" selected>Car Model</option>
                                                </select>
                                            </div>

                                            <!-- Second Row -->
                                            <div class="col-md-3">
                                                <label class="form-label">Vehicle Type</label>
                                                <select class="form-control select2" id="vehicle_type1"
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


                            <!-- Step 3: Information Summary -->
                            <div class="form-step tab" id="step3">
                                <h5 class="mb-4">Information Summary</h5>

                                <div class="row col-md-12">
                                    <table class="table table-bordered">
                                        <input type="text" name="personal_info[reference_number]" id="reference_number"
                                            value hidden>
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

                                        {{-- <input type="text" name="personal_info[members_housephoneno]"
                                            value="<?= $records['result_info'][0]['members_housephoneno'] ?>" hidden>
                                        --}}
                                        {{-- <input type="text" name="personal_info[members_mobileno]"
                                            value="<?= $records['result_info'][0]['members_mobileno'] ?>" hidden> --}}
                                        {{-- <input type="text" name="personal_info[members_alternate_mobileno]"
                                            value="<?= $records['result_info'][0]['members_alternate_mobileno'] ?>"
                                            hidden> --}}
                                        {{-- <input type="text" name="personal_info[members_emailaddress]"
                                            value="<?= $records['result_info'][0]['members_emailaddress'] ?>" hidden>
                                        --}}
                                        {{-- <input type="text" name="personal_info[alt_email]"
                                            value="<?= $records['result_info'][0]['members_alternate_emailaddress'] ?>"
                                            hidden> --}}
                                        <input type="text" name="personal_info[mailing_preference]"
                                            value="<?= $records['result_info'][0]['members_mailingpreference'] ?>"
                                            hidden>

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
                                            value="<?= $records['result_info'][0]['members_licenseexpirationdate'] ?>"
                                            hidden>

                                        <thead>

                                            <tr>
                                                <th colspan="5" class="text-center blueFill">
                                                    PERSONAL INFORMATION
                                                    <i class="fas fa-edit personal hidden_icon"
                                                        style="cursor: pointer; position: absolute; right: 3rem;"></i>
                                                    <i class="fas fa-x personal hidden_icon"
                                                        style="cursor: pointer; position: absolute; right: 3rem; display: none;"></i>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>

                                                <td><strong>Title:</strong>
                                                    <?= $records['result_info'][0]['members_title'] ?>
                                                    <input type="text" name="personal_info[members_title]"
                                                        value="<?= $records['result_info'][0]['members_title'] ?>"
                                                        hidden>
                                                    <br>
                                                    {{-- <label class="update_personal"><strong>Change
                                                            to: </strong></label> --}}
                                                    <br>
                                                    <select id="uptitle" style="width:100%;"
                                                        class="update_personal text-input form-control" name="uptitle">
                                                        <option
                                                            value="<?= $records['result_info'][0]['members_title'] ?>">
                                                            <?= $records['result_info'][0]['members_title'] ?>
                                                        </option>
                                                        <option value="MR.">MR</option>
                                                        <option value="MS.">MS</option>
                                                        <option value="MRS.">MRS</option>
                                                        <option value="ATTY.">ATTY</option>
                                                        <option value="DR.">DR</option>
                                                        <option value="ENGR.">ENGR</option>
                                                    </select>
                                                </td>

                                                <td name="personal_info[members_lastname]" id="echoLastName">
                                                    <strong>Last Name:</strong>
                                                    <?= $records['result_info'][0]['members_lastname'] ?></td>
                                                <td name="personal_info[members_firstname]" id="echoFirstName">
                                                    <strong>First Name:</strong>
                                                    <?= $records['result_info'][0]['members_firstname'] ?></td>
                                                <td name="personal_info[members_middlename]" id="echoMiddleName">
                                                    <strong>Middle Name:</strong>
                                                    <?= $records['result_info'][0]['members_middlename'] ?></td>
                                            </tr>
                                            <tr>
                                                <td id="echoBirthdate"><strong>Birth Date:</strong>
                                                    <?= $records['result_info'][0]['members_birthdate'] ?></td>
                                                <td colspan="2"><strong>Birth Place:</strong>
                                                    <?= $records['result_info'][0]['members_birthplace'] ?>
                                                    <input type="text" name="personal_info[members_birthplace]"
                                                        value="<?= $records['result_info'][0]['members_birthplace'] ?>"
                                                        hidden>
                                                    <br>
                                                    {{-- <label class="update_personal"><strong>Change
                                                            to: </strong></label> --}}
                                                    <br>
                                                    <input name="upbirthplace" id="upbirthplace" type="text"
                                                        class="update_personal text-input form-control w-100"
                                                        value="<?= $records['result_info'][0]['members_birthplace'] ?>"
                                                        style="width: 350px;">
                                                </td>
                                                <td name="personal_info[members_gender]" id="echoGender"><strong>Gender:
                                                    </strong>
                                                    <?= $records['result_info'][0]['members_gender'] ?>
                                                    <input type="text" name="personal_info[members_gender]"
                                                        value="<?= $records['result_info'][0]['members_gender'] ?>"
                                                        hidden>
                                                    <br>
                                                    {{-- <label class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <select id="upgender" name="upgender"
                                                        class="update_personal text-input form-control">
                                                        <option
                                                            value="<?= $records['result_info'][0]['members_gender'] ?>">
                                                            <?= $records['result_info'][0]['members_gender'] ?>
                                                        </option>
                                                        <option value="MALE">MALE</option>
                                                        <option value="FEMALE">FEMALE</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td id="echoCitizenship"><strong>Citizenship:</strong>
                                                    <?= $records['result_info'][0]['nationality_name'] ?><br>
                                                    <input type="text" name="personal_info[citizenship]"
                                                        value="<?= $records['result_info'][0]['nationality_name'] ?>"
                                                        hidden>
                                                    {{-- <label class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <select id="ctzen_membership" name="ctzen_membership"
                                                        class="update_personal text-input form-control">
                                                        <option
                                                            value="<?= $records['result_info'][0]['nationality_name'] ?>">
                                                            <?= $records['result_info'][0]['nationality_name'] ?>
                                                        </option>
                                                        <option value="FILIPINO">FILIPINO</option>
                                                        <option value="FOREIGNER">FOREIGNER</option>
                                                    </select>
                                                    <br>
                                                    <label class="label" hidden="hidden"
                                                        id="nationality1">Nationality</label>
                                                    <input type="text" name="nationality" id="nationality"
                                                        class="text-input form-control"
                                                        value="<?= $records['result_info'][0]['othercitizenship'] ?>"
                                                        hidden>
                                                </td>
                                                <td id="echoStatus"><strong>Status:</strong>
                                                    <?= $records['result_info'][0]['members_civilstatus'] ?><br>
                                                    <input type="text" name="personal_info[members_civilstatus]"
                                                        value="<?= $records['result_info'][0]['members_civilstatus'] ?>"
                                                        hidden>
                                                    {{-- <label class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <select id="upstatus" name="upstatus"
                                                        class="update_personal text-input form-control">
                                                        <option
                                                            value="<?= $records['result_info'][0]['members_civilstatus'] ?>">
                                                            <?= $records['result_info'][0]['members_civilstatus'] ?>
                                                        </option>
                                                        <option value="SINGLE">SINGLE</option>
                                                        <option value="MARRIED">MARRIED</option>
                                                        <option value="WIDOWED">WIDOWED</option>
                                                    </select>
                                                </td>
                                                <td colspan="2" id="echoOccupation"><strong>Occupation:</strong>
                                                    <?= $records['result_info'][0]['occupation_name'] ?>
                                                    <input type="text" name="personal_info[occupation_name]"
                                                        value="<?= $records['result_info'][0]['occupation_name'] ?>"
                                                        hidden>
                                                    <br>
                                                    {{-- <label class="update_personal"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" id="upoccupation" name="upoccupation"
                                                        value="<?= $records['result_info'][0]['occupation_name'] ?>"
                                                        class="update_personal text-input form-control w-100"
                                                        style="width: 300px;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="text-center blueFill text-light">
                                                    CONTACT INFORMATION
                                                    <i class="fas fa-edit contact hidden_icon"
                                                        style="cursor: pointer; position: absolute; right: 3rem;"></i>
                                                    <i class="fas fa-x contact hidden_icon"
                                                        style="cursor: pointer; position: absolute; right: 3rem; display: none;"></i>
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
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <table class="update_contact" style="border: none;">
                                                        <tr style="border: none;">
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Building
                                                                        No./Street</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_haddress1]"
                                                                    value="<?= $records['result_info'][0]['members_haddress1'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control" type="text"
                                                                    name="street"
                                                                    value="<?= $records['result_info'][0]['members_haddress1'] ?>"
                                                                    id="street">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Barangay/Town</strong></label>
                                                                <input class="text-input form-control" type="text"
                                                                    name="town"
                                                                    value="<?= $records['result_info'][0]['members_haddress2'] ?>"
                                                                    id="town">

                                                                <input type="text"
                                                                    name="personal_info[members_haddress2]"
                                                                    value="<?= $records['result_info'][0]['members_haddress2'] ?>"
                                                                    hidden>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>City/Municipality</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_housecity]"
                                                                    value="<?= $records['result_info'][0]['house_city_name'] ?>"
                                                                    hidden>

                                                                <input class="text-input form-control" type="text"
                                                                    name="city"
                                                                    value="<?= $records['result_info'][0]['house_city_name'] ?>"
                                                                    id="city">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Province</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_housedistrict]"
                                                                    value="<?= $records['result_info'][0]['house_district_name'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control" type="text"
                                                                    id="province"
                                                                    value="<?= $records['result_info'][0]['house_district_name'] ?>"
                                                                    name="province">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Zip
                                                                        Code</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_housezipcode]"
                                                                    value="<?= $records['result_info'][0]['members_housezipcode'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control numb" type="text"
                                                                    id="zcode" name="zcode" maxlength="4"
                                                                    inputmode="numeric" style="width: 130px"
                                                                    value="<?= $records['result_info'][0]['members_housezipcode'] ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" id="echocomname"><strong>Company
                                                        Name:</strong>
                                                    <?= $records['result_info'][0]['members_businessname'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" name="personal_info[members_businessname]"
                                                        value="<?= $records['result_info'][0]['members_businessname'] ?>"
                                                        hidden>
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
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <table class="update_contact" style="border: none;">
                                                        <tr style="border: none;">
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Building
                                                                        No./Street</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_oaddress1]"
                                                                    value="<?= $records['result_info'][0]['members_oaddress1'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control" type="text"
                                                                    name="street1"
                                                                    value="<?= $records['result_info'][0]['members_oaddress1'] ?>"
                                                                    id="street1">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Barangay/Town</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_oaddress2]"
                                                                    value="<?= $records['result_info'][0]['members_oaddress2'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control"
                                                                    value="<?= $records['result_info'][0]['members_oaddress2'] ?>"
                                                                    type="text" name="town1" id="town1">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>City/Municipality</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_officecity]"
                                                                    value="<?= $records['result_info'][0]['office_city_name'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control"
                                                                    value="<?= $records['result_info'][0]['office_city_name'] ?>"
                                                                    type="text" name="city1" id="city1">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Province</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_officedistrict]"
                                                                    value="<?= $records['result_info'][0]['office_district_name'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control" type="text"
                                                                    id="province1"
                                                                    value="<?= $records['result_info'][0]['office_district_name'] ?>"
                                                                    name="province1">
                                                            </td>
                                                            <td style="border: none;"><label
                                                                    class="update_contact"><strong>Zip
                                                                        Code</strong></label>
                                                                <input type="text"
                                                                    name="personal_info[members_officezipcode]"
                                                                    value="<?= $records['result_info'][0]['members_officezipcode'] ?>"
                                                                    hidden>
                                                                <input class="text-input form-control numb" type="text"
                                                                    id="zcode1"
                                                                    value="<?= $records['result_info'][0]['members_officezipcode'] ?>"
                                                                    name="zcode1" maxlength="4" inputmode="numeric"
                                                                    style="width: 130px">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" id="echoMailingPreference"><strong>Mailing
                                                        Preference:</strong><?= $records['result_info'][0]['members_mailingpreference'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" name="personal_info[mailing_preference]"
                                                        value="<?= $records['result_info'][0]['members_mailingpreference'] ?>"
                                                        hidden>
                                                    <select id="upaddress" name="upaddress"
                                                        class="update_contact text-input form-control">
                                                        <option
                                                            value="<?= $records['result_info'][0]['members_mailingpreference'] ?>">
                                                            <?= $records['result_info'][0]['members_mailingpreference'] ?>
                                                        </option>
                                                        <option value="HOME" id="home">HOME
                                                            ADDRESS</option>
                                                        <option value="OFFICE" id="office">OFFICE
                                                            ADDRESS</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id="echoHomeMobileNo"><strong>Home
                                                        Phone:</strong><br>
                                                    <?= $records['result_info'][0]['members_housephoneno'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" name="personal_info[members_housephoneno]"
                                                        value="<?= $records['result_info'][0]['members_housephoneno'] ?>"
                                                        hidden>
                                                    <input type="text" id="uphousephone" name="uphousephone"
                                                        value="<?= $records['result_info'][0]['members_housephoneno'] ?>"
                                                        class="update_contact text-input form-control numb"
                                                        onkeyup="maskTelNo(this.id)" style="width: 250px;"
                                                        inputmode="numeric">
                                                </td>
                                                <td id="echoOfficeMobileNo"><strong>Company
                                                        Phone:</strong><br>
                                                    <?= $records['result_info'][0]['members_officephoneno'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    {{-- <input type="text" name="personal_info[members_officephoneno]"
                                                        value="<?= $records['result_info'][0]['members_officephoneno'] ?>"
                                                        hidden> --}}
                                                    <input type="text" id="upofficephoneno" name="upofficephoneno"
                                                        onkeyup="maskTelNo(this.id)"
                                                        class="update_contact text-input form-control numb"
                                                        style="width: 250px;" inputmode="numeric">
                                                </td>
                                                <td id="echomobilenum"><strong>Mobile No:</strong><br>
                                                    <?= $records['result_info'][0]['members_mobileno'] ?><br>
                                                    <br>
                                                    <input type="text" name="personal_info[members_mobileno]"
                                                        value="<?= $records['result_info'][0]['members_mobileno'] ?>"
                                                        hidden>
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
                                                <td id="echoalternatemobilenum"><strong>Alternate Mobile
                                                        No:</strong><br>
                                                    <?= $records['result_info'][0]['members_alternate_mobileno'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" name="personal_info[members_alternate_mobileno]"
                                                        value="<?= $records['result_info'][0]['members_alternate_mobileno'] ?>"
                                                        hidden>
                                                    <input type="text" id="upaltmobileno" name="upaltmobileno"
                                                        value="<?= $records['result_info'][0]['members_alternate_mobileno'] ?>"
                                                        class="update_contact text-input form-control numb phone-input"
                                                        style="width: 250px;" inputmode="numeric"
                                                        data-error-container="error-msg-2"
                                                        data-valid-container="valid-msg-2">
                                                    <span id="valid-msg-2" class="hide valid-msg"></span>
                                                    <span id="error-msg-2" class="hide error-msg"></span>
                                                </td>
                                                <td id="echoemailadd"><strong>Email
                                                        Address:</strong><br>
                                                    <?= $records['result_info'][0]['members_emailaddress'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text" name="personal_info[members_emailaddress]"
                                                        value="<?= $records['result_info'][0]['members_emailaddress'] ?>"
                                                        hidden>
                                                    <input type="email" id="upemail" name="upemail"
                                                        value="<?= $records['result_info'][0]['members_emailaddress'] ?>"
                                                        class="update_contact text-input form-control"
                                                        style="width: 250px;">
                                                </td>
                                                <td id="echoalternateemailadd"><strong>Alternate
                                                        Email Address:</strong><br>
                                                    <?= $records['result_info'][0]['members_alternate_emailaddress'] ?><br>
                                                    {{-- <label class="update_contact"><strong>Change to:
                                                        </strong></label> --}}
                                                    <br>
                                                    <input type="text"
                                                        name="personal_info[members_alternate_emailaddress]"
                                                        value="<?= $records['result_info'][0]['members_alternate_emailaddress'] ?>"
                                                        hidden>
                                                    <input type="email" id="upaltemail" name="upaltemail"
                                                        value="<?= $records['result_info'][0]['members_alternate_emailaddress'] ?>"
                                                        class="update_contact text-input form-control"
                                                        style="width: 250px;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                            <tr>
                                                <th colspan="6" class="text-center blueFill text-light">VEHICLE
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
                                                        <td><strong>Update:</strong><br><input type="checkbox"
                                                                id="v{{ $key + 1 }}" name="v{{ $key + 1 }}" class="check"
                                                                onclick="updateV{{ $key + 1 }}()" disabled></td>
                                                        <?php
                                                    if ($r['vehicleinfo_csticker'] == 1) { ?>
                                                        <td><strong>Conduction
                                                                Sticker:&nbsp;</strong><br><br><input type="checkbox"
                                                                id="csticker" name="csticker" value="csticker" checked disabled>
                                                        </td>
                                                        <?php
                                                    } else { ?>
                                                        <td><strong>Conduction Sticker:&nbsp;</strong><input type="checkbox"
                                                                id="csticker" name="csticker" value="csticker" disabled></td>
                                                        <?php
                                                    }
                                                    ?>
                                                        <td colspan="2" id="echoplatenum"><strong>Plate
                                                                No:</strong>
                                                            <?= isset($r['vehicleinfo_plateno']) ? $r['vehicleinfo_plateno'] : '' ?>
                                                        </td>
                                                        <td id="echomake"><strong>Make:</strong>
                                                            <?= isset($r['vehiclebrand_name']) ? $r['vehiclebrand_name'] : '' ?>
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td id="echomodel"><strong>Model:</strong>
                                                            <?= isset($r['vehiclemodel_name']) ? $r['vehiclemodel_name'] : '' ?>
                                                        </td>
                                                        <td id="echoymodel"><strong>Year Model:</strong>
                                                            <?= isset($r['vehicleinfo_year']) ? $r['vehicleinfo_year'] : '' ?>
                                                        </td>
                                                        <td id="echocolor"><strong>Color:</strong>
                                                            <?= isset($r['vehiclecolor_name']) ? $r['vehiclecolor_name'] : '' ?>
                                                        </td>
                                                        <td id="echoftype"><strong>Fuel Type:</strong>
                                                            <?= isset($r['vehiclefuel_name']) ? $r['vehiclefuel_name'] : '' ?>
                                                        </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">No vehicle details available</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>


                                    <h4 class="mt-3 text-dark">Update my personal information?</h4>&nbsp;
                                    &nbsp;
                                    <div class="pradio mb-5 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="uyes" name="uradio"
                                                value="1">
                                            <label class="custom-control-label" for="uyes" style="font-size:16px;"
                                                id="yesLabel">YES</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="uno" name="uradio"
                                                value="0">
                                            <label class="custom-control-label" for="uno" style="font-size:16px;"
                                                id="noLabel">NO</label>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align: justify;">
                                        <div class="col-12">
                                            <div class="formCheck d-flex">
                                                <input class="check-input" type="checkbox" id="aq" name="aq" value="1"
                                                    checked>
                                                <p class="form-check-label p-2" for="summarycheck1">I would like to
                                                    receive AQ
                                                    Magazine via email.</p>
                                            </div>
                                            <div class="formCheck d-flex">
                                                <input class="check-input" type="checkbox" id="agree" name="agree"
                                                    value="1" required>
                                                <p class="form-check-label p-2" for="summarycheck2">I confirm that the
                                                    information given in this form is
                                                    true, complete and accurate.</p>
                                            </div>
                                            {{-- <div class="formCheck d-flex">
                                                <input class="check-input" type="checkbox" id="agreeDP" name="agreeDP"
                                                    value="1" required>
                                                <p class="form-check-label p-2" for="summarycheck3">I agree to the Terms
                                                    and
                                                    Conditions of the Privacy
                                                    Policy of the Automobile Association Philippines
                                                    which I acknowledge that I have read and
                                                    understood.
                                                </p>
                                            </div> --}}
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
    <script src="/script/renew_form.js"></script>
    <script src="/script/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('vehicle_autocomp')
    @include('dynamic_vehicle')
    <script>
        // $(document).ready(function() {
        //     $('.select2').select2({
        //         placeholder: 'Search...',
        //         searchable: true
        //     });
        // });


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