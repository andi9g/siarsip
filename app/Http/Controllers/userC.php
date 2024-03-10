<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\jabatanM;
use App\Models\identitasM;
use Illuminate\Http\Request;
use Hash;

class userC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $jabatan = jabatanM::get();


        $user = User::where("name", "like", "%$keyword%")
        ->orderBy("name", "asc")
        ->paginate(10);

        $user->appends($request->only(["limit", "keyword"]));

        return view("pages.user.user", [
            "keyword" => $keyword,
            "jabatan" => $jabatan,
            "user" => $user,
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
            'name'=>'required',
            'username'=>'required',
            'jabatan'=>'required',
            'posisi'=>'required',
        ]);

        try{
            $password = Hash::make("admin".date("Y"));

            $tambah = new User;
            $tambah->name = $request->name;
            $tambah->username = $request->username;
            $tambah->password = $password;
            $tambah->save();

            $identitas = new identitasM;
            $identitas->iduser = $tambah->iduser;
            $identitas->namalengkap = $tambah->name;
            $identitas->idjabatan = $request->idjabatan;
            $identitas->akses = $request->posisi;
            $identitas->save();

            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $iduser)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'jabatan'=>'required',
            'posisi'=>'required',
        ]);

        // try{

            User::where("iduser", $iduser)->first()->update([
                "name" => $request->name,
                "username" => $request->username,
            ]);

            $cek = identitasM::where("iduser", $iduser)->count();
            if($cek == 0) {
                identitasM::create([
                    "iduser" => $iduser,
                    "namalengkap" => $request->name,
                    "idjabatan" => $request->idjabatan,
                    "akses" => $request->posisi,
                ]);
            }

            identitasM::where("iduser", $iduser)->first()->update([
                "iduser" => $iduser,
                "namalengkap" => $request->name,
                "idjabatan" => $request->idjabatan,
                "akses" => $request->posisi,
            ]);


            return redirect()->back()->with('success', 'Success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($iduser)
    {
        // try{
        //     User::where("iduser", $iduser)->delete();
        //     identitasM::where("iduser", $iduser)->delete();
        //     return redirect()->back()->with('success', 'Success');
        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }

        return redirect()->back()->with('error', 'Maaf fitur hapus dihentikan sementara, karena terhubung ke data pengguna sekolah :D');

    }
}
