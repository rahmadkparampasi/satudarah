<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('dnrm.insertM')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body row">
                @csrf
                <input type="hidden" class="form-control" id="dnrm_idDnrm" name="dnrm_id">
                <input type="hidden" class="form-control" id="prsn_idDnrm" name="prsn_id">
                <div class="form-group p-4 mb-0 pb-0 required col-md-12 col-sm-12">
                    <label class="control-label" for="prsn_dnrDnrm">Pasien Sudah Pernah Donor Di Parigi Moutong</label>
                    <select class="form-control" id="prsn_dnrDnrm" name="prsn_dnr" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="B">Belum</option>
                        <option value="S">Sudah</option>
                    </select>
                    <small>Tanyakan apakah pasien sudah pernah donor di Parigi Moutong? Untuk mencari kecocokan dengan data pasien yang telah ada di sistem</small>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_nikDnrm">NIK (Nomor Induk Kependudukan)</label>
                    <div class="row">
                        <div class="col-lg-10 col-md-6 col-sm-6">
                            <input type="text" class="form-control" id="prsn_nikDnrm" name="prsn_nik" placeholder="" required minlength="16">
                        </div>
                        <div class="col-lg-1 col-md-2 col-sm-2">
                            <button type="button" class="btn btn-success" ><i class="fa fa-sync"></i></button>
                        </div>
                    </div>
                    <small>Jika terdapat perubahan pada NIK, buka halaman personal kemudian lakukan perubahan NIK</small>
                </div>

                <script>
                    $("#prsn_nikDnrm").on("input", function(){
                        if ($('#prsn_nikDnrm').val().length==16) {
                            showAnimated();
                            myData = new FormData();
                            myData.append('search_val', $('#prsn_nikDnrm').val());
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
                                    $('#prsn_idDnrm').val(data.prsn_id);
                                    $('#prsn_nmDnrm').val(data.prsn_nm);
                                    $('#prsn_tmptlhrDnrm').val(data.prsn_tmptlhr);
                                    $('#prsn_tgllhrDnrm').val(data.prsn_tgllhr);
                                    $('#prsn_jkDnrm').val(data.prsn_jk);
                                    $('#prsn_altDnrm').val(data.prsn_alt);
                                    $('#prsn_kecDnrm').val(data.kec_id);
                                    $('#prsn_golDnrm').val(data.prsn_gol);
                                    $('#prsn_krjDnrm').val(data.prsn_krj);
                                    $('#prsn_telpDnrm').val(data.prsn_telp);
                                    $('#prsn_waDnrm').val(data.prsn_wa);

                                    getSelect(data.kec_id, data.desa_id, 'prsn_desaDnrm');
                                },
                                error: function(xhr) {
                                    hideAnimated();                        
                                    showToast(xhr.responseJSON.response.message, 'error');
                                    $('#prsn_idDnrm').val('');
                                    $('#prsn_nmDnrm').val('');
                                    $('#prsn_tmptlhrDnrm').val('');
                                    $('#prsn_tgllhrDnrm').val('');
                                    $('#prsn_jkDnrm').val('');
                                    $('#prsn_altDnrm').val('');
                                    $('#prsn_kecDnrm').val('');
                                    $('#prsn_desaDnrm')
                                        .find('option')
                                        .remove()
                                        .end()
                                        .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                                        .val('');
                                    $('#prsn_golDnrm').val('');
                                    $('#prsn_krjDnrm').val('');
                                    $('#prsn_telpDnrm').val('');
                                    $('#prsn_waDnrm').val('');
                                }
                            });
                        }else{
                            $('#prsn_id').val('');
                        }
                    });
                </script>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_nmDnrm">Nama Lengkap</label>
                    <input type="text" class="form-control" id="prsn_nmDnrm" name="prsn_nm" placeholder="" required>
                    <small>Isikan nama lengkap tanpa gelar</small>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_tmptlhrDnrm">Tempat Lahir</label>
                    <input type="text" class="form-control" id="prsn_tmptlhrDnrm" name="prsn_tmptlhr" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_tgllhrDnrm">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="prsn_tgllhrDnrm" name="prsn_tgllhr" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_jkDnrm">Jenis Kelamin</label>
                    <select class="form-control" id="prsn_jkDnrm" name="prsn_jk" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_altDnrm">Alamat</label>
                    <input class="form-control" id="prsn_altDnrm" name="prsn_alt" placeholder="" required />
                    <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_kecDnrm">Kecamatan</label>
                    <select class="form-control" id="prsn_kecDnrm" name="prsn_kec" required onchange="ambilDataSelect('prsn_desaDnrm', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desaDnrm'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kecDnrm')">
                        <option hidden value="">Pilih Salah Satu Kecamatan</option>
                        @foreach ($Kec as $tk)
                            <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_desaDnrm">Desa/Kelurahan</label>
                    <select class="form-control" id="prsn_desaDnrm" name="prsn_desa" required>
                        <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_golDnrm">Golongan Darah</label>
                    <select class="form-control" id="prsn_golDnrm" name="prsn_gol" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        @foreach ($Gol as $tk)
                            <option value="{{$tk['gol_id']}}">{{$tk['gol_nm']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_krjDnrm">Pekerjaan</label>
                    <select class="form-control" id="prsn_krjDnrm" name="prsn_krj" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        @foreach ($Krj as $tk)
                            <option value="{{$tk['krj_id']}}">{{$tk['krj_nm']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_telpDnrm">Nomor Telepon</label>
                    <input type="text" class="form-control" id="prsn_telpDnrm" name="prsn_telp" placeholder="" required="">
                </div>
                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="prsn_waDnrm">Nomor Telepon Terhubung Whatsapp</label>
                    <select class="form-control" id="prsn_waDnrm" name="prsn_wa" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
               
                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="dnrm_jmlhDnrm">Jumlah Donor (Kantung)</label>
                    <input type="number" class="form-control" id="dnrm_jmlhDnrm" name="dnrm_jmlh" placeholder="" required>
                </div>
                <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                    <label class="control-label" for="dnrm_tglDnrm">Tanggal Donor</label>
                    <input type="date" class="form-control" id="dnrm_tglDnrm" name="dnrm_tgl" placeholder="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrm.insertM')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>