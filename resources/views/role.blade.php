@extends('layouts.base',['title' => "$title - Admin"])

<!-- Start wrapper-->

@section('content') 
<!-- Spinner Start -->

<div
    id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div
        class="spinner-border text-primary"
        style="width: 3rem; height: 3rem;"
        role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('layouts.header')
    <!-- Navbar End -->
    <div class="card-body">

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data {{ $title }}</h6>
                <div class="table-responsive">
                   <table class="table">
                        <button type="button" class="btn btn-success m-2">
                            <i class="fa fa-plus me-2"></i>Tambah Role</button>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $index => $r )

                      <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $r->role }}</td>
                                <td width="15%">
                                    <button type="button" class="btn btn-square btn-danger m-1">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-square btn-secondary m-1">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Content End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
</div>

@endsection
<!--End wrapper-->
<script>
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})
</script>