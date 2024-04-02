@php
    $iduser = Auth::user()->iduser;
    $dibagikan = App\Models\bagikanM::where("iduser", $iduser)->where("ket", 0)->count();
    if(!empty(Auth::user()->identitas)) {
        $nama = Auth::user()->identitas->namalengkap;
        $gambar = Auth::user()->identitas->gambar;
    }else {
        $nama = Auth::user()->siswa->namalengkap;
        $gambar = Auth::user()->siswa->gambar;
    }
@endphp

<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>
            SIARSIP
        </title>
    <style>
      th td {
        padding: 5px 5px !important;
        margin: 0px !important;
      }
      .myhover:hover {
        background: rgba(136, 175, 252, 0.359) !important;
      }

      #loading {
        z-index: 9999 !important;
      }

    </style>
		<!-- Site favicon -->
{{-- <link
    rel="apple-touch-icon"
    sizes="180x180"
    href="vendors/images/apple-touch-icon.png"/>
<link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="vendors/images/favicon-32x32.png"/>
<link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="vendors/images/favicon-16x16.png"/> --}}

<!-- Mobile Specific Metas -->
<meta
    name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1"/>

    @include('layouts.header')
    @yield('head')

	</head>
	<body class="bg-sm body-sm">
        <div class="cssload-dots" id="loading" style="display: none">
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
        </div>



		<div class="header" style="height: 60px;">
			<div class="header-left">
				<div class="menu-icon bi bi-list m-0 p-0"></div>
			</div>

			<div class="header-right">


				<div class="user-info-dropdown">

          <div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
            <span class="user-icon" style="width:40px;box-shadow:none;height:40px">
              <img src="{{ url('gambar', [ $gambar ]) }}" style="max-height: 40px;width:40px" alt="">
            </span>
							<span class="user-name">{{ $nama }}</span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="{{ url('profil', []) }}"
								><i class="dw dw-user1"></i> Profile</a
							>
							<form action="{{ route('logout', []) }}" method="post">
                @csrf
                <button class="dropdown-item" type="submit">
                    <i class="dw dw-logout"></i>
                    Log Out
                </button >
              </form>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="left-side-bar bg-primary">
			<div class="brand-logo">
				<a href="index.html">
					<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
					{{-- <img
						src="{{ url('gambar', ['user.png']) }}"
						width="40px"
						class="light-logo mr-2"
					/> --}}
                    <b>
                        SIARSIP
                    </b>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">


						<li>
							<a href="{{ url('home', []) }}" class="dropdown-toggle no-arrow @yield('homeActive')">
								<span class="micon fa fa-home"></span
								><span class="mtext">Home</span>
							</a>
						</li>

                        @if (!empty(Auth::user()->siswa))
                        <li>
							<a href="{{ url('materi', []) }}" class="dropdown-toggle no-arrow @yield('materiActive')">
								<span class="micon fa fa-book"></span
								><span class="mtext">Materi</span>
							</a>
						</li>
                        @endif

                        @if (!empty(Auth::user()->identitas))

                        <li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle @yield('arsipActive')">
								<span class="micon fa fa-file-archive-o"></span
								><span class="mtext">Data Arsip</span>
							</a>
							<ul class="submenu">
								<li><a href="{{ url('arsipku', []) }}" class="@yield('arsipkuActive')">Arsipku</a></li>
								<li><a href="{{ url('dibagikan', []) }}" class="@yield('dibagikanActive')">Dibagikan
                                    @if ($dibagikan > 0)
                                    <small class="badge badge-danger border-0 p-1">{{ $dibagikan }}</small>

                                    @endif
                                </a></li>
                                @if ((empty(Auth::user()->identitas->akses)?'':Auth::user()->identitas->akses) == "superadmin")
								<li><a href="{{ url('keseluruhan', []) }}" class="@yield('keseluruhanActive')">Keseluruhan</a></li>
                                @endif
							</ul>
						</li>
                        @if (!empty(Auth::user()->identitas))
                        @if (Auth::user()->identitas->akses == "guru")
                        <li>
							<a href="{{ url('modulajar', []) }}" class="dropdown-toggle no-arrow @yield('modulajarActive')">
								<span class="micon fa fa-graduation-cap"></span
								><span class="mtext">Modul Ajar/RPP</span>
							</a>
						</li>

                        @endif
                        @endif
                        @if (!empty(Auth::user()->identitas))
                        @if (Auth::user()->identitas->akses == "superadmin" || Auth::user()->identitas->akses == "kepsek")
                            <li>
                                <a href="{{ url('monitoring', []) }}" class="dropdown-toggle no-arrow @yield('monitoringActive')">
                                    <span class="micon fa fa-bar-chart"></span
                                    ><span class="mtext">Monitoring Modul/RPP</span>
                                </a>
                            </li>
                        @endif
                        @endif


                        @if ((empty(Auth::user()->identitas->akses)?'':Auth::user()->identitas->akses) == "superadmin")
                        <li>
                            <hr class="bg-light">
							<a href="{{ url('pengaturan', []) }}" class="dropdown-toggle no-arrow @yield('pengaturanActive')">
								<span class="micon bi bi-wrench"></span
								><span class="mtext">Pengaturan</span>
							</a>
						</li>

                        <li>
							<a href="{{ url('user', []) }}" class="dropdown-toggle no-arrow @yield('userActive')">
								<span class="micon fa fa-user"></span
								><span class="mtext">Data Pengolah</span>
							</a>
						</li>
                        <li>
							<a href="{{ url('siswa', []) }}" class="dropdown-toggle no-arrow @yield('siswaActive')">
								<span class="micon fa fa-users"></span
								><span class="mtext">Data Siswa</span>
							</a>
						</li>
                        <li>
							<a href="{{ url('mapel', []) }}" class="dropdown-toggle no-arrow @yield('mapelActive')">
								<span class="micon fa fa-book"></span
								><span class="mtext">Mata Pelajaran</span>
							</a>
						</li>
                        @endif


                        @endif
					</ul>
				</div>
			</div>
		</div>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
      <div class="page-header mb-2">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>@yield('judul')</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">

              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{ url('home', []) }}">Home</a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                  @yield('judul')
                </li>

              </ol>

            </nav>
          </div>



        </div>


      </div>

      <div class="my-2">
        @yield('kembali')
      </div>

      <div class="pd-20 card-box mb-10">
            @yield('cari')

			@yield('content')

      </div>
        <div class="">
            @yield('content2')

        </div>

		</div>

		@include('layouts.footer')
    @include('sweetalert::alert')
    @yield('foot')
	</body>
</html>
