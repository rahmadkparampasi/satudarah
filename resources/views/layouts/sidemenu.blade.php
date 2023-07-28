<nav class="pcoded-navbar theme-horizontal menu-light brand-blue">
    <div class="navbar-wrapper container">
        <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
            <ul class="nav pcoded-inner-navbar sidenav-inner">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tachometer-alt"></i></span><span class="pcoded-mtext">Beranda</span></a>
                </li>

                <?php
                    if ($Pgn!=null) {
                ?>
                    <?php
                        if ($Pgn['users_id']!=""||$Pgn['users_id']!=null) {
                    ?>
                        <?php
                            if ($Pgn['users_tipe']=="ORG") {
                        ?>
                            <li class="nav-item pcoded-hasmenu">
                                <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Kelompok & Anggota</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="">Personal</a></li>
                                    
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link "><span class="pcoded-micon"><i class="fa fa-paper-plane"></i></span><span class="pcoded-mtext">Inovasi Umum</span></a>
                            </li>
                            
                        
                        <?php
                            }elseif($Pgn['users_tipe']=="ADM"){
                        ?>        

                            <li class="nav-item">
                                <a href="{{url('prsn')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user"></i></span><span class="pcoded-mtext">Personal</span></a>
                            </li>
                            <li class="nav-item pcoded-hasmenu">
                                <a href="/#!" class="nav-link " onclick="return false;"><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Donor Darah</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="{{route('dnrp.index')}}">Personal</a></li>
                                    <li><a href="{{route('dnrk.index')}}">Kegiatan</a></li>                                
                                    {{-- <li><a href="{{route('dnr.index', ['K'])}}">Mandiri</a></li>                                 --}}
                                </ul>
                            </li>   
                            <li class="nav-item pcoded-hasmenu">
                                <a href="/#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Pengguna Dan Organisasi</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="{{url('org')}}">Organisasi</a></li>
                                    <li><a href="/users">Pengguna</a></li>                                
                                </ul>
                            </li>   
                            <li class="nav-item">
                                <a href="/referensi" class="nav-link "><span class="pcoded-micon"><i class="fa fa-cogs"></i></span><span class="pcoded-mtext">Pengaturan</span></a>
                            </li>
                        <?php
                            }
                        ?>
                    <?php
                        }
                    ?>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>