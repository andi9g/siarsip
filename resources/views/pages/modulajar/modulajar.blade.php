@extends('layouts.admin')

@section('judul', "Data Modul Ajaran")

@section('modulajarActive', 'active')

@section('modulajarActive', 'active')

@section('cari')
<div id="tambahmodulajar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-modulajar" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-modulajar">Tambah Data Modul Ajar</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('modulajar.store', []) }}" method="post" id="myFormBerkas" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namamodulajar">Nama Modul Ajar</label>
                        <input id="namamodulajar" class="form-control @error('namamodulajar')
                            is-invalid
                        @enderror" type="text" value="{{ old('namamodulajar') }}" name="namamodulajar" placeholder="masukan nama modulajar">
                    </div>

                    <div class="form-group">
                        <label for="idmapel">Guru Mapel</label>
                        <select id="idmapel" required class="form-control custom-select2" style="width: 100%" name="idmapel">
                            <option disabled selected>Pilih Nama Mapel</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->idmapel }}">{{ $m->namamapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Berkas</label>
                        <input id="tanggal" class="form-control @error('tanggal')
                            is-invalid
                        @enderror" value="{{ empty(old('tanggal'))?date('Y-m-d'):old('tanggal') }}" type="date" name="tanggal">
                    </div>

                    <div class="form-group">
                        <label for="file">Masukan File</label>
                        <input id="file" class="form-control" type="file" name="file">
                        <small><i>Pastikan upload berkas dibawah 20MB dan format yang di dukung adalah PDF, DOCX dan XLS</i></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="myButton">Tambah Modul Ajar</button>
                </div>

            </form>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahmodulajar">Tambah Modul Ajar</button>
    </div>
    <div class="col-md-6">
        <form action="{{ url()->current() }}">
            <div class="input-group m-0">
                <input class="form-control" type="text" name="keyword" placeholder="berdasarkan nama modulajar" aria-label="berdasarkan nama modulajar" aria-describedby="keyword">
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
                <th class="text-center">Nama Berkas Modul Ajar</th>
                <th class="text-center">Mime Type</th>
                <th class="text-center">Mapel</th>
                <th class="text-center">Bagikan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($modulajar as $item)
                <tr>
                    <td>{{ $loop->iteration + $modulajar->firstItem() - 1 }}</td>
                    <td><b>{{ $item->namamodulajar }}</b></td>
                    {{-- <td>{{ $item->keterangan->keterangan }}</td> --}}
                    <td>
                        {{ $item->mimetype }}
                    </td>
                    <th>
                        {{ $item->mapel->namamapel }}
                    </th>
                    <td nowrap width="5px">
                        <a href="{{ route('bagikan.modulajar', [$item->idmodulajar]) }}" class="badge badge-btn badge-primary border-0">
                            <i class="fa fa-share-alt"></i> Bagikan
                        </a>
                    </td>
                    <td nowrap width="5px">
                        <a href="{{ route('modulajar.show', [$item->idmodulajar]) }}" class="badge badge-secondary badge-btn border-0 d-inline">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                        <form action='{{ route('modulajar.destroy', [$item->idmodulajar]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='ml-1 badge badge-danger badge-btn border-0'>
                                 <i class="fa fa-trash"></i>
                             </button>
                        </form>
                        <button class="ml-1 badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#ubahmodul{{ $item->idmodulajar }}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </td>
                </tr>
                <div id="ubahmodul{{ $item->idmodulajar }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-modulajar{{ $item->idmodulajar }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-modulajar{{ $item->idmodulajar }}">Ubah Data</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('modulajar.update', [$item->idmodulajar]) }}" method="post" id="myFormBerkas" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="namamodulajar">Nama Modul Ajar</label>
                                        <input id="namamodulajar" class="form-control @error('namamodulajar')
                                            is-invalid
                                        @enderror" type="text" value="{{ $item->namamodulajar }}" name="namamodulajar" placeholder="masukan nama modulajar">
                                    </div>

                                    <div class="form-group">
                                        <label for="idmapel">Guru Mapel</label>
                                        <select id="idmapel" required class="form-control custom-select2" style="width: 100%" name="idmapel">
                                            <option disabled selected>Pilih Nama Mapel</option>
                                            @foreach ($mapel as $m)
                                                <option value="{{ $m->idmapel }}" @if ($item->idmapel == $m->idmapel)
                                                    selected
                                                @endif>{{ $m->namamapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Berkas</label>
                                        <input id="tanggal" class="form-control @error('tanggal')
                                            is-invalid
                                        @enderror" value="{{ $item->tanggal }}" type="date" name="tanggal">
                                    </div>

                                    <div class="form-group">
                                        <label for="file">Masukan File</label>
                                        <input id="file" class="form-control" type="file" name="file">
                                        <small><i>Pastikan upload berkas dibawah 20MB dan format yang di dukung adalah PDF, DOCX dan XLS</i></small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" id="myButton">Ubah Modul Ajar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $modulajar->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection
