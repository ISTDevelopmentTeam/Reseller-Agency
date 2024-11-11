<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Custom table styling */
    .table-custom {
      margin-top: 20px;
    }
    .table th, .table td {
      text-align: center;
    }
    .table th {
      background-color: #f8f9fa;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f2f2f2;
    }
    .select2-container{
    z-index:100000;
    }

     /* CSS for Landscape Modal */
     .modal-landscape {
            max-width: 90%; /* Expands the modal width to 90% */
            width: 100%;
        }

        /* Optional: Adjust form controls and table widths within the modal */
        .modal-landscape .form-control,
        .modal-landscape .table-custom {
            width: 100%;
        }


  </style>

<form action="{{ route('cms.update', ['id' => $data['plan_id'], 'member_id' => $data['membership_id']]) }}" method="POST" class="p-4 shadow-lg rounded bg-light border border-muted">
    @csrf
    <input type="hidden" name="plan_id_fetched" id="plan_id_fetched">

    <h3 class="mb-4 text-primary text-center">Edit Plan Type</h3>

    <!-- Type of Membership -->
    <div class="mb-3">
        <label for="edit_type_of_membership" class="form-label fw-bold">Type of Membership</label>
        <select name="edit_type_of_membership" id="edit_type_of_membership" class="form-select shadow-sm">

            @foreach($membership_plantype as $type_of_membership)

            <option value="{{$type_of_membership->membership_id}}">{{$type_of_membership->membership_name}}</option>

            @endforeach

        </select>
    </div>

    <!-- Plan Type -->
    <div class="mb-3">
        <label for="edit_plan_type" class="form-label fw-bold">Plan Type</label>
        <select name="edit_plan_type" id="edit_plan_type" class="form-select shadow-sm">

            <option value="">Select a Plan Type</option>
            

        </select>
    </div>

    <!-- Amount -->
    <div class="mb-3">
        <label for="edit_amount" class="form-label fw-bold">Amount</label>
        <div class="input-group shadow-sm">
            <span class="input-group-text" id="basic-addon1">$</span>
            <input type="text" class="form-control" name="edit_amount" id="edit_amount" placeholder="Enter amount">
        </div>
    </div>

    <!-- Remarks -->
    <div class="mb-3">
        <label for="edit_remarks" class="form-label fw-bold">Remarks</label>
        <textarea class="form-control" name="edit_remarks" id="edit_remarks" rows="4" placeholder="Enter remarks here"></textarea>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label for="edit_status" class="form-label fw-bold">Status</label>
        <select name="edit_status" id="edit_status" class="form-select shadow-sm">

            <option value="ACTIVE" {{ $data['plan_status'] == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
            <option value="INACTIVE" {{ $data['plan_status'] == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>

        </select>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Edit Changes</button>
        <button type="button" class="btn btn-secondary px-4 py-2 ms-2 shadow-sm" data-bs-dismiss="modal">Go Back</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Access the plan_name from the array correctly using array syntax

        //Type of Membership
        const fetched_membership_name   = "{{ $data['membership_id'] }}";
        const fetched_membership_ID     = document.getElementById('edit_type_of_membership');


        // Plan Type Fetched
        const fetched_type_of_plan      = "{{ $data['plan_name'] }}";
        const fetched_type_of_plan_ID   = document.getElementById('edit_plan_type');
        
        // Amount
        const fetched_amount            = "{{ $data['plan_amount'] }}";
        const fetched_amount_ID         = document.getElementById('edit_amount');


        //Remarks
        const fetched_remarks           = "{{ $data['remarks'] }}";  
        const fetched_remarks_ID        = document.getElementById('edit_remarks');





        // Set the value of the select element to the fetched value
        fetched_membership_ID.value     = fetched_membership_name;
        fetched_type_of_plan_ID.value   = fetched_type_of_plan;
        fetched_amount_ID.value         = fetched_amount;
        fetched_remarks_ID.value        = fetched_remarks;


    });






</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data for all membership plans and types, passed from the Blade view
        const subOptions = @json($membership_plans_and_types); // Ensure $membership_plans_and_types is structured properly in the controller

        // Pre-fetched values
        const fetched_membership_id = "{{ $data['membership_id'] }}"; // Assuming you have `membership_id`
        const fetched_plan_name = "{{ $data['plan_name'] }}"; // Assuming `plan_name` is the second dropdown value

        // Set the first dropdown's value and update the second dropdown
        const firstDropdown = document.getElementById('edit_type_of_membership');
        firstDropdown.value = fetched_membership_id;

        // Function to update the second dropdown based on the first dropdown selection
        function updateSecondDropdown() {
            const firstOptionValue = firstDropdown.value;
            const secondDropdown = document.getElementById('edit_plan_type');

            // Clear the second dropdown
            secondDropdown.innerHTML = '<option value="">Select a Plan Type</option>';

            // If a valid first option is selected
            if (firstOptionValue) {
                // Filter the subOptions based on the first dropdown value (membership_id)
                const filteredOptions = subOptions.filter(option => option.membership_id == firstOptionValue);

                // Populate the second dropdown with the filtered options
                filteredOptions.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.plan_name;
                    optionElement.textContent = option.plan_name;
                    secondDropdown.appendChild(optionElement);
                });

                // Automatically select the first available option in the second dropdown
                if (filteredOptions.length > 0) {
                    secondDropdown.value = filteredOptions[0].plan_name;
                }
            }
        }

        // Call the function initially to set up the second dropdown
        updateSecondDropdown();

        // Listen for changes on the first dropdown and update the second dropdown
        firstDropdown.addEventListener('change', updateSecondDropdown);
    });
</script>









</html>
</body>