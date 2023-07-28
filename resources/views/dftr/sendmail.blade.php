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

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <script src="/vendors/script/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .select2.select2-container {
            width: 100% !important;
        }

        .select2.select2-container .select2-selection {
            border: none;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            
            height: calc(1.5em + 1.25rem + 2px);
            /* margin-bottom: 15px; */
            /* padding: 0.625rem 1.1875rem; */
            outline: none !important;
            transition: all .15s ease-in-out;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            display: block;
            word-wrap: normal;
            text-transform: none;
            font-family: inherit;
            margin: 0;
            text-align: left !important;
            padding-left: 0;
            padding-right: 0;
            border-bottom: 1px solid #ced4da;
        }

        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 32px;
            padding-left: 0;
        }

        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: none;
            border-left: none;
            height: 32px;
            width: 33px;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
            background: #f8f8f8;
        }
        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
        }
    </style>
    
</head>

<body>
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

    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <img src="/assets/img/Parigi_Moutong.png" width="60" alt="" class="img-fluid mb-0">
                                </div>
                                <div class="col-6">
                                    <img src="/assets/img/logo-1.png" width="60" alt="" class="img-fluid mb-0">
                                </div>
                            </div>
                            <h3 class="mb-0 f-w-bold">SATU DARAH</h3>
                            <p class="mb-5 f-w-400">SISTEM AKOMODASI TERPADU DONOR DARAH KABUPATEN PARIGI MOUTONG</p>
                            <h4 class="mb-2 f-w-bold">KIRIM ULANG EMAIL VERIFIKASI</h4>
                            <br/>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <a href="#" class="close text-dark" data-dismiss="alert" aria-label="close">X</a>

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{$error}}</strong></li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            @if (session()->has('registerError'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <a href="#" class="close text-dark" data-dismiss="alert" aria-label="close">X</a>
                                    <strong>{{session('registerError')}}</strong>
                                </div>
                            @endif
                            
                            <form class="form-contact contact_form" action="{{route('register.insert.umum')}}" method="post" novalidate="novalidate">
                                @csrf
                                
                                <div class="form-group mb-3 text-justify">
                                    <input type="text" class="form-control" placeholder="Email Pengguna" id="users_mail" name="users_mail" value="{{old('users_mail')}}" required>
                                    

                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
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
                                
                                <button type="submit" class="btn btn-block btn-primary mb-2">KIRIM</button>
                                
                            </form>
                            <p class="mb-1">Sudah punya akun? <a href="{{route('masuk')}}" class="f-w-400">Masuk Disini</a></p>
                            <p class="mb-4">Belum punya akun? <a href="{{route('register')}}" class="f-w-400">Daftar Disini</a></p>
                            <a href="{{route('home')}}" class="btn btn-block btn-info text-white mb-4"><i class="fa fa-reply"></i> KEMBALI</a>
                            
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © 2023 - <script>
                                    document.write(new Date().getFullYear())
                                </script>,
            
                                <a href="https://bappelitbangda.parigimoutongkab.go.id/" target="_blank" class="font-weight-bold" target="_blank">BAPPEDA</a><br/>
                                KABUPATEN PARIGI MOUTONG.
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/register/reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '/register/reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
    
    <script>
    
        $(function() {
            $(document).ready(function() {
                $('#users_instC').select2({
                    // theme: "bootstrap",
    
                    minimumInputLength: 3,
                    allowClear: false,
                    width: '100%',
                    placeholder: 'Masukan Nama Instansi',
                    ajax: {
                        dataType: 'json',
                        url: "{{route('inst.getDataText')}}",
                        delay: 800,
                        data: function(params) {
                            return {
                                search: params.term
                            }
                        },
                        processResults: function (data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                }).on('select2:select', function (evt) {
                    $('#users_inst').val($("#users_instC option:selected").val());
                }).on('select2:clear', function (evt) {
                    $('#users_inst').val('');
                });
            });
        });
    </script>
    {{-- @include('includes.anotherscript') --}}
    {{-- @include('includes.ajaxinsert') --}}
    <!-- Required Js -->
    <script src="/vendors/script/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="/vendors/include/js/vendor-all.min.js"></script>
    
    <script src="/vendors/include/js/plugins/bootstrap.min.js"></script>

    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="/vendors/include/js/ripple.js"></script>
    <script src="/vendors/include/js/pcoded.min.js"></script>
    <script src="/vendors/script/sweetalert2/sweetalert.min.js"></script>
    
    <script src="/vendors/include/animation.js"></script>
</body>

</html>