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
</head>
<body>




  


  <div class="container">

    <h2 class="mt-5">CMS</h2>
    <table class="table table-striped table-bordered table-custom">
    <a href="{{ route('add_cms_page') }}" class="btn btn-primary">Add Membership</a>
      <thead>
        <tr>
          <th>Type of Membership</th>
          <th>Plan Type</th>
          <th>Ammount</th>
          <th>Status</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
        @foreach($details as $detail)

        <tr>
          <td>{{        $detail->membership_name    }}</td>
          <td>{{        $detail->plan_name              }}</td>
          <td>{{        $detail->plan_amount            }}</td>
          <td>{{        $detail->plan_status      }}</td>
          <td>
          <a href="{{ route('edit_cms_page', [
            'membership_id'     => $detail->membership_id,
            'plan_id'           => $detail->plan_id,
            'membership_name'   => $detail->membership_name,
            'plan_name'         => $detail->plan_name,
            'plan_amount'       => $detail->plan_amount,
            'remarks'           => $detail->remarks,
            'plan_status'       => $detail->plan_status
        ]) }}" class="btn btn-primary">EDIT PLAN TYPE</a>  

        {{-- <a href="{{ route('view_cms_page', [
            'membership_id'     => $detail->membership_id,
            'plan_id'           => $detail->plan_id,
            'membership_name'   => $detail->membership_name,
            'plan_name'         => $detail->plan_name,
            'plan_amount'       => $detail->plan_amount,
            'remarks'           => $detail->remarks,
            'plan_status'       => $detail->plan_status
        ]) }}" class="btn btn-primary">VIEW PLAN TYPE</a>          --}}
        </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>


<!-- Button trigger modal -->
  

<!-- Modal if Pressing To Edit Plan Type -->
<div class="modal fade edit_modal" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>



<!-- Viewing of Plan Type Promo / Adding Discount Promo  -->

<div class="modal fade view_modal" id="view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Extra wide modal for side-by-side layout -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_label">Membership Plan Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left Column: Form Fields -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subscriptionTitle" class="form-label">Type of Membership</label>
                            <input type="text" class="form-control" id="view_type_of_membership" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Plan Type</label>
                            <input type="text" class="form-control" id="view_plan_Type" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="line1Detail" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="view_amount" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="view_remarks" rows="4" disabled></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label><br>
                            <input type="text" class="form-control" id="view_status" disabled>
                        </div>
                    </div>

                    <!-- Right Column: Discounted Rate Section -->
                    <div class="col-md-6">
                        <div class="text-center mb-3"><strong>DISCOUNTED RATE</strong></div>
                        <div class="mb-3">
                            <label for="amount_discount" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="amount_discount">
                        </div>
                        <div class="mb-3">
                            <label for="start_discount" class="form-label">Date Start:</label>
                            <input type="date" class="form-control" id="start_discount">
                        </div>
                        <div class="mb-3">
                            <label for="end_discount" class="form-label">Date End:</label>
                            <input type="date" class="form-control" id="end_discount">
                        </div>
                    </div>
                </div>

                <!-- Discount Logs Table (Below Form and Discounted Rate Sections) -->
                <div class="container mt-4">
                    <h2>Discount Logs</h2>
                    <table class="table table-striped table-bordered table-custom">
                        <thead>
                            <tr>
                                <th>Discounted Amount</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($updated as $update)
                                <tr>
                                    <td>{{ $update->discount_amount }}</td>
                                    <td>{{ \Carbon\Carbon::parse($update->discount_start)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($update->discount_end)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($update->added_when)->format('F j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





  <!-- JavaScript to fill modal with data -->
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