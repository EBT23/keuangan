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
    <div class="card h-100">
        @if (Session::has('success'))
        <div class="alert alert-success mb-2">
            {{ Session::get('success') }}
        </div>
        @else
        
        @endif
        <div class="card-body">
            <h4 class="card-title">MY PROFILE</h4>
            <hr>
            <form method="POST" action="#">
                @csrf
                <div class="form-group row mb-2">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control " value="{{ $user->name }}" name="name"  autocomplete="current-password" readonly>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" value="{{ $user->email }}" autocomplete="email" readonly>
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label for="no_identitas" class="col-md-4 col-form-label text-md-right">{{ __('No Identitas') }}</label>
                    <div class="col-md-6">
                        <input id="no_identitas" type="text" class="form-control" value="{{ $user->no_identitas }}" autocomplete="no_identitas" readonly>
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label for="tgl_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tgl Lahir') }}</label>
                    <div class="col-md-6">
                        <input id="tgl_lahir" type="text" class="form-control" value="{{ $user->tgl_lahir }}" autocomplete="tgl_lahir" readonly>
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label for="no_tlp" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon') }}</label>
                    <div class="col-md-6">
                        <input id="no_tlp" type="text" class="form-control" value="{{ $user->no_tlp }}" autocomplete="no_tlp" readonly>
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Created At') }}</label>
                    <div class="col-md-6">
                        <input id="new_password_confirmation" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}" name="new_password_confirmation"  readonly>
                    </div>
                </div>
            </form>
            <div class="form-group row mt-2">
                <div class="col-md-6 offset-md-4">
                    <button type="button" class="btn btn-outline-primary m-md-1 " data-bs-toggle="modal"data-bs-target="#exampleModal{{ $user->id }}">
                                            {{ __('Edit Profile') }}
                    </button>
                </div>
                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Ptofile
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('update.profile', ['id' => $user['id']]) }}"
                                    method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name"
                                            value="{{ $user->name }}" class="form-control"
                                            id="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email"
                                            class="form-label">Email</label>
                                        <input type="email" name="email"
                                            value="{{ $user->email }}"
                                            class="form-control" id="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_identitas" class="form-label">No Identitas</label>
                                        <input type="number" name="no_identitas"
                                            value="{{ $user->no_identitas }}" class="form-control"
                                            id="no_identitas" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir"
                                            value="{{ $user->tgl_lahir }}" class="form-control" required
                                            id="tgl_lahir">
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="posisi_id" class="form-label">Nama Posisi</label>
                                        <select class="form-select"
                                            aria-label="Default select example"
                                            name="posisi_id" required>
                                            <option value="" disabled selected>Pilih Posisi</option>
                                            @foreach ($posisi1 as $item)
                                                <option @if($user->posisi_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama_posisi}}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    
                                    <div class="mb-3">
                                        <label for="no_tlp" class="form-label">No Telepon</label>
                                        <input type="number" name="no_tlp"
                                            value="{{ $user->no_tlp }}" class="form-control" required
                                            id="no_tlp">
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
            </div>
        </div>
        <!-- Content End -->
        
        @endsection
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
        </div>
        