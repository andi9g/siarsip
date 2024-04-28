@extends('layouts.admin')

@section('judul', "Data Arsipan")

@section('arsipActive', 'active')

@section('arsipkuActive', 'active')

@section('cari')
<div id="tambaharsip" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-arsip" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-arsip">Tambah Data Arsip</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('arsipku.store', []) }}" method="post" id="myFormBerkas" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaarsip">Nama Arsip</label>
                        <input id="namaarsip" class="form-control @error('namaarsip')
                            is-invalid
                        @enderror" type="text" value="{{ old('namaarsip') }}" name="namaarsip" placeholder="masukan nama arsip">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan Arsip</label>
                        <select id="keterangan" required class="form-control" name="idketerangan">
                            <option value="">Pilih Keterangan Arsip</option>
                            @foreach ($keterangan as $item)
                                <option value="{{ $item->idketerangan }}">{{ $item->keterangan }}</option>
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
                    <button type="submit" class="btn btn-success" id="myButton">Tambah Arsip</button>
                </div>

            </form>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambaharsip">Tambah Arsip</button>
    </div>
    <div class="col-md-9">
        <form action="{{ url()->current() }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select id="keterangan" class="form-control" name="ket" onchange="submit()">
                        <option value="">Semua Keterangan</option>
                        @foreach ($keterangan as $item)
                            <option value="{{ $item->idketerangan }}" @if ($item->idketerangan == $ket)
                                selected
                            @endif>{{ $item->keterangan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <select id="thn" class="form-control" name="thn" onchange="submit()">
                    @foreach ($thn as $item)
                        <option value="{{ $item }}" @if ($item == $tahun)
                            selected
                        @endif>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <div class="input-group m-0">
                    <input class="form-control" type="text" name="keyword" placeholder="berdasarkan nama arsip" aria-label="berdasarkan nama arsip" aria-describedby="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
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
                <th class="text-center">Nama Berkas Arsip</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Mime Type</th>
                <th class="text-center">Bagikan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($arsip as $item)
                <tr>
                    <td>{{ $loop->iteration + $arsip->firstItem() - 1 }}</td>
                    <td><b>{{ $item->namaarsip }}</b></td>
                    <td>{{ $item->keterangan->keterangan }}</td>
                    <td>
                        {{ $item->mimetype }}
                    </td>
                    <td nowrap width="5px">
                        <a href="{{ route('bagikan', [$item->idarsip]) }}" class="badge badge-btn badge-primary border-0">
                            <i class="fa fa-share-alt"></i> Bagikan
                        </a>
                    </td>
                    <td nowrap width="5px">
                        <form action="{{ route('downloadArsipku', [$item->idarsip]) }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="badge badge-success badge-btn border-0">
                                <i class="fa fa-download"></i> Download
                            </button>
                        </form>
                        <a href="{{ route('arsipku.show', [$item->idarsip]) }}" class="badge badge-secondary badge-btn border-0 d-inline">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                        <form action='{{ route('arsipku.destroy', [$item->idarsip]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='ml-1 badge badge-danger badge-btn border-0'>
                                 <i class="fa fa-trash"></i>
                             </button>
                        </form>
                        <button class=" badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#edit{{ $item->idarsip }}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </td>
                </tr>

                <div id="edit{{ $item->idarsip }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->idarsip }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="my-modal-title{{ $item->idarsip }}">Ubah Data</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('arsipku.update', [$item->idarsip]) }}" method="post" id="myFormBerkas" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="namaarsip">Nama Arsip</label>
                                        <input id="namaarsip" class="form-control @error('namaarsip')
                                            is-invalid
                                        @enderror" type="text" value="{{ $item->namaarsip }}" name="namaarsip" placeholder="masukan nama arsip">
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan Arsip</label>
                                        <select id="keterangan" required class="form-control" name="idketerangan">
                                            <option value="">Pilih Keterangan Arsip</option>
                                            @foreach ($keterangan as $k)
                                                <option value="{{ $k->idketerangan }}" @if ($item->idketerangan == $k->idketerangan)
                                                    selected
                                                @endif>{{ $k->keterangan }}</option>
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
                                        <small><i>Pastikan upload berkas dibawah 20MB dan format yang di dukung adalah PDF, DOCX dan XLS,</i></small>
                                        <small>
                                            <i>
                                                <font class="text-danger">Jika tidak mau merubah berkas kosongkan inputan File</font>
                                            </i>
                                        </small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" id="myButton">Update Data</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $arsip->links("vendor.pagination.bootstrap-4") }}
</div>
@endsection
