 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}<img src="{{ asset('img/myapneapath-favicon.png') }}" width="30rem">
        </div>
        <div class="sidebar-brand-text mx-3">MyApneaPath</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/backoffice') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

     <!-- Nav Item - Patient -->
     <li class="nav-item">
        <a href="{{ url('/patients-list') }}" class="nav-link">
            <i class="fa-solid fa-hospital-user"></i>
            <span>Patients</span></a>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Doctor -->
     <li class="nav-item">
        <a href="{{ url('/doctors-list') }}" class="nav-link">
            <i class="fa-solid fa-user-doctor"></i>
            <span>Doctors</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Specialties -->
    <li class="nav-item">
       <a href="{{ url('/specialties-list') }}" class="nav-link">
            <i class="fa-solid fa-bookmark"></i>
            <span>Specialties</span></a>
   </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Facilities -->
    <li class="nav-item">
       <a href="{{ url('/facilities-list') }}" class="nav-link">
            <i class="fa-solid fa-house-medical"></i>
            <span>Facilities</span></a>
   </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        TRANSACTIONS
    </div>

    <!-- Nav Item - Referral Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <span>Referrals</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{ url('/referrals-list') }}">Referrals</a>
                <a class="collapse-item" href="{{ url('/referral-types-list') }}">Referral Types</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-folder-plus"></i>
            <span>Records</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                <a class="collapse-item" href="{{ url('/medical-records-list') }}">Medical Records</a>
                <a class="collapse-item" href="{{ url('/attachments-list') }}">Attachments</a>
            </div>
        </div>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Facilities -->
     <li class="nav-item">
        <a href="{{ url('/appointments-list') }}" class="nav-link">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Appoinments</span></a>
    </li>
  
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('img/backoffice/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
<!-- End of Sidebar -->