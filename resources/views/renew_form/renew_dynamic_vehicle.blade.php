<script>
document.addEventListener('DOMContentLoaded', function () {
    let vehicleCount = document.querySelectorAll('.vehicle-item').length; // Start with the count of existing vehicles
    let maxVehicles = 1; // Default max vehicles

    const membershipTypeSelect = document.getElementById('membershiptype') || document.getElementById('membershipType');
    const addButton = document.getElementById('addVehicle');
    const vehicleFieldsContainer = document.getElementById('vehicleFields');

    // Function to update maxVehicles based on selected membership type
    function updateMaxVehicles() {
        if (membershipTypeSelect) {
            const selectedOption = membershipTypeSelect.options[membershipTypeSelect.selectedIndex];
            maxVehicles = parseInt(selectedOption.getAttribute('data-vehicle_num') || 1);
        }
    }

    // Initialize maxVehicles on page load
    updateMaxVehicles();

    // Add change event listener for membership type
    if (membershipTypeSelect) {
        membershipTypeSelect.addEventListener('change', function () {
            updateMaxVehicles();
            const currentVehicles = document.querySelectorAll('.vehicle-item').length;

            if (currentVehicles > maxVehicles) {
                const removableVehicles = document.querySelectorAll('.vehicle-item .remove-vehicle');
                removableVehicles.forEach(button => button.closest('.vehicle-item').remove());

                Swal.fire({
                    title: "Vehicle Limit Adjusted",
                    html: `The number of vehicles has been adjusted to match your new membership type limit (${maxVehicles} vehicles).`
                });
            }
            updateVehicleNumbersAndFields();
        });
    }

    if (addButton && vehicleFieldsContainer) {
    addButton.addEventListener('click', function () {
        const currentVehicles = document.querySelectorAll('.vehicle-item').length;

        if (currentVehicles >= maxVehicles) {
            Swal.fire({
                title: "Vehicle Limit Reached",
                html: `You have reached the maximum number of vehicles (${maxVehicles}) allowed for your current Membership Type.`
            });
            return;
        }

        // Increment vehicleCount
        vehicleCount++;

        // Create new vehicle fields dynamically
        const newVehicleDiv = document.createElement('div');
        newVehicleDiv.classList.add('vehicle-item', 'rounded', 'p-3', 'mb-3');

        // Use vehicleCount for correct numbering
        const newVehicleNumber = vehicleCount;

            newVehicleDiv.innerHTML = `
                <h6 class="mb-3">Vehicle <span class="vehicle-number">${newVehicleNumber}</span></h6>
                <div class="row g-3 vehicle-entry">
                    <!-- First Row -->
                    <div class="col-md-4 centered-content">
                        <label class="label" style="font-size: medium;">
                            Is Conduction Sticker Available?
                        </label>
                        <input type="hidden" class="cs-value" name="is_cs[]" value="0">
                        <div>
                            <div class="options-container">
                                <label class="radio-checkbox">
                                    <input type="checkbox"
                                        class="cs-yes"
                                        id="csticker_yes${newVehicleNumber}"
                                        value="1"
                                        onclick="updateLabelDyna(this, 'yes')">
                                    <span class="checkmark"></span> YES
                                </label>
                                <label class="radio-checkbox">
                                    <input type="checkbox"
                                        class="cs-no"
                                        id="csticker_no${newVehicleNumber}"
                                        value="0"
                                        onclick="updateLabelDyna(this, 'no')"
                                        checked
                                        disabled>
                                    <span class="checkmark"></span>NO
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="platenum${newVehicleNumber}" class="label">Plate No</label>
                        <input name="vehicle_plate[]" type="text" class="text-input form-control form-control-sm platenum @error('vehicle_plate.*') is-invalid @enderror" id="platenum${newVehicleNumber}"
                        autocomplete="off" placeholder=" Enter Plate No" style="text-transform: uppercase;" maxlength="8" required>
                        <div class="validation-message_plateno" id="validation-message_plateno" style="color: red;"></div>
                    </div>
                    <!-- Diplomat section for new vehicle -->
                    <div class="col-md-3 centered-content">
                        <label class="label" style="font-size: medium;">
                            Is Diplomat?
                        </label>
                        <input type="hidden" id="is_diplomat_${newVehicleNumber}" name="is_diplomat[]" value="0">
                        <div>
                            <div class="options-container">
                                <label class="radio-checkbox">
                                    <input type="checkbox"
                                        id="is_diplomat_yes_${newVehicleNumber}"
                                        value="1"
                                        onclick="update_diplomat('is_diplomat_yes_${newVehicleNumber}', 'is_diplomat_no_${newVehicleNumber}')">
                                    <span class="checkmark"></span> YES
                                </label>
                                <label class="radio-checkbox">
                                    <input type="checkbox"
                                        id="is_diplomat_no_${newVehicleNumber}"
                                        value="0"
                                        onclick="update_diplomat('is_diplomat_no_${newVehicleNumber}', 'is_diplomat_yes_${newVehicleNumber}')"
                                        checked
                                        disabled>
                                    <span class="checkmark"></span>NO
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Car Make</label>
                        <select class="form-control form-control-sm select2" id="make${newVehicleNumber}" name="vehicle_make[]" required>
                            <option value="" selected>Car Make</option>
                            @foreach ($carMake as $row2)
                                <option value="{{ $row2['brand'] }}">{{ strtoupper($row2['brand']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Car Models</label>
                        <select class="form-control select2" id="model${newVehicleNumber}" name="vehicle_model[]" required>
                            <option value="" selected>Car Model</option>
                        </select>
                    </div>
                    <!-- Second Row -->
                    <div class="col-md-3">
                        <label class="form-label">Vehicle Type</label>
                        <select class="form-control select2" id="vehicle_type${newVehicleNumber}" name="vehicle_type[]" required>
                            <option value="" selected>Vehicle Type</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Year</label>
                        <input type="text"
                            id="year${newVehicleNumber}"
                            name="vehicle_year[]"
                            maxlength="4"
                            class="form-control number_only"
                            placeholder="Enter year"
                            onkeypress="return /[0-9]/i.test(event.key)"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            pattern="[0-9]{4}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sub model</label>
                        <input type="text" id="submodel${newVehicleNumber}" name="submodel[]" class="form-control"
                            placeholder="Enter sub model" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Color</label>
                        <input type="text" id="color${newVehicleNumber}" name="vehicle_color[]" class="form-control"
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="orAttachment${newVehicleNumber}" class="form-label">Upload: Official Receipt</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="orAttachment${newVehicleNumber}"
                                    name="or_image[]"
                                    onchange="handleVehicleFileUpload(this, 'or${newVehicleNumber}', 'orFeedback${newVehicleNumber}')" required>
                                <label class="input-group-text" for="orAttachment${newVehicleNumber}">
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>
                            <div id="orFeedback${newVehicleNumber}" class="text-danger"></div>
                            <img id="or${newVehicleNumber}" src="" alt="Image or"
                                style="max-width: 200px; display: none; margin-top: 10px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="crAttachment${newVehicleNumber}" class="form-label">Upload: Certificate of Registration</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="crAttachment${newVehicleNumber}"
                                    name="cr_image[]"
                                    onchange="handleVehicleFileUpload(this, 'cr${newVehicleNumber}', 'crFeedback${newVehicleNumber}')" required>
                                <label class="input-group-text" for="crAttachment${newVehicleNumber}">
                                    <i class="fas fa-upload"></i>
                                </label>
                            </div>
                            <div id="crFeedback${newVehicleNumber}" class="text-danger"></div>
                            <img id="cr${newVehicleNumber}" src="" alt="Image cr"
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
            this.closest('.vehicle-item').remove();
            updateVehicleNumbersAndFields();
        });

        // Important: Add the new vehicle at the correct position
        const vehicleItems = document.querySelectorAll('.vehicle-item');
        if (vehicleItems.length > 0) {
            const lastVehicle = vehicleItems[vehicleItems.length - 1];
            lastVehicle.after(newVehicleDiv);
        } else {
            vehicleFieldsContainer.appendChild(newVehicleDiv);
        }

        // Initialize Select2 for the newly added vehicle
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $(`#make${newVehicleNumber}, #model${newVehicleNumber}, #vehicle_type${newVehicleNumber}`).select2({
                dropdownCssClass: "select2-dropdown",
                searchable: true
            });
        }

        // Initialize year input restrictions
        $(`#year${newVehicleNumber}`).on('keypress', function(e) {
            return /[0-9]/i.test(e.key);
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Bind AJAX events for the newly added vehicle
        bindAjaxEvents(newVehicleNumber);

        // Initialize the new vehicle
        initializeVehicle(newVehicleDiv);

        // Update vehicle numbers to ensure proper sequence
        updateVehicleNumbersAndFields();
    });
}

    // Function to update vehicle numbers and fields sequentially
    function updateVehicleNumbersAndFields() {
        const vehicleItems = document.querySelectorAll('.vehicle-item');
        vehicleItems.forEach((item, index) => {
            const vehicleNumber = index + 1;
            const vehicleNumberSpan = item.querySelector('.vehicle-number');
            if (vehicleNumberSpan) {
                vehicleNumberSpan.textContent = vehicleNumber;
            }

            // Update IDs and names of input fields
            item.querySelectorAll('input, select').forEach(field => {
                field.id = field.id.replace(/\d+/, vehicleNumber);
                if (field.name) {
                    field.name = field.name.replace(/\[\d+\]/, `[${vehicleNumber}]`);
                }
            });

            // Update labels for fields
            item.querySelectorAll('label[for]').forEach(label => {
                label.setAttribute('for', label.getAttribute('for').replace(/\d+/, vehicleNumber));
            });

            // Update event listeners for newly added fields
            bindAjaxEvents(vehicleNumber);
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

function updateVehicleSummary() {
        const tbody = $("#myTable tbody");
        tbody.empty();

        // Get all vehicle entries - both from new and renew forms
        function getVehicleDetails(element, index) {
            // For new membership form entries
            let plate        = element.find('[name="vehicle_plate[]"]').val();
            let make         = element.find('[name="vehicle_make[]"]').val();
            let model        = element.find('[name="vehicle_model[]"]').val();
            let year         = element.find('[name="vehicle_year[]"]').val();
            let color        = element.find('[name="vehicle_color[]"]').val();
            let fuel         = element.find('[name="vehicle_fuel[]"]').val();
            let transmission = element.find('[name="vehicle_transmission[]"]').val();

            // If values are empty (renew form), try getting from disabled fields
            if (!plate) plate               = element.find('[name="vehicle_plate[]"]:disabled').val();
            if (!make) make                 = element.find('[name="vehicle_make[]"]:disabled').val();
            if (!model) model               = element.find('[name="vehicle_model[]"]:disabled').val();
            if (!year) year                 = element.find('[name="vehicle_year[]"]:disabled').val();
            if (!color) color               = element.find('[name="vehicle_color[]"]:disabled').val();
            if (!fuel) fuel                 = element.find('[name="vehicle_fuel[]"]:disabled').val();
            if (!transmission) transmission = element.find('[name="vehicle_transmission[]"]:disabled').val();

            // For renew form, also check selected options in disabled selects
            if (!make) make                 = element.find('[name="vehicle_make[]"]:disabled option:selected').text();
            if (!model) model               = element.find('[name="vehicle_model[]"]:disabled option:selected').text();
            if (!fuel) fuel                 = element.find('[name="vehicle_fuel[]"]:disabled option:selected').text();
            if (!transmission) transmission = element.find('[name="vehicle_transmission[]"]:disabled option:selected').text();

            // Check if this is an existing vehicle in renew form
            const isVehicleUpdatedInput = document.getElementById(`is_vehicle_updated_${index + 1}`);
            const updateStatus = isVehicleUpdatedInput ? isVehicleUpdatedInput.value : null;
            const hasUpdateToggle = element.find('.vehicle-switch').length > 0;

            return {
                plate,
                make,
                model,
                year,
                color,
                fuel,
                transmission,
                isExistingVehicle: hasUpdateToggle,
                updateStatus: updateStatus
            };
        }

        // Process both existing and new vehicles
        $('.vehicle-item').each(function(index) {
            const vehicleData = getVehicleDetails($(this), index);

            if (vehicleData.plate || vehicleData.make) {
                tbody.append(`
                    <tr>
                        <td rowspan="3" style="text-align: center; vertical-align: middle;">
                            <h3 class="text-center">${index + 1}${nthNumber(index + 1)}</h3>
                        </td>
                        <td colspan="1"><strong>Plate No.</strong> ${vehicleData.plate || 'N/A'}</td>
                        <td><strong>Make:</strong> ${vehicleData.make || 'N/A'}</td>
                        <td><strong>Model:</strong> ${vehicleData.model || 'N/A'}</td>
                    </tr>
                    <tr>
                        <td><strong>Year:</strong> ${vehicleData.year || 'N/A'}</td>
                        <td><strong>Color:</strong> ${vehicleData.color || 'N/A'}</td>
                        <td><strong>Fuel:</strong> ${vehicleData.fuel || 'N/A'}</td>
                    </tr>
                    <tr>
                        <td><strong>Transmission: </strong>${vehicleData.transmission || 'N/A'}</td>
                        ${vehicleData.isExistingVehicle ?
                            `<td colspan="2"><strong>Update Vehicle: </strong>${vehicleData.updateStatus === '1' ? 'YES' : 'NO'}</td>`
                            : '<td colspan="2"></td>'
                        }
                    </tr>
                `);
            }
        });
    }

    // Helper function for ordinal numbers (unchanged)
    function nthNumber(number) {
        if (number > 3 && number < 21) return 'th';
        switch (number % 10) {
            case 1: return "st";
            case 2: return "nd";
            case 3: return "rd";
            default: return "th";
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Update summary when any input/select changes
        $(document).on('change', '.vehicle-item input, .vehicle-item select', function() {
            updateVehicleSummary();
        });

        // Update when vehicle information toggle changes (for renew form)
        $(document).on('change', '[id^=updateVehicle_]', function() {
            setTimeout(updateVehicleSummary, 100);
        });

        // Update summary when a vehicle is added
        $('#addVehicle').on('click', function() {
            setTimeout(updateVehicleSummary, 100);
        });

        // Update summary when a vehicle is removed
        $(document).on('click', '.remove-vehicle', function() {
            setTimeout(updateVehicleSummary, 100);
        });

        // Monitor changes to the vehicle update switches in renew form
        $(document).on('change', '.vehicle-switch', function() {
            setTimeout(updateVehicleSummary, 100);
        });

        // Initial summary update
        updateVehicleSummary();
    });
</script>
