@extends('layouts.admin')

@section('judul', "Data Keseluruhan Keseluruhan")

@section('keseluruhanActive', 'active')

@section('keseluruhankuActive', 'active')

@section('cari')


<div class="row">
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="keterangan" class="form-control" name="ket" onchange="submit()">
                            <option value="">Semua Keterangan</option>
                            @foreach ($keterangan as $item)
                                <option value="{{ $item->idketerangan }}" @if ($item->idketerangan == $ket)
                                    selected
                                @endif>{{ $item->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="thn" class="form-control" name="thn" onchange="submit()">
                        @foreach ($thn as $item)
                            <option value="{{ $item }}" @if ($item == $tahun)
                                selected
                            @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group m-0">
                        <input class="form-control" type="text" name="keyword" placeholder="berdasarkan nama arsip" aria-label="berdasarkan nama arsip" aria-describedby="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
    </div>
</div>

@endsection


@section('content')
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th width="5px">No</th>
                <th class="text-center">Nama Berkas Keseluruhan</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Pemilik</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($keseluruhan as $item)
                <tr>
                    <td>{{ $loop->iteration + $keseluruhan->firstItem() - 1 }}</td>
                    <td><b>{{ $item->namaarsip }}</b></td>
                    <td>{{ $item->keterangan->keterangan }}</td>
                    <td>
                        {{ $item->user->identitas->namalengkap }}
                    </td>
                    <td nowrap width="5px">
                        <form action="{{ route('downloadKeseluruhan', [$item->idarsip]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="badge badge-success badge-btn border-0">
                                <i class="fa fa-download"></i> Download
                            </button>
                        </form>
                        <a href="{{ route('keseluruhan.show', [$item->idarsip]) }}" class="badge badge-secondary badge-btn border-0">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $keseluruhan->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection
