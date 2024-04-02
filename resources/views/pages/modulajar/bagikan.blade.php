@extends('layouts.admin')

@section('arsipActive', 'active')
@section('modulajarActive', 'active')


@section('judul', "Bagikan Modul")


@section('content')


<form action="{{ route('bagikan.modulajar.proses', [$idmodulajar]) }}" method="post">
    @csrf
    <label for="">Bagikan Modul Ajar</label>
    <select class="custom-select2 form-control select2-hidden-accessible" multiple style="width: 100%" name="data[]" data-select2-id="4" tabindex="-1" aria-hidden="true">
        @foreach ($jurusan as $j)
            @foreach ($kelas as $k)
                @php
                    $cek = App\Models\bagikanmodulajarM::where("iduser", Auth::user()->iduser)->where("idmodulajar", $idmodulajar)
                    ->where("idkelas", $k->idkelas)
                    ->where("idjurusan", $j->idjurusan)
                    ->count();
                @endphp

            <option value="{{ $j->idjurusan.'-'.$k->idkelas }}" @if ($cek > 0)
                selected
            @endif>
                {{ $k->namakelas.'-'.$j->jurusan }}
            @endforeach

        </option>
        @endforeach
    </select>



    <div class="clearfix mt-4">
        <div class="float-left">
            <a href="{{ url('modulajar', []) }}" class="btn btn-danger btn-sm rounded-0">KEMBALI</a>

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
