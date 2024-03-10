<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class profilC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("pages.profil.profil");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahgambar(Request $request)
    {
        try{
            $request->validate([
                'gambar'=>'required'
            ]);

            if ($request->hasFile("gambar")) {
                $file = $request->gambar;
                $extension = $file->getClientOriginalExtension();
                $ex = strtolower($extension);
                $size = $file->getSize();
                $filename = strtotime(date("Y-m-d H:i:s")).uniqid().".".$extension;

                if($ex == "png" || $ex == "jpg" || $ex == "jpeg") {
                    if($size < 1000000) {
                        $file->move(public_path("gambar"), $filename);

                        $user = Auth::user()->identitas;
                        $user->update([
                            "gambar" => $filename,
                        ]);

                        return redirect()->back()->with('success', 'Success');
                    }else {
                        return redirect()->back()->with('error', 'Maaf size di atas 500Kb');
                    }
                }else {
                    return redirect()->back()->with('error', 'Maaf format bukan gambar');
                }

            }


            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ubahpassword(Request $request)
    {
        $request->validate([
            'password'=>'required|min:6',
            'password2' => 'required|same:password',
        ],[
            "min" => "minimal 6 karakter",
            "required" => "Wajib diisi",
            "same" => "Password tidak sama",
        ]);
        try{


            $password = Hash::make($request->password);
            $user = Auth::user();
            $user->update([
                "password" => $password,
            ]);

            Auth::logout();
            return redirect('login')->with('success', 'Success, Silahkan login kembali');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahnama(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'jk'=>'required',
            'agama'=>'required',
        ]);
        try{

            $nama = $request->name;
            $user = Auth::user();
            $updateUser = $user->update([
                "name" => $nama,
            ]);

            $updateIdentitas = $user->identitas->update([
                "namalengkap" => $nama,
                "email" => $request->email,
                "jk" => $request->jk,
                "agama" => $request->agama,
            ]);

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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
