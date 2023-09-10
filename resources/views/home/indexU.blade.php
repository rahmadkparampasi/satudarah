<!DOCTYPE html>
<html lang="en">

<head>
    <title>SATU DARAH | REGISTRASI</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="keywords" content="Satu Darah"/>
    <meta name="description" content="Sistem Akomodasi Terpadu Donor Darah Kabupaten Parigi Moutong"/>
    <meta name="copyright"content="Pemerintah Daerah Kabupaten Parigi Moutong">
    <meta name="og:image" content="/assets/img/Logo-L-1.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    
    <meta name="author" content="Pemerintah Daerah Kabupaten Parigi Moutong" />
	<!-- Favicon icon -->
    <link rel="icon" href="/logo.png" type="image/png" />

	<!-- vendor css -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500" rel="stylesheet">
		
    <link rel="stylesheet" href="/vendors/include/home/css/linearicons.css">
    <link rel="stylesheet" href="/vendors/include/home/css/owl.carousel.css">
    <link rel="stylesheet" href="/vendors/include/home/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendors/include/home/css/nice-select.css">
    <link rel="stylesheet" href="/vendors/include/home/css/magnific-popup.css">
    <link rel="stylesheet" href="/vendors/include/home/css/bootstrap.css">
    <link rel="stylesheet" href="/vendors/include/home/css/main.css">
    <link rel="stylesheet" href="/vendors/include/loading.css" media="all">
    <!-- DataTables -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/datatables.min.css" />
   
    <script src="/vendors/script/jquery/3.1.1/jquery.min.js"></script>
   
</head>

<body class="dup-body">
    <div class="dup-body-wrap">
        <!-- Start Header Area -->
        <header class="default-header bg-white">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{url('')}}"><img src="/assets/img/Parigi_Moutong.png" height="50" alt=""></a>
                        <a href="{{url('')}}"><img src="/assets/img/logo-rs.png" height="50" alt=""></a>
                        <a href="{{url('')}}"><img src="/assets/img/pmi.png" height="50" alt=""></a>
                    </div>
                    <div class="main-menubar d-flex align-items-center">
                        <nav class="hide">
                            <a href="{{url('login/logout')}}">KELUAR</a>
                        </nav>
                        <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header Area -->
        <section class="generic-banner element-banner relative">
			<div class="container">
				<div class="row height align-items-center justify-content-center">
					<div class="col-lg-10">
						<div class="banner-content text-center">
							<h2 class="text-white">Hallo!</h2>
							<h3 class="text-white" >Selamat Datang {{$Prsn->prsn_nm}}</h3>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="sample-text-area">
			<div class="container">
                <div class="card mb-20">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-1">Data Personal
                                    
                                    <span class="badge badge-info font-weight-bold f-20" style="font-size: 20px">{{$Prsn->total}}</span>
                                </h4>
                            </div>
                            <div class="col">
                                <h1 class="mb-1 text-right font-weight-bold text-danger">{{$Prsn->gol_nm}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">ID</label>
                            <div class="col-sm-9">
                                <p><strong>{{$Prsn->prsn_kd}}</strong> &nbsp&nbsp&nbsp
                                    @if ($Prsn->prsn_bc!="")
                                        <a href="{{route('printCard', [$token])}}" target="_blank" class="btn btn-info text-white"><i class="fa fa-id-card text-white"></i> KARTU DONOR</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Nama</label>
                            <div class="col-sm-9">
                                {{ucwords(strtolower(stripslashes($Prsn->prsn_nm)))}}
                            </div>
                        </div>
                        <hr/>
                        
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Kontak</label>
                            <div class="col-sm-9">
                                {{$Prsn->prsn_telp}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">TTL/Umur</label>
                            <div class="col-sm-9">
                                {{$Prsn->prsn_tmptlhr}}, {{$Prsn->prsn_tgllhrAltT}}<br/>
                                Umur: {{$Prsn->umur}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                {{$Prsn->prsn_jkAltT}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Pekerjaan</label>
                            <div class="col-sm-9">
                                {{$Prsn->krj_nm}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
                            <div class="col-sm-9">
                                {{$Prsn->prsn_altAltT}}
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-1">Riwayat Donor</h4>
                    </div>
                    <div class="card-body">
                        <table id="{{$IdForm}}dTPrsnDnrm" class=" display table align-items-centertable-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-wrap">Kategori Donor</th>
                                    <th class="text-wrap">Lokasi/Nama Kegiatan</th>
                                    <th class="text-wrap">Tanggal</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($Dnrm as $tk) @php $no++ @endphp
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td class="text-wrap">{{$tk->dnrm_katAltT}}</td>
                                        <td class="text-wrap">
                                            @if ($tk->dnrm_kat=="K")
                                                {{$tk->dnr_nm}}
                                            @else
                                                {{$tk->dnrm_lok}}
                                            @endif
                                        </td>
                                        <td class="text-wrap">{{$tk->dnrm_tglAltT}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        dTD('table#{{$IdForm}}dTPrsnDnrm');
                    });
                </script>
				
			</div>
		</section>
        
        <section class="video-area" style="background: url(/assets/img/yunus-tug-tu6bOG7EM38-unsplash.jpg) no-repeat center center/cover;">
            <div class="overlay overlay-bg"></div>
            <div class="container">
                <div class="video-content">
                    {{-- <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="play-btn"><img src="/assets/img/home/play-btn.png" alt=""></a> --}}
                    <h3 class="h2 text-white">Manfaat Donor Darah</h3><br/><br/>
                    <a href="{{route('register')}}" class="primary-btn white">Daftar Sekarang<span class="lnr lnr-arrow-right"></span></a><br/><br/>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <iframe class="w-100" height="400" src="https://www.youtube.com/embed/DNu0vtDlYWE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><br/><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <iframe class="w-100" height="400" src="https://www.youtube.com/embed/vWdGPK3Qy0g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <!-- End Video Area -->

        <!-- Strat Footer Area -->
        <footer class="section-gap footer-widget-area" style="background: url(/assets/img/nguy-n-hi-p-2rNHliX6XHk-unsplash.jpg) no-repeat center center/cover;">
            <div class="overlay overlay-bg"></div>
            <div class="container">
                <div class="subscription-area">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <h6 class="text-white text-center text-uppercase mb-20">Terima kasih banyak atas partisipasimu dalam mengirimkan data untuk membantu penyampaian informasi donor darah. Kontribusimu sangat berarti bagi kami dalam meningkatkan kesadaran tentang pentingnya donor darah dan menyelamatkan nyawa.<br/><br/>

                                Dengan bantuanmu, kami dapat lebih efektif menyampaikan informasi kepada masyarakat tentang manfaat dan urgensi menjadi pendonor darah. Semoga informasi yang kami sampaikan dapat menginspirasi lebih banyak orang untuk bergabung dalam aksi sosial ini.<br/><br/>
                                
                                Kami menghargai setiap sumbangsihmu dalam upaya menjadikan dunia ini tempat yang lebih baik melalui donor darah. Terima kasih sekali lagi atas kesediaanmu berpartisipasi dalam membantu menyelamatkan nyawa dan memberikan harapan bagi mereka yang membutuhkan.<br/><br/>
                                
                                Terima kasih banyak!</h6>
                        </div>
                        <a href="{{route('register')}}" class="primary-btn white">Daftar Sekarang<span class="lnr lnr-arrow-right"></span></a>
                    </div>
                </div>
                
                <div class="footer-bottom ">
                    <p class="footer-text text-center m-0">Copyright &copy; 2023 All rights reserved   |   <a href="{{url('')}}">Satu Darah Parigi Moutong</a></p>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>

    @include('includes.anotherscript')

    
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- @include('includes.anotherscript') --}}
    {{-- @include('includes.ajaxinsert') --}}
    <!-- Required Js -->
    <script src="/vendors/script/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/datatables.min.js"></script>
    <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
    <script src="/vendors/include/home/js/vendor/bootstrap.min.js"></script>
    <script src="/vendors/include/home/js/jquery.ajaxchimp.min.js"></script>
    <script src="/vendors/include/home/js/owl.carousel.min.js"></script>
    <script src="/vendors/include/home/js/jquery.nice-select.min.js"></script>
    <script src="/vendors/include/home/js/jquery.magnific-popup.min.js"></script>
    <script src="/vendors/include/home/js/main.js"></script>
    
    <script src="/vendors/include/animation.js"></script>
</body>

</html>