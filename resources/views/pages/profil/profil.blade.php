@extends('layouts.admin')

@section("judul", "Profil")

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-lg text-bold">Gambar</div>
                </div>
                <div class="card-body text-center">
                    <img src="{{ url('gambar', [Auth::user()->identitas->gambar]) }}" width="80%" class="rounded-circle" alt="">
                </div>
                <div class="card-footer">
                    <form action="{{ route('ubah.gambar', []) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" type="file" name="gambar" placeholder="masukan gambar" aria-label="masukan gambar" aria-describedby="ubahgambar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" id="ubahgambar">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="custom-tabs-four-nama-tab"
                                data-toggle="pill"
                                href="#custom-tabs-four-nama"
                                role="tab"
                                aria-controls="custom-tabs-four-nama"
                                aria-selected="true">Nama Lengkap</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="custom-tabs-four-password-tab"
                                data-toggle="pill"
                                href="#custom-tabs-four-password"
                                role="tab"
                                aria-controls="custom-tabs-four-password"
                                aria-selected="false">Password</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div
                            class="tab-pane fade active show "
                            id="custom-tabs-four-nama"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-four-nama-tab">

                            <form action="{{ route('ubah.nama', []) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" class="form-control" type="text" value="{{ Auth::user()->name }}" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input id="jabatan" class="form-control" type="text" disabled value="{{ empty(Auth::user()->identitas->jabatan->jabatan)?'none':Auth::user()->identitas->jabatan->jabatan }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control" type="text" name="email" value="{{ empty(Auth::user()->identitas->email)?'':Auth::user()->identitas->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="kelamin">Kelamin</label><br>
                                    <input type="radio" name="jk" value="L" @if (Auth::user()->identitas->jk == "L")
                                        checked
                                    @endif>
                                    <label for="">Laki - Laki</label>
                                    &emsp;
                                    <input type="radio" name="jk" value="P" @if (Auth::user()->identitas->jk == "P")
                                    checked
                                @endif>
                                    <label for="">Perempuan</label>

                                </div>

                                <div class="form-group">
                                    <label for="my-input">Agama</label>
                                    <select name="agama" id="agama" class="form-control">
                                        <option value="Islam" @if (Auth::user()->identitas->agama == "Islam")
                                            selected
                                        @endif>Islam</option>
                                        <option value="Kristen Protestan" @if (Auth::user()->identitas->agama == "Kristen Protestan")
                                            selected
                                        @endif>Kristen Protestan</option>
                                        <option value="Katolik" @if (Auth::user()->identitas->agama == "Katolik")
                                            selected
                                        @endif>Katolik</option>
                                        <option value="Hindu" @if (Auth::user()->identitas->agama == "Hindu")
                                            selected
                                        @endif>Hindu</option>
                                        <option value="Buddha" @if (Auth::user()->identitas->agama == "Buddha")
                                            selected
                                        @endif>Buddha</option>
                                        <option value="Konghucu" @if (Auth::user()->identitas->agama == "Konghucu")
                                            selected
                                        @endif>Konghucu</option>
                                    </select>
                                </div>




                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">UPDATE</button>
                                </div>
                            </form>


                        </div>
                        <div
                            class="tab-pane fade"
                            id="custom-tabs-four-password"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-four-password-tab">

                            <form action="{{ route('ubah.password', []) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input id="password" class="form-control @error('password')
                                        is-invalid
                                    @enderror" type="password" name="password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password2">Ulangi Password</label>
                                    <input id="password2" class="form-control @error('password2')
                                        is-invalid
                                    @enderror" type="password" name="password2">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">UPDATE</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@endsection
