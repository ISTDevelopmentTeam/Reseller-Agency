<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application List Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{ asset('style/dashboard.css') }}>
</head>
<body>
    <!-- Sidebar and header remain the same -->
    <div class="container-fluid">
        <div class="row">
           @include('layout/sidebar')
            <!-- Main Content -->
            <div class="col main-content p-4">
                @include('layout/nav')
                
                <!-- Profile Modal -->
                @include('layout/profile')

                <!-- Main content with updated date inputs -->
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-md-10">
                        <div class="container mt-5">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title mb-0">Reseller Applications List</h4>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center">
                                                <label class="me-2">Show</label>
                                                <select class="form-select form-select-sm" style="width: 80px;">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                <label class="ms-2">entries</label>
                                            </div>
                                            <div class="input-group" style="width: 250px;">
                                                <span class="input-group-text bg-white">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Search...">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>TRANSACTION DATE</th>
                                                    <th>REFERENCE NO.</th>
                                                    <th>TYPE OF MEMBERSHIP</th>
                                                    <th>LAST NAME</th>
                                                    <th>FIRST NAME</th>
                                                    <th>TYPE OF INQUIRIES</th>
                                                    <th>INQUIRIES STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2024-2-3</td>
                                                    <td>K-001</td>
                                                    <td>PIDP</td>
                                                    <td>CAPYBARA</td>
                                                    <td>WINNA</td>
                                                    <td>RENEW</td>
                                                    <td>
                                                        <span class="badge bg-warning">Pending</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2024-3-15</td>
                                                    <td>K-002</td>
                                                    <td>GOLD</td>
                                                    <td>DOE</td>
                                                    <td>JOHN</td>
                                                    <td>NEW</td>
                                                    <td>
                                                        <span class="badge bg-success">Approved</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2024-4-20</td>
                                                    <td>K-003</td>
                                                    <td>SILVER</td>
                                                    <td>SMITH</td>
                                                    <td>JANE</td>
                                                    <td>RENEW</td>
                                                    <td>
                                                        <span class="badge bg-danger">Rejected</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="text-muted">
                                            Showing 1 to 3 of 3 entries
                                        </div>
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination pagination-sm mb-0">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
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