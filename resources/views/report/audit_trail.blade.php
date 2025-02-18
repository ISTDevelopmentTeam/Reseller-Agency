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
                <div class="container-fluid py-4">
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Commission Report</h2>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary" onclick="resetFilters()">
                                <i class="fas fa-redo-alt me-1"></i> Reset
                            </button>
                            <button class="btn btn-primary" onclick="exportToExcel()">
                                <i class="fas fa-file-excel me-1"></i> Export
                            </button>
                        </div>
                    </div>
            
                    <!-- Filter Panel -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Date Range -->
                                <div class="col-md-4">
                                    <label class="form-label text-muted small">Date Range</label>
                                    <div class="input-group">
                                        <input type="date" id="startDate" class="form-control">
                                        <span class="input-group-text bg-light">to</span>
                                        <input type="date" id="endDate" class="form-control">
                                    </div>
                                </div>
                                
                                <!-- Type Filter -->
                                <div class="col-md-2">
                                    <label class="form-label text-muted small">Type</label>
                                    <select id="typeFilter" class="form-select" onchange="applyFilters()">
                                        <option value="">All Types</option>
                                        <option value="new">New Client</option>
                                        <option value="renewal">Renewal</option>
                                    </select>
                                </div>
                                
                                <!-- Agent Filter -->
                                <div class="col-md-3">
                                    <label class="form-label text-muted small">Agent</label>
                                    <select id="agentFilter" class="form-select" onchange="applyFilters()">
                                        <option value="">All Agents</option>
                                        <option value="1">John Doe</option>
                                        <option value="2">Jane Smith</option>
                                        <option value="3">Mike Johnson</option>
                                    </select>
                                </div>
                                
                                <!-- Search -->
                                <div class="col-md-3">
                                    <label class="form-label text-muted small">Search</label>
                                    <div class="input-group">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search..." oninput="applyFilters()">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Summary Cards -->
                    <div class="row mb-4 g-3">
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 bg-primary bg-gradient text-white">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 opacity-75">Total Commission</h6>
                                    <h3 class="card-title mb-0">₱75,000.00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 bg-success bg-gradient text-white">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 opacity-75">New Clients</h6>
                                    <h3 class="card-title mb-0">₱45,000.00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 bg-warning bg-gradient text-white">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 opacity-75">Renewals</h6>
                                    <h3 class="card-title mb-0">₱30,000.00</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 bg-info bg-gradient text-white">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 opacity-75">Total Transactions</h6>
                                    <h3 class="card-title mb-0">15</h3>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Commission Table -->
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="commissionsTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-4">Date</th>
                                            <th>Agent</th>
                                            <th>Client</th>
                                            <th>Type</th>
                                            <th class="text-end">Amount</th>
                                            <th class="text-end">Commission</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-4">2024-02-18</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="/api/placeholder/32/32" class="rounded-circle me-2" width="32" height="32" alt="">
                                                    <div>
                                                        <div class="fw-medium">John Doe</div>
                                                        <div class="small text-muted">ID: A001</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>ABC Company</td>
                                            <td><span class="badge bg-success-subtle text-success">New Client</span></td>
                                            <td class="text-end">₱25,000.00</td>
                                            <td class="text-end">₱2,500.00</td>
                                            <td class="text-center"><span class="badge bg-success">Paid</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary" onclick="viewDetails(1)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4">2024-02-17</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="/api/placeholder/32/32" class="rounded-circle me-2" width="32" height="32" alt="">
                                                    <div>
                                                        <div class="fw-medium">Jane Smith</div>
                                                        <div class="small text-muted">ID: A002</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>XYZ Corporation</td>
                                            <td><span class="badge bg-warning-subtle text-warning">Renewal</span></td>
                                            <td class="text-end">₱15,000.00</td>
                                            <td class="text-end">₱1,500.00</td>
                                            <td class="text-center"><span class="badge bg-warning">Pending</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary" onclick="viewDetails(2)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">Showing 1 to 2 of 2 entries</div>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Details Modal -->
                <div class="modal fade" id="detailsModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Commission Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="detailsTable">
                                        <!-- Details will be populated by JavaScript -->
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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