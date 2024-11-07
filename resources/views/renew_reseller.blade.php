<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #002B5B;
            width: 16rem;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            margin: 0.2rem 0;
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .stat-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            background-color: #FFB800;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .user-profile {
            cursor: pointer;
        }
        .dropdown-menu {
            min-width: 200px;
            padding: 8px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .dropdown-item {
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.2s ease;
            color: #333;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
            color: #0d6efd;
        }
        .dropdown-item:active {
            background-color: #e9ecef;
            color: #0d6efd;
        }
        .dropdown-divider {
            margin: 8px 0;
        }
        .dropdown-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        .renewal-form {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .renewal-form.show {
            display: block;
            opacity: 1;
        }
        .modal-blur {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
        }

        .search-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
        }
        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #dee2e6;
        }
        .divider::before {
            left: 0;
        }
        .divider::after {
            right: 0;
        }
        .divider span {
            background-color: white;
            padding: 0 1rem;
            color: #0d6efd;
            font-weight: bold;
        }
        .search-btn {
            min-width: 120px;
        }
        .table-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .table thead {
            background-color: #0d6efd;
            color: white;
        }
        .status-new {
            color: #dc3545;
            font-weight: bold;
        }
        .btn-renew {
            min-width: 100px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layout/sidebar')

            <!-- Main Content -->
            <div class="col main-content p-4">
                @include('layout/nav')
                
                <!-- Profile Modal -->
                @include('layout/profile')

                <div class="row justify-content-center mt-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">
                            <div class="search-card">
                                <h2 class="text-center mb-4">Search Membership Record</h2>
                                
                                <!-- PIN Search -->
                                <div class="mb-4">
                                    <label class="form-label">Pincode</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter PIN code">
                                    </div>
                                </div>
            
                                <div class="divider">
                                    <span>OR</span>
                                </div>
            
                                <!-- Name Search -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" placeholder="Enter last name">
                                        </div>
                                    </div>
                                </div>
            
                                <!-- Birth Date -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label">Birth Month</label>
                                        <select class="form-select">
                                            <option value="">Select birth month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <!-- Add all months -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Birth Day</label>
                                        <select class="form-select">
                                            <option value="">Select birth day</option>
                                            <!-- JavaScript will populate days -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Birth Year</label>
                                        <input type="number" class="form-control" placeholder="Enter birth year">
                                    </div>
                                </div>
            
                                <div class="text-center">
                                    <button class="btn btn-primary search-btn" type="button">
                                        <i class="fas fa-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
            
                            <!-- Results Table -->
                            <div class="table-container mt-4">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Record No.</th>
                                            <th>Vehicle</th>
                                            <th>Membership Category</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Activation Date</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>SDS512 - HONDA CIVIC</td>
                                            <td>PIDP</td>
                                            <td>GAVANES</td>
                                            <td>ANALYN MAE</td>
                                            <td>2024-09-26</td>
                                            <td>2025-09-26</td>
                                            <td><span class="status-new">NEW MEMBER</span></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm btn-renew">
                                                    <i class="fas fa-sync-alt me-1"></i>Renew
                                                </button>
                                            </td>
                                        </tr>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBtn = document.getElementById('searchBtn');
            const resetBtn = document.getElementById('resetBtn');
            const renewalForm = document.getElementById('renewalForm');

            // Show form when search button is clicked
            searchBtn.addEventListener('click', function() {
                renewalForm.classList.add('show');
            });

            // Hide form when reset button is clicked
            resetBtn.addEventListener('click', function() {
                renewalForm.classList.remove('show');
                // Clear all input fields
                document.querySelectorAll('input, select, textarea').forEach(element => {
                    element.value = '';
                });
            });
        });
    </script>
</body>
</html>