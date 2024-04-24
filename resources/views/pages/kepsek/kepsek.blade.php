@extends('layouts.admin')

@section('judul', "Monitoring Modul Guru")

@section('monitoringActive', 'active')

@section('monitoringActive', 'active')

@section('cari')


<div class="row">
    <div class="col-md-12">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" value="{{ $keyword }}" name="keyword" placeholder="berdasarkan nama mapel" aria-label="berdasarkan nama mapel" aria-describedby="keyword">
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
            <tr class="py-0 my-0">
                <th width="5px" class="text-center">No</th>
                <th class="text-center">Nama Guru</th>
                <th class="text-center" width="10px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $loop->iteration + $user->firstItem() - 1 }}</td>
                    <td><b><a href="">{{ $item->identitas->namalengkap }}</a></b></td>
                    <th>
                        <a href="{{ route('lihatberkas', [$item->iduser]) }}" class="badge badge-btn badge-success">
                            <i class="fa fa-eye"></i> Detail Berkas
                        </a>
                    </th>



                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $user->links("vendor.pagination.bootstrap-4") }}
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
