<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('Asia/Jakarta');

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth')->except('show','viewUser','viewDate');
    }

    public function viewUser($user){
        $artikel = Artikel::where('user_id',$user)->paginate(10);
        $user = User::find($user);
        $pesan = "User Tidak Ditemukan";
        $arr = [
            "title" => "404"
        ];

        if ( $user == NULL ){
            return view('artikel.view.user',compact('artikel','arr','pesan','user'));
        }
        
        $arr['title'] = "Pencarian {$user->name}";
        
        return view('artikel.view.user',compact('artikel','arr','user'));
    }

    public function viewDate($date){
        $artikel = Artikel::where('tanggalArtikel',$date)->paginate(10);
        $pesan = "Not Found";
        $arr = [
            "title" => "404"
        ];
        $dataArtikel = [];
        foreach ( $artikel as $art ){
            $dataArtikel[] = $art->tanggalArtikel;
        }

        if ( count($dataArtikel) == 0  ){
            return view('artikel.view.date',compact('artikel','pesan','arr','dataArtikel','date'));
        }
        $arr['title'] = "Pencarian tanggal : {$date}";
        return view('artikel.view.date',compact('artikel','arr','date','dataArtikel'));
    }

    public function index()
    {
        //
        $arr = [
            "title" => "Artikel"
        ];
        $artikel = Artikel::all();
        return view('artikel',compact('artikel','arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $arr = [
            "title" => "Add Artikel"
        ];
        $kategori = Kategori::all();
        return view('artikel.create',compact('arr','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $artikelAll = Artikel::all();
        $judulArtikel = [];
        foreach ( $artikelAll as $all ){
            $judulArtikel[] = $all->judul;
        }


        $artikel = new Artikel;
        $validated = [
            'judul' => 'required|unique:artikels|max:255',
            'foto' => 'required|image',
            'isi' => 'required|unique:artikels,isi'
        ];
        $validateData = $request->validate($validated);

        
        $artikel->kategori_id = $request->kategori;
        $artikel->user_id = $request->userid;
        $artikel->judul = $request->judul;
        $artikel->foto = $request->file('foto')->store('artikel-images');
        $artikel->isi = $request->isi;
        $artikel->tanggalArtikel = date("d-m-Y");

        $artikel->save();

        return redirect('artikel')->with('success','Artikel Berhasil Di Tambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $artikel = Artikel::find($id);
        $message = "Artikel yang anda cari tidak ada";
        $arr = [
            "title" => "404"
        ];
        if ( $artikel === NULL ){
            return view('artikel.view.artikel',compact('artikel','message','arr'));
        }
        $arr['title'] = $artikel->judul;
       
        
        return view('artikel.view.artikel',compact('artikel','arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $arr = [
            "title" => "Artikel Edit"
        ];
        $kategori = Kategori::all();
        $artikel = Artikel::find($id);
        return view('artikel.edit',compact('artikel','arr','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

           
        $artikel = Artikel::find($id);
        $validated = [
            'isi' => 'required'
        ];

        if ( $request->judul != $artikel->judul ){
            $validated['judul'] = 'required|unique:artikels|max:255';
        } else if (isset($request->foto)){
            $validated['foto'] = 'required|image';
        }

        $validateData = $request->validate($validated);

        $artikel->kategori_id = $request->kategori;
        $artikel->judul = $request->judul;

        if ( empty($request->file()) ){
            $artikel->foto = $artikel->foto;
        } else {
            Storage::delete($artikel->foto);
            $artikel->foto = $request->file('foto')->store('artikel-images');
        }
        $artikel->isi = $request->isi;
        $artikel->tanggalArtikel = $artikel->tanggalArtikel;

        $artikel->save();
        
        return redirect('/artikel')->with('success','Artikel Berhasil di ubah');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $artikel = Artikel::findOrFail($id);

        Storage::delete($artikel->foto);
        $artikel->delete();

        return redirect('/artikel')->with('success','Artikel Berhasil Di Hapus');
    }
}
