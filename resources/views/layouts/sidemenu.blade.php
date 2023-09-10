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
                            if ($Pgn['users_tipe']=="UTD") {
                        ?>
                            <li class="nav-item">
                                <a href="{{url('prsn')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user"></i></span><span class="pcoded-mtext">Personal</span></a>
                            </li>
                            <li class="nav-item pcoded-hasmenu">
                                <a href="/#!" class="nav-link " onclick="return false;"><span class="pcoded-micon"><i class="fa fa-tint"></i></span><span class="pcoded-mtext">Donor Darah</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="{{route('dnrp.index')}}">Permintaan Darah</a></li>
                                    <li><a href="{{route('dnrk.index')}}">Kegiatan</a></li>    
                                </ul>
                            </li>   
                            <li class="nav-item pcoded-hasmenu">
                                <a href="/#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Pengguna</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="{{route('users.index')}}">Pengguna</a></li>                                
                                </ul>
                            </li>   
                        
                        <?php
                            }elseif($Pgn['users_tipe']=="ADM"){
                        ?>        

                            <li class="nav-item">
                                <a href="{{url('prsn')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-user"></i></span><span class="pcoded-mtext">Personal</span></a>
                            </li>
                            <li class="nav-item pcoded-hasmenu">
                                <a href="/#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Pengguna Dan Organisasi</span></a>
                                <ul class="pcoded-submenu">
                                    <li><a href="{{url('org')}}">Organisasi</a></li>
                                    <li><a href="{{route('users.index')}}">Pengguna</a></li>                                
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