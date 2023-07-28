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
                            <form class="form-contact contact_form" action="{{route('register.insert')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row mb-3">
                                    
                                    <div class="col-12">
                                        <img src="/assets/img/logo-1.png" width="80" alt="" class="img-fluid mb-0">
                                    </div>
                                </div>
                                <h3 class="mb-0 f-w-bold">SATU DARAH</h3>
                                <p class="mb-5 f-w-400">SISTEM AKOMODASI TERPADU DONOR DARAH KABUPATEN PARIGI MOUTONG</p>
                                <h4 class="mb-2 f-w-bold">DAFTAR</h4>
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
                                <h6 class="mb-3 mt-5 f-w-bold">BIODATA</h6>
                                <div class="form-group mb-3 text-left">
                                    <input type="text" class="form-control" placeholder="NIK" id="prsn_nik" name="prsn_nik" value="{{old('prsn_nik')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" id="prsn_nm" name="prsn_nm" value="{{old('prsn_nm')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <small>Isikan nama lengkap tanpa gelar dan mohon nama yang disertakan tidak di singkat (seperti Mohammad menjadi Moh.)</small>
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <input type="text" class="form-control" placeholder="Tempat Lahir" id="prsn_tmptlhr" name="prsn_tmptlhr" value="{{old('prsn_tmptlhr')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <input type="date" class="form-control" placeholder="Tanggal Lahir" id="prsn_tgllhr" name="prsn_tgllhr" value="{{old('prsn_tgllhr')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <select type="text" class="form-control" placeholder="Jenis Kelamin" id="prsn_jk" name="prsn_jk" value="{{old('prsn_jk')}}" required>
                                        <option value="" hidden>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('prsn_jk') == "L" ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="P" {{ old('prsn_jk') == "P" ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <textarea class="form-control" id="prsn_alt" name="prsn_alt" placeholder="Alamat" required rows="2" value="{{old('prsn_alt')}}">{{old('prsn_alt')}}</textarea>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <select type="text" class="form-control" placeholder="Kecamatan" id="prsn_kec" name="prsn_kec" value="{{old('prsn_kec')}}" required  onchange="ambilDataSelect('prsn_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kec')">
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
                                    <select type="text" class="form-control" placeholder="Desa" id="prsn_desa" name="prsn_desa" value="{{old('prsn_desa')}}" required>
                                        <option value="" hidden>Pilih Desa</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <select type="text" class="form-control" placeholder="Golongan Darah" id="prsn_gol" name="prsn_gol" value="{{old('prsn_gol')}}" required>
                                        <option value="" hidden>Pilih Golongan Darah</option>
                                        @foreach ($Gol as $tk)
                                            <option value="{{$tk['gol_id']}}" {{ old('prsn_gol') == $tk['gol_id'] ? 'selected' : '' }}>{{$tk['gol_nm']}}</option>
                                        @endforeach
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <input type="text" class="form-control" placeholder="Nomor Telepon" id="prsn_telp" name="prsn_telp" value="{{old('prsn_telp')}}" required>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 text-left">
                                    <select type="text" class="form-control" placeholder="Nomor Telepon Terhubung Whatsapp" id="prsn_wa" name="prsn_wa" value="{{old('prsn_wa')}}" required>
                                        <option value="" hidden>Nomor Telepon Terhubung Whatsapp</option>
                                        <option value="1" {{ old('prsn_wa') == "1" ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ old('prsn_wa') == "0" ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('registerError')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="captcha1">
                                            <div class="row">
                                                <div class="col-8">
                                                    <span>{!! captcha_img('flat') !!}</span>
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-danger btn-sm" class="reload1" id="reload1">
                                                        <i class="fa fa-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input id="captcha1" type="text" class="form-control" placeholder="Captcha" name="captcha1">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-block btn-primary mb-2">DAFTAR</button>
                                <a href="{{url('')}}" class="btn btn-block btn-info text-white mb-4"><i class="fa fa-reply"></i> BERANDA</a>
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