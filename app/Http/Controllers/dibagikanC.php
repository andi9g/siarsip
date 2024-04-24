<?php

namespace App\Http\Controllers;

use App\Models\arsipM;
use App\Models\User;
use App\Models\bagikanM;
use App\Models\keteranganM;
use Illuminate\Http\Request;
use Storage;
use Str;
use Auth;

class dibagikanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $ket = empty($request->ket)?'':$request->ket;
        $tahun = empty($request->thn)?date("Y"):$request->thn;
        $iduser = Auth::user()->iduser;

        $keterangan = keteranganM::get();


        if(bagikanM::has('arsip')->where('iduser', $iduser)
        ->count() > 0) {
            $tahunAwal = date("Y", strtotime(bagikanM::has('arsip')
            ->whereHas("arsip", function ($query) {
                $query->orderBy('tanggal', 'asc');
            })
            ->first()->arsip->tanggal));


            $tahunAkhir = date("Y", strtotime(bagikanM::has('arsip')
            ->whereHas("arsip", function ($query) {
                $query->orderBy('tanggal', 'asc');
            })
            ->first()->arsip->tanggal));

            $thn = [];
            for ($i = $tahunAwal; $i <= $tahunAkhir; $i++) {
                $thn[] = $i;
            }
        }else {
            $thn = [
                date("Y"),
            ];
        }


        $thn = $thn;


        $arsip = bagikanM::has('arsip')
        ->where("iduser", $iduser)
        ->whereHas("arsip", function ($query) use ($keyword) {
            $query->where("namaarsip", "like", "%$keyword%")
            ->orderBy("tanggal", "desc");
        })
        ->whereHas("arsip", function ($query) use ($tahun) {
            $query->whereYear("tanggal", "=", $tahun);
        })
        ->whereHas("arsip", function ($query2) use ($ket) {
            $query2->where("idketerangan","like", "$ket%");
        })
        ->paginate(15);

        $arsip->appends($request->only(["limit","keyword"]));

        $cek = bagikanM::where("iduser", $iduser)->where("ket", 0);

        if($cek->count() > 0) {
            $cek->update([
                "ket" => 1
            ]);
        }

        return view("pages.dibagikan.arsip", [
            "keyword" => $keyword,
            "keterangan" => $keterangan,
            "arsip" => $arsip,
            "ket" => $ket,
            "tahun" => $tahun,
            "thn" => $thn,
        ]);
    }

    public function download(arsipM $arsipM, $idarsip)
    {
        try{
            $iduser = Auth::user()->iduser;
            $cek = bagikanM::where("iduser", $iduser)->where("idarsip", $idarsip);

            if($cek->count() > 0) {
                $file = Storage::download($cek->first()->arsip->links);
                return $file;
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\bagikanM  $bagikanM
     * @return \Illuminate\Http\Response
     */
    public function show(bagikanM $bagikanM, $idarsip)
    {
        try{
            $iduser = Auth::user()->iduser;
            $cek = bagikanM::where("iduser", $iduser)->where("idarsip", $idarsip);

            if($cek->count() > 0) {
                $filePath = storage_path('app/' . $cek->first()->arsip->links);

                if (file_exists($filePath)) {
                    return response()->file($filePath);
                }
            }

            abort(404);
        }catch(\Throwable $th){
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bagikanM  $bagikanM
     * @return \Illuminate\Http\Response
     */
    public function edit(bagikanM $bagikanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bagikanM  $bagikanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bagikanM $bagikanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bagikanM  $bagikanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(bagikanM $bagikanM)
    {
        //
    }
}
