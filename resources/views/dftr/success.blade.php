<!DOCTYPE html>
<html lang="en">

<head>
    <title>SATU DARAH</title>
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
    {{-- <link rel="stylesheet" href="/vendors/include/home/css/nice-select.css"> --}}
    <link rel="stylesheet" href="/vendors/include/home/css/magnific-popup.css">
    <link rel="stylesheet" href="/vendors/include/home/css/bootstrap.css">
    <link rel="stylesheet" href="/vendors/include/home/css/main.css">
    <link rel="stylesheet" href="/vendors/include/loading.css" media="all">

   
    <script src="/vendors/script/jquery/3.1.1/jquery.min.js"></script>
    
</head>

<body class="dup-body">

    <div id="selfLoading" class="hide">
        <div class="imagePos">
            <div class="row">
                <div class="col-lg-12" style="text-align: center;">
                    <img style="width: 18rem;" src="/assets/img/fav.png" alt="" style="margin-left: auto; margin-right: auto;" class="imageTemp">
                </div>
                <div class="col-lg-12">
                    <p style="color: #fff; font-size: 40px; text-align: center;"><strong>LOADING</strong></p>
                </div>
            </div>
        </div>

    </div>

    <div class="dup-body-wrap">
        <!-- Start Header Area -->
        <header class="default-header">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-center align-items-center">
                    <div class="logo">
                        <a href="{{url('')}}"><img src="/assets/img/Parigi_Moutong.png" height="50" alt=""></a>
                        <a href="{{url('')}}"><img src="/assets/img/logo-rs.png" height="50" alt=""></a>
                        <a href="{{url('')}}"><img src="/assets/img/pmi.png" height="50" alt=""></a>
                    </div>
                    
                </div>
            </div>
        </header>
        <!-- End Header Area -->
         <!-- Start Banner Area -->
         <section class="banner-area relative">
            <div class="overlay overlay-bg"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-12 mt-100">
                        <div class="banner-content">
                            <form class="form-contact contact_form" action="{{route('register.insert')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row mb-3">
                                    
                                    <div class="col-12">

                                        <img src="/assets/img/Logo-L-1.png" class="w-100"/>
                                        <h1 class="text-center">Dariku Untukmu</h1>
                                    </div>
                                </div>
                                
                                <h2 class="mb-20 f-w-bold text-center">DAFTAR</h2><br/>
                                <div class="alert alert-success alert-dismissible pr-3 pl-3" role="alert">
                                    <strong class="text-center">Registrasi Berhasil Dilakukan<br/><br/></strong>
                                    <p class="text-justify">Terima kasih banyak atas partisipasinya dalam mengirimkan data untuk membantu penyampaian informasi donor darah. Kontribusi Anda sangat berarti dan membantu kami menjalankan kampanye donor darah dengan lebih efektif. Dengan dukungan Anda, kami dapat mencapai lebih banyak orang dan menyelamatkan lebih banyak nyawa. Terima kasih sekali lagi atas kerjasama dan kebaikan hati Anda! </p>
                                </div>
                                <a href="{{url('')}}" class="btn btn-block btn-info mb-4"><i class="fa fa-home text-white"></i>  BERANDA</a>
                                <div class="copyright text-center text-sm text-muted text-lg-start mb-50">
                                    © 2023 - <script>
                                        document.write(new Date().getFullYear())
                                    </script>,
                
                                    <a href="https://parigimoutongkab.go.id/" target="_blank" class="font-weight-bold" target="_blank">SATU DARAH</a><br/>
                                    KABUPATEN PARIGI MOUTONG.
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <!-- End Banner Area -->
    </div>
    @include('includes.anotherscript')

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- @include('includes.anotherscript') --}}
    {{-- @include('includes.ajaxinsert') --}}
    <!-- Required Js -->
    <script src="/vendors/script/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="/vendors/include/home/js/vendor/bootstrap.min.js"></script>
    <script src="/vendors/include/home/js/jquery.ajaxchimp.min.js"></script>
    <script src="/vendors/include/home/js/owl.carousel.min.js"></script>
    {{-- <script src="/vendors/include/home/js/jquery.nice-select.min.js"></script> --}}
    <script src="/vendors/include/home/js/jquery.magnific-popup.min.js"></script>
    <script src="/vendors/include/home/js/main.js"></script>
    
    <script src="/vendors/include/animation.js"></script>
</body>

</html>