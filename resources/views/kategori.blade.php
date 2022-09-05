@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-start">
        <div class="col-lg-6 text-center">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('ACTION') }}</div>
                <div class="card-body d-flex justify-content-around">
                        <a href="{{ url('/home') }}" class="btn btn-dark mx-1">BACK TO HOME</a>
                        <a href="{{ url('/kategori/create') }}" class="btn btn-primary">TAMBAH KATEGORI</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <h1 class="fw-bold fst-italic text-center" style="font-size: 4em;"><svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="bi bi-file-medical-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 4.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5a.5.5 0 1 1 1 0zM5.5 9h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zm0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
              </svg>TIK HEALTH</h1>
        </div>
        <div class="col-lg-12  mt-4">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Kategori') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center fs-1 p-3">Data Kategori</h3>
                    @include('flash-message')
                    <div class="table-responsive rounded">
                        <table class="table table-dark text-center shadow-sm">
                            <thead>
                              <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                  $i = 1;
                                @endphp
                                 @foreach ( $kategori as $kat)
                                    <tr class="table-light">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $kat->nama }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ url('kategori/' . $kat->id . '/edit') }}" class="btn btn-primary mx-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                </svg>edit data</a>
                                            <a href="{{ url('kategori/hapus/' . $kat->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg>delete data</a>
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
@endsection
