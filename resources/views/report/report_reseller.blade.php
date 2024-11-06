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
    <style>
        /* Previous styles remain the same */
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

        input[type="date"] {
            height: 38px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            background-color: transparent;
            padding: 0.375rem 0.75rem;
            cursor: pointer;
        }

        .modal-blur {
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <!-- Sidebar and header remain the same -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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