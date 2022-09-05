<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori; 
use App\Models\Artikel;

class KategoriController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth')->except('solokategori');
    }

    public function index()
    {
        //
        $kategori = Kategori::all();
        $arr = [
            "title" => "Kategori"
        ];
        return view('/kategori',compact('kategori','arr'));
    }

    public function solokategori($id){
        $kategori = Kategori::where('slug',$id)->first();
        $arr = [
            "title" => "404"
        ];

        if ( $kategori === NULL ){
            $message = "Kategori Not Found";
            return view('kategori.view.kategori',compact('message','kategori','arr'));
        }
        $artikel = Artikel::where('kategori_id',$kategori->id)->paginate(10);
        $message = "Kategori Not Found";
        $arr['title'] = "Kategori {$kategori->nama}";
        
        
       return view('kategori.view.kategori',compact('artikel','arr','kategori'));
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
            "title" => "Kategori Create"
        ];
        
        return view('/kategori/create',compact('arr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function checkSlug($slug){

       $pecahSlug = explode(" ",strtolower($slug));
       return implode("-",$pecahSlug);

    }
    public function store(Request $request)
    {
        //
        $kategori = new Kategori;

        $validated = $request->validate([
            "nama" => "required|unique:kategoris|max:255"
        ]);
        

        $kategori->nama = $request->nama;
        $kategori->slug = $this->checkSlug($request->nama);
        
        $kategori->save();

        return redirect('/kategori')->with('success','Kategori berhasil ditambahkan');
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
        $kategori = Kategori::find($id);
        $arr = [
            "title" => "Kategori Edit"
        ];
        return view('kategori.edit',compact('kategori','arr'));
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
        $kategori = Kategori::find($id);
        $arr = [
            "title" => "Edit Kategori"
        ];
        return view('kategori.edit',compact('kategori','arr'));
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
        $kategori = Kategori::find($id);

        $validated = [];

        if ( $kategori->nama != $request->nama ){
            $validated['nama'] = "required|unique:kategoris|max:255";
        }

        $kategori->nama = $request->nama;
        $kategori->slug = $this->checkSlug($request->nama);

        $validatedData = $request->validate($validated);
        $kategori->save();

        return redirect('/kategori')->with('success','Kategori berhasil di update');
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
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();
        return redirect('/kategori')->with('success','Kategori berhasil di hapus');
    }
}
