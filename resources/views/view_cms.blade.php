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

    <center><h2 class="mt-4">{{$data['membership_name']}}</h2></center>

<div class="container mt-4">
    <div class="row">
        <!-- Left Column: Form Fields -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="view_type_of_membership" class="form-label">Type of Membership</label>
                <input type="text" class="form-control" value={{$data['membership_name']}} disabled>
            </div>
            <div class="mb-3">
                <label for="view_plan_Type" class="form-label">Plan Type</label>
                <input type="text" class="form-control" value={{$data['plan_name']}} disabled>
            </div>
            <div class="mb-3">
                <label for="view_amount" class="form-label">Amount</label>
                <input type="text" class="form-control" value={{$data['plan_amount']}} disabled>
            </div>
            <div class="mb-3">
                <label for="view_remarks" class="form-label">Remarks</label>
                <textarea class="form-control" rows="4" disabled>{{ $data['remarks'] }}</textarea>
            </div>
            <div class="mb-3">
                <label for="view_status" class="form-label">Status</label>
                <input type="text" class="form-control" value={{$data['plan_status']}} disabled>
            </div>
        </div>

        <!-- Right Column: Discounted Rate Section -->
        
            <div class="col-md-6">
            <div class="text-center mb-3"><strong>DISCOUNTED RATE</strong></div>
            <form action="{{ route('cms.discountLog', ['id' => $data['plan_id']]) }}" method="POST" class="p-4 shadow-lg rounded bg-light border border-muted">
            @csrf 

            <div class="mb-3">
                <label for="amount_discount" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount_discount">
            </div>
            <div class="mb-3">
                <label for="start_discount" class="form-label">Date Start</label>
                <input type="date" class="form-control" name="start_discount">
            </div>
            <div class="mb-3">
                <label for="end_discount" class="form-label">Date End</label>
                <input type="date" class="form-control" name="end_discount">
            </div>
            <center><button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">Add Discount</button></center>
        </center>
    </form>

        </div>
    </div>
    <!-- Discount Logs Table (Below Form and Discounted Rate Sections) -->
    <center><h2 class="mt-4">Discount Logs</h2></center>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Discounted Amount</th>
                <th>Date Start</th>
                <th>Date End</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample static data rows (replace with dynamic data as needed) -->
            <tr>
                @foreach($discount_logs as $discount_details);
                <td>{{ $discount_details->discount_amount }}</td>
                <td>{{ \Carbon\Carbon::parse($discount_details->discount_start)->format('F j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($discount_details->discount_end)->format('F j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($discount_details->added_when)->format('F j, Y') }}</td>
            </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>


</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
