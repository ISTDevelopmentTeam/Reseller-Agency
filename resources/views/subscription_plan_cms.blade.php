<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

<style>
   
 
   #sidebar-wrapper {
    min-height: 100vh;
    width: 250px;
    margin-left: 0;
    transition: margin 0.25s ease-out, width 0.25s ease-out;
    background-color: #4040F2;
    position: fixed;
    z-index: 1000;
    height: 100%;
    padding-bottom: 60px;
}

/* Wrapper and content adjustments */
#wrapper {
    display: flex;
}

#page-content-wrapper {
    width: 100%;
    margin-left: 250px; /* Match sidebar width */
    transition: margin 0.25s ease-out;
}

/* Toggled state for sidebar (collapsed) */
#wrapper.toggled #sidebar-wrapper {
    width: 70px;
}

#wrapper.toggled #page-content-wrapper {
    margin-left: 70px;
}

/* Hide text and only show icons when the sidebar is toggled */
#wrapper.toggled .logo-text,
#wrapper.toggled .menu-text {
    display: none;
}

/* Ensure icons are always visible */
.list-group-item i {
    width: 20px;
    text-align: center;
    display: inline-block;
    font-size: 1.1rem;
    margin-right: 0.5rem;
}

/* Increase icon size when sidebar is collapsed */
#wrapper.toggled .list-group-item i {
    font-size: 1.5rem;
}

/* Hide copyright text when sidebar is collapsed */
#wrapper.toggled .copyright {
    display: none;
}

/* Show copyright text when sidebar is expanded */
#wrapper:not(.toggled) .copyright {
    display: block;
}

/* Mobile and tablet responsive styles */
@media (max-width: 768px) {
    #sidebar-wrapper {
        margin-left: 0;
        width: 250px;
    }
    
    /* Initial state - sidebar hidden on mobile */
    #wrapper:not(.toggled) #sidebar-wrapper {
        margin-left: -250px;
    }
    
    /* When toggled - sidebar shows on mobile */
    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        width: 250px;
    }
    
    /* Content adjustments for mobile */
    #page-content-wrapper {
        margin-left: 0;
        width: 100%;
    }
    
    #wrapper.toggled #page-content-wrapper {
        margin-left: 250px;
    }

    /* Keep text visible on mobile when sidebar is open */
    #wrapper.toggled .logo-text,
    #wrapper.toggled .menu-text {
        display: inline;
    }
}

@media (max-width: 425px) {
    #sidebar-wrapper {
        width: 100%; /* Full width on very small screens */
    }
    
    #wrapper.toggled #page-content-wrapper {
        margin-left: 0;
        transform: translateX(100%);
    }
}

/* Sidebar content styles */
.sidebar-heading {
    padding: 1rem;
    font-size: 1.2rem;
    color: white;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between; 
    transition: all 0.3s ease;
}

/* Center logo when sidebar is collapsed */
#wrapper.toggled .sidebar-heading {
    justify-content: center; 
}

/* Adjust logo size when sidebar is collapsed */
#wrapper.toggled .sidebar-heading img {
    width: 40px; 
    height: auto;
    margin-right: 10%;
}

/* Keep text visible when sidebar is expanded */
#wrapper:not(.toggled) .sidebar-heading img {
    width: 50px; 
}


#wrapper.toggled .logo-text {
    display: none;
}

.list-group-item {
    background-color: transparent;
    color: rgba(255, 255, 255, 0.8);
    border: none;
    padding: 0.75rem 1.25rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}

.list-group-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
}

/* Copyright section */
.copyright {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1rem;
    color: rgba(255, 255, 255, 0.6);
    font-size: 12px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.1);
}

/* Toggle button adjustments */
#sidebarToggle {
    z-index: 1001;
    position: relative;
}

/* Ensure icons are always visible */
.list-group-item i {
    width: 20px;
    text-align: center;
    display: inline-block;
}

#formSubMenu {
    background-color: rgba(0, 0, 0, 0.2);
}

#formSubMenu .submenu-item {
    padding-left: 3rem !important;
    background-color: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.8);
}

#formSubMenu .submenu-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
}

/* General sidebar styling */
#sidebar-wrapper .list-group-item {
    background-color: transparent;
    color: rgba(255, 255, 255, 0.8);
    border: none;
    padding: 0.8rem 1.25rem;
}

#sidebar-wrapper .list-group-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
}

#sidebar-wrapper .list-group-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
}
    /* Custom table styling */
    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .table-custom {
        margin-top: 0 !important;
        vertical-align: middle;
    }

    .table-custom th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .table-custom td {
        vertical-align: middle;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 1.2em;
        display: inline-block;
    }
    
    .btn-sm {
        padding: 0.25rem 1rem;
    }
    
   
    .badge.rounded-pill {
        min-width: 80px;
    }

    .btn-group .btn {
        border-radius: 0.25rem !important;
        margin: 0 0.2rem;
    }

    .pagination {
        margin-bottom: 0;
    }

    .page-link {
        padding: 0.375rem 0.75rem;
    }

    .input-group-text {
        border: 1px solid #ced4da;
        background-color: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

.navbar .dropdown-menu {
    min-width: 200px;
}

.navbar .nav-link {
    padding: 0.5rem 1rem;
}

/* Hover effect for dropdown items */
.navbar .dropdown-item:hover {
    background-color: #f8f9fa;
}

/* Transition for dropdown */
.navbar .dropdown-menu {
    transition: transform 0.2s ease-out, opacity 0.2s ease-out;
    transform-origin: top;
}

/* Profile picture hover effect */
.navbar .nav-link img {
    transition: transform 0.2s ease;
}

.navbar .nav-link:hover img {
    transform: scale(1.1);
}

  </style>
</head>
<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading" style="font-weight: bold; font-size: 1.2em;">
                <img src="images/aap_logo_white.png" alt="AAP LOGO" class="ms-2" style="width: 50px; height: 40px;">
                <span class="logo-text" style="margin-right: 20px">Reseller CMS</span>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-tachometer-alt me-2"></i><span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action active">
                    <i class="fas fa-id-badge me-2"></i><span class="menu-text">Membership</span>
                </a>
                
                <a href="#" class="list-group-item list-group-item-action" id="formDropdown" data-bs-toggle="collapse" data-bs-target="#formSubMenu" aria-expanded="false" aria-controls="formSubMenu">
                    <i class="fas fa-file-invoice me-2"></i><span class="menu-text">Form</span>
                </a>
        
                <div class="collapse" id="formSubMenu">
                    <a href="#" class="list-group-item list-group-item-action submenu-item">
                        <i class="fas fa-plus me-2"></i><span class="menu-text">New</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action submenu-item">
                        <i class="fas fa-redo me-2"></i><span class="menu-text">Renew</span>
                    </a>
                </div>
                
                
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i><span class="menu-text">Users</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-file-alt me-2"></i><span class="menu-text">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-cogs me-2"></i><span class="menu-text">Settings</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-sign-out-alt me-2"></i><span class="menu-text">Log-out</span>
                </a>
            </div>
             <!-- Copyright -->
             <div class="copyright">
                Copyright ©2024 All Rights Reserved Automobile Association of Philippines
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-dark d-flex justify-content-center align-items-center" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                                    <img src="images/diablo_user.jpg" class="rounded-circle me-2" alt="Profile Picture" style="width: 32px; height: 32px; object-fit: cover;">
                                    <span>Admin</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="px-3 py-2 text-center border-bottom">
                                        <img src="images/diablo_user.jpg" class="rounded-circle mb-2" alt="Profile Picture" style="width: 64px; height: 64px; object-fit: cover;">
                                        <p class="mb-0 fw-bold">Admin</p>
                                        <p class="text-muted small mb-2">admin@example.com</p>
                                    </div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 text-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Profile Picture">
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Change Picture</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" value="Admin">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="admin@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Theme</label>
                        <select class="form-select">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                            <option value="system">System Default</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Language</label>
                        <select class="form-select">
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notifications</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotif">
                            <label class="form-check-label" for="emailNotif">Email Notifications</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="pushNotif">
                            <label class="form-check-label" for="pushNotif">Push Notifications</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>




  


<div class="container-fluid px-4">
    <div class="card shadow mt-4 mb-4">
        <div class="card-header bg-primary bg-gradient d-flex justify-content-between align-items-center py-3">
            <h5 class="m-0 font-weight-bold text-white">
                <i class="fas fa-id-badge me-2"></i>Edit Membership
            </h5>
        </div>
        <div class="card-body">
            <!-- Search and Filter Section -->
            <div class="row mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search Membership Plan">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <select class="form-select">
                        <option value="">Filter by Status</option>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-4">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMembershipModal">
                        <i class="fa fa-plus"></i> Add Type of Membership
                    </button>

                    {{-- <a href="{{ route('add_cms_page') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle me-2"></i>Add Type of Membership
                    </a> --}}
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-custom">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Type of Membership</th>
                            <th class="text-center">Plan Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
<!-- Table Body -->
<tbody>
    @foreach($details as $detail)
    <tr>
        <td>{{ $detail->membership_name }}</td>
        <td>{{ $detail->plan_name }}</td>
        <td class="text-center">{{ $detail->plan_amount }}</td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                <span class="badge bg-{{ $detail->plan_status == 'ACTIVE' ? 'success' : 'danger' }} rounded-pill px-3">
                    {{ $detail->plan_status }}
                </span>
            </div>
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $detail->plan_id }}">
                    <i class="fas fa-pencil me-2"></i>Edit
                </button>
            </div>
        </td>
    </tr>

    <!-- Edit Modal for each row -->
    <div class="modal fade" id="editModal{{ $detail->plan_id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $detail->plan_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('update_plan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="membership_id" value="{{ $detail->membership_id }}">
                    <input type="hidden" name="plan_id" value="{{ $detail->plan_id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $detail->plan_id }}">Edit Plan Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="membership_name" class="form-label">Membership Name</label>
                            {{-- <input type="text" class="form-control" id="membership_name" name="membership_name" value="{{ $detail->membership_name }}"> --}}

                            <select id="cars" name="edit_membership_name" class="form-control">
                                @foreach($membership_plantype as $membership_info)
                                    <option value="{{ $membership_info->membership_name }}" 
                                            @if($membership_info->membership_id == $detail->membership_id) selected @endif>
                                        {{ $membership_info->membership_name }}
                                    </option>
                                @endforeach
                            </select>
                    
                        </div>

                        <div class="mb-3">
                            <label for="plan_name" class="form-label">Plan Name</label>
                            {{-- <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{ $detail->plan_name }}"> --}}

                            <select id="plan" name="edit_membership_plantype" class="form-control">
                                @foreach($details as $plan)
                                    <option value="{{ $plan->plan_id }}" 
                                            @if($plan->plan_id == $detail->plan_id) selected @endif>
                                        {{ $plan->plan_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="plan_amount" class="form-label">Plan Amount</label>
                            <input type="number" class="form-control" id="edit_plan_amount" name="edit_plan_amount" value="{{ $detail->plan_amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="edit_remarks">{{ $detail->remarks }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="plan_status" class="form-label">Status</label>
                            <select class="form-select" id="plan_status" name="edit_plan_status">
                                <option value="ACTIVE" {{ $detail->plan_status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                <option value="INACTIVE" {{ $detail->plan_status == 'INACTIVE' ? 'selected' : '' }}>INACTIVE</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</tbody>
                </table>
            </div>

                        <!-- Pagination Section -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $details->firstItem() }} to {{ $details->lastItem() }} of {{ $details->total() }} entries
                            </div>
                            <nav aria-label="Page navigation">
                                {{ $details->links('pagination::bootstrap-4') }}
                            </nav>
                            </div>
                         </div>


<!-- Button trigger modal -->
  

<!-- Modal if Pressing To Edit Plan Type -->
<!-- <div class="modal fade edit_modal" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->




<!-- Add Membership Modal -->
<div class="modal fade" id="addMembershipModal" tabindex="-1" aria-labelledby="addMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('add.membership') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMembershipModalLabel">Add New Membership</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="membership_name" class="form-label">Type of Membership</label>

                        <select id="cars" name="add_membership_name" class="form-control">
                            @foreach($membership_plantype as $membership_info)
                            <option value="{{$membership_info->membership_id}}">{{ $membership_info->membership_name }}</option>
                            @endforeach
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="plan_name" class="form-label">Plan Name</label>
                        <select id="cars" name="add_membership_plantype" class="form-control">
                            <option value="">Please Select Plan</option>
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="plan_amount" class="form-label">Plan Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="number" class="form-control" id="plan_amount" name="plan_amount" step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="plan_status" class="form-label">Status</label>
                        <select class="form-select" id="plan_status" name="plan_status" required>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Membership</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>






<script>

    //sidebar script shrink
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const wrapper = document.getElementById('wrapper');
    const toggleIcon = sidebarToggle.querySelector('i'); 
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            wrapper.classList.toggle('toggled');

            // Toggle icon based on sidebar state
            if (wrapper.classList.contains('toggled')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-arrow-right');
            } else {
                toggleIcon.classList.remove('fa-arrow-right');
                toggleIcon.classList.add('fa-bars');
            }
        });
    }
    
    // Handle resize events to reset sidebar for mobile
    function handleResize() {
        if (window.innerWidth <= 768) {
            wrapper.classList.remove('toggled');
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-bars');
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize(); 
});


//modal for profile and settings

document.addEventListener('DOMContentLoaded', function() {
    // Update the Profile link
    const profileLink = document.querySelector('.dropdown-item:nth-child(1)');
    profileLink.setAttribute('data-bs-toggle', 'modal');
    profileLink.setAttribute('data-bs-target', '#profileModal');
    
    // Update the Settings link
    const settingsLink = document.querySelector('.dropdown-item:nth-child(2)');
    settingsLink.setAttribute('data-bs-toggle', 'modal');
    settingsLink.setAttribute('data-bs-target', '#settingsModal');
});



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



<script>
    $(document).ready(function() {

        var csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
    headers: { "X-CSRFToken": csrftoken }
});


        // Listen to changes on the 'add_membership_name' dropdown
        $('select[name="add_membership_name"]').on('change', function() {
            var membershipId = $(this).val(); // Get the selected membership_id
            if (membershipId) {
                // Send AJAX request
                $.ajax({
                    url: '/get-fetch/' + membershipId,  // URL to fetch data based on membership_id
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear and populate the 'add_membership_plantype' dropdown
                        var planSelect = $('select[name="add_membership_plantype"]');
                        planSelect.empty(); // Clear existing options
                        planSelect.append('<option value="">Please Select Plan</option>'); // Default option

                        
                        $.each(data, function(key, value) {
                            planSelect.append('<option value="' + value.plan_name    + '">' + value.plan_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching plans:", error);
                    }
                });
            } else {
                // If no membership is selected, clear the second dropdown
                $('select[name="add_membership_plantype"]').empty().append('<option value="">Please Select Plan</option>');
            }
        });




 // Listen to changes on the 'add_membership_name' dropdown
 $('select[name="edit_membership_name"]').on('change', function() {
            var membershipId = $(this).val(); // Get the selected membership_id
            if (membershipId) {
                // Send AJAX request
                $.ajax({
                    url: '/get-fetch/' + membershipId,  // URL to fetch data based on membership_id
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear and populate the 'add_membership_plantype' dropdown
                        var planSelect = $('select[name="edit_membership_plantype"]');
                        planSelect.empty(); // Clear existing options
                        planSelect.append('<option value="">Please Select Plan</option>'); // Default option

                        // Populate with new options from fetched data
                        $.each(data, function(key, value) {
                            planSelect.append('<option value="' + value.plan_name + '">' + value.plan_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching plans:", error);
                    }
                });
            } else {
                // If no membership is selected, clear the second dropdown
                $('select[name="edit_membership_plantype"]').empty().append('<option value="">Please Select Plan</option>');
            }
        });




    });
</script>
