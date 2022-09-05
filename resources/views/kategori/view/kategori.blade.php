@extends('layouts.app')

@section('content')
        @if ( isset($message) )
           <div class="fs-1 d-flex align-content-center justify-content-center text-danger">{{ $message }}</div>
        @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h3 class="text-center">Artikel Kategori : <span class="text-primary fw-bold">{{ $kategori->nama }}</span></h3>
                    <a href="/index" class="btn btn-primary">Back To Index</a>
                </div>
            </div>
        </div>
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
                      <a href="#" class="text-primary text-decoration-none">{{ $art->kategori->nama }}</a>
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
        @endif
      
      </main>
  
</main>

@endsection
