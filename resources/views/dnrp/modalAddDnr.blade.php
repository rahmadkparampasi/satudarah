<div id="modalAddDnr" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddDnrTitle" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="modalAddDnrF" method="POST" action="{{route('dnrm.insert')}}" enctype="multipart/form-data" data-load="true">
            @csrf
            <input type="hidden" id="dnrm_id" name="dnrm_id" value="" />
            <input type="hidden" id="dnrm_dnr" name="dnrm_dnr" value="{{$Dnrp->dnr_id}}" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddDnrTitle">Tambah Data Pendonor</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" class="form-control" id="prsn_idDnrm" name="prsn_id">
                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_nikDnrm">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control" id="prsn_nikDnrm" name="prsn_nik" placeholder="" required>
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
                                        $('#prsn_telpDnrm').val('');
                                        $('#prsn_waDnrm').val('');
                                        $('#prsn_desaDnrm')
                                            .find('option')
                                            .remove()
                                            .end()
                                            .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                                            .val('');
                                        $('#prsn_golDnrm').val('');
                                    }
                                });
                            }else{
                                $('#prsn_idDnrm').val('');
                            }
                        });
                    </script>
                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_nmDnrm">Nama Lengkap</label>
                        <input type="text" class="form-control" id="prsn_nmDnrm" name="prsn_nm" placeholder="" required>
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
                        <textarea class="form-control" id="prsn_altDnrm" name="prsn_alt" placeholder="" required rows="2"></textarea>
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
                        <label class="control-label" for="prsn_telpDnrm">Nomor Telepon</label>
                        <input type="text" class="form-control" id="prsn_telpDnrm" name="prsn_telp" placeholder="" required>
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

                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="dnrm_orgDnrm">Tempat Donor</label>
                        <select class="form-control" id="dnrm_orgDnrm" name="dnrm_org" required>
                            <option hidden value="">Pilih Salah Satu</option>
                            @foreach ($Org as $tk)
                                <option value="{{$tk['org_id']}}">{{$tk['org_nm']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="item form-group">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $(document).ready(function() {
            var modalAddDnrF = $('#modalAddDnrF');
            modalAddDnrF.submit(function(e) {
                showAnimated();
                //$('#addChildRmr :input').prop("disabled", false);
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                $.ajax({
                    type: modalAddDnrF.attr('method'),
                    url: modalAddDnrF.attr('action'),
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        hideAnimated();
                        $('#modalAddDnr').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        if(typeof modalAddDnrF.attr('data-load')!=='undefined'){
                            if (modalAddDnrF.attr('data-load')==='true') {
                                $.ajax({
                                    url:"{{url('dnrm/loadDnrp/'.$dnr_id)}}",
                                    success: function(data1) {
                                        $('#dnrmAddDatadata').html(data1);
                                        showToast(data.response.message, 'success');
                                    },
                                    error:function(xhr) {
                                        window.location.reload();
                                    }
                                });
                                $.ajax({
                                    url:"{{url('dnrp/loadView/'.$dnr_id)}}",
                                    success: function(data1) {
                                        $('#{{$IdForm}}data').html(data1);
                                        showToast(data.response.message, 'success');
                                    },
                                    error:function(xhr) {
                                        window.location.reload();
                                    }
                                });
                            }else{
                                swal.fire({
                                title: "Terima Kasih",
                                text: data.response.message,
                                icon: data.response.response
                                }).then(function() {
                                    window.location.reload();
                                });
                            }
                        }else{
                            swal.fire({
                            title: "Terima Kasih",
                            text: data.response.message,
                            icon: data.response.response
                            }).then(function() {
                                window.location = "{{url($UrlForm)}}";
                            });
                        }
                    },
                    error: function(xhr) {
                        hideAnimated();                        
                        showToast(xhr.responseJSON.response.message, 'error');
                    }
                });
            });
        });
    });
</script>