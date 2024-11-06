<div class="modal fade modal-blur" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileModalLabel">Profile Settings</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="profileForm">
                                    <!-- Profile Picture Section -->
                                    <div class="text-center mb-4">
                                        <img src="images/diablo_user.jpg" alt="Profile Picture" class="rounded-circle img-fluid border border-2 border-primary mb-2" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-camera-fill"></i> Change Photo
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Profile Details -->
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" value="User Lorem">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" value="user@example.com">
                                    </div>

                                    <!-- Password Change Section -->
                                    <div class="mb-3">
                                        <h6 class="mb-3">Change Password</h6>
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
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>