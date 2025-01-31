<script>
    document.addEventListener('DOMContentLoaded', function () {
        let vehicleCount = 2; // Start with the second vehicle
        let maxVehicles = 1; // Default max vehicles

        // Membership Type Change Handler
        const membershipTypeSelect = document.getElementById('membershiptype');
        const addButton = document.getElementById('addVehicle');
        const vehicleFieldsContainer = document.getElementById('vehicleFields');

        // Function to update maxVehicles based on selected membership type
        function updateMaxVehicles() {
            if (membershipTypeSelect) {
                const selectedOption = membershipTypeSelect.options[membershipTypeSelect.selectedIndex];
                maxVehicles = parseInt(selectedOption.getAttribute('data-vehicle_num') || 1);
                // console.log('Max vehicles allowed:', maxVehicles);
            }
        }

        // Initialize maxVehicles on page load
        updateMaxVehicles();

        if (membershipTypeSelect) {
            membershipTypeSelect.addEventListener('change', function () {
                updateMaxVehicles();
                vehicleCount = 2; // Reset vehicle count to start with the second vehicle
            });
        }

        if (addButton && vehicleFieldsContainer) {
            addButton.addEventListener('click', function () {
                console.log('Add button clicked. Current vehicle count:', vehicleCount);
                console.log('Max vehicles allowed:', maxVehicles);

                if (vehicleCount > maxVehicles) {
                    // Using SweetAlert for max vehicle limit notification
                    Swal.fire({
                        title: "<i>Sorry</i>",
                        html: `You have reached the maximum number of vehicles (${maxVehicles}) allowed for your current Membership Type.`
                    });
                    return; // Stop further execution
                }

                // Create new vehicle fields dynamically
                const newVehicleDiv = document.createElement('div');
                newVehicleDiv.classList.add('vehicle-item', 'border', 'rounded', 'p-3', 'mb-3');

                newVehicleDiv.innerHTML = `
                <h6 class="mb-3">Vehicle <span class="vehicle-number">${vehicleCount}</span></h6>
                <div class="row g-3 vehicle-entry">
                    <!-- First Row -->
                    <div class="col-md-4 centered-content">
                        <label class="label" style="font-size: medium;">
                            Is Conduction Sticker Available?
                        </label>
                        <input type="hidden" id="csticker${vehicleCount}" name="is_cs[]" value="0" >
                        <div>
                            <div class="options-container">
                                <label class="radio-checkbox">
                                    <input type="checkbox" id="csticker_yes${vehicleCount}"  value="1" onchange="updateLabeldyna('csticker_yes${vehicleCount}', 'csticker_no${vehicleCount}')" >
                                    <span class="checkmark"></span> YES
                                </label>
                                <label class="radio-checkbox">
                                    <input type="checkbox" id="csticker_no${vehicleCount}" value="0" onchange="updateLabeldyna('csticker_no${vehicleCount}', 'csticker_yes${vehicleCount}')" checked disabled>
                                    <span class="checkmark"></span>NO
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="platenum${vehicleCount}" class="label">Plate No</label>
                        <input name="vehicle_plate[]" type="text" class="text-input form-control form-control-sm platenum @error('vehicle_plate.*') is-invalid @enderror" id="platenum${vehicleCount}"
                        autocomplete="off" placeholder=" Enter Plate No" style="text-transform: uppercase;" required>
                        <div class="validation-message_plateno" id="validation-message_plateno" style="color: red;"></div>
                    </div>
                    <div class="col-md-3 centered-content">
                        <label class="label" style="font-size: medium;">
                            Is Diplomat?
                        </label>
                        <input type="hidden" id="is_diplomat_${vehicleCount}" name="is_diplomat[]" value="0" >
                        <div>
                            <div class="options-container">
                            <label class="radio-checkbox">
                                <input type="checkbox" id="is_diplomat_yes_${vehicleCount}"  value="1" onchange="update_diplomat('is_diplomat_yes_${vehicleCount}', 'is_diplomat_no_${vehicleCount}')" >
                                <span class="checkmark"></span>
                                YES
                            </label>
                            <label class="radio-checkbox">
                                <input type="checkbox" id="is_diplomat_no_${vehicleCount}" value="0" onchange="update_diplomat('is_diplomat_no_${vehicleCount}', 'is_diplomat_yes_${vehicleCount}')" checked disabled>
                                <span class="checkmark"></span>
                                NO
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Car Make</label>
                        <select class="form-control form-control-sm select2" id="make${vehicleCount}" name="vehicle_make[]" required>
                            <option value="" selected>Car Make</option>
                            @foreach ($carMake as $row2)
                                <option value="{{ $row2['brand'] }}">{{ strtoupper($row2['brand']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Car Models</label>
                        <select class="form-control select2" id="model${vehicleCount}" name="vehicle_model[]">
                            <option value="" selected>Car Model</option>
                        </select>
                    </div>
                    <!-- Second Row -->
                    <div class="col-md-3">
                        <label class="form-label">Vehicle Type</label>
                        <select class="form-control select2" id="vehicle_type${vehicleCount}" name="vehicle_type[]">
                            <option value="" selected>Vehicle Type</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Year</label>
                        <input type="text" 
                            id="year${vehicleCount}" 
                            name="vehicle_year[]" 
                            maxlength="4" 
                            class="form-control number_only"
                            placeholder="Enter year"
                            onkeypress="return /[0-9]/i.test(event.key)"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            pattern="[0-9]{4}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sub model</label>
                        <input type="text" id="submodel${vehicleCount}" name="submodel[]" class="form-control"
                            placeholder="Enter sub model">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Color</label>
                        <input type="text" id="color${vehicleCount}" name="vehicle_color[]" class="form-control"
                            placeholder="Enter color">
                    </div>

                    <!-- Third Row -->
                    <div class="col-md-3">
                        <label class="form-label">Fuel Type</label>
                        <select class="form-select" name="vehicle_fuel[]">
                            <option disabled selected value="">Fuel Type</option>
                            <option value="GAS">GAS</option>
                            <option value="DIESEL">DIESEL</option>
                            <option value="ELECTRIC">ELECTRIC</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Transmission Type</label>
                        <select class="form-select" name="vehicle_transmission[]">
                            <option disabled selected value="">Select Transmission Type</option>
                            <option value="AUTOMATIC">AUTOMATIC</option>
                            <option value="MANUAL">MANUAL</option>
                        </select>
                    </div>
<div class="col-md-6">
            <div class="form-group">
                <label for="orAttachment${vehicleCount}" class="form-label">Upload: Official Receipt</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="orAttachment${vehicleCount}"
                        name="or_image[]"
                        onchange="handleVehicleFileUpload(this, 'or${vehicleCount}', 'orFeedback${vehicleCount}')" required>
                    <label class="input-group-text" for="orAttachment${vehicleCount}">
                        <i class="fas fa-upload"></i>
                    </label>
                </div>
                <div id="orFeedback${vehicleCount}" class="text-danger"></div>
                <img id="or${vehicleCount}" src="" alt="Image or"
                    style="max-width: 200px; display: none; margin-top: 10px;">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="crAttachment${vehicleCount}" class="form-label">Upload: Certificate of Registration</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="crAttachment${vehicleCount}"
                        name="cr_image[]"
                        onchange="handleVehicleFileUpload(this, 'cr${vehicleCount}', 'crFeedback${vehicleCount}')" required>
                    <label class="input-group-text" for="crAttachment${vehicleCount}">
                        <i class="fas fa-upload"></i>
                    </label>
                </div>
                <div id="crFeedback${vehicleCount}" class="text-danger"></div>
                <img id="cr${vehicleCount}" src="" alt="Image cr"
                    style="max-width: 200px; display: none; margin-top: 10px;">
            </div>
        </div>
                </div>
                <button type="button" class="btn btn-danger mt-3 remove-vehicle">
                    <i class="bi bi-trash me-2"></i>Remove Vehicle
                </button>
            `;

                // Add event listener to remove button
                newVehicleDiv.querySelector('.remove-vehicle').addEventListener('click', function () {
                    const vehicleItems = document.querySelectorAll('.vehicle-item');
                    if (vehicleItems.length > 1) {
                        this.closest('.vehicle-item').remove();
                        vehicleCount--; // Decrement vehicle count
                        updateVehicleNumbers();
                    } else {
                        Swal.fire({
                            title: "Error",
                            html: "At least one vehicle is required."
                        });
                    }
                });

                vehicleFieldsContainer.appendChild(newVehicleDiv);

                // Initialize Select2 for the newly added vehicle only
                if (typeof $ !== 'undefined' && $.fn.select2) {
                    $(`#make${vehicleCount}, #model${vehicleCount}, #vehicle_type${vehicleCount}`).select2({
                        dropdownCssClass: "select2-dropdown",
                        searchable: true
                    });
                }

                // Add AJAX event listeners for the newly added vehicle
                bindAjaxEvents(vehicleCount);

                vehicleCount++; // Increment vehicle count for the next addition
            });
        }

        // Update vehicle numbers when a vehicle is removed
        function updateVehicleNumbers() {
            const vehicleItems = document.querySelectorAll('.vehicle-item');
            vehicleItems.forEach((item, index) => {
                const vehicleNumberSpan = item.querySelector('.vehicle-number');
                if (vehicleNumberSpan) {
                    vehicleNumberSpan.textContent = index + 1;
                }
            });
        }

        // Function to bind AJAX events dynamically
        function bindAjaxEvents(vehicleNumber) {
            // Make event
            $(`#make${vehicleNumber}`).on("change", function () {
                var make = $(`#make${vehicleNumber}`).val();
                $(`#model${vehicleNumber}`).empty();
                $(`#vehicle_type${vehicleNumber}`).empty();
                $(`#submodel${vehicleNumber}`).val("");
                $(`#year${vehicleNumber}`).val("");
                $(`#amount`).val("");

                $.ajax({
                    url: "/api/v1/insurance/getCarModel",
                    type: "post",
                    data: {
                        make: make
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        var len = response.length;
                        $(`#model${vehicleNumber}`).empty();
                        $(`#model${vehicleNumber}`).append("<option value=''>Please select</option>");
                        for (var i = 0; i < len; i++) {
                            var model = response[i]["model"];
                            $(`#model${vehicleNumber}`).append(
                                "<option value='" + model + "'>" + model + "</option>"
                            );
                        }
                    }
                });
            });

            // Model event
            $(`#model${vehicleNumber}`).on("change", function () {
                var model = $(`#model${vehicleNumber}`).val();
                $(`#vehicle_type${vehicleNumber}`).empty();
                $(`#submodel${vehicleNumber}`).val("");
                $(`#year${vehicleNumber}`).val("");
                $(`#amount`).val("");

                $.ajax({
                    url: "/api/v1/insurance/getBodyType",
                    type: "post",
                    data: {
                        model: model
                    },
                    dataType: "json",
                    success: function (response) {
                        var len = response.length;
                        $(`#vehicle_type${vehicleNumber}`).empty();
                        $(`#vehicle_type${vehicleNumber}`).append("<option value=''>Please select</option>");
                        for (var i = 0; i < len; i++) {
                            var bodytype = response[i]["bodytype_name"];
                            $(`#vehicle_type${vehicleNumber}`).append(
                                "<option value='" + bodytype + "'>" + bodytype + "</option>"
                            );
                        }
                    }
                });
            });

            // Year autocomplete
            $(`#year${vehicleNumber}`)
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        var model = $(`#model${vehicleNumber}`).val();
                        var vehicle_type = $(`#vehicle_type${vehicleNumber}`).val();
                        $(`#amount`).val(0);
                        $(`#submodel${vehicleNumber}`).val('');
                        $.ajax({
                            url: "/api/v1/insurance/getYearModel",
                            type: "post",
                            data: {
                                model: model,
                                vehicle_type: vehicle_type
                            },
                            dataType: "json",
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    focus: function (event, ui) {
                        $(`#year${vehicleNumber}`).val(ui.item.year);
                        return false;
                    },
                    select: function (event, ui) {
                        $(`#year${vehicleNumber}`).val(ui.item.year);
                        return false;
                    }
                })
                .bind("focus", function () {
                    $(this).autocomplete("search");
                });

            // Submodel autocomplete
            $(`#submodel${vehicleNumber}`)
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        var model = $(`#model${vehicleNumber}`).val();
                        var year = $(`#year${vehicleNumber}`).val();

                        $.ajax({
                            url: "/api/v1/insurance/getSubModel",
                            type: "post",
                            data: {
                                model: model,
                                year: year
                            },
                            dataType: "json",
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    focus: function (event, ui) {
                        $(`#submodel${vehicleNumber}`).val(ui.item.submodel_name);
                        $("#car_details_btn").prop("disabled", false);
                        return false;
                    },
                    select: function (event, ui) {
                        $(`#submodel${vehicleNumber}`).val(ui.item.submodel_name);
                        $(`#amount`).val(ui.item.amount);
                        return false;
                    }
                })
                .bind("focus", function () {
                    $(this).autocomplete("search");
                });

            // Autocomplete render methods
            $(`#year${vehicleNumber}, #submodel${vehicleNumber}`).each(function () {
                $(this).data("ui-autocomplete")._renderMenu = function (ul, items) {
                    var that = this;
                    ul.addClass("custom-menu");
                    $.each(items, function (index, item) {
                        that._renderItemData(ul, item);
                    });
                };

                $(this).data("ui-autocomplete")._renderItem = function (ul, item) {
                    return $("<li>")
                        .addClass("custom-menu-item")
                        .data("ui-autocomplete-item", item)
                        .append("<div>" + (item.year || item.submodel_name) + "</div>")
                        .appendTo(ul);
                };
            });
        }

        // Initialize Select2 for the initial vehicle form
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('#make1, #model1, #vehicle_type1').select2({
                dropdownCssClass: "select2-dropdown",
                searchable: true
            });
        }

        // Initial binding for the first vehicle
        bindAjaxEvents(1);
    });

    // Add this after your existing DOMContentLoaded event listener

