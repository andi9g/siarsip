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

class arsipkuC extends Controller
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

        if(arsipM::count() > 0) {
            $tahunAwal = date("Y", strtotime(arsipM::orderBy("tanggal", "asc")->first()->tanggal));
            $tahunAkhir = date("Y", strtotime(arsipM::orderBy("tanggal", "desc")->first()->tanggal));
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


        $arsip = arsipM::where("iduser", $iduser)
        ->where("namaarsip", "like", "%$keyword%")
        ->where(function ($query) use ($tahun) {
            $query->whereYear("tanggal", "=", $tahun);
        })
        ->where(function ($query2) use ($ket) {
            $query2->where("idketerangan","like", "$ket%");
        })
        ->orderBy("tanggal", "desc")
        ->paginate(15);

        $arsip->appends($request->only(["limit","keyword"]));

        return view("pages.arsip.arsip", [
            "keyword" => $keyword,
            "keterangan" => $keterangan,
            "arsip" => $arsip,
            "ket" => $ket,
            "tahun" => $tahun,
            "thn" => $thn,
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
        $request->validate([
            'namaarsip'=>'required',
            'file'=>'required|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mp3|file',
            'tanggal'=>'required',
        ]);

        try{
            $data = $request->all();

            if ($request->file('file')->isValid()) {
                $originalName = $request->file('file')->getClientOriginalName();
                $mimeType = $request->file('file')->getClientMimeType();
                $extension = $request->file('file')->extension();
                $encryptedName = Str::random(40) . '.' . $extension;

                // Simpan berkas dengan nama terenkripsi
                $path = $request->file('file')->storeAs('uploads', $encryptedName);
            }
            $data["links"] = $path;
            $data["mimetype"] = $mimeType;
            $data["iduser"] = Auth::user()->iduser;

            arsipM::create($data);
            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }


    }

    public function bagikan(arsipM $arsipM, $idarsip)
    {
        $iduser = Auth::user()->iduser;
        $cek = arsipM::where("iduser", $iduser)->where("idarsip", $idarsip);

        if($cek->count() > 0) {
            $user = User::has("identitas")
            ->where("iduser", "!=", $iduser)->get();

            return view("pages.arsip.bagikan", [
                "user" => $user,
                "idarsip" => $idarsip,
                "arsip" => $cek->first(),
            ]);
        }else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan');




    }
    public function prosesbagikan(Request $request, arsipM $arsipM, $idarsip)
    {
        try{
            $iduser = Auth::user()->iduser;
            $bagikan = bagikanM::where("idarsip", $idarsip)->delete();

            if(count($request->iduser) > 0) {
                foreach ($request->iduser as $item) {
                    $tambah = new bagikanM;
                    $tambah->iduser = $item;
                    $tambah->idarsip = $idarsip;
                    $tambah->save();
                }
            }

            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('warning', 'Telah diproses');
        }

    }
    public function prosesbagikankeseluruhan(Request $request,arsipM $arsipM, $idarsip)
    {
        try{
            $iduser = Auth::user()->iduser;
            $user = User::where("iduser", "!=", $iduser)->get();
            foreach ($user as $item) {
                $tambah = new bagikanM;
                $tambah->iduser = $item->iduser;
                $tambah->idarsip = $idarsip;
                $tambah->save();
            }

            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }

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
            $cek = arsipM::where("iduser", $iduser)->where("idarsip", $idarsip);

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
        // try{
            $iduser = Auth::user()->iduser;
            $cek = arsipM::where("iduser", $iduser)->where("idarsip", $idarsip);

            if($cek->count() > 0) {
                $file = Storage::download($cek->first()->links);
                return $file;
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan');
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('error', 'Terjadi kesalahan');
        // }
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
    public function update(Request $request, arsipM $arsipM, $idarsip)
    {
        $request->validate([
            'namaarsip'=>'required',
            'idketerangan'=>'required',
            'tanggal'=>'required',
        ]);

        // try{
            $data = $request->all();

            if ($request->hasFile('file')) {
                $originalName = $request->file('file')->getClientOriginalName();
                $mimeType = $request->file('file')->getClientMimeType();
                $extension = $request->file('file')->extension();
                $encryptedName = Str::random(40) . '.' . $extension;

                // Simpan berkas dengan nama terenkripsi
                $path = $request->file('file')->storeAs('uploads', $encryptedName);
            }else {
                $arsip = arsipM::where("idarsip", $idarsip)->first();
                $path  = $arsip->links;
                $mimeType = $arsip->mimetype;
            }
            $data["links"] = $path;
            $data["mimetype"] = $mimeType;
            $data["iduser"] = Auth::user()->iduser;

            arsipM::where("idarsip", $idarsip)->first()->update($data);
            return redirect()->back()->with('success', 'Success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\arsipM  $arsipM
     * @return \Illuminate\Http\Response
     */
    public function destroy(arsipM $arsipM, $idarsip)
    {
        try{
            arsipM::where("idarsip", $idarsip)->where("iduser", Auth::user()->iduser)->delete();
            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
