<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    .container-step .form-outer{
        width: 100%;
        overflow: hidden;
    }
    .container-step .form-outer form{
        display: flex;
        width: 300%;
    }
    .form-outer form .page{
        width: 33.33%;
        transition: margin-left 0.3s ease-in-out;
    }
    .container-step .progress-bar-step{
        display: flex;
        margin: 40px 0;
        user-select: none;
    }
    .container-step .progress-bar-step .step{
        text-align: center;
        width: 100%;
        position: relative;
    }
    .container-step .progress-bar-step .step p{
        font-weight: 500;
        font-size: 18px;
        color: #ff5252;;
        margin-bottom: 8px;
    }
    .progress-bar-step .step .bullet{
        height: 25px;
        width: 25px;
        border: 2px solid #ff5252;;
        display: inline-block;
        border-radius: 50%;
        position: relative;
        transition: 0.2s;
        font-weight: 500;
        font-size: 17px;
        line-height: 25px;
    }
    .progress-bar-step .step .bullet.active{
        border-color: #8ac248;
        background: #8ac248;
    }
    .progress-bar-step .step .bullet span{
        position: absolute;
        left: 50%;
        /* top: -50%; */
        transform: translateX(-50%);
    }
    .progress-bar-step .step .bullet.active span{
        display: none;
    }
    
    @keyframes animate {
        100%{
            transform: scaleX(1);
        }
    }
    
    .progress-bar-step .step p.active{
        color: #8ac248;
        transition: 0.2s linear;
    }
    .progress-bar-step .step .check-step{
        position: absolute;
        left: 50%;
        top: 70%;
        font-size: 15px;
        transform: translate(-50%, -50%);
        display: none;
        color: #fff;
    }
    .progress-bar-step .step .check-step.active{
        display: block;
        color: #fff;
    }
</style>
<div class="col-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        
            
            <div class="card-body" style="">
                <div class="container-step w-md-50 w-sm-100" >
                    <div class="progress-bar-step">
                        <div class="step">
                            <p>Pasien</p>
                            <div class="bullet" style="box-sizing: unset !important;">
                                <span class="text-danger" style="box-sizing: unset !important;"><i class="fa fa-user-injured"></i></span>
                            </div>
                            <div class="check-step fas fa-check"></div>
                        </div>
                        <div class="step">
                            <p>Kontak</p>
                            <div class="bullet" style="box-sizing: unset !important;">
                                <span class="text-danger" style="box-sizing: unset !important;"><i class="fa fa-phone"></i></span>
                            </div>
                            <div class="check-step fas fa-check"></div>
                        </div>
                        <div class="step">
                            <p>Kebutuhan</p>
                            <div class="bullet" style="box-sizing: unset !important;">
                                <span class="text-danger" style="box-sizing: unset !important;"><i class="fa fa-boxes"></i></span>
                            </div>
                            <div class="check-step fas fa-check"></div>
                        </div>
                        
                    </div>
                    <div class="form-outer">
                        <form class="" action="{{route('dnrp.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="{{url('dnrp/load')}}">
                        @csrf
                        <input type="hidden" class="form-control" id="dnr_id" name="dnr_id">
                            <div class="page slide-page">
                                <h5 class="text-center w-100">Data Pasien</h5>
                                <div class="row display1">
                                    <input type="hidden" class="form-control" id="prsn_id" name="prsn_id">

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-12 col-sm-12">
                                        <label class="control-label" for="prsn_dnr">Pasien Sudah Pernah Donor Di Parigi Moutong</label>
                                        <select class="form-control" id="prsn_dnr" name="prsn_dnr" required data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            <option value="B">Belum</option>
                                            <option value="S">Sudah</option>
                                        </select>
                                        <small>Tanyakan apakah pasien sudah pernah donor di Parigi Moutong? Untuk mencari kecocokan dengan data pasien yang telah ada di sistem</small>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_nik">NIK (Nomor Induk Kependudukan)</label>
                                        <div class="row">
                                            <div class="col-lg-10 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" id="prsn_nik" name="prsn_nik" placeholder="" required data-parsley-group="group-1" minlength="16">
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-sm-2">
                                                <button type="button" class="btn btn-success" ><i class="fa fa-sync"></i></button>
                                            </div>
                                        </div>
                                        <small>Jika terdapat perubahan pada NIK, buka halaman personal kemudian lakukan perubahan NIK</small>
                                    </div>

                                    <script>
                                        $("#prsn_nik").on("input", function(){
                                            if ($('#prsn_nik').val().length==16) {
                                                showAnimated();
                                                myData = new FormData();
                                                myData.append('search_val', $('#prsn_nik').val());
                                                myData.append('search_key', 'NIK');
                                                myData.append('_token', '{{csrf_token()}}');
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{route('prsn.searchJson')}}',
                                                    enctype: 'multipart/form-data',
                                                    data: myData,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(data) {
                                                        hideAnimated();
                                                        showToast('Data Personal Ditemukan', 'success');
                                                        $('#prsn_id').val(data.prsn_id);
                                                        $('#prsn_nm').val(data.prsn_nm);
                                                        $('#prsn_tmptlhr').val(data.prsn_tmptlhr);
                                                        $('#prsn_tgllhr').val(data.prsn_tgllhr);
                                                        $('#prsn_jk').val(data.prsn_jk);
                                                        $('#prsn_alt').val(data.prsn_alt);
                                                        $('#prsn_kec').val(data.kec_id);
                                                        $('#prsn_gol').val(data.prsn_gol);
                                                        $('#prsn_krj').val(data.prsn_krj);

                                                        getSelect(data.kec_id, data.desa_id, 'prsn_desa');
                                                    },
                                                    error: function(xhr) {
                                                        hideAnimated();                        
                                                        showToast(xhr.responseJSON.response.message, 'error');
                                                        $('#prsn_id').val('');
                                                        $('#prsn_nm').val('');
                                                        $('#prsn_tmptlhr').val('');
                                                        $('#prsn_tgllhr').val('');
                                                        $('#prsn_jk').val('');
                                                        $('#prsn_alt').val('');
                                                        $('#prsn_kec').val('');
                                                        $('#prsn_desa')
                                                            .find('option')
                                                            .remove()
                                                            .end()
                                                            .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                                                            .val('');
                                                        $('#prsn_gol').val('');
                                                        $('#prsn_krj').val('');
                                                    }
                                                });
                                            }else{
                                                $('#prsn_id').val('');
                                            }
                                        });
                                    </script>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_nm">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="prsn_nm" name="prsn_nm" placeholder="" required data-parsley-group="group-1">
                                        <small>Isikan nama lengkap tanpa gelar</small>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_tmptlhr">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="prsn_tmptlhr" name="prsn_tmptlhr" placeholder="" required data-parsley-group="group-1">
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_tgllhr">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="prsn_tgllhr" name="prsn_tgllhr" placeholder="" required data-parsley-group="group-1">
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_jk">Jenis Kelamin</label>
                                        <select class="form-control" id="prsn_jk" name="prsn_jk" required data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_alt">Alamat</label>
                                        <input class="form-control" id="prsn_alt" name="prsn_alt" placeholder="" required  data-parsley-group="group-1"/>
                                        <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_kec">Kecamatan</label>
                                        <select class="form-control" id="prsn_kec" name="prsn_kec" required onchange="ambilDataSelect('prsn_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kec')" data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Kecamatan</option>
                                            @foreach ($Kec as $tk)
                                                <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_desa">Desa/Kelurahan</label>
                                        <select class="form-control" id="prsn_desa" name="prsn_desa" required data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                                        </select>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_gol">Golongan Darah</label>
                                        <select class="form-control" id="prsn_gol" name="prsn_gol" required data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            @foreach ($Gol as $tk)
                                                <option value="{{$tk['gol_id']}}">{{$tk['gol_nm']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="prsn_krj">Pekerjaan</label>
                                        <select class="form-control" id="prsn_krj" name="prsn_krj" required data-parsley-group="group-1">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            @foreach ($Krj as $tk)
                                                <option value="{{$tk['krj_id']}}">{{$tk['krj_nm']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 field d-flex justify-content-center">
                                        <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrp.insert')}}')" class="btn btn-danger mx-2"> <i class="fa fa-ban"></i> Batal</button> 
                                        <button type="button" class="firstNext next btn btn-success"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
    
                                    </div>
                                </div>
                            </div>
                            <div class="page">
                                <h5 class="text-center w-100">Data Kontak</h5>
                                <div class="row display2" style="display: none">
                                    <input type="hidden" class="form-control" id="ktk_prsn_id" name="ktk_prsn_id">
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_nik">NIK (Nomor Induk Kependudukan)</label>
                                        <input type="text" class="form-control" id="ktk_prsn_nik" name="ktk_prsn_nik" placeholder="" required data-parsley-group="group-2" minlength="16">
                                    </div>

                                    <script>
                                        $("#ktk_prsn_nik").on("input", function(){
                                            if ($('#ktk_prsn_nik').val().length==16) {
                                                showAnimated();
                                                myData = new FormData();
                                                myData.append('search_val', $('#ktk_prsn_nik').val());
                                                myData.append('search_key', 'NIK');
                                                myData.append('_token', '{{csrf_token()}}');
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{route('prsn.searchJson')}}',
                                                    enctype: 'multipart/form-data',
                                                    data: myData,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(data) {
                                                        hideAnimated();
                                                        showToast('Data Personal Ditemukan', 'success');
                                                        $('#ktk_prsn_id').val(data.prsn_id);
                                                        $('#ktk_prsn_nm').val(data.prsn_nm);
                                                        $('#ktk_prsn_tmptlhr').val(data.prsn_tmptlhr);
                                                        $('#ktk_prsn_tgllhr').val(data.prsn_tgllhr);
                                                        $('#ktk_prsn_jk').val(data.prsn_jk);
                                                        $('#ktk_prsn_alt').val(data.prsn_alt);
                                                        $('#ktk_prsn_kec').val(data.kec_id);
                                                        $('#ktk_prsn_telp').val(data.prsn_telp);
                                                        $('#ktk_prsn_wa').val(data.prsn_wa);
                                                        $('#ktk_prsn_krj').val(data.prsn_krj);
                                                        getSelect(data.kec_id, data.desa_id, 'ktk_prsn_desa');
                                                    },
                                                    error: function(xhr) {
                                                        hideAnimated();                        
                                                        showToast(xhr.responseJSON.response.message, 'error');
                                                        $('#ktk_prsn_id').val('');
                                                        $('#ktk_prsn_nm').val('');
                                                        $('#ktk_prsn_tmptlhr').val('');
                                                        $('#ktk_prsn_tgllhr').val('');
                                                        $('#ktk_prsn_jk').val('');
                                                        $('#ktk_prsn_alt').val('');
                                                        $('#ktk_prsn_kec').val('');
                                                        $('#ktk_prsn_desa')
                                                            .find('option')
                                                            .remove()
                                                            .end()
                                                            .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                                                            .val('');
                                                        $('#ktk_prsn_telp').val('');
                                                        $('#ktk_prsn_wa').val('');
                                                        $('#ktk_prsn_krj').val('');
                                                    }
                                                });
                                            }else{
                                                $('#ktk_prsn_id').val('');
                                            }
                                        });
                                    </script>
                                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_nm">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="ktk_prsn_nm" name="ktk_prsn_nm" placeholder="" required data-parsley-group="group-2">
                                        <small>Isikan nama lengkap tanpa gelar</small>
                                    </div>
                    
                                    
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_tmptlhr">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="ktk_prsn_tmptlhr" name="ktk_prsn_tmptlhr" placeholder="" required data-parsley-group="group-2">
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_tgllhr">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="ktk_prsn_tgllhr" name="ktk_prsn_tgllhr" placeholder="" required data-parsley-group="group-2">
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_jk">Jenis Kelamin</label>
                                        <select class="form-control" id="ktk_prsn_jk" name="ktk_prsn_jk" required data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_alt">Alamat</label>
                                        <input class="form-control" id="ktk_prsn_alt" name="ktk_prsn_alt" placeholder="" required  data-parsley-group="group-2"/>
                                        <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_kec">Kecamatan</label>
                                        <select class="form-control" id="ktk_prsn_kec" name="ktk_prsn_kec" required onchange="ambilDataSelect('ktk_prsn_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['ktk_prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'ktk_prsn_kec')" data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Kecamatan</option>
                                            @foreach ($Kec as $tk)
                                                <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_desa">Desa/Kelurahan</label>
                                        <select class="form-control" id="ktk_prsn_desa" name="ktk_prsn_desa" required data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                                        </select>
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_telp">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="ktk_prsn_telp" name="ktk_prsn_telp" placeholder="" required data-parsley-group="group-2">
                                    </div>
                                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_wa">Nomor Telepon Terhubung Whatsapp</label>
                                        <select class="form-control" id="ktk_prsn_wa" name="ktk_prsn_wa" required data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="dnr_ktk">Jenis Kontak</label>
                                        <select class="form-control" id="dnr_ktk" name="dnr_ktk" required data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            @foreach ($Ktk as $tk)
                                                <option value="{{$tk['ktk_id']}}">{{$tk['ktk_nm']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="ktk_prsn_krj">Pekerjaan</label>
                                        <select class="form-control" id="ktk_prsn_krj" name="ktk_prsn_krj" required data-parsley-group="group-2">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            @foreach ($Krj as $tk)
                                                <option value="{{$tk['krj_id']}}">{{$tk['krj_nm']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 field d-flex justify-content-center">
                                        <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrp.insert')}}')" class="btn btn-danger mx-2"> <i class="fa fa-ban"></i> Batal</button>
    
                                        <button type="button" class="prev-1 prev btn btn-warning mx-1"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="button" class="next-1 next btn btn-success mx-1"><i class="fa fa-arrow-right"></i> Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                            <div class="page">
                                <h5 class="text-center w-100">Kebutuhan Darah</h5>
                                <div class="row display3" style="display: none">
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="dnr_bth">Kebutuhan (Kantong)</label>
                                        <input type="number" class="form-control" id="dnr_bth" name="dnr_bth" placeholder="" required data-parsley-group="group-3" min="1">
                                        <small>Isikan hanya berupa angka</small>
                                    </div>
    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="dnr_org">Tempat Rawat</label>
                                        <select class="form-control" id="dnr_org" name="dnr_org" required data-parsley-group="group-3">
                                            <option hidden value="">Pilih Salah Satu Layanan Faskes</option>
                                            @foreach ($Org as $tk)
                                                <option value="{{$tk['org_id']}}">{{$tk['org_nm']}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="dnr_sft">Sifat</label>
                                        <select class="form-control" id="dnr_sft" name="dnr_sft" required data-parsley-group="group-3">
                                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                                            <option value="B">Biasa</option>
                                            <option value="U">Urgent</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                                        <label class="control-label" for="dnr_tgl">Tanggal Rawat</label>
                                        <input type="date" class="form-control" id="dnr_tgl" name="dnr_tgl" placeholder="" required data-parsley-group="group-3">
                                    </div>
                                   
                                    
                                    <div class="col-12 field d-flex justify-content-center">
                                        <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrp.insert')}}')" class="btn btn-danger mx-2"> <i class="fa fa-ban"></i> Batal</button>
                                        <button type="button" class="prev-2 prev btn btn-warning mx-1"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                        <button type="submit" class="submit btn btn-success mx-1"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
</div>
<script>
            
    const slidePage = document.querySelector(".slide-page");
    const nextBtnFirst = document.querySelector(".firstNext");
    const prevBtnSec = document.querySelector(".prev-1");
    const nextBtnSec = document.querySelector(".next-1");
    const prevBtnThird = document.querySelector(".prev-2");
    const nextBtnThird = document.querySelector(".next-2");
    const prevBtnFourth = document.querySelector(".prev-3");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check-step");
    const bullet = document.querySelectorAll(".step .bullet");
    let current = 1;
    nextBtnFirst.addEventListener("click", function(event){
        $('#<?= $IdForm ?>').parsley().whenValidate({
            group: 'group-1'
        }).done(function() {
            event.preventDefault();
            slidePage.style.marginLeft = "-33.33%";
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            $('.check-step').eq(current - 1).show();
            progressText[current - 1].classList.add("active");
            current += 1;
            $('.display1').hide();
            $('.display2').show();
        })
    });
    nextBtnSec.addEventListener("click", function(event){
        $('#<?= $IdForm ?>').parsley().whenValidate({
            group: 'group-2'
        }).done(function() {
            event.preventDefault();
            slidePage.style.marginLeft = "-66.66%";
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            $('.check-step').eq(current - 1).show();
            progressText[current - 1].classList.add("active");
            current += 1;
            $('.display2').hide();
            $('.display3').show();

        });
    });
    
    prevBtnSec.addEventListener("click", function(event){
        event.preventDefault();
        slidePage.style.marginLeft = "0%";
        bullet[current - 2].classList.remove("active");
        progressCheck[current - 2].classList.remove("active");
        $('.check-step').eq(current - 2).hide();
        progressText[current - 2].classList.remove("active");
        current -= 1;
        $('.display2').hide();
        $('.display3').hide();
        $('.display1').show();

    });
    prevBtnThird.addEventListener("click", function(event){
        event.preventDefault();
        slidePage.style.marginLeft = "-33.33%";
        bullet[current - 2].classList.remove("active");
        progressCheck[current - 2].classList.remove("active");
        $('.check-step').eq(current - 2).hide();
        progressText[current - 2].classList.remove("active");
        current -= 1;
        $('.display2').show();
        $('.display3').hide();

    });
    // prevBtnFourth.addEventListener("click", function(event){
    //     event.preventDefault();
    //     slidePage.style.marginLeft = "-50%";
    //     bullet[current - 2].classList.remove("active");
    //     progressCheck[current - 2].classList.remove("active");
    //     progressText[current - 2].classList.remove("active");
    //     current -= 1;
    // });
</script>