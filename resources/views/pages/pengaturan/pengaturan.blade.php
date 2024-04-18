@extends('layouts.admin')

@section("pengaturanActive", "active")

@section("judul", "Pengaturan")

@section('content')
<div id="tambahjabatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-jabatan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-jabatan">Tambah Jabatan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambahJabatan', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jabatan">Nama Jabatan</label>
                        <input id="jabatan" class="form-control" type="text" name="jabatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="tambahketerangan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-keterangan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-keterangan">Tambah Jabatan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambahKeterangan', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="keterangan">Nama Keterangan</label>
                        <input id="keterangan" class="form-control" type="text" name="keterangan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="tambahjurusan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-keterangan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-keterangan">Tambah Jabatan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambahJurusan', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input id="jurusan" class="form-control" type="text" name="jurusan" placeholder="contoh : TKJ">
                    </div>
                    <div class="form-group">
                        <label for="namajurusan">Kepanjangan</label>
                        <input id="namajurusan" class="form-control" type="text" name="namajurusan" placeholder="contoh : Teknik Komputer Jaringan">
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
        <div class="col-md-6 mb-3">
            <div class="card ">
                <div class="card-header"><div class="card-title p-0 m-0">JABATAN</div></div>
                <div class="card-body table-responsive">
                    <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal" data-target="#tambahjabatan">Tambah Jabatan</button>

                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Jabatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td width="5px">{{ $loop->iteration }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td nowrap width="5px">
                                        <form action='{{ route('hapusJabatan', [$item->idjabatan]) }}' method='post' class='d-inline'>
                                             @csrf
                                             @method('DELETE')
                                             <button type='submit' onclick="return confirm('yakin ingin dihapus!')" class='badge badge-danger badge-btn border-0'>
                                                 <i class="fa fa-trash"></i>
                                             </button>
                                        </form>

                                        <button class="badge badge-btn border-0 badge-info" type="button" data-toggle="modal" data-target="#ubahjabatan{{ $item->idjabatan }}">
                                            <i class="fa fa-edit"></i> Ubah
                                        </button>
                                    </td>
                                </tr>

                                <div id="ubahjabatan{{ $item->idjabatan }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->idjabatan }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="my-modal-title{{ $item->idjabatan }}">Ubah Jabatan</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('ubahJabatan', [$item->idjabatan]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="jabatan">Nama Jabatan</label>
                                                        <input id="jabatan" class="form-control" value="{{ $item->jabatan }}" type="text" name="jabatan">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>





        <div class="col-md-6 mb-3">
            <div class="card ">
                <div class="card-header"><div class="card-title p-0 m-0">KETERANGAN BERKAS</div></div>
                <div class="card-body table-responsive">
                    <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal" data-target="#tambahketerangan">Tambah ket. Berkas</button>

                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ket. Berkas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($keterangan as $item)
                                <tr>
                                    <td width="5px">{{ $loop->iteration }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <form action='{{ route('hapusKeterangan', [$item->idketerangan]) }}' method='post' class='d-inline'>
                                             @csrf
                                             @method('DELETE')
                                             <button type='submit' onclick="return confirm('yakin ingin dihapus!')" class='badge badge-danger badge-btn border-0'>
                                                 <i class="fa fa-trash"></i>
                                             </button>
                                        </form>

                                        <button class="badge badge-btn border-0 badge-info" type="button" data-toggle="modal" data-target="#ubahketerangan{{ $item->idketerangan }}">
                                            <i class="fa fa-edit"></i> Ubah
                                        </button>
                                    </td>
                                </tr>

                                <div id="ubahketerangan{{ $item->idketerangan }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->idketerangan }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="my-modal-title{{ $item->idketerangan }}">Ubah Keterangan</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('ubahKeterangan', [$item->idketerangan]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="keterangan">Nama Keterangan</label>
                                                        <input id="keterangan" class="form-control" value="{{ $item->keterangan }}" type="text" name="keterangan">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card ">
                <div class="card-header"><div class="card-title p-0 m-0">JURUSAN</div></div>
                <div class="card-body table-responsive">
                    <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal" data-target="#tambahjurusan">Tambah Jurusan</button>

                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jurusan</th>
                                <th>Kepanjangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jurusan as $item)
                                <tr>
                                    <td width="5px">{{ $loop->iteration }}</td>
                                    <td>{{ $item->jurusan }}</td>
                                    <td>{{ $item->namajurusan }}</td>
                                    <td>
                                        <form action='{{ route('hapusJurusan', [$item->idjurusan]) }}' method='post' class='d-inline'>
                                             @csrf
                                             @method('DELETE')
                                             <button type='submit' onclick="return confirm('yakin ingin dihapus!')" class='badge badge-danger badge-btn border-0'>
                                                 <i class="fa fa-trash"></i>
                                             </button>
                                        </form>

                                        <button class="badge badge-btn border-0 badge-info" type="button" data-toggle="modal" data-target="#ubahjurusan{{ $item->idjurusan }}">
                                            <i class="fa fa-edit"></i> Ubah
                                        </button>
                                    </td>
                                </tr>

                                <div id="ubahjurusan{{ $item->idjurusan }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->idjurusan }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="my-modal-title{{ $item->idjurusan }}">Ubah Jurusan</h5>
                                                <button class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('ubahJurusan', [$item->idjurusan]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="jurusan">Nama Jurusan</label>
                                                        <input id="jurusan" class="form-control" value="{{ $item->jurusan }}" type="text" name="jurusan">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="namajurusan">Nama Keterangan</label>
                                                        <input id="namajurusan" class="form-control" type="text" value="{{ $item->namajurusan }}" name="namajurusan">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
