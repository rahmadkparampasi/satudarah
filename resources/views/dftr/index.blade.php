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
                    <div class="lds-roller imageTemp"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
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
                                
                                <h2 class="mb-20 f-w-bold text-center">DAFTAR</h2>
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
                                @if (session()->has('registerError'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <a href="#" class="close text-dark" data-dismiss="alert" aria-label="close">X</a>
                                        <strong>{{session('registerError')}}</strong>
                                    </div>
                                @endif
                               
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_nm">Nama Lengkap</label>
                                    <input type="text" class="form-control dftrReg" placeholder="Nama Lengkap" id="prsn_nm" name="prsn_nm" value="{{old('prsn_nm')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <small>Isikan nama lengkap tanpa gelar dan mohon nama yang disertakan tidak di singkat (seperti Mohammad menjadi Moh.)</small>
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_tmptlhr">Tempat Lahir</label>
                                    <input type="text" class="form-control dftrReg" placeholder="Tempat Lahir" id="prsn_tmptlhr" name="prsn_tmptlhr" value="{{old('prsn_tmptlhr')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_tgllhr">Tanggal Lahir</label>
                                    <input type="date" class="form-control dftrReg" placeholder="Tanggal Lahir" id="prsn_tgllhr" name="prsn_tgllhr" value="{{old('prsn_tgllhr')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_jk">Jenis Kelamin</label>
                                    <select type="text" class="form-control dftrReg" placeholder="Jenis Kelamin" id="prsn_jk" name="prsn_jk" value="{{old('prsn_jk')}}" required>
                                        <option value="" hidden>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('prsn_jk') == "L" ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="P" {{ old('prsn_jk') == "P" ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_alt">Alamat</label>
                                    <textarea class="form-control dftrReg" id="prsn_alt" name="prsn_alt" placeholder="Alamat" required rows="2" value="{{old('prsn_alt')}}">{{old('prsn_alt')}}</textarea>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_kec">Kecamatan</label>
                                    <select type="text" class="form-control dftrReg" placeholder="Kecamatan" id="prsn_kec" name="prsn_kec" value="{{old('prsn_kec')}}" required  onchange="ambilDataSelect('prsn_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kec')">
                                        <option value="" hidden>Pilih Kecamatan</option>
                                        @foreach ($Kec as $tk)
                                            <option value="{{$tk['id']}}" >{{$tk['namaAlt']}}</option>
                                        @endforeach
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_desa">Desa</label>

                                    <select type="text" class="form-control dftrReg" placeholder="Desa" id="prsn_desa" name="prsn_desa" value="{{old('prsn_desa')}}" required>
                                        <option value="" hidden>Pilih Desa</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_gol">Golongan Darah</label>
                                    <select type="text" class="form-control dftrReg" placeholder="Golongan Darah" id="prsn_gol" name="prsn_gol" value="{{old('prsn_gol')}}" required>
                                        <option value="" hidden>Pilih Golongan Darah</option>
                                        <option value="">Tidak Tahu</option>
                                        @foreach ($Gol as $tk)
                                            <option value="{{$tk['gol_id']}}" {{ old('prsn_gol') == $tk['gol_id'] ? 'selected' : '' }}>{{$tk['gol_nm']}}</option>
                                        @endforeach
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_telp">Telepon</label>
                                    <input type="text" class="form-control dftrReg" placeholder="Nomor Telepon" id="prsn_telp" name="prsn_telp" value="{{old('prsn_telp')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_krj">Pekerjaan</label>
                                    <select type="text" class="form-control dftrReg" placeholder="Pekerjaan" id="prsn_krj" name="prsn_krj" value="{{old('prsn_krj')}}" required>
                                        <option value="" hidden>Pilih Pekerjaan</option>
                                        @foreach ($Krj as $tk)
                                            <option value="{{$tk['krj_id']}}" {{ old('prsn_krj') == $tk['krj_id'] ? 'selected' : '' }}>{{$tk['krj_nm']}}</option>
                                        @endforeach
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <label class="control-label text-dark font-weight-bold" for="prsn_telp">Nomor Telepon Terhubung Whatsapp</label>

                                    <select type="text" class="form-control dftrReg" placeholder="Nomor Telepon Terhubung Whatsapp" id="prsn_wa" name="prsn_wa" value="{{old('prsn_wa')}}" required>
                                        <option value="" hidden>Nomor Telepon Terhubung Whatsapp</option>
                                        <option value="1" {{ old('prsn_wa') == "1" ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ old('prsn_wa') == "0" ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-5 text-center form-check">
                                    <input class="form-check-input" onclick="copyForm()" style="{{ $mobile ? 'margin-left: -0.5rem;' : 'margin-left: -1rem;' }} "  id="prsn_consent" name="prsn_consent" type="checkbox" data-toggle="modal" data-target="#modalConcent">
                                    <label data-toggle="modal" data-target="#modalConcent" class="form-check-label font-weight-bold pl-1" onclick="copyForm()" for="prsn_consent">Saya menyutuji dan telah membaca form persetujuan</label>
                                    
                                </div>
                                <script>
                                    $(".dftrReg").on("input", function(){
                                        resetFormCont();
                                    });
                                    function copyForm(){
                                        $(document).ready(function(){
                                            $('#modalConcent').modal('show'); 

                                        });
                                        $('#contNm').html($('#prsn_nm').val());
                                        $('#contNm2').html($('#prsn_nm').val());
                                        $('#contTmptLhr').html($('#prsn_tmptlhr').val());
                                        $('#contJk').html($('#prsn_jk option:selected').text());
                                        $('#contAlt').html($('#prsn_alt').val());
                                        $('#contKec').html($('#prsn_kec option:selected').text());
                                        $('#contDesa').html($('#prsn_desa option:selected').text());
                                        $('#contGol').html($('#prsn_gol option:selected').text());
                                        $('#contKrj').html($('#prsn_krj option:selected').text());
                                        $('#contTelp').html($('#prsn_telp').val());

                                        var dTglLhr = new Date($('#prsn_tgllhr').val());

                                        var monthTglLhr = GetMonthName(dTglLhr.getMonth()+1);
                                        var dayTglLhr = dTglLhr.getDate();

                                        var outputTglLhr = (dayTglLhr<10 ? '0' : '') + dayTglLhr + ' ' +
                                            monthTglLhr + ' ' +
                                            dTglLhr.getFullYear();

                                        $('#contTglLhr').html(outputTglLhr);

                                        var dTgl = new Date();

                                        var monthTgl = GetMonthName(dTgl.getMonth()+1);
                                        var dayTgl = dTgl.getDate();

                                        var outputTgl = (dayTgl<10 ? '0' : '') + dayTgl + ' ' +
                                            monthTgl + ' ' +
                                            dTgl.getFullYear();

                                        $('#contTgl').html(outputTgl);

                                    }
                                    function resetFormCont(){
                                        $('#prsn_consent').prop('checked', false);
                                        
                                        $('#contNm').html('');
                                        $('#contNm2').html('');
                                        $('#contTmptLhr').html('');
                                        $('#contJk').html('');
                                        $('#contAlt').html('');
                                        $('#contKec').html('');
                                        $('#contDesa').html('');
                                        $('#contGol').html('');
                                        $('#contTelp').html('');
                                        $('#contTglLhr').html('');
                                        $('#contTgl').html('');
                                        $('#contKrj').html('');

                                    }

                                    function GetMonthName(monthNumber) {
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        return months[monthNumber - 1];
                                    }
                                </script>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="captcha1">
                                            <div class="row">
                                                <div class="col-8">
                                                    <span>{!! captcha_img('flat') !!}</span>
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-danger " class="reload1" id="reload1">
                                                        <i class="lnr lnr-sync text-white font-weight-bold"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input id="captcha1" type="text" class="form-control" placeholder="Captcha" name="captcha1">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-block btn-primary mb-2 py-3"><i class="fa fa-check text-white"></i> DAFTAR</button>
                                <p class="mb-2 text-center">Sudah punya akun? <a href="{{route('login')}}" class="f-w-400 text-primary">Masuk Disini</a></p>
                                <a href="{{url('')}}" class="btn btn-block btn-info mb-4 py-3"><i class="fa fa-home text-white"></i>  BERANDA</a>
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

    @include('dftr.modalConcent')
    @include('includes.anotherscript')

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/register/reload-captcha',
                success: function (data) {
                    $(".captcha1 span").html(data.captcha);
                }
            });
        });
        $('#reload1').click(function () {
            $.ajax({
                type: 'GET',
                url: '/register/reload-captcha',
                success: function (data) {
                    $(".captcha1 span").html(data.captcha);
                }
            });
        });
    </script>
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