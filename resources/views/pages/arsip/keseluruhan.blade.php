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
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" placeholder="berdasarkan nama keseluruhan" aria-label="berdasarkan nama keseluruhan" aria-describedby="keyword">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                        <i class="fa fa-search"></i> Cari
                    </button>
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
                <th>Nama Berkas Keseluruhan</th>
                <th>Keterangan</th>
                <th>Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($keseluruhan as $item)
                <tr>
                    <td>{{ $loop->iteration + $keseluruhan->firstItem() - 1 }}</td>
                    <td><b>{{ $item->namaarsip }}</b></td>
                    <td>{{ $item->keterangan->keterangan }}</td>
                    <td>
                        {{ $item->user->name }}
                    </td>
                    <td>
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
