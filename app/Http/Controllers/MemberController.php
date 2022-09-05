<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $member = Member::all();
        $arr = [
            "title" => "User"
        ];
        return view('users',compact('member','arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $arr = [
            "title" => "Create"
        ];
        return view('member.create',compact('arr'));
    }

    public function hitungBMI($tinggiBadan,$beratBadan){
     
        $tinggibadan = $tinggiBadan * $tinggiBadan / 10000;
        $hasil = $beratBadan / $tinggibadan;

        
        $arr = [
            "hasil" => round($hasil,1)
        ];

        if ( $hasil < 18.5 ){
            $arr = array_merge($arr, array("keterangan" => "Kurus"));
        } else if ( $hasil <= 22.9){
            $arr = array_merge($arr, array("keterangan" => "Normal"));
        } else if ( $hasil <= 29.9 ){
            $arr = array_merge($arr, array("keterangan" => "Gemuk"));
        } else if ( $hasil > 30 ){
            $arr = array_merge($arr, array("keterangan" => "Obesitas"));
        }

        return $arr;
    }

    public function cekHobi(array $hobi){
        if ( $hobi[0] == $hobi[1] OR $hobi[1] == $hobi[2] OR $hobi[0] == $hobi[2]){
            return false;
        }

    
        $gabung = implode(",",$hobi);
        return $gabung;
    }

    public function hitungUmur($tahunLahir){
        $tahunSekarang = date('Y');
        $umur = $tahunSekarang - $tahunLahir;
        
        return $umur;
    }

    public function cekKonsultasi($statusUmur,$keterangan){
        if ( $statusUmur >= 17 && $keterangan === "Obesitas"){
            return true;
        } else {
            return false;
        }
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
        $hitungBMI = $this->hitungBMI($request->tinggibadan,$request->beratbadan);
        $tahunLahir = explode("-",$request->tahunlahir)[0];
        $hobi = $this->cekHobi($request->hobi);

        if ( $hobi == false){
            return "
            <script>
                alert('Hobi tidak boleh sama!!')
            </script>
            " . redirect("/member/create");
        }

        $member = new Member;
        $member->nama = $request->nama;
        $member->tinggiBadan = $request->tinggibadan;
        $member->beratBadan = $request->beratbadan;
        $member->BMI = $hitungBMI['hasil'];
        $member->statusBeratBadan = $hitungBMI['keterangan'];
        $member->hobi = $this->cekHobi($request->hobi);
        $member->umur = $this->hitungUmur($tahunLahir);
        $member->konsultasi = $this->cekKonsultasi($member->umur,$member->statusBeratBadan);
        $member->save();

        return redirect('/member')->with('success','Data Berhasil Di Tambah!');
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
        $member = Member::findOrFail($id);
        $umur = $member->umur;
        $tahunSekarang = date('Y') - $umur;

        $arr = [
            "title" => "User Edit",
            "umur" => (int)$tahunSekarang,
        ];

        $hobi = [
            "datahobi" => explode(",",$member->hobi)
        ];


        return view('member.edit',compact('member','arr','hobi'));
    }

    // UDIN GTG

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
        $hitungBMI = $this->hitungBMI($request->tinggibadan,$request->beratbadan);
        $tahunLahir = explode("-",$request->tahunlahir)[0];
        $hobi = $this->cekHobi($request->hobi);

        if ( $hobi == false){
            return "
            <script>
                alert('Hobi tidak boleh sama!!')
            </script>
            " . redirect("member/" . $id . "/edit");
        }

        $member = Member::findOrFail($id);
        $member->nama = $request->nama;
        $member->tinggiBadan = $request->tinggibadan;
        $member->beratBadan = $request->beratbadan;
        $member->BMI = $hitungBMI['hasil'];
        $member->statusBeratBadan = $hitungBMI['keterangan'];
        $member->hobi = $this->cekHobi($request->hobi);
        $member->umur = $this->hitungUmur($tahunLahir);
        $member->konsultasi = $this->cekKonsultasi($member->umur,$member->statusBeratBadan);
        $member->save();

        return redirect('users')->with('success','Data Berhasil Di Update');
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
        $member = Member:: findOrFail($id);
        $member->delete();

        return redirect('/users');
    }
}
