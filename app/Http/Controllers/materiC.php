<?php

namespace App\Http\Controllers;

use App\Models\modulajarM;
use App\Models\bagikanmodulajarM;
use App\Models\mapelM;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class materiC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $user = Auth::user();

        $mapel = bagikanmodulajarM::from("bagikanmodulajar as bm")
        ->join("modulajar as m", "m.idmodulajar", 'bm.idmodulajar')
        ->join("mapel as mp", "mp.idmapel", "m.idmapel")
        ->join("user as u", "u.iduser", "m.iduser")
        ->join("guru as i", "i.iduser", "u.iduser")
        ->where("idkelas", $user->siswa->idkelas)
        ->where("idjurusan", $user->siswa->idjurusan)
        ->where(function ($query) use ($keyword) {
            $query->where("mp.namamapel", "like", "%$keyword%");
        })
        ->select("bm.iduser","mp.idmapel","mp.namamapel", "i.namalengkap")
        ->groupBy("bm.iduser","mp.idmapel","mp.namamapel", "i.namalengkap")
        ->get();


        return view("pages.materi.materi", [
            "keyword" => $keyword,
            "mapel" => $mapel,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function materi(Request $request, $idmapel)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $user = Auth::user();

        $namamapel = bagikanmodulajarM::from("bagikanmodulajar as bm")
        ->join("modulajar as m", "m.idmodulajar", 'bm.idmodulajar')
        ->join("mapel as mp", "mp.idmapel", "m.idmapel")
        ->join("user as u", "u.iduser", "m.iduser")
        ->join("guru as i", "i.iduser", "u.iduser")
        ->where("mp.idmapel", $idmapel)
        ->where("idkelas", $user->siswa->idkelas)
        ->where("idjurusan", $user->siswa->idjurusan)
        ->select("m.*","bm.*", "mp.*", "i.*")
        ->first();

        $modul = bagikanmodulajarM::from("bagikanmodulajar as bm")
        ->join("modulajar as m", "m.idmodulajar", 'bm.idmodulajar')
        ->join("mapel as mp", "mp.idmapel", "m.idmapel")
        ->join("user as u", "u.iduser", "m.iduser")
        ->join("guru as i", "i.iduser", "u.iduser")
        ->where("mp.idmapel", $idmapel)
        ->where("idkelas", $user->siswa->idkelas)
        ->where("idjurusan", $user->siswa->idjurusan)
        ->select("m.*","bm.*", "mp.*")
        ->get();



        return view("pages.materi.lihat", [
            "keyword" => $keyword,
            "modul" => $modul,
            "namamapel" => $namamapel,
        ]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\modulajarM  $modulajarM
     * @return \Illuminate\Http\Response
     */
    public function show(modulajarM $modulajarM, $idmodulajar)
    {
        try{
            $idjurusan = Auth::user()->siswa->idjurusan;
            $idkelas = Auth::user()->siswa->idkelas;


            $cek = modulajarM::has('user')
            ->has('bagikan')
            ->whereHas("bagikan", function ($query) use ($idjurusan, $idkelas){
                $query->where("idjurusan", $idjurusan)
                ->where("idkelas", $idkelas);
            })
            ->where("idmodulajar", $idmodulajar);

            if($cek->count() > 0) {
                $filePath = storage_path('app/' . $cek->first()->links);

                if (file_exists($filePath)) {
                    return response()->file($filePath);
                }
            }

            abort(404);
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\modulajarM  $modulajarM
     * @return \Illuminate\Http\Response
     */
    public function edit(modulajarM $modulajarM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\modulajarM  $modulajarM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, modulajarM $modulajarM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\modulajarM  $modulajarM
     * @return \Illuminate\Http\Response
     */
    public function destroy(modulajarM $modulajarM)
    {
        //
    }
}
