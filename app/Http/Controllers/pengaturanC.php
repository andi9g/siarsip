<?php

namespace App\Http\Controllers;

use App\Models\keteranganM;
use App\Models\jabatanM;
use App\Models\bagikanM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jabatan = jabatanM::get();
        $keterangan = keteranganM::get();
        return view("pages.pengaturan.pengaturan", [
            "jabatan" => $jabatan,
            "keterangan" => $keterangan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahJabatan(Request $request)
    {
        $request->validate([
            'jabatan'=>'required'
        ]);
        try{
            $data = $request->all();
            jabatanM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahJabatan(Request $request, $idjabatan)
    {
        $request->validate([
            'jabatan'=>'required'
        ]);
        try{
            $data = $request->all();
            jabatanM::where("idjabatan", $idjabatan)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapusJabatan(Request $request, $idjabatan)
    {

        try{
            jabatanM::destroy($idjabatan);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function tambahKeterangan(Request $request)
    {
        $request->validate([
            'keterangan'=>'required'
        ]);
        try{
            $data = $request->all();
            keteranganM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahKeterangan(Request $request, $idketerangan)
    {
        $request->validate([
            'keterangan'=>'required'
        ]);
        try{
            $data = $request->all();
            keteranganM::where("idketerangan", $idketerangan)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapusKeterangan(Request $request, $idketerangan)
    {

        try{
            keteranganM::destroy($idketerangan);
            return redirect()->back()->with('success', 'Success');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keteranganM  $keteranganM
     * @return \Illuminate\Http\Response
     */
    public function show(keteranganM $keteranganM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keteranganM  $keteranganM
     * @return \Illuminate\Http\Response
     */
    public function edit(keteranganM $keteranganM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\keteranganM  $keteranganM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keteranganM $keteranganM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\keteranganM  $keteranganM
     * @return \Illuminate\Http\Response
     */
    public function destroy(keteranganM $keteranganM)
    {
        //
    }
}
