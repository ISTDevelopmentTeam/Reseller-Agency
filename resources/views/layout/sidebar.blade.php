 <!-- Sidebar -->
 <div class="col-auto px-0 sidebar">
                <!-- Sidebar content remains the same -->
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-1 mt-md-3 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 fw-bolder">Reseller Portal</span>
                        <img src="images/aap_logo_white.png" alt="AAP LOGO" class="ms-3" style="width: 40px; height: 30px;">
                    </a>                    
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100">
                        <li class="w-100">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-list me-2"></i>
                                <span class="ms-1">Application List</span>
                            </a>
                            <!-- Sub-menu for New and Renew under Application List -->
                            <ul class="nav flex-column ms-4">
                                <li class="w-100">
                                    <a href="{{ route('new_reseller') }}" class="nav-link {{ Request::routeIs('new_reseller') ? 'active' : '' }}">
                                        <i class="fas fa-plus me-2"></i>
                                        <span class="ms-1">New</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="{{ route('renew_reseller') }}" class="nav-link {{ Request::routeIs('renew_reseller') ? 'active' : '' }}">
                                        <i class="fas fa-sync-alt me-2"></i>
                                        <span class="ms-1">Renew</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="w-100">
                            <a href="{{ route('report_reseller') }}" class="nav-link {{ Request::routeIs('report_reseller') ? 'active' : '' }}">
                                <i class="fas fa-chart-bar me-2"></i>
                                <span class="ms-1">Report</span>
                            </a>
                        </li>
                        <li class="w-100">
                            <a href="{{ route('audit_trail') }}" class="nav-link {{ Request::routeIs('audit_trail') ? 'active' : '' }}">
                                <i class="fas fa-book me-2"></i>
                                <span class="ms-1">Audit Trail</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>