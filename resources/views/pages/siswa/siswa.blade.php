@extends('layouts.admin')

@section('siswaActive', 'active')
@section('judul', "Data Siswa")

@section('cari')
<div id="tambahsiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-siswa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-siswa">Data Siswa</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('siswa.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nis">Nomor Induk Siswa (NIS)</label>
                        <input id="nis" class="form-control" type="number" name="nis">
                    </div>
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input id="namalengkap" class="form-control" type="text" name="namalengkap">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" class="form-control" name="idkelas">
                            @foreach ($kelas as $k)
                                <option value="{{ $k->idkelas }}">{{ $k->namakelas }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select id="jurusan" class="form-control" name="idjurusan">
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->idjurusan }}">{{ $j->jurusan }}</option>

                            @endforeach
                        </select>
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
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahsiswa">Tambah</button>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="berdasarkan nama" aria-label="berdasarkan nama arsip" aria-describedby="keyword">
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
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Rombel</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                    <td class="text-bold"><b>{{ $item->nis }}</b>
                    <td class="text-bold"><b>{{ $item->namalengkap }}</b>
                    </td>
                    <td>{{ $item->kelas->namakelas }} - {{ $item->jurusan->jurusan }}</td>
                    <td>
                        <form action='{{ route('siswa.destroy', [$item->idsiswa]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('Setuju untuk menghapus data siswa?')" class='badge badge-danger badge-btn border-0'>
                                 <i class="fa fa-trash"></i>
                             </button>
                        </form>
                        <button class="badge badge-info badge-btn border-0 d-inline" type="button" data-toggle="modal" data-target="#editsiswa{{ $item->idsiswa }}">
                            <i class="fa fa-edit"></i> Ubah
                        </button>
                        <form action='{{ route('reset.siswa', [$item->idsiswa]) }}' method='post' class='d-inline'>
                            @csrf
                            <button type='submit' onclick="return confirm('reset password?')" class='badge badge-secondary badge-btn border-0'>
                                <i class="fa fa-key"></i> Reset Pas.
                            </button>
                       </form>
                    </td>
                </tr>
                <div id="editsiswa{{ $item->idsiswa }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->idsiswa }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title{{ $item->idsiswa }}">Edit Data {{ $item->namalengkap }}</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('siswa.update', [$item->idsiswa]) }}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nis">Nomor Induk Siswa (NIS)</label>
                                        <input id="nis" class="form-control" type="number" name="nis" value="{{ $item->nis }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="namalengkap">Nama Lengkap</label>
                                        <input id="namalengkap" class="form-control" type="text" name="namalengkap" value="{{ $item->namalengkap }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select id="kelas" class="form-control" name="idkelas">
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->idkelas }}" @if ($k->idkelas == $item->idkelas)
                                                    selected
                                                @endif>{{ $k->namakelas }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <select id="jurusan" class="form-control" name="idjurusan">
                                            @foreach ($jurusan as $j)
                                                <option value="{{ $j->idjurusan }}" @if ($j->idjurusan == $item->idjurusan)
                                                    selected
                                                @endif>{{ $j->jurusan }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">EDIT Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $siswa->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection
