@extends('layouts.admin')

@section('judul', "Data Materi")

@section('materiActive', 'active')

@section('materiActive', 'active')




@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('materi', []) }}" class="badge badge-danger badge-btn">Kembali</a>
        </div>
        <div class="col-md-6 text-right">
            <p><b>{{ $namamapel->namalengkap }}</b></p>

        </div>
    </div>
    <div class="row">
        @foreach ($modul as $item)
            <div class="col-md-12 mb-3">
                <div class="card bg-light">
                    <div class="card-body myhover">
                            <h5 class="card-title text-bold my-1 py-0">
                                <b>{{ $item->namamodulajar }}</b>
                            </h5>
                            <p class="card-text my-0 py-0">
                                {{ $item->mimetype }}
                            </p>
                            <a href="{{ route('materi.show', [$item->idmodulajar]) }}" class="badge badge-btn badge-success px-4 mt-2">
                                <i class="fa fa-eye"></i> Lihat / Download
                            </a>
                        </div>
                    </div>

            </div>



        @endforeach
    </div>

</div>
@endsection
