<?php

namespace App\Http\Controllers;

use App\Models\arsipM;
use App\Models\keteranganM;
use Auth;
use Storage;
use Illuminate\Http\Request;

class keseluruhanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $keterangan = keteranganM::get();
        $keseluruhan = arsipM::where("namaarsip", "like", "%$keyword%")
        ->orderBy("tanggal", "desc")
        ->paginate(15);

        $keseluruhan->appends($request->only(["limit","keyword"]));

        return view("pages.arsip.keseluruhan", [
            "keyword" => $keyword,
            "keterangan" => $keterangan,
            "keseluruhan" => $keseluruhan,
        ]);
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
     * @param  \App\Models\arsipM  $arsipM
     * @return \Illuminate\Http\Response
     */
    public function show(arsipM $arsipM, $idarsip)
    {
        try{
            $iduser = Auth::user()->iduser;
            $cek = arsipM::where("idarsip", $idarsip);

            if($cek->count() > 0) {
                $filePath = storage_path('app/' . $cek->first()->links);

                if (file_exists($filePath)) {
                    return response()->file($filePath);
                }
            }

            abort(404);
        }catch(\Throwable $th){
            abort(404);
        }
    }

    public function download(arsipM $arsipM, $idarsip)
    {
        try{
            $cek = arsipM::where("idarsip", $idarsip);

            if($cek->count() > 0) {
                $file = Storage::download($cek->first()->links);
                return $file;
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\arsipM  $arsipM
     * @return \Illuminate\Http\Response
     */
    public function edit(arsipM $arsipM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\arsipM  $arsipM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, arsipM $arsipM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\arsipM  $arsipM
     * @return \Illuminate\Http\Response
     */
    public function destroy(arsipM $arsipM)
    {
        //
    }
}
