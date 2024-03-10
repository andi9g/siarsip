@extends('layouts.admin')

@section('homeActive', 'active')

@section('judul', "welcome")

@section('kembali')
@if ((empty(Auth::user()->identitas->akses)?'':Auth::user()->identitas->akses) == "admin")
<div class="row pb-10 mt-3">
    <div class="col-xl-3 col-lg-6 col-md-6 mt-3 ">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $arsip }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Arsip
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="icon-copy fa fa-file-archive-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mt-3 ">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $user }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Jumlah Account
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                        <span class="icon-copy fa fa-users"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 mt-3 ">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $arsipku }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Arsipku
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="icon-copy fa fa-file-archive-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mt-3 ">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $bagikan }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Dibagikan Ke Saya
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                        <span class="icon-copy fa fa-share-alt"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@else
<div class="row pb-10 mt-3">
<div class="col-xl-6 col-lg-6 col-md-6 mt-3 ">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ $arsipku }}</div>
                <div class="font-14 text-secondary weight-500">
                    Arsipku
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                    <i class="icon-copy fa fa-file-archive-o"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 mt-3 ">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ $bagikan }}</div>
                <div class="font-14 text-secondary weight-500">
                    Dibagikan Ke Saya
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                    <span class="icon-copy fa fa-share-alt"></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
@endsection

@section('content')

    <center>
        <h2>SELAMAT DATANG</h2>
    </center>


@endsection
