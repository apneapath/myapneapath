<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/myapneapath-favicon.png') }}" width="30rem">
        </div>
        <div class="sidebar-brand-text mx-3">MyApneaPath</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('backoffice') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/backoffice') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">



    <!--Using the @ role Blade Directive (Preferred Method with Spatie/Permission Package)-->
    {{-- @if (auth()->user()->hasRole('Super Admin'))
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endif --}}

    <!--Or, you can use @ role and @ endrole:-->
    {{-- @role('Super Admin')
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endrole --}}

    <!--Manually Checking Roles Using hasRole() Method-->
    {{-- @if (auth()->user()->hasRole('Super Admin'))
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endif --}}

    <!--Using Multiple Roles-->
    {{-- @if (auth()->user()->hasRole(['Super Admin', 'Admin']))
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endif --}}

    <!--Checking User Permissions-->
    {{-- @if (auth()->user()->can('create posts'))
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endif --}}

    <!--Combining Roles and Permissions-->
    {{-- @if (auth()->user()->hasRole('Super Admin') && auth()->user()->can('create posts'))
        <a href="/add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    @endif --}}


    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Administrator'))
        <!-- Heading -->
        <div class="sidebar-heading">Administrator</div>

        <!-- Nav Item - Referral Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fa-solid fa-gear"></i>
                <span>Admin</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('users-list') ? 'active' : '' }}"
                        href="{{ url('/users-list') }}">Users</a>
                    @if (auth()->user()->hasRole('Super Admin'))
                        <a class="collapse-item {{ request()->is('roles-list') ? 'active' : '' }}"
                            href="{{ url('/roles-list') }}">Roles</a>
                        <a class="collapse-item {{ request()->is('activity-logs') ? 'active' : '' }}"
                            href="{{ url('/activity-logs') }}">Activity Logs</a>
                    @endif
                </div>
            </div>
        </li>
    @endif




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Patient -->
    <li class="nav-item {{ request()->is('patients-list') ? 'active' : '' }}">
        <a href="{{ url('/patients-list') }}" class="nav-link">
            <i class="fa-solid fa-hospital-user"></i>
            <span>Patients</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Doctor -->
    <li class="nav-item {{ request()->is('providers-list') ? 'active' : '' }}">
        <a href="{{ url('/providers-list') }}" class="nav-link">
            <i class="fa-solid fa-user-doctor"></i>
            <span>Providers</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Referral Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <span>Referrals</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('referrals-list') ? 'active' : '' }}"
                    href="{{ url('/referrals-list') }}">Referral</a>
                <a class="collapse-item {{ request()->is('referral-types-list') ? 'active' : '' }}"
                    href="{{ url('/referral-types-list') }}">Referral Types</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Specialties -->
    <li class="nav-item {{ request()->is('specialties-list') ? 'active' : '' }}">
        <a href="{{ url('/specialties-list') }}" class="nav-link">
            <i class="fa-solid fa-bookmark"></i>
            <span>Specialties</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Facilities -->
    <li class="nav-item {{ request()->is('facilities-list') ? 'active' : '' }}">
        <a href="{{ url('/facilities-list') }}" class="nav-link">
            <i class="fa-solid fa-house-medical"></i>
            <span>Facilities</span>
        </a>
    </li>

    {{-- <!-- Heading -->
    <div class="sidebar-heading">TRANSACTIONS</div> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-folder-plus"></i>
            <span>Records</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('medical-records-list') ? 'active' : '' }}"
                    href="{{ url('/medical-records-list') }}">Medical Records</a>
                <a class="collapse-item {{ request()->is('attachments-list') ? 'active' : '' }}"
                    href="{{ url('/attachments-list') }}">Attachments</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Appointments -->
    <li class="nav-item {{ request()->is('appointments-list') ? 'active' : '' }}">
        <a href="{{ url('/appointments-list') }}" class="nav-link">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Appointments</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