function updateVehicleSummary() {
    const tbody = $("#myTable tbody");
    tbody.empty();
    
    // Get all vehicle entries (both static and dynamic)
    $(".vehicle-entry").each(function(index) {
        const plate        = $(this).find('[name="vehicle_plate[]"]').val();
        const make         = $(this).find('[name="vehicle_make[]"]').val();
        const model        = $(this).find('[name="vehicle_model[]"]').val();
        const year         = $(this).find('[name="vehicle_year[]"]').val();
        const color        = $(this).find('[name="vehicle_color[]"]').val();
        const fuel         = $(this).find('[name="vehicle_fuel[]"]').val();
        const transmission = $(this).find('[name="vehicle_transmission[]"]').val();

        if (plate) {
            tbody.append(`
                <tr>
                    <td rowspan="3" style="text-align: center; vertical-align: middle;">
                        <h3 class="text-center">${index + 1}${nthNumber(index + 1)}</h3>
                    </td>
                    <td colspan="1"><strong>Plate No.</strong> ${plate}</td>
                    <td><strong>Make:</strong> ${make}</td>
                    <td><strong>Model:</strong> ${model}</td>
                </tr>
                <tr>
                    <td><strong>Year:</strong> ${year}</td>
                    <td><strong>Color:</strong> ${color}</td>
                    <td><strong>Fuel:</strong> ${fuel}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Transmission: </strong>${transmission}</td>
                </tr>
            `);
        }
    });
}

// Helper function for ordinal numbers
function nthNumber(number) {
    if (number > 3 && number < 21) return 'th';
    switch (number % 10) {
        case 1: return "st";
        case 2: return "nd";
        case 3: return "rd";
        default: return "th";
    }
}

// Add these event listeners to update summary when vehicle details change
document.addEventListener('DOMContentLoaded', function() {
    // Update summary when any input changes
    $(document).on('change', '.vehicle-entry input, .vehicle-entry select', function() {
        updateVehicleSummary();
    });
    
    // Update summary when a vehicle is added
    $('#addVehicle').on('click', function() {
        setTimeout(updateVehicleSummary, 100); // Small delay to ensure new fields are added
    });
    
    // Update summary when a vehicle is removed
    $(document).on('click', '.remove-vehicle', function() {
        setTimeout(updateVehicleSummary, 100);
    });
    
    // Initial summary update
    updateVehicleSummary();
});
</script>