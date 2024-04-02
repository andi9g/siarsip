<?php

namespace App\Http\Controllers;

use App\Models\modulajarM;
use App\Models\bagikanmodulajarM;
use App\Models\User;
use App\Models\jurusanM;
use App\Models\mapelM;
use App\Models\kelasM;
use Illuminate\Http\Request;
use Auth;
use Str;

class modulajarC extends Controller
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
        $modulajar = modulajarM::where("iduser", $iduser)
        ->where("iduser", "like", "%$keyword%")
        ->paginate(15);

        $modulajar->appends($request->only(['limit', 'keyword']));
        $mapel = mapelM::where("iduser", $iduser)->get();

        return view("pages.modulajar.modulajar", [
            "keyword" => $keyword,
            "mapel" => $mapel,
            "modulajar" => $modulajar,
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
            'namamodulajar'=>'required',
            'file'=>'required|mimes:png,jpg,pdf,pdf,docx,xls,mp4,pptx|file',
            'tanggal'=>'required',
        ]);

        // try{
            $data = $request->all();

            if ($request->file('file')->isValid()) {
                $originalName = $request->file('file')->getClientOriginalName();
                $mimeType = $request->file('file')->getClientMimeType();
                $extension = $request->file('file')->extension();
                $encryptedName = Str::random(40) . '.' . $extension;

                // Simpan berkas dengan nama terenkripsi
                $path = $request->file('file')->storeAs('uploads/modulajar', $encryptedName);
            }
            $data["links"] = $path;
            $data["mimetype"] = $mimeType;
            $data["iduser"] = Auth::user()->iduser;

            modulajarM::create($data);
            return redirect()->back()->with('success', 'Success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
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
            $iduser = Auth::user()->iduser;
            $cek = modulajarM::where("iduser", $iduser)->where("idmodulajar", $idmodulajar);

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

    public function bagikan($idmodulajar)
    {
        $iduser = Auth::user()->iduser;
        $cek = modulajarM::where("iduser", $iduser)->where("idmodulajar", $idmodulajar);
        $jurusan = jurusanM::get();
        $kelas = kelasM::get();
        if($cek->count() > 0) {
            $user = User::has("siswa")
            ->with("siswa")->get();

            // dd($user);
            return view("pages.modulajar.bagikan", [
                "user" => $user,
                "jurusan" => $jurusan,
                "kelas" => $kelas,
                "idmodulajar" => $idmodulajar,
                "arsip" => $cek->first(),
            ]);
        }else {
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan');

    }

    public function prosesbagikan(Request $request, $idmodulajar)
    {
        // try{
            $iduser = Auth::user()->iduser;
            $data = $request->data;

            bagikanmodulajarM::where("idmodulajar", $idmodulajar)->where("iduser", $iduser)->delete();
            if(!empty($data)) {

                foreach ($data as $d) {
                    $ex = explode("-", $d);

                    $tambah = new bagikanmodulajarM;
                    $tambah->idmodulajar = $idmodulajar;
                    $tambah->idjurusan = $ex[0];
                    $tambah->idkelas = $ex[1];
                    $tambah->iduser = $iduser;
                    $tambah->save();

                }
            }

            return redirect()->back()->with('success', 'Success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('error', 'Terjadi kesalahan');
        // }

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
