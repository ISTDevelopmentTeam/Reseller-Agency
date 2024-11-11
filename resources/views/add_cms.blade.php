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

<form action="{{ route('cms.add') }}" method="POST">
 @csrf <!-- CSRF token for security -->


    <h3 class="mb-4 text-primary text-center">Add Membership</h3>

    <!-- Type of Membership -->
    <div class="mb-3">
        <label for="add_type_of_membership" class="form-label fw-bold">Type of Membership</label>
        <select name="add_type_of_membership" id="add_type_of_membership" class="form-select shadow-sm">

            @foreach($membership_plantype AS $type_of_membership)

            <option value="{{$type_of_membership->membership_id}}">{{$type_of_membership->membership_name}}</option>

            @endforeach

        </select>
    </div>

    <!-- Plan Type -->
    <div class="mb-3">
        <label for="add_plan_type" class="form-label fw-bold">Plan Type</label>
        <select name="add_plan_type" id="add_plan_type" class="form-select shadow-sm">

            <option value="">Select a Plan Type</option>
            

        </select>
    </div>

    <!-- Amount -->
    <div class="mb-3">
        <label for="add_amount" class="form-label fw-bold">Amount</label>
        <div class="input-group shadow-sm">
            <span class="input-group-text" id="basic-addon1">₱</span>
            <input type="number" class="form-control" name="add_amount" id="add_amount" placeholder="Enter amount">
        </div>
    </div>

    <!-- Remarks -->
    <div class="mb-3">
        <label for="edit_remarks" class="form-label fw-bold">Remarks</label>
        <textarea class="form-control" name="add_remarks" id="add_remarks" rows="4" placeholder="Enter remarks here"></textarea>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label for="add_status" class="form-label fw-bold">Status</label>
        <select name="add_status" id="add_status" class="form-select shadow-sm">

            <option value="ACTIVE">ACTIVE</option>
            <option value="INACTIVE">INACTIVE</option>

        </select>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Add Data</button>
        <button type="button" class="btn btn-secondary px-4 py-2 ms-2 shadow-sm" data-bs-dismiss="modal">Go Back</button>
    </div>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data for all membership plans and types, passed from the Blade view
        const subOptions = @json($membership_plans_and_types); // Ensure $membership_plans_and_types is structured properly in the controller

        // Function to update the second dropdown based on the first dropdown selection
        function updateSecondDropdown() {
            const firstOptionValue = document.getElementById('add_type_of_membership').value;
            const secondDropdown = document.getElementById('add_plan_type');

            // Clear the second dropdown
            secondDropdown.innerHTML = '<option value="">Select a Plan Type</option>';

            // If a valid first option is selected
            if (firstOptionValue) {
                // Filter the subOptions based on the first dropdown value (parent_id)
                const filteredOptions = subOptions.filter(option => option.membership_id == firstOptionValue);

                // Populate the second dropdown with the filtered options
                filteredOptions.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.plan_name; // The ID of the plan
                    optionElement.textContent = option.plan_name; // The name of the plan
                    secondDropdown.appendChild(optionElement);
                });
            }
        }

        // Listen for changes on the first dropdown and update the second dropdown
        document.getElementById('add_type_of_membership').addEventListener('change', updateSecondDropdown);
    });
</script>


</html>
</body>