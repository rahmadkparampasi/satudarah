<!DOCTYPE html>
<html lang="en">

<head>
    <title>SATU DARAH | MASUK</title>
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
    <meta name="copyright"content="Badan Perencanaan Pembangunan Penelitian Dan Pengembangan Daerah Kabupaten Parigi Moutong">
    <meta name="og:image" content="/logo.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    
    <meta name="author" content="Badan Perencanaan Pembangunan Penelitian Dan Pengembangan Daerah Kabupaten Parigi Moutong" />
	<!-- Favicon icon -->
    <link rel="icon" href="/logo.png" type="image/png" />

	<!-- vendor css -->
    <link rel="stylesheet" href="/vendors/include/css/style.css">
    <link rel="stylesheet" href="/vendors/include/loading.css" media="all">

    <script src="/vendors/script/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .auth-wrapper{
            background: #FF4680;
        }
    </style>
    
</head>

<body>
    <div id="selfLoading" class="hide">
        <div class="imagePos">
            <div class="row">
                <div class="col-lg-12" style="text-align: center;">
                    <img style="width: 18rem;" src="/assets/img/logo.png" alt="" style="margin-left: auto; margin-right: auto;" class="imageTemp">
                </div>
                <div class="col-lg-12">
                    <p style="color: #fff; font-size: 40px; text-align: center;"><strong>LOADING</strong></p>
                </div>
            </div>
        </div>

    </div>

    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form class="form-contact contact_form" action="{{route('masuk.auth')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row mb-3">
                                    
                                    <div class="col-12">
                                        <img src="/assets/img/logo-1.png" width="80" alt="" class="img-fluid mb-0">
                                    </div>
                                </div>
                                <h3 class="mb-0 f-w-bold">SATU DARAH</h3>
                                <p class="mb-5 f-w-400">SISTEM AKOMODASI TERPADU DONOR DARAH KABUPATEN PARIGI MOUTONG</p>
                                <h4 class="mb-2 f-w-bold">MASUK</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <a href="#" class="close text-dark" data-dismiss="alert" aria-label="close">X</a>

                                        <ul class="list-unstyled text-left">
                                            @foreach ($errors->all() as $error)
                                                <li><strong>{{$error}}</strong></li>
                                            @endforeach
                                        </ul>
                                    </div><br />
                                @endif
                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <a href="#" class="close text-dark" data-dismiss="alert" aria-label="close">X</a>
                                        <strong>{{session('loginError')}}</strong>
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{old('username')}}" required>
                                    @error('loginError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required value="{{old('password')}}">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="captcha">
                                            <div class="row">
                                                <div class="col-8">
                                                    <span>{!! captcha_img('flat') !!}</span>
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-danger btn-sm" class="reload" id="reload">
                                                        <i class="fa fa-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input id="captcha" type="text" class="form-control" placeholder="Captcha" name="captcha">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-block btn-primary mb-2">MASUK</button>
                                
                                
                                
                                <div class="copyright text-center text-sm text-muted text-lg-start">
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
        </div>
    </div>

    <script type="text/javascript">
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
    
    
    {{-- @include('includes.anotherscript') --}}
    {{-- @include('includes.ajaxinsert') --}}
    <!-- Required Js -->
    <script src="/vendors/script/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="/vendors/include/js/vendor-all.min.js"></script>
    
    <script src="/vendors/include/js/plugins/bootstrap.min.js"></script>
    
    <script src="/vendors/include/js/ripple.js"></script>
    <script src="/vendors/include/js/pcoded.min.js"></script>
    <script src="/vendors/script/sweetalert2/sweetalert.min.js"></script>
    
    <script src="/vendors/include/animation.js"></script>
</body>

</html>