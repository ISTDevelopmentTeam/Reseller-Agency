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
    <link rel="stylesheet" href={{ asset('style/audit_trail.css') }}>
</head>
<body>
@include("layout.sidebar");
@include("layout.nav");

                <!-- Main content with updated date inputs -->
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-md-10">
                        <div class="container mt-5">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="container py-4">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </span>
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-search"></i>
                                                        </span>
                                                        <input type="text" class="form-control" placeholder="Search...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <button class="btn btn-primary">
                                                <i class="fas fa-download me-1"></i> Export
                                            </button>
                                        </div>
                                    </div>
                    
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Timestamp</th>
                                                    <th>User</th>
                                                    <th>Action</th>
                                                    <th>Module</th>
                                                    <th>Record ID</th>
                                                    <th>IP Address</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2024-10-28 09:45:23</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="User">
                                                            John Doe
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-success">INSERT</span></td>
                                                    <td>Products</td>
                                                    <td>#PRD001</td>
                                                    <td>192.168.1.100</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                            View Changes
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2024-10-28 09:30:15</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="User">
                                                            Jane Smith
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-warning">UPDATE</span></td>
                                                    <td>Users</td>
                                                    <td>#USR002</td>
                                                    <td>192.168.1.101</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                            View Changes
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2024-10-28 09:15:45</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="User">
                                                            Mike Johnson
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-danger">DELETE</span></td>
                                                    <td>Orders</td>
                                                    <td>#ORD003</td>
                                                    <td>192.168.1.102</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                            View Changes
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="text-muted">
                                            Showing 1 to 3 of 150 entries
                                        </div>
                                        <nav>
                                            <ul class="pagination mb-0">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Details Modal -->
                            <div class="modal fade" id="detailsModal" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Field</th>
                                                            <th>Old Value</th>
                                                            <th>New Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>Product A</td>
                                                            <td>Product B</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>$99.99</td>
                                                            <td>$149.99</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Stock</td>
                                                            <td>50</td>
                                                            <td>100</td>
                                                        </tr>
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
    <script src="/script/sidebar.js"></script>
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