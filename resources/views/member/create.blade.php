@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-4 text-center">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('ACTION') }}</div>
                <div class="card-body d-flex justify-content-around">
                        <a href="{{ url('/home') }}" class="btn btn-danger">BACK TO HOME</a>
                        <a href="{{ url('/users') }}" class="btn btn-dark">BACK TO USER</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-4">
            <h1 class="fw-bold fst-italic text-center" style="font-size: 4em;"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-file-medical-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 4.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5a.5.5 0 1 1 1 0zM5.5 9h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
              </svg>TIK HEALTH</h1>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Input User') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center fs-1 p-3">Tambah User Baru</h3>
                    <form action="{{ route('member.store'); }}" method="POST">  
                        @csrf
                        <div class="mb-3">
                          <label for="nama" class="form-label">Nama : </label>
                          <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                          <label for="tinggibadan" class="form-label">Tinggi Badan : </label>
                          <input type="text" name="tinggibadan" class="form-control" id="tinggibadan"  required>
                        </div>
                        <div class="mb-3">
                          <label for="beratbadan" class="form-label">Berat Badan : </label>
                          <input type="text" name="beratbadan" class="form-control" id="beratbadan" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahunlahir" class="form-label">Tanggal Lahir : </label>
                            <input type="date" name="tahunlahir" class="form-control" id="tahunlahir"  required>
                         </div>
                        <div class="mb-3">
                            <label for="hobi" class="form-label">Hobi : <span class="text-danger">*MINIMAL 3 HOBI</span></label>
                            <br>
                            <label for="" class="fst-italic text-danger">Hobi 1 ( Hobi pertama akan ditampilkan ke layar )</label>
                            <input type="text" name="hobi[]" class="form-control" id="hobi"  required>
                            <br>
                            <label for="" class="fst-italic text-danger">Hobi 2</label>
                            <input type="text" name="hobi[]" class="form-control" id="hobi"  required>
                            <br>
                            <label for="" class="fst-italic text-danger">Hobi 3</label>
                            <input type="text" name="hobi[]" class="form-control" id="hobi" required>
                         </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
