@extends('layouts.admin')

@section('judul', "Mata Pelajaran")

@section('monitoringActive', 'active')

@section('monitoringActive', 'active')

@section('cari')
<a href="{{ url('monitoring', []) }}" class="badge badge-danger badge-btn mb-3">Kembali</a>
<div class="row">

    <div class="col-md-12">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" value="{{ $keyword }}" name="keyword" placeholder="berdasarkan nama modul" aria-label="berdasarkan nama modul" aria-describedby="keyword">
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
                <th>Nama Modul Ajar</th>
                <th>Ket Berkas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($modulajar as $item)
                <tr>
                    <td>{{ $loop->iteration + $modulajar->firstItem() - 1 }}</td>
                    <th>{{ $item->namamodulajar }}</th>
                    <td>
                        {{ $item->mimetype }}
                    </td>
                    <th>
                        <a href="{{ route('show.berkas', [$item->idmodulajar]) }}" class="badge badge-btn badge-secondary w-100 py-2">
                            <i class="fa fa-eye"></i> Buka Berkas
                        </a>
                    </th>



                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $modulajar->links("vendor.pagination.bootstrap-4") }}
</div>

@endsection


@section('foot')
<script>
    $(document).ready(function() {
        $('.custom-select2').select2({
            scrollAfterSelect: true
        });
    });

</script>
@endsection
