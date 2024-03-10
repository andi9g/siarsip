@extends('layouts.admin')

@section('arsipActive', 'active')
@section('arsipkuActive', 'active')


@section('judul', $arsip->namaarsip)


@section('content')

<form action="{{ route('proses.bagikan.keseluruhan', [$idarsip]) }}" method="post">
    @csrf
    <button type="submit" class="btn btn-warning btn-sm rounded-0 px-3 mb-4" onclick="return confirm('yakin ingin dibagikan kepada semua user?')">Bagikan ke Semua User</button>
</form>

<form action="{{ route('proses.bagikan', [$idarsip]) }}" method="post">
    @csrf
    <select class="custom-select2 form-control select2-hidden-accessible" multiple style="width: 100%" name="iduser[]" data-select2-id="4" tabindex="-1" aria-hidden="true">
        @foreach ($user as $item)
        @php
            $cek = App\Models\bagikanM::where("iduser", $item->iduser)->where("idarsip", $idarsip)->count();
        @endphp
            <option value="{{ $item->iduser }}" @if ($cek > 0)
                selected
            @endif>
                {{ $item->name }}
        </option>
        @endforeach
    </select>

    <div class="clearfix mt-4">
        <div class="float-left">
            <a href="{{ url('arsipku', []) }}" class="btn btn-danger btn-sm rounded-0">KEMBALI</a>

        </div>
        <div class="float-right">
            <button type="submit" class="btn btn-success btn-sm rounded-0">BAGIKAN ARSIP</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.custom-select2').select2({
            scrollAfterSelect: true
        });
    });
</script>
@endsection
