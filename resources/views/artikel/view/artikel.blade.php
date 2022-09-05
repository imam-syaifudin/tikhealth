@extends('layouts.app')

@section('content')
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    @if( isset($message) )
      <div class="fs-1 d-flex align-content-center justify-content-center text-danger">{{ $message }}</div>
    @else
    <center><img src="{{ asset('storage/' . $artikel->foto) }}" class="img-thumbnail img-fluid shadow-lg mb-3" alt="Image Artikel" width="600" height="600"></center>
    <h1 class="mt-5 fw-bold fs-1 text-center">{{ $artikel->judul }}</h1>
    <h5 class="fst-italic text-center" style="font-size: 15px;">Kategori <a href="../../kategori/view/{{ $artikel->kategori->slug }}" class="text-decoration-none">{{ $artikel->kategori->nama }}</a></h5>
    <p class="lead">{!! $artikel->isi !!}</p>
    <p class="">Ditulis Oleh <span class="text-primary"><a href="{{ url('artikel/view/user/' . $artikel->user_id ) }}" class="text-decoration-none">{{ $artikel->user->name }}</span></a> Tanggal <span class="text-primary"><a href="{{ url('artikel/view/date/' . $artikel->tanggalArtikel) }}" class="text-decoration-none">{{ $artikel->tanggalArtikel }}</a></span></p>
    <p>Back to <a href="/index" class="text-decoration-none">INDEX</a> TIK HEALTH</p>
  </div>
  @endif
</main>

@endsection
