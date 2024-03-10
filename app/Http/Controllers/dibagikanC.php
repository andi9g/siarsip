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
        $iduser = Auth::user()->iduser;

        $keterangan = keteranganM::get();
        $arsip = bagikanM::join("arsip", "arsip.idarsip", "bagikan.idarsip")
        ->where("bagikan.iduser", $iduser)
        ->where("arsip.namaarsip", "like", "%$keyword%")
        ->orderBy("bagikan.created_at", "desc")
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
