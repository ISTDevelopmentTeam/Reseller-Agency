<!-- Page Content -->
<div id="page-content-wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-dark d-flex justify-content-center align-items-center" id="sidebarToggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown"
                                    href="#" role="button" data-bs-toggle="dropdown">
                                    <img src="images/diablo_user.jpg" class="rounded-circle me-2" alt="Profile Picture"
                                        style="width: 32px; height: 32px; object-fit: cover;">
                                    <span>Admin</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="px-3 py-2 text-center border-bottom">
                                        <img src="images/diablo_user.jpg" class="rounded-circle mb-2"
                                            alt="Profile Picture" style="width: 64px; height: 64px; object-fit: cover;">
                                        <p class="mb-0 fw-bold">Admin</p>
                                        <p class="text-muted small mb-2">admin@example.com</p>
                                    </div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#profileModal">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#settingsModal">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form id="logout" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="bi bi-box-arrow-right me-2">Logout</button>
                                    </form>
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
                                    <img src="https://via.placeholder.com/100" class="rounded-circle mb-3"
                                        alt="Profile Picture">
                                    <div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Change
                                            Picture</button>
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
            