@extends('layouts.app')

@section('content')
<main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <img src="https://i.pinimg.com/736x/c2/a7/99/c2a799c3a8d2b852fa783be07e4bce53.jpg" class="img-fluid img-thumbnail rounded-circle shadow-lg" width="300" height="300" alt="Artikel Thumbnails">
          <h1 class="fw-light mt-3">Our Artikel</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="/index" class="btn btn-primary my-2">Halaman Index</a>
            <a href="/register" class="btn btn-secondary my-2">Register</a>
          </p>
        </div>
      </div>
    </section>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <form action="{{ url('/index/cari') }}" method="GET">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" name="value" value="{{ request('value') }}"aria-describedby="button-addon2" autofocus>
            <button class="btn btn-primary text-light" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
    <main>
      
        <div class="album py-5 bg-light">
          <div class="container">
            @if ( isset($messageArr) )
              <h2 class="text-center">{{ $messageArr['pesan'] }}</h2>
            @endif
            {{ $artikel->links() }}
            <div class="row jusitfy-content-center row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
              @foreach($artikel as $art)  
                <div class="col-lg-4">
                <div class="card shadow-sm">
                  <img src="{{ asset('storage/' . $art->foto ) }}" class="rounded-top" height="400" width="100%" alt="Thumbnail">
                  <div class="card-body">
                    <h4 class="judulartikel fw-bold">{{ $art->judul }}</h3>
                    <a href="kategori/view/{{ $art->kategori->slug }}" class="text-primary text-decoration-none">{{ $art->kategori->nama }}</a>
                    <h5 class="card-text fs-6">{!! Str::limit($art->isi, 150) !!}</h5>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ url('artikel/view/' . $art->id) }}" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                        <a href="{{ url('artikel/' . $art->id . '/edit') }}" type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                      </div>
                      
                    </div>
                  </div>
                </div>
               </div>
              @endforeach
            </div>
            {{ $artikel->links() }}
          </div>
        </div>
      
      </main>
  
</main>

@endsection
