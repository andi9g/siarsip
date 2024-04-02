@extends('layouts.admin')

@section('judul', "Data Materi")

@section('materiActive', 'active')

@section('materiActive', 'active')

@section('cari')


<div class="row">
    <div class="col-md-6">
        <center>
            <h1 class="text-secondary">{{ Auth::user()->siswa->kelas->namakelas." - ".Auth::user()->siswa->jurusan->jurusan }}</h1>
        </center>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" placeholder="berdasarkan mata pelajaran" aria-label="berdasarkan nama mapel" aria-describedby="keyword" value="{{ $keyword }}">
                <div class="input-group-append" >
                    <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content2')
<div class="container-fluid">
    <div class="row">
        @foreach ($mapel as $item)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body myhover">
                        <a href="{{ route('lihat.mapel', [$item->idmapel]) }}" class="hover">
                            <h5 class="card-title text-bold my-1 py-0">
                                <b>{{ $item->namamapel }}</b>
                            </h5>
                            <p class="card-text my-0 py-0">
                                {{ $item->namalengkap }}
                            </p>
                        </a>
                        </div>
                    </div>

            </div>



        @endforeach
    </div>

</div>
@endsection
