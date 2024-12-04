<div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading" style="font-weight: bold; font-size: 1.2em;">
                <img src="images/aap_logo_white.png" alt="AAP LOGO" class="ms-2" style="width: 50px; height: 40px;">
                <span class="logo-text" style="margin-right: 20px">{{ session('roles') }}</span>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i><span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-id-badge me-2"></i><span class="menu-text">Membership</span>
                </a>

                <a href="#" class="list-group-item list-group-item-action" id="formDropdown" data-bs-toggle="collapse"
                    data-bs-target="#formSubMenu" aria-expanded="false" aria-controls="formSubMenu">
                    <i class="fas fa-file-invoice me-2"></i><span class="menu-text">Form</span>
                </a>

                <div class="collapse" id="formSubMenu">
                    <a href="{{route('new_reseller.index')}}" class="list-group-item list-group-item-action submenu-item {{ Request::routeIs('new_reseller.index') ? 'active' : '' }}">
                        <i class="fas fa-plus me-2"></i><span class="menu-text">New</span>
                    </a>
                    <a href="{{route('renew_reseller')}}" class="list-group-item list-group-item-action submenu-item {{ Request::routeIs('renew_reseller') ? 'active' : '' }}">
                        <i class="fas fa-redo me-2"></i><span class="menu-text">Renew</span>
                    </a>
                </div>

                <!-- Roles Validation if whast icon to show or hide base on the user role --->
                @if(session('roles') == 'Member')
                <a href="{{route('subscription_plan_cms')}}" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i><span class="menu-text">CMS</span>
                </a>
                @endif
                <!-- End of Code --->

                <a href="{{route('audit_trail')}}" class="list-group-item list-group-item-action" {{ Request::routeIs('audit_trail') ? 'active' : '' }}>
                    <i class="fas fa-file-alt me-2"></i><span class="menu-text">Reports</span>
                </a>
                <!-- <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                    data-bs-target="#settingsModal">
                    <i class="fas fa-cogs me-2"></i><span class="menu-text">Settings</span>
                </a>
                <a href="/" class="list-group-item list-group-item-action">
                    <i class="fas fa-sign-out-alt me-2"></i><span class="menu-text">Log-out</span>
                </a> -->
            </div>
            <!-- Copyright -->
            <div class="copyright">
                Copyright ©2024 All Rights Reserved Automobile Association of Philippines
            </div>
        </div>

        