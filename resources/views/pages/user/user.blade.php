@extends('layouts.admin')

@section('userActive', 'active')

@section('judul', "Data Pengguna")


@section('cari')
    <div id="tambahpengguna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-pengguna" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-pengguna">Tambah Pengguna</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input id="name" class="form-control" placeholder="namalengkap" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" class="form-control" placeholder="username" type="text" name="username">
                            <small class="text-danger"><i>password default adalah : admin{{ date('Y') }}, dapat dirubah setelah login</i></small>
                        </div>

                        <hr>

                        <div class='form-group'>
                            <label for='forjabatan' class='text-capitalize'>Jabatan</label>
                            <select name='idjabatan' required id='forjabatan' class='form-control'>
                                <option value=''>Pilih</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->idjabatan }}">{{ ucwords($item->jabatan) }}</option>
                                @endforeach
                            <select>
                        </div>
                        <div class='form-group'>
                            <label for='forposisi' class='text-capitalize'>Posisi</label>
                            <select name='posisi' required id='forposisi' class='form-control'>
                                <option value='user'>User</option>
                                <option value='admin'>Admin</option>
                            <select>
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
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahpengguna">Tambah Pengguna</button>

        </div>
        <div class="col-md-6">
            <form action="{{ url()->current() }}">
                <div class="input-group m-0">
                    <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="berdasarkan nama" aria-label="berdasarkan nama" aria-describedby="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-secondary text-white" id="keyword">
                            <i class="fa fa-search"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection


@section('content')
<div class="table-responsive mt-3">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th width="5px">No</th>
                <th>Nama User</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $loop->iteration + $user->firstItem() - 1 }}</td>
                    <td>{{ ucwords($item->name) }}</td>
                    <td>
                        @if (Hash::check("admin".date("Y"), $item->password))
                            Default
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <form action='{{ route('user.destroy', [$item->iduser]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('hapus data user?')" class='badge badge-danger badge-btn border-0'>
                                 <i class="fa fa-trash"></i> Hapus
                             </button>
                        </form>

                        <button class="badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#edituser{{ $item->iduser }}">
                        <i class="fa fa-edit"></i>
                        Edit
                        </button>
                    </td>
                </tr>
                <div id="edituser{{ $item->iduser }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-data" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit-data">Edit Data</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('user.update', [$item->iduser]) }}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input id="name" class="form-control" placeholder="namalengkap" value="{{ $item->name }}" type="text" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" class="form-control" placeholder="username" value="{{ $item->username }}" type="text" name="username">
                                        <small class="text-danger"><i>password default adalah : admin{{ date('Y') }}, dapat dirubah setelah login</i></small>
                                    </div>

                                    <hr>

                                    <div class='form-group'>
                                        <label for='forjabatan' class='text-capitalize'>Jabatan</label>
                                        <select name='idjabatan' required id='forjabatan' class='form-control'>
                                            <option value=''>Pilih</option>
                                            @foreach ($jabatan as $i)
                                                <option value="{{ $i->idjabatan }}" @if ($i->idjabatan == $item->identitas->idjabatan)
                                                    selected
                                                @endif>{{ ucwords($i->jabatan) }}</option>
                                            @endforeach
                                        <select>
                                    </div>
                                    <div class='form-group'>
                                        <label for='forposisi' class='text-capitalize'>Posisi</label>
                                        <select name='posisi' required id='forposisi' class='form-control'>
                                            <option value='user' @if ($item->identitas->akses == "user")
                                                selected
                                            @endif>User</option>
                                            <option value='admin'  @if ($item->identitas->akses == "admin")
                                                selected
                                            @endif>Admin</option>
                                        <select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $user->links("vendor.pagination.bootstrap-4") }}
</div>

@endsection
