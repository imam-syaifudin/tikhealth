<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    //
    public function index()
    {
        $arr = [
            "title" => "TIK HEALTH"
        ];
        $artikel = Artikel::paginate(9)->withQueryString();

        return view('index',compact('artikel','arr'));
    }

    public function cari(Request $request){
        $arr = [
            "title" => "TIK HEALTH"
        ];
        $artikel = Artikel::where('judul','like', '%' . $request->value . '%')
        ->orWhere('isi','like', '%' . $request->value . '%')
        ->orWhere('isi','like', '%' . $request->value . '%')
        ->paginate(9)
        ->withQueryString();

        $dataArtikel = [];
        foreach( $artikel as $art ){
            $dataArtikel[] = $art->judul;
        }

        if ( empty($dataArtikel) ){
            $messageArr = [
                "pesan" => "Maaf Artikel Tidak Ditemukan :("
            ];
            return view('index',compact('arr','messageArr','artikel'));
        } else {
            return view('index',compact('artikel','arr'));
        }

        
    }
}
