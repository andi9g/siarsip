@extends('layouts.admin')

@section('judul', "Mata Pelajaran")

@section('mapelActive', 'active')

@section('mapelActive', 'active')

@section('cari')
<div id="tambahmapel" class="modal fade"  role="dialog" aria-labelledby="tambah-mapel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-mapel">Form Tambah Mapel</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mapel.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="iduser">Guru Mapel</label>
                        <select id="iduser" required class="form-control custom-select2" style="width: 100%" name="iduser">
                            <option>Pilih Guru Mapel</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->iduser }}">{{ $item->identitas->namalengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="namamapel">Nama Mapel</label>
                        <input id="namamapel" class="form-control" type="text" name="namamapel">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahmapel">Tambah Modul Ajar</button>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" placeholder="berdasarkan nama mapel" aria-label="berdasarkan nama mapel" aria-describedby="keyword">
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
                <th class="text-center" width="5px">No</th>
                <th class="text-center">Nama Mapel</th>
                <th class="text-center">Guru Mapel</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mapel as $item)
                <tr>
                    <td>{{ $loop->iteration + $mapel->firstItem() - 1 }}</td>
                    <td><b>{{ $item->namamapel }}</b></td>
                    <td>
                        {{ $item->user->identitas->namalengkap }}
                    </td>

                    <td width="5px" nowrap>
                        <form action='{{ route('mapel.destroy', [$item->idmapel]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='mx-1 badge badge-danger badge-btn border-0'>
                                 <i class="fa fa-trash"></i>
                             </button>
                        </form>
                        <button class="mx-1 badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#editmapel{{ $item->idmapel }}"><i class="fa fa-edit"></i>Edit</button>
                    </td>
                </tr>
                <div id="editmapel{{ $item->idmapel }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editmapel{{ $item->idmapel }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editmapel{{ $item->idmapel }}">Edit Data Mapel</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="iduser">Guru Mapel</label>
                                    <select id="iduser" required class="form-control custom-select2" style="width: 100%" name="iduser">
                                        <option>Pilih Guru Mapel</option>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->iduser }}" @if ($u->iduser == $item->iduser)
                                                selected
                                            @endif>{{ $u->identitas->namalengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="namamapel">Nama Mapel</label>
                                    <input id="namamapel" class="form-control" type="text" name="namamapel" value="{{ $item->namamapel }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">EDIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $mapel->links("vendor.pagination.bootstrap-4") }}
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
