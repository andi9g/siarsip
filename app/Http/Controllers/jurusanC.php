<?php

namespace App\Http\Controllers;

use App\Models\jurusanM;
use Illuminate\Http\Request;

class jurusanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('pengaturan');
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
     * @param  \App\Models\jurusanM  $jurusanM
     * @return \Illuminate\Http\Response
     */
    public function show(jurusanM $jurusanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jurusanM  $jurusanM
     * @return \Illuminate\Http\Response
     */
    public function edit(jurusanM $jurusanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jurusanM  $jurusanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jurusanM $jurusanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jurusanM  $jurusanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(jurusanM $jurusanM)
    {
        //
    }
}
