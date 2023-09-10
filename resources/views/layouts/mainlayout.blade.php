<!DOCTYPE html>
<html lang="en">

<head>
    <title>SATU DARAH - @yield('title')</title>
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
    <meta name="og:image" content="/favicon.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    
    <meta name="author" content="Badan Perencanaan Pembangunan Penelitian Dan Pengembangan Daerah Kabupaten Parigi Moutong" />
    
    <!-- Favicon icon -->
    <link rel="icon" href="/logo.png" type="image/png" />

    <!-- prism css -->
    <link rel="stylesheet" href="/vendors/include/css/prism-coy.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="/vendors/include/css/style.css">

    <!-- quill-1.3.6 -->
    <link rel="stylesheet" href="/vendors/script/quill-1.3.6/dist/quill.core.css" media="all">
    <link rel="stylesheet" href="/vendors/script/quill-1.3.6/dist/quill.snow.css" media="all">
    <link rel="stylesheet" href="/vendors/script/quill-1.3.6/plugins/quill-better-table-master/dist/quill-better-table.css" media="all">
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="/vendors/script/fontawesome/css/all.min.css" media="all">

    <!-- toastr-master -->
    <link rel="stylesheet" href="/vendors/script/toastr-master/build/toastr.min.css" media="all">
    
    <link rel="stylesheet" href="/vendors/include/loading.css" media="all">

    <link rel="stylesheet" href="/vendors/script/parsley/2.9.2/src/parsley.css" media="all">

    <!-- bootstrap-treeview-master -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" media="all">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/datatables.min.css" />

    <script src="/vendors/script/jquery/3.1.1/jquery.min.js"></script>

    <style>
        body{
            background: #FF4680;
        }
        .swal2-container {
            z-index: 10000 !important;
        }
        .form-group.required .control-label:after {
            content:"*";
            color:red;
        }
        .pcoded-navbar.theme-horizontal ~ .pcoded-header:not(.headerpos-fixed) {
            background: #FF4680;
        }
        .pcoded-header.header-blue:not(.headerpos-fixed) {
            background: #FF4680;
        }
        .pcoded-navbar.menu-light .pcoded-inner-navbar > li.active > a, .pcoded-navbar.menu-light .pcoded-inner-navbar > li.pcoded-trigger > a {
            background: #FF4680;
        }

        .pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.active > a:before,
            .pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.pcoded-trigger > a:before,
            .pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li:hover > a:before {
            background: #FF4680;
        }

        .pcoded-navbar .pcoded-inner-navbar > li.active > a, .pcoded-navbar .pcoded-inner-navbar > li.pcoded-trigger > a {
            background: #FF4680;
        }
        .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.active:after, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-trigger:after {
            background: #FF4680;
        }
        .dropdown-menu > li.active, .dropdown-menu > li:active, .dropdown-menu > li:focus, .dropdown-menu > li:hover,
            .dropdown-menu > .dropdown-item.active,
            .dropdown-menu > .dropdown-item:active,
            .dropdown-menu > .dropdown-item:focus,
            .dropdown-menu > .dropdown-item:hover {
            background: #FF4680;
        }

        .pcoded-header .dropdown .profile-notification .pro-body li.active, .pcoded-header .dropdown .profile-notification .pro-body li:active, .pcoded-header .dropdown .profile-notification .pro-body li:focus, .pcoded-header .dropdown .profile-notification .pro-body li:hover {
            background: #FF4680;
        }

        .top {
            --offset: 0px; 
            width: 60px;
            height: 60px;
            position: sticky;
            bottom: 20px;      
            left: 100%;
            margin-right:20px; 
            place-self: end;
            margin-top: calc(10vh + var(--offset));
            
            /* visual styling */
            border: none;
            text-decoration: none;
            padding: 10px;
            font-family: sans-serif;
            color: #fff;
            background: #FF4680;
            border-radius: 50%;
            white-space: nowrap;
            font-size: 25px;
        }
       
        .top:hover{
            background: #4680ff;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="selfLoading" class="">
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
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    @include('layouts.sidemenu')

    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="container">
            <div class="m-header">
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                <a href="/" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    {{-- <img src="/assets/img/logo-W.png" width="25" alt="" class="logo">
                    <img src="/assets/img/logo-W.png" width="25" alt="" class="logo-thumb"> --}}
                </a>
                <a href="#!" class="mob-toggler">
                    <i class="feather icon-more-vertical"></i>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <?php
                            if ($Pgn!=null) {
                        ?>
                        <h5 class="pop-search text-light"><?= $Pgn['users_nm'] ?></h5>
                        <?php
                            }
                        ?>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <ul class="pro-body">
                                    <li><a href="#!" class="dropdown-item" title="Logout" onclick="callHrefWC('Ingin Keluar Aplikasi', '/masuk/authKeluar'); return false;">
                                        <i class="feather icon-power"></i> Keluar Aplikasi
                                    </a></li>
                                    <li><a href="#!" class="dropdown-item" title="Ubah Password" data-toggle="modal" data-target="#modalChangePwd" onclick="resetForm('modalChangePwdF'); addFill('users_nmPwd', '{{$Pgn->users_nm}}'); addFill('users_idPwd', '{{$Pgn->users_id}}'); addFill('tipePwd', 'ND');  return false;"><i class="feather icon-lock"></i> Ubah Password</a></li>
                                    
                                </ul>
                               
                                
                            </div>
                        </div>
                        {{-- <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" title="Logout" onclick="callHrefWC('Ingin Keluar Aplikasi', '/masuk/authKeluar'); return false;">
                                <i class="fa fa-power-off"></i>
                            </a>
                            
                        </div> --}}
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper container">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10"><?= $WebTitle ?></h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="<?= $BasePage ?>"><?= $PageTitle ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                @yield('content')

                                <!-- [ horizontal-layout ] end -->
                            </div>
                            
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
            @include('users.modalChangePwd')
        </div>
        @if ($Pgn->users_tipe=="UTD")
            @include('layouts.modalViewPrsnRight')
            @include('layouts.modalAddPrsnRight')
            
            <button type="button" data-toggle="modal" onclick="$('#viewPrsnRight').html(''); resetForm('<?= $IdForm ?>searchFormSide');" data-target="#modalViewPrsnRight" class="top side-panel-toggle"><i class="fa fa-users"></i></button>
        @endif
    </div>
   
    <!-- Required Js -->
    <script src="/vendors/include/js/vendor-all.min.js"></script>
    <script src="/vendors/include/js/plugins/bootstrap.min.js"></script>
    <script src="/vendors/include/js/ripple.js"></script>
    <script src="/vendors/include/js/pcoded.min.js"></script>

    <script src="/vendors/include/animation.js"></script>

    <!-- prism Js -->
    <script src="/vendors/include/js/plugins/prism.js"></script>

    <script src="/vendors/script/parsley/2.9.2/dist/parsley.min.js"></script>
    <script src="/vendors/script/parsley/2.9.2/dist/i18n/id.js"></script>

    <!-- DataTables -->
    <!-- DataTables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/datatables.min.js"></script>
    <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>
    @if (isset($mobile))
        @if ($mobile)
            <script>
                $.fn.DataTable.ext.pager.numbers_length = 3;
            </script>
            
        @endif
    @endif
    <!-- quill-1.3.6 -->
    <!-- <script src="/vendors/script/quill-1.3.6/dist/quill.core.js"></script> -->
    <!-- <script src="/vendors/script/quill-1.3.6/dist/quill.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0-dev.3/quill.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/T-vK/DynamicQuillTools@master/DynamicQuillTools.js"></script>
        
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- fontawesome -->
    <script src="/vendors/script/fontawesome/js/all.min.js"></script>

    <!-- toastr-master -->
    <script src="/vendors/script/toastr-master/build/toastr.min.js"></script>


    <!-- jquery-clock-timepicker -->
    <script src="/vendors/script/jquery-clock-timepicker-2.6.2/jquery-clock-timepicker.js"></script>

    <!-- bootstrap-treeview-master -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>

    <!-- jQuery-Mask-Plugin-master -->
    <script src="/vendors/script/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>

    <!-- sweetAlert -->
    <script src="/vendors/script/sweetalert2/sweetalert.min.js"></script>

    <script src="/vendors/include/js/horizontal-menu.js"></script>
    <script>
        (function() {
            if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
                return;
            }
            try {
                window.layoutHelpers._getSetting("Rtl")
                window.layoutHelpers.setCollapsed(
                    localStorage.getItem('layoutCollapsed') === 'true',
                    false
                );
            } catch (e) {}
        })();
        $(function() {
            $('#layout-sidenav').each(function() {
                new SideNav(this, {
                    orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
                });
            });
            $('body').on('click', '.layout-sidenav-toggle', function(e) {
                e.preventDefault();
                window.layoutHelpers.toggleCollapsed();
                if (!window.layoutHelpers.isSmallScreen()) {
                    try {
                        localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
                    } catch (e) {}
                }
            });
        });
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

    <script src="/vendors/include/js/analytics.js"></script>

</body>

</html>
