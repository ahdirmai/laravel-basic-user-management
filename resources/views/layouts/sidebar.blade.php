<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- 'administrator',
    'bendahara',
    'wajib pajak',
    'pemungut pajak' --}}

    {{-- role admin --}}
    @role('administrator')
    <div class="sidebar-heading">
        Administator
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    @endrole

    @role('bendahara')
    <div class="sidebar-heading">
        Bendahara
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('bendahara.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Bendahara Page</span>
        </a>
    </li>
    @endrole

    @role('wajib pajak')
    <div class="sidebar-heading">
        Wajib Pajak
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('wajib-pajak.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('wajib-pajak.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Wajib Pajak Page</span>
        </a>
    </li>
    @endrole


    @role('pemungut pajak')
    <div class="sidebar-heading">
        Pemungut Pajak
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('pemungut-pajak.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pemungut-pajak.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pemungut Pajak Page</span>
        </a>
    </li>
    @endrole


</ul>