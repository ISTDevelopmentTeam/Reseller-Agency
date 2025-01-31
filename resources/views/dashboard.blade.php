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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('style/dashboard.css') }}">
</head>

<body>
    @include("layout.sidebar")
    @include("layout.nav")

    <div class="row g-4">
        <!-- Stats Cards -->
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-muted mb-2">Today's New Reseller</h6>
                        <h2 class="mb-0">{{ $todayNewResellers }}</h2>
                    </div>
                    <div class="stat-icon users">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-muted mb-2">Monthly New Reseller</h6>
                        <h2 class="mb-0">{{ $monthlyNewResellers }}</h2>
                    </div>
                    <div class="stat-icon shield">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-12 col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-muted mb-2">Weekly Reseller Applicants</h6>
                        <h2 class="mb-0">{{ $weeklyResellers }}</h2>
                    </div>
                    <div class="stat-icon user-times">
                        <i class="fas fa-user-times text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Table Section -->
        <div class="col-12">
            <div class="custom-card">
                <div class="card-header">
                    <h4 class="mb-0">Membership List</h4>
                </div>
                <div class="table-wrapper">
                    <table id="membershipTable" class="custom-table">
                        <thead>
                            <tr>
                                <th>TRANSACTION DATE</th>
                                <th>TYPE OF MEMBERSHIP</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>TYPE OF INQUIRIES</th>
                                <th>INQUIRIES STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->application_date }}</td>
                                    <td>{{ $member->membership_type }}</td>
                                    <td>{{ $member->members_lastname }}</td>
                                    <td>{{ $member->members_firstname }}</td>
                                    <td>{{ $member->typesofapplication }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($member->status) }}">
                                            {{ $member->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('script/sidebar.js') }}"></script>
    
    <script>
        $(document).ready(function () {
        $('#membershipTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            order: [[0, 'desc']],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
</script>
    </script>
</body>
</html>