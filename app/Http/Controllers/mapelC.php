<?php

namespace App\Http\Controllers;

use App\Models\mapelM;
use App\Models\User;
use Illuminate\Http\Request;

class mapelC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $user = User::has("identitas")->get();

        $mapel = mapelM::where("namamapel", "like", "%$keyword%")
        ->orderBy("namamapel", "asc")
        ->paginate(15);

        $mapel->appends($request->only(['limit', 'keyword']));

        return view("pages.mapel.mapel", [
            "keyword" => $keyword,
            "mapel" => $mapel,
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
        try{
            $data = $request->all();
            mapelM::create($data);
            return redirect()->back()->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mapelM  $mapelM
     * @return \Illuminate\Http\Response
     */
    public function show(mapelM $mapelM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mapelM  $mapelM
     * @return \Illuminate\Http\Response
     */
    public function edit(mapelM $mapelM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mapelM  $mapelM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mapelM $mapelM, $idmapel)
    {
        try{
            $data = $request->all();
            mapelM::where("idmapel", $idmapel)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mapelM  $mapelM
     * @return \Illuminate\Http\Response
     */
    public function destroy(mapelM $mapelM, $idmapel)
    {
        try{
            mapelM::destroy($idmapel);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
