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
    <link rel="stylesheet" href="{{ asset('style/membership.css') }}">
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
            <div class="col-md-10 col-lg-8"> <!-- Adjusted column width -->
                <form id="resellerForm" action="{{ route('new_membership.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="hiddenFormData" name="form_data" value="">
                    @foreach ($errors->all() as $key => $error)
                        <p style="color: red">{{ $key }} : {{ $error }}</p>
                    @endforeach

                    <!-- Card 1: Personal Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Personal Information</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="membershiptype" class="form-label">Type of Membership</label>
                                <select class="form-select" id="membershiptype" name="personal_info[membership_type]"
                                    required>
                                    @if($selectedMembership)
                                        <option value="{{ $selectedMembership->membership_id }}"
                                            data-vehicle_num="{{ $selectedMembership->vehicle_num }}" selected>
                                            {{ $selectedMembership->membership_name }}
                                        </option>
                                    @else
                                        <option value="" selected disabled>Select Plan Type</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="plantype" class="form-label">Plan Type</label>
                                <select class="form-select" id="plantype" name="personal_info[plan_type]" required>
                                    @if($selectedPlan)
                                        <option value="{{ $selectedPlan->plan_id }}" selected>
                                            {{ $selectedPlan->plan_name }} - {{ $selectedPlan->plan_amount }}
                                        </option>
                                    @else
                                        <option value="" selected disabled>Select Plan Type</option>
                                    @endif
                                </select>
                                <input type="hidden" name="personal_info[plantype_id]" id="selected_plan_id">
                            </div>
                            <div class="col-md-4 mb-3">
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
                                <select class="form-select" id="title" name="personal_info[members_title]" required>
                                    <option value="" selected disabled>Select Title</option>
                                    <option value="MR">MR</option>
                                    <option value="MS">MS</option>
                                    <option value="MRS">MRS</option>
                                    <option value="ATTY">ATTY</option>
                                    <option value="DR">DR</option>
                                    <option value="ENGR">ENGR</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control letters_only_fname" id="firstName"
                                    name="personal_info[members_firstname]" required>
                                <div class="validation-message_fname" style="color: red;"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control letters_only_mname" id="middleName"
                                    name="personal_info[members_middlename]">
                                <div class="validation-message_mname" style="color: red;"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control letters_only_lname" id="lastName"
                                    name="personal_info[members_lastname]" required>
                                <div class="validation-message_lname" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="personal_info[members_gender]" required>
                                    <option value="" selected disabled>Select a Gender</option>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Birthdate</label>
                                <input type="text" class="form-control" name="personal_info[members_birthdate]"
                                    id="birthdate" placeholder="MM/DD/YYYY" maxlength="10" required>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-3">
                                <label for="civilStatus" class="form-label">Civil Status</label>
                                <select class="form-select" id="civilStatus" name="personal_info[members_civilstatus]"
                                    required>
                                    <option value="" selected disabled>Select Civil Status</option>
                                    <option value="SINGLE">SINGLE</option>
                                    <option value="MARRIED">MARRIED</option>
                                    <option value="WIDOWED">WIDOWED</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="citizenship" class="form-label">Citizenship</label>
                                <select type="text" class="form-control" name="personal_info[citizenship]"
                                    id="citizenship" required>
                                    <option value="" selected disabled>Select Citizenship</option>
                                    <option value="filipino"> FILIPINO</option>
                                    <option value="foreigner">FOREIGNER</option>
                                </select>
                            </div>
                            <div class="col-md-3" id="add_info" style="display: none;">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control" name="personal_info[nationality]"
                                    id="nationality">
                            </div>
                        </div>
                        <!-- Rest of personal information fields in similar row/col structure -->
                    </div>

                    <!-- Card 2: Contact Information -->
                    <div class="card bordered">
                        <h5 class="card-title mb-4">Contact Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="mail" class="form-label">Mailing Preference</label>
                                <select class="form-select" name="personal_info[mailing_preference]" id="mail" required>
                                    <option disabled selected value="">Select Mailing Address</option>
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
                                <input type="text" class="form-control" name="personal_info[town]" id="town" required>
                            </div>
                            <div class="col-md-3">
                                <label for="city" class="form-label">City/Municipality</label>
                                <input type="text" class="form-control" name="personal_info[city]" id="city" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" name="personal_info[province]" id="province"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="zcode" class="form-label">Zip</label>
                                <input type="text" class="form-control" name="personal_info[zcode]" id="zcode" required>
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
                                    data-code-input="ccode-1" required>
                                <span id="valid-msg-1" class="hide valid-msg"></span>
                                <span id="error-msg-1" class="hide error-msg"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="alternateMobile" class="form-label">Alternate Mobile
                                    Number</label>
                                <input type="tel" class="form-control phone-input"
                                    name="personal_info[members_alternate_mobileno]" id="alternateMobile"
                                    data-error-container="error-msg-2" data-valid-container="valid-msg-2"
                                    data-code-input="ccode-2">
                                <span id="valid-msg-2" class="hide valid-msg"></span>
                                <span id="error-msg-2" class="hide error-msg"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="personal_info[members_emailaddress]"
                                    id="emailAddress" required>
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
                                    <input type="text" class="form-control" name="personal_info[street1]" id="street1">
                                </div>
                                <div class="col-md-5">
                                    <label for="town" class="form-label">Barangay / Towns</label>
                                    <input type="text" class="form-control" name="personal_info[town1]" id="town1">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="city" class="form-label">City/Municipality</label>
                                    <input type="text" class="form-control" name="personal_info[city1]" id="city1">
                                </div>
                                <div class="col-md-5">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" name="personal_info[province1]"
                                        id="province1">
                                </div>
                                <div class="col-md-2">
                                    <label for="zcode" class="form-label">Zip</label>
                                    <input type="text" class="form-control" name="personal_info[zcode1]" id="zcode1">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="comname" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="personal_info[comname]" id="comname">
                                </div>
                                <div class="col-md-3">
                                    <label for="telephoneNumber" class="form-label">Telephone
                                        Number</label>
                                    <input type="tel" class="form-control" name="personal_info[members_alternate_tel]"
                                        id="telephoneNumber">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="navigation-buttons"></div>
                        </div>
                    </div>
                    <!-- Card 3: Contact Information -->
                    <div class="card bordered">
                        <h5 class="mb-4">Vehicle Details</h5>
                        <div id="vehicleFields">
                            <!-- Initial Vehicle Form -->
                            <div class="vehicle-item border rounded p-3 mb-3">
                                <h6 class="mb-3">Vehicle <span class="vehicle-number">1</span></h6>
                                <div class="row g-3">
                                    <!-- First Row -->
                                    <div class="col-md-3 centered-content">
                                        <label class="label" style="font-size: medium;">
                                            Is Conduction Sticker Available?
                                        </label>
                                        <input type="hidden" id="csticker" name="is_cs[]" value="0">
                                        <div>
                                            <div class="options-container">
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="csticker_yes" value="1"
                                                        onchange="updateLabeldyna('csticker_yes', 'csticker_no')">
                                                    <span class="checkmark"></span>
                                                    YES
                                                </label>
                                                <label class="radio-checkbox">
                                                    <input type="checkbox" id="csticker_no" value="0"
                                                        onchange="updateLabeldyna('csticker_no', 'csticker_yes')"
                                                        checked disabled>
                                                    <span class="checkmark"></span>
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="platenum" class="label">Plate No</label>
                                        <input name="vehicle_plate[]" type="text"
                                            class="text-input form-control form-control-sm platenum" id="platenum"
                                            autocomplete="off" placeholder=" Enter Plate No"
                                            style="text-transform: uppercase;" required>
                                        <div class="validation-message_plateno" id="validation-message_plateno"
                                            style="color: red;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Car Make</label>
                                        <select class="form-control form-control-sm select2" id="make1"
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
                                        <select class="form-control select2" id="model1" name="vehicle_model[]"
                                            required>
                                            <option value="" selected>Car Model</option>
                                        </select>
                                    </div>

                                    <!-- Second Row -->
                                    <div class="col-md-3">
                                        <label class="form-label">Vehicle Type</label>
                                        <select class="form-control select2" id="vehicle_type1" name="vehicle_type[]"
                                            required>
                                            <option value="" selected>Vehicle Type</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="number" id="year1" name="vehicle_year[]" class="form-control"
                                            placeholder="Enter year" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Sub model</label>
                                        <input type="text" id="submodel1" name="submodel[]" class="form-control"
                                            placeholder="Enter sub model" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" id="color" name="vehicle_color[]" class="form-control"
                                            placeholder="Enter color" required>
                                    </div>

                                    <!-- Third Row -->
                                    <div class="col-md-3">
                                        <label class="form-label">Fuel Type</label>
                                        <select class="form-select" name="vehicle_fuel[]" required>
                                            <option disabled selected value="">Fuel Type</option>
                                            <option value="GAS">GAS</option>
                                            <option value="DIESEL">DIESEL</option>
                                            <option value="ELECTRIC">ELECTRIC</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Transmission Type</label>
                                        <select class="form-select" name="vehicle_transmission[]" required>
                                            <option disabled selected value="">Select Transmission Type</option>
                                            <option value="AUTOMATIC">AUTOMATIC</option>
                                            <option value="MANUAL">MANUAL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="orAttachment" class="form-label">Upload: Official
                                                Receipt</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="orAttachment"
                                                    name="upload_receipt"
                                                    onchange="handleFileUpload(this, 'or', 'orFeedback')" required>
                                                <label class="input-group-text" for="orAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            <div id="orFeedback" class="text-danger"></div>
                                            <img id="or" src="" alt="Image or"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="crAttachment" class="form-label">Upload: Certificate of
                                                Registration</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="crAttachment"
                                                    name="cr_image"
                                                    onchange="handleFileUpload(this, 'cr', 'crFeedback')" required>
                                                <label class="input-group-text" for="crAttachment">
                                                    <i class="fas fa-upload"></i>
                                                </label>
                                            </div>
                                            <div id="crFeedback" class="text-danger"></div>
                                            <img id="cr" src="" alt="Image cr"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Vehicle Button -->
                        <button type="button" class="btn btn-primary mt-3" id="addVehicle">
                            <i class="bi bi-plus-circle me-2"></i>Add Item
                        </button>

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
    <script src="/script/membership.js"></script>
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
</body>

</html>