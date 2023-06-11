@extends('layouts.base',['title' => "$title - Admin"])
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
    <div class="card">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @else
        
        @endif
        <div class="card-body">
            <h4 class="card-title">FORM TAMBAH DATA KARYAWAN</h4>
            <hr>
            <form action="{{ route('tambah.karyawan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
							<label for="name">Nama Lengkap</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  id="name" name="name" aria-describedby="name">
							@error('name')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_identitas" class="form-label">No Identitas</label>
                            <input type="number" class="form-control  @error('no_identitas') is-invalid @enderror" value="{{ old('no_identitas') }}" name="no_identitas" id="no_identitas">
                            @error('no_identitas')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <textarea class="form-control @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir" value="{{ old('tempat_lahir') }}" id="tempat_lahir"></textarea>
                            @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" id="tgl_lahir" name="tgl_lahir" id="tgl_lahir">
                            @error('tgl_lahir')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="no_rek" class="form-label">No Rekening</label>
                            <input type="text" class="form-control @error('no_rek') is-invalid @enderror" value="{{ old('no_rek') }}" name="no_rek" id="no_rek">
                            @error('no_rek')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="posisi_id" class="form-label">Posisi</label>
                            <select class="form-select @error('posisi_id') is-invalid @enderror" value="{{ old('posisi_id') }}" name="posisi_id" data-allow-clear="true">
                                <option selected="">Pilih Posisi</option>
                                @foreach ($posisi as $item)
                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama_posisi'] }}
                                </option>
                                @endforeach
                            </select>
                            @error('posisi_id')
                            <div class="text-danger">The Posisi field is required.</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" value="{{ old('status') }}" name="status" data-allow-clear="true">
                                <option selected="">Status :</option>
                                <option value="Karyawan Tetap" {{ old('status')=='active' ? 'selected' : '' }}>Karyawan
                                    Tetap</option>
                                <option value="Karyawan Tidak Tetap" {{ old('status')=='inactive' ? 'selected' : '' }}>
                                    Karyawan Tidak Tetap</option>
                            </select>
                            @error('status')
                            <div class="text-danger">The Status field is required.</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="domisili" class="form-label">Domisili</label>
                            <textarea class="form-control @error('domisili') is-invalid @enderror" value="{{ old('domisili') }}" name="domisili" id="domisili"></textarea>
                            @error('domisili')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_tlp" class="form-label">No Handphone</label>
                            <input type="number" class="form-control @error('no_tlp') is-invalid @enderror" value="{{ old('no_tlp') }}" id="no_tlp" name="no_tlp" id="no_tlp">
                            @error('no_tlp')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                </div>
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </form>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @elseif (Session::has('errors'))
                    <div class="alert alert-danger">
                        {{ Session::get('errors') }}
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Data Karyawan</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">No Identitas</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">No Handphone</th>
                                            <th scope="col">Domisili</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $index => $kr )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $kr['no_identitas'] }}</td>
                                            <td>{{ $kr['name'] }}</td>
                                            <td>{{ $kr['nama_posisi'] }}</td>
                                            <td>{{ $kr['tempat_lahir'] }}</td>
                                            <td>{{ $kr['tgl_lahir'] }}</td>
                                            <td>{{ $kr['no_tlp'] }}</td>
                                            <td>{{ $kr['domisili'] }}</td>
                                            <td>{{ $kr['status'] }}</td>
                                            <td class="d-flex">
                                                <span>
                                                    <a href="{{ route('edit.karyawan', ['id' => $kr['user_id']]) }}"
                                                        type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light m-md-1">
                                                        Edit</a>
                                                </span>
                                                <span>
                                                    <form action="{{ route('delete.karyawan', ['id' => $kr['id']]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button
                                                            onclick="return confirm('Anda yakin akan menghapus ini? ')"
                                                            type="submit"
                                                            class="btn btn-outline-danger waves-effect waves-light mt-1">Hapus</i></button>
                                                    </form>
                                                </span>
                                                </div>
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
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    </script>
    @endsection