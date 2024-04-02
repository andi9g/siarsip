<?php

namespace App\Http\Controllers;

use App\Models\siswaM;
use App\Models\User;
use App\Models\jurusanM;
use App\Models\kelasM;
use Hash;
use Illuminate\Http\Request;

class siswaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $siswa = siswaM::where("namalengkap", "like", "%$keyword%")
        ->orderBy("idkelas", "asc")
        ->orderBy("namalengkap", "asc")
        ->paginate(15);
        $jurusan = jurusanM::get();
        $kelas = kelasM::get();

        return view("pages.siswa.siswa", [
            "keyword" => $keyword,
            "siswa" => $siswa,
            "jurusan" => $jurusan,
            "kelas" => $kelas,
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
        try{

            $akun = new User;
            $akun->username = sprintf("%03s", $request->nis);
            $akun->password = Hash::make("siswa".date("Y"));
            $akun->save();

            $data = $request->all();
            $data["iduser"] = $akun->iduser;
            $data["nis"] = sprintf("%03s", $request->nis);

            siswaM::create($data);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function show(siswaM $siswaM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function edit(siswaM $siswaM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswaM $siswaM, $idsiswa)
    {
        try{
            $siswa = siswaM::where("idsiswa", $idsiswa)->first();


            User::where("iduser", $siswa->iduser)->first()->update([
                "nis" => sprintf("%03s", $request->nis),
            ]);

            $data = $request->all();
            $data["iduser"] = $siswa->iduser;
            $data["nis"] = sprintf("%03s", $request->nis);

            $siswa->update($data);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */

     public function resetpassword(siswaM $siswaM, $idsiswa)
     {
         try{
             $siswa = siswaM::where("idsiswa", $idsiswa)->first();

             $password = Hash::make("siswa".date("Y"));

             User::where("iduser", $siswa->iduser)->update([
                "password" => $password,
             ]);

             return redirect()->back()->with('success', 'Success');
         }catch(\Throwable $th){
             return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
         }
     }

    public function destroy(siswaM $siswaM, $idsiswa)
    {
        try{
            $siswa = siswaM::where("idsiswa", $idsiswa)->first();

            User::where("iduser", $siswa->iduser)->delete();

            siswaM::destroy($idsiswa);

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
