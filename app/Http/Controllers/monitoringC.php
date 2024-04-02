<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\modulajarM;
use App\Models\bagikanmodulajarM;
use Illuminate\Http\Request;
use Auth;
use PDF;

class monitoringC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $user = User::has("identitas")
        ->whereHas("identitas", function ($query) use ($keyword){
            $query->where("namalengkap", "like", "%$keyword%")
            ->where("akses", "!=", "kepsek")
            ->orderBy("namalengkap", "asc");
        })
        ->paginate(15);

        $user->appends($request->only(['limit', 'keyword']));

        return view("pages.kepsek.kepsek", [
            "keyword" => $keyword,
            "user" => $user,
        ]);
    }

    public function berkas(Request $request, $iduser)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $modulajar = modulajarM::where("iduser", $iduser)
        ->where("namamodulajar", "like", "%$keyword%")
        ->orderBy("idmodulajar", 'desc')
        ->paginate(15);

        $modulajar->appends($request->only(['limit', 'keyword']));

        return view("pages.kepsek.berkas", [
            "keyword" => $keyword,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $idmodulajar)
    {
        try{

            $cek = modulajarM::where("idmodulajar", $idmodulajar);

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
