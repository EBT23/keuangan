@extends('layouts.base')
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
    <div class="card">

        <div class="card-body">
            <h4 class="card-title">FORM TAMBAH DATA PEMASUKAN</h4>
            <hr>
        <form action="{{ route('tambah.pemasukan') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
             <div class="col-6">
                <div class="mb-3">
                    <label for="distributor_id" class="form-label">Distributor</label>
                    <select class="form-select" name="distributor_id" data-allow-clear="true" required>
                        <option selected="">Pilih Distributor</option>
                        @foreach ($data1 as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_distributor }}
                            </option>
                        @endforeach
                    </select>
                  </div>
              <div class="mb-3">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
              </div>
            </div>
                 <div class="col-6" >
                    <div class="mb-3">
                        <label for="tgl" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tgl" name="tgl" id="tgl" required>
                      </div>
                      <div class="mb-3">
                        <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
                        <input class="form-control" name="total_pemasukan" id="total_pemasukan" required>
                      </div>
                      <div class="mb-3">
                          <label for="bukti_pemasukan" class="form-label">Bukti Pemasukan</label>
                          <input class="form-control form-control-sm" name="bukti_pemasukan" id="bukti_pemasukan" type="file" required >
                          </div>
                     </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="submit">Tambah</button>
                      </div>
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
                            <h6 class="mb-4">Data Pemasukan</h6>
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Distributor</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Total Pemasukkan</th>
                                            <th scope="col">Bukti Pemasukkan</th>
                                            <th scope="col">Aksi</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $pm )
                                        <tr>
                                            <th scope="row">{{ $index+1 }}</th>
                                            <td>{{ $pm->nama_distributor }}</td>
                                            <td>{{ $pm->keterangan }}</td>
                                            <td>{{ $pm->tgl }}</td>
                                            <td>Rp. {{ number_format($pm->total_pemasukan)  }}</td>
                                            {{-- <td><img src="{{ asset('upload/pemasukan/' . $pm['bukti_pemasukan'] . '') }}" width="30" height="30" alt="Gambar Kosong">
                                            </td> --}}
                                           <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#imageModal{{ $pm->id }}">
                                            <i class="far fa-eye"></i>
                                          </button>
                                        </td>
                                           <!-- Button trigger modal -->
                                                <!-- Modal -->
                                                <div class="modal fade" id="imageModal{{ $pm->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel">Bukti Pemasukan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('upload/pemasukan/' . $pm->bukti_pemasukan . '') }}" width="750" height="500" alt="Gambar Kosong">
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('edit.pemasukan', $pm->id) }}" type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        Edit</a>
                                                        <form action="{{ route('delete.pemasukan', $pm->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="return confirm('Anda yakin akan menghapus ini? ')" type="submit"
                                                        class="btn btn-outline-danger waves-effect waves-light">Hapus</i></button>
                                                    </form>
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

@endsection
