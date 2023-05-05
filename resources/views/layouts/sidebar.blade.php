<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="#" class="navbar-brand mx-4 mb-3">
            <h6 class="text-primary">
                {{-- <img src="{{ asset('img/logo-pvc.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <span class="brand-text font-weight-light">PT. PANORAMA VARIA CIPTA</span></i>
            </h6>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('index') }}" class="nav-item nav-link ">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('karyawan') }}" class="nav-item nav-link">
                <i class="fa fa-th me-2"></i>Karyawan</a>
            <a href="{{ route('pemasukan') }}" class="nav-item nav-link">
                <i class="fa fa-th me-2"></i>Pemasukkan</a>
            <a href="{{ route('pengeluaran') }}" class="nav-item nav-link">
                <i class="fa fa-keyboard me-2"></i>Pengeluaran</a>
            <a href="{{ route('jenis.pengeluaran') }}" class="nav-item nav-link">
                <i class="fa fa-keyboard me-2"></i>Jenis Pengeluaran</a>
            <a href="{{ route('penggajian') }}" class="nav-item nav-link">
                <i class="fa fa-table me-2"></i>Penggajian</a>
            <a href="{{ route('penjab') }}" class="nav-item nav-link">
                <i class="fa fa-chart-bar me-2"></i>PenJab</a>
            <a href="{{ route('posisi') }}" class="nav-item nav-link">
                <i class="fa fa-chart-bar me-2"></i>Posisi</a>
            <a href="{{ route('distributor') }}" class="nav-item nav-link">
                <i class="fa fa-chart-bar me-2"></i>Distributor</a>
            <a href="{{ route('role') }}" class="nav-item nav-link">
                <i class="far fa-file-alt me-2"></i>Role</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->