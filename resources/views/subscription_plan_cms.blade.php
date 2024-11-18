<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

@include("includes.header");

  


<div class="container-fluid px-4">
    <div class="card shadow mt-4 mb-4">
        <div class="card-header bg-primary bg-gradient d-flex justify-content-between align-items-center py-3">
            <h5 class="m-0 font-weight-bold text-white">
                <i class="fas fa-id-badge me-2"></i>Edit Membership
            </h5>
        </div>
        <div class="card-body">
            <!-- Search and Filter Section -->
            <div class="row mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search Membership Plan">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <select class="form-select">
                        <option value="">Filter by Status</option>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-4">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMembershipModal">
                        <i class="fa fa-plus"></i> Add Type of Membership
                    </button>

                    {{-- <a href="{{ route('add_cms_page') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle me-2"></i>Add Type of Membership
                    </a> --}}
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-custom">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Type of Membership</th>
                            <th class="text-center">Plan Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
<!-- Table Body -->
<tbody>
    @foreach($details as $detail)
    <tr>
        <td>{{ $detail->membership_name }}</td>
        <td>{{ $detail->plan_name }}</td>
        <td class="text-center">{{ $detail->plan_amount }}</td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                <span class="badge bg-{{ $detail->plan_status == 'ACTIVE' ? 'success' : 'danger' }} rounded-pill px-3">
                    {{ $detail->plan_status }}
                </span>
            </div>
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $detail->plan_id }}">
                    <i class="fas fa-pencil me-2"></i>Edit
                </button>
            </div>
        </td>
    </tr>

    <!-- Edit Modal for each row -->
    <div class="modal fade" id="editModal{{ $detail->plan_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $detail->plan_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('update_plan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="membership_id" value="{{ $detail->membership_id }}">
                    <input type="hidden" name="plan_id" value="{{ $detail->plan_id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $detail->plan_id }}">Edit Plan Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="membership_name" class="form-label">Membership Name</label>
                            {{-- <input type="text" class="form-control" id="membership_name" name="membership_name" value="{{ $detail->membership_name }}"> --}}

                            <select id="cars" name="edit_membership_name" class="form-control">
                                @foreach($membership_plantype as $membership_info)
                                    <option value="{{ $membership_info->membership_name }}" 
                                            @if($membership_info->membership_id == $detail->membership_id) selected @endif>
                                        {{ $membership_info->membership_name }}
                                    </option>
                                @endforeach
                            </select>
                    
                        </div>

                        <div class="mb-3">
                            <label for="plan_name" class="form-label">Plan Name</label>
                            {{-- <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{ $detail->plan_name }}"> --}}

                            <select id="plan" name="edit_membership_plantype" class="form-control">
                                @foreach($details as $plan)
                                    <option value="{{ $plan->plan_id }}" 
                                            @if($plan->plan_id == $detail->plan_id) selected @endif>
                                        {{ $plan->plan_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="plan_amount" class="form-label">Plan Amount</label>
                            <input type="number" class="form-control" id="edit_plan_amount" name="edit_plan_amount" value="{{ $detail->plan_amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="edit_remarks">{{ $detail->remarks }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="plan_status" class="form-label">Status</label>
                            <select class="form-select" id="plan_status" name="edit_plan_status">
                                <option value="ACTIVE" {{ $detail->plan_status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                <option value="INACTIVE" {{ $detail->plan_status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</tbody>
                </table>
            </div>

                        <!-- Pagination Section -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $details->firstItem() }} to {{ $details->lastItem() }} of {{ $details->total() }} entries
                            </div>
                            <nav aria-label="Page navigation">
                                {{ $details->links('pagination::bootstrap-4') }}
                            </nav>
                            </div>
                         </div>


<!-- Button trigger modal -->
  

<!-- Modal if Pressing To Edit Plan Type -->
<!-- <div class="modal fade edit_modal" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-landscape">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_label">Edit Plan Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ route('cms.update') }}" method="POST"> --}}
                    @csrf
                    <input type="hidden" class="form-control" name="plan_id_fetched" id="plan_id_fetched">

                    <div class="mb-3">
                        <label for="edit_type_of_membership" class="form-label">Type of Membership</label>
                        <select name="edit_type_of_membership" id="edit_type_of_membership" class="form-control">
                            @foreach($membership_plantype as $detail_option)
                                <option value="{{$detail_option->membership_name}}">{{$detail_option->membership_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_plan_type" class="form-label">Plan Type</label>
                        <select name="edit_plan_type" id="edit_plan_type" class="form-control">
                            @foreach($details as $inner_detail)
                                <option value="{{$inner_detail->plan_name}}">{{$inner_detail->plan_name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" name="edit_amount" id="edit_amount" value="{{ $detail->amount }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" name="edit_remarks" id="edit_remarks" rows="4">{{ $detail->remarks }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select name="edit_status" id="edit_status" class="form-control">
                            <option value="ACTIVE" {{ $detail->status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="INACTIVE" {{ $detail->status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirm Edit Changes</button>
            </form>

            </div>
        </div>
    </div>
</div> -->




<!-- Add Membership Modal -->
<div class="modal fade" id="addMembershipModal" tabindex="-1" aria-labelledby="addMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('add.membership') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMembershipModalLabel">Add New Membership</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="membership_name" class="form-label">Type of Membership</label>

                        <select id="cars" name="add_membership_name" class="form-control">
                            @foreach($membership_plantype as $membership_info)
                            <option value="{{$membership_info->membership_id}}">{{ $membership_info->membership_name }}</option>
                            @endforeach
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="plan_name" class="form-label">Plan Name</label>
                        <select id="cars" name="add_membership_plantype" class="form-control">
                            <option value="">Please Select Plan</option>
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="plan_amount" class="form-label">Plan Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" class="form-control" id="plan_amount" name="plan_amount" step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="plan_status" class="form-label">Status</label>
                        <select class="form-select" id="plan_status" name="plan_status" required>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Membership</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>






<script>
    function fillModalData(plan_id_fetched, edit_type_of_membership, edit_plan_type, edit_amount, edit_remarks, edit_status) {
        
        // Set the modal fields with the row data
        document.getElementById('edit_type_of_membership').value = edit_type_of_membership;
        document.getElementById('edit_plan_type').value = edit_plan_type;
        document.getElementById('edit_amount').value = edit_amount;
        document.getElementById('edit_remarks').value = edit_remarks;
        document.getElementById('edit_status').value = edit_status;
        document.getElementById('plan_id_fetched').value = plan_id_fetched;

        
        
    }

    function ViewfillModalData(plantype_id, view_subscriptionTitle, view_price, view_line1Detail, view_remarks, view_status) {

        document.getElementById('view_subscriptionTitle').value = view_subscriptionTitle;
        document.getElementById('view_price').value = view_price;
        document.getElementById('view_line1Detail').value = view_line1Detail;
        document.getElementById('view_remarks').value = view_remarks;
        document.getElementById('view_status').value = view_status;
 
    }

    

</script>



<script>
    $(document).ready(function() {

        var csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
    headers: { "X-CSRFToken": csrftoken }
});


        // Listen to changes on the 'add_membership_name' dropdown
        $('select[name="add_membership_name"]').on('change', function() {
            var membershipId = $(this).val(); // Get the selected membership_id
            if (membershipId) {
                // Send AJAX request
                $.ajax({
                    url: '/get-fetch/' + membershipId,  // URL to fetch data based on membership_id
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear and populate the 'add_membership_plantype' dropdown
                        var planSelect = $('select[name="add_membership_plantype"]');
                        planSelect.empty(); // Clear existing options
                        planSelect.append('<option value="">Please Select Plan</option>'); // Default option

                        
                        $.each(data, function(key, value) {
                            planSelect.append('<option value="' + value.plan_name    + '">' + value.plan_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching plans:", error);
                    }
                });
            } else {
                // If no membership is selected, clear the second dropdown
                $('select[name="add_membership_plantype"]').empty().append('<option value="">Please Select Plan</option>');
            }
        });




 // Listen to changes on the 'add_membership_name' dropdown
 $('select[name="edit_membership_name"]').on('change', function() {
            var membershipId = $(this).val(); // Get the selected membership_id
            if (membershipId) {
                // Send AJAX request
                $.ajax({
                    url: '/get-fetch/' + membershipId,  // URL to fetch data based on membership_id
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear and populate the 'add_membership_plantype' dropdown
                        var planSelect = $('select[name="edit_membership_plantype"]');
                        planSelect.empty(); // Clear existing options
                        planSelect.append('<option value="">Please Select Plan</option>'); // Default option

                        // Populate with new options from fetched data
                        $.each(data, function(key, value) {
                            planSelect.append('<option value="' + value.plan_name + '">' + value.plan_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching plans:", error);
                    }
                });
            } else {
                // If no membership is selected, clear the second dropdown
                $('select[name="edit_membership_plantype"]').empty().append('<option value="">Please Select Plan</option>');
            }
        });




    });
</script>
