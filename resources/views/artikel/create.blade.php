@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 text-center">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('ACTION') }}</div>
                <div class="card-body d-flex justify-content-around">
                        <a href="{{ url('/home') }}" class="btn btn-dark mx-1">BACK TO HOME</a>
                        <a href="{{ url('/artikel') }}" class="btn btn-primary">BACK TO ARTIKEL</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <h1 class="fw-bold fst-italic text-center" style="font-size: 4em;"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-file-medical-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 4.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5a.5.5 0 1 1 1 0zM5.5 9h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
              </svg>TIK HEALTH</h1>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Add Artikel') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center fs-1 p-3">Tambah Artikel</h3>
                    <form action="{{ route('artikel.store'); }}" method="POST" enctype="multipart/form-data">  
                        @csrf
                        <div class="mb-3">
                          <label for="judul" class="form-label">Judul Artikel : </label>
                          <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" aria-describedby="emailHelp" required value="{{ old('judul') }}">
                          @error('judul')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto" required>
                            @error('foto')
                            <div class="alert alert-danger mt-3" role="alert">
                                yang anda upload bukan gambar
                              </div>
                            @enderror
                        </div>
                        <label for="kategori">Kategori : </label>
                        <div class="input-group mb-3">
                            <select class="form-select fs-5" id="inputGroupSelect02" name="kategori" required>
                                @foreach ( $kategori as $kat )
                                    <option value={{ $kat->id }}>{{ $kat->nama}}</option>
                                @endforeach
                            </select>
                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                        </div>
                        <label for="isi">Tulis Artikel : </label>
                        <input type="hidden" value="{{ auth()->user()->id }}" name="userid">
                        <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
                        <trix-editor input="isi"></trix-editor>
                        @error('isi')
                          <div class="alert alert-danger mt-3" role="alert">
                            {{ $message }}
                          </div>
                        @enderror
                        <button type="submit" class="btn btn-secondary mt-3">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
