<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Sidebar and header remain the same -->
    @include("includes/header")
                <!-- Main content with updated date inputs -->
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-md-10">
                        <div class="container mt-5">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h4 class="text-center mb-4">Reseller Report: Processed</h4>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <label class="form-label">Per Page:</label>
                                            <select class="form-select">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label class="form-label">From:</label>
                                            <div class="date-input-group">
                                                <input type="date" class="form-control" id="startDate">

                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label class="form-label">To:</label>
                                            <div class="date-input-group">
                                                <input type="date" class="form-control" id="endDate">

                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label class="form-label">&nbsp;</label>
                                            <button class="btn btn-primary d-block w-100">Download</button>
                                        </div>
                                    </div>
                                    
                                    <!-- Table section remains the same -->
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>APPLICATION DATE</th>
                                                    <th>PROCESS DATE</th>
                                                    <th>REFERENCE NO.</th>
                                                    <th>TYPE OF RESELLER</th>
                                                    <th>LAST NAME</th>
                                                    <th>FIRST NAME</th>
                                                    <th>TYPE OF INQUIRIES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table data will be populated here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    
                        
                                </div>
                            </div>
                            <div class="small text-muted mt-4 text-center">
                                Copyright © 2024 Automobile Association of the Philippines
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add basic date validation
        document.addEventListener('DOMContentLoaded', function() {
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');

            // Set max date to today for both inputs
            const today = new Date().toISOString().split('T')[0];
            startDate.max = today;
            endDate.max = today;

            // Ensure end date is not before start date
            startDate.addEventListener('change', function() {
                endDate.min = this.value;
            });

            // Ensure start date is not after end date
            endDate.addEventListener('change', function() {
                startDate.max = this.value;
            });
        });
    </script>
</body>
</html>