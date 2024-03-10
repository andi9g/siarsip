@extends('layouts.admin')

@section('arsipActive', 'active')
@section('judul', "Arsip yang Dibagikan")

@section('dibagikanActive', 'active')

@section('cari')

<div class="row">
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="berdasarkan nama arsip" aria-label="berdasarkan nama arsip" aria-describedby="keyword">
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
                <th>Nama Berkas Arsip</th>
                <th>Keterangan</th>
                <th>Dibagikan Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arsip as $item)
                <tr>
                    <td>{{ $loop->iteration + $arsip->firstItem() - 1 }}</td>
                    <td class="text-bold"><b>{{ $item->arsip->namaarsip }}</b>
                        @if ($item->ket == 0)
                            <small class="badge badge-btn badge-info">
                                <i>NEW</i>
                            </small>
                        @endif
                    </td>
                    <td>{{ $item->arsip->keterangan->keterangan }}</td>
                    <td>
                        {{ $item->arsip->user->name }}
                    </td>
                    <td>
                        <form action="{{ route('downloadDibagikan', [$item->idarsip]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="badge badge-success badge-btn border-0">
                                <i class="fa fa-download"></i> Download
                            </button>
                        </form>
                        <a href="{{ route('dibagikan.show', [$item->idarsip]) }}" class="badge badge-secondary badge-btn border-0">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $arsip->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection
