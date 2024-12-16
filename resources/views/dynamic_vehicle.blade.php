<script>
document.addEventListener('DOMContentLoaded', function() {
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
            console.log('Max vehicles allowed:', maxVehicles);
        }
    }

    // Initialize maxVehicles on page load
    updateMaxVehicles();

    if (membershipTypeSelect) {
        membershipTypeSelect.addEventListener('change', function() {
            updateMaxVehicles();
            vehicleCount = 2; // Reset vehicle count to start with the second vehicle
        });
    }

    if (addButton && vehicleFieldsContainer) {
        addButton.addEventListener('click', function() {
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
                        <input type="text" name="vehicle_plate[]" class="form-control" placeholder="Enter plate number">
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
                        <input type="number" id="year${vehicleCount}" name="vehicle_year[]" class="form-control"
                            placeholder="Enter year">
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
                <button type="button" class="btn btn-danger mt-3 remove-vehicle">
                    <i class="bi bi-trash me-2"></i>Remove Vehicle
                </button>
            `;

            // Add event listener to remove button
            newVehicleDiv.querySelector('.remove-vehicle').addEventListener('click', function() {
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
        $(`#make${vehicleNumber}`).on("change", function() {
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
                success: function(response) {
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
        $(`#model${vehicleNumber}`).on("change", function() {
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
                success: function(response) {
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
            source: function(request, response) {
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
                    success: function(data) {
                        response(data);
                    }
                });
            },
            focus: function(event, ui) {
                $(`#year${vehicleNumber}`).val(ui.item.year);
                return false;
            },
            select: function(event, ui) {
                $(`#year${vehicleNumber}`).val(ui.item.year);
                return false;
            }
        })
        .bind("focus", function() {
            $(this).autocomplete("search");
        });

        // Submodel autocomplete
        $(`#submodel${vehicleNumber}`)
        .autocomplete({
            minLength: 0,
            source: function(request, response) {
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
                    success: function(data) {
                        response(data);
                    }
                });
            },
            focus: function(event, ui) {
                $(`#submodel${vehicleNumber}`).val(ui.item.submodel_name);
                $("#car_details_btn").prop("disabled", false);
                return false;
            },
            select: function(event, ui) {
                $(`#submodel${vehicleNumber}`).val(ui.item.submodel_name);
                $(`#amount`).val(ui.item.amount);
                return false;
            }
        })
        .bind("focus", function() {
            $(this).autocomplete("search");
        });

        // Autocomplete render methods
        $(`#year${vehicleNumber}, #submodel${vehicleNumber}`).each(function() {
            $(this).data("ui-autocomplete")._renderMenu = function(ul, items) {
                var that = this;
                ul.addClass("custom-menu");
                $.each(items, function(index, item) {
                    that._renderItemData(ul, item);
                });
            };

            $(this).data("ui-autocomplete")._renderItem = function(ul, item) {
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
</script>
