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
                    <div class="col-12 col-md-10">
                        <!-- Search Section -->
                        <div class="stat-card p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Search Applications</h5>
                                <div class="stat-icon">
                                    <i class="fas fa-search text-white"></i>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        <input type="text" class="form-control" placeholder="Business Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Owner's Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-store"></i></span>
                                        <select class="form-select">
                                            <option value="" selected>All Business Types</option>
                                            <option value="retail">Retail</option>
                                            <option value="wholesale">Wholesale</option>
                                            <option value="distribution">Distribution</option>
                                            <option value="service">Service</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-secondary me-md-2" type="button" id="resetBtn">Reset</button>
                                        <button class="btn btn-primary" type="button" id="searchBtn">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Renewal Form (Initially Hidden) -->
                        <div class="renewal-form stat-card p-4" id="renewalForm">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Renew Reseller Application Form</h5>
                                <div class="stat-icon">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label for="businessName" class="form-label">Business Name</label>
                                    <input type="text" class="form-control" id="businessName" placeholder="Enter business name" required>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="ownerName" class="form-label">Owner's Name</label>
                                        <input type="text" class="form-control" id="ownerName" placeholder="Enter owner's name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contactNumber" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="emailAddress" placeholder="Enter email address" required>
                                </div>

                                <div class="mb-3">
                                    <label for="businessAddress" class="form-label">Business Address</label>
                                    <textarea class="form-control" id="businessAddress" rows="2" placeholder="Enter complete address" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="businessType" class="form-label">Business Type</label>
                                    <select class="form-select" id="businessType" required>
                                        <option value="" selected disabled>Select business type</option>
                                        <option value="retail">Retail</option>
                                        <option value="wholesale">Wholesale</option>
                                        <option value="distribution">Distribution</option>
                                        <option value="service">Service</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                </div>
                            </form>
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