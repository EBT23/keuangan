@extends('layouts.base',['title' => "Penggajian - Admin"])
<!-- Start wrapper-->

@section('content')
<!-- Spinner Start -->

<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
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
               
                <h4 class="card-title">FORM TAMBAH PENGATURAN GAJI</h4>
                <hr>
                <form action="{{ route('tambah_pengaturan_gaji') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="nama_karyawan">Nama Karyawan</label>
                                <select class="form-control" id="nama_karyawan" name="nama_karyawan">
                                    <option value="" selected disabled>Pilih Karyawan</option>
                                    @foreach ( $users as $u )
                                    <option value="{{ $u->id }}">{{ $u->name.'-'.$u->no_identitas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gapok" class="form-label">Gaji Pokok</label>
                                <input class="form-control @error('gapok') is-invalid @enderror" name="gapok" id="gapok">
                                @error('gapok')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror 
                            </div>
                            <div class="form-group mb-3">
                                <label for="lembur" class="form-label">Lembur/ Jam</label>
                                <input class="form-control @error('lembur') is-invalid @enderror"   name="lembur" id="lembur">
                                @error('lembur')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                                <input class="form-control @error('tunjangan_jabatan') is-invalid @enderror"   name="tunjangan_jabatan" id="tunjangan_jabatan">
                                @error('tunjangan_jabatan')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror 
                            </div>
                            <div class="form-group mb-3">
                                <label for="uang_makan" class="form-label">Uang Makan / Hari</label>
                                <input class="form-control @error('uang_makan') is-invalid @enderror"  name="uang_makan" id="uang_makan">
                                @error('uang_makan')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror 
                            </div>
                           
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 mb-3">Submit</button>
                </form>
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @else
                
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Gaji Pokok</th>
                                <th scope="col">Tunjangan Jabatan</th>
                                <th scope="col">Uang Makan / Hari</th>
                                <th scope="col">Uang Lembur / Jam</th>
                                <th scope="col">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan_gaji as $index =>$pg )
                            <tr>
                                <td>{{ $index+1}}</td>
                                <td>{{ $pg->name.'-'.$pg->no_identitas }}</td>
                                <td>{{ $pg->nama_posisi }}</td>
                                <td>Rp. {{ number_format($pg->gapok) }}</td>
                                <td>Rp. {{ number_format($pg->tunjangan_jabatan) }}</td>
                                <td>Rp. {{ number_format($pg->uang_makan) }}</td>
                                <td>Rp. {{ number_format($pg->lembur) }}</td>
                                <td class="d-flex">
                                    <span>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary m-md-1 " data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $pg->id }}">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $pg->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data
                                                            gaji
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('edit_pengaturan_gaji') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="nama_karyawan" class="form-label">Nama
                                                                    Keryawan</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example"
                                                                    name="nama_karyawan" required>
                                                                    <option value="" disabled selected>Pilih Karyawan
                                                                    </option>
                                                                    @foreach ( $users as $u )
                                                                    <option @if ($pg->id_user == $u->id) selected @endif value="{{ $u->id }}">{{ $u->name.'-'.$u->no_identitas }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" name="id" value="{{ $pg->id }}"
                                                                    class="form-control" id="id" hidden>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="gapok" class="form-label">Gaji Pokok</label>
                                                                <input type="number" name="gapok"
                                                                    value="{{ $pg->gapok }}" class="form-control"
                                                                    id="gapok" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tunjangan_jabatan"
                                                                    class="form-label">Tunjangan Jabatan</label>
                                                                <input type="number" name="tunjangan_jabatan"
                                                                    value="{{ $pg->tunjangan_jabatan }}"
                                                                    class="form-control" id="tunjangan_jabatan" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="uang_makan" class="form-label">Uang
                                                                    Makan / Hari</label>
                                                                <input type="number" name="uang_makan"
                                                                    value="{{ $pg->uang_makan }}" class="form-control"
                                                                    id="uang_makan" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="lembur" class="form-label">Uang
                                                                    Lembur / Hari</label>
                                                                <input type="number" name="lembur"
                                                                    value="{{ $pg->lembur }}" class="form-control" required
                                                                    id="lembur">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                    <span class="row">
                                        <div class="col-lg-2">
                                            <form action="{{ route('delete_pengaturan_gaji', $pg->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button onclick="return confirm('Anda yakin akan menghapus ini? ')"
                                                    type="submit"
                                                    class="btn btn-outline-danger waves-effect waves-light mt-1 ">Hapus</i></button>
                                            </form>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<!-- Content End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
</div>

<!--End wrapper-->
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
@endsection