<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Admin <sup>:3</sup></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Manajemen Data
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/customer') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pembeli</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/seller') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelapak</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/product') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Produk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/category') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Kategori</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/rekening') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Rekening</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.data.deposit') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Permintaan Deposit</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.data.withdraw') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Permintaan Withdraw</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.history.deposit') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Riwayat Deposit</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.history.withdraw') }}">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Riwayat Withdraw</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/data/account') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola Admin</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>