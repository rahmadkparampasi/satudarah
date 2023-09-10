<style>
	.modal.right .modal-dialog {
		/* position: fixed; */
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}
    
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

</style>
@if ($mobile)
    <style>
        .modal.right.fade .modal-dialog {
            right: -47px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
                -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                    transition: opacity 0.3s linear, right 0.3s ease-out;
        }
    </style>
@else
    <style>
        .modal.right.fade .modal-dialog {
            right: -560px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
                -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                    transition: opacity 0.3s linear, right 0.3s ease-out;
        }
    </style>
@endif
<div class="modal right fade" id="modalAddPrsnRight" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddPrsnRightLabel">TAMBAH DATA PERSONAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <button type="button" area-hidden="true" class="btn btn-danger btn-sm" onclick="$('#viewPrsnRight').html('');resetForm('<?= $IdForm ?>addFormSide');" data-dismiss="modal"><i class="fa fa-angle-double-right"></i></button>
                    {{-- <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span> --}}
                </button>
            </div>
            <div class="modal-body overflow-scroll" >
                <div class="row">
                    <div class="col-12 mb-5">
                        <form  action="{{route('prsn.insertSide')}}" data-load="true" id="<?= $IdForm ?>addFormSide" method="post" enctype="multipart/form-data" data-parsley-validate="">
                            @csrf
                            <input type="hidden" class="form-control" id="prsn_idRightSide" name="prsn_id">
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_nmRightSide">Nama Lengkap</label>
                
                                <input type="text" class="form-control" id="prsn_nmRightSide" name="prsn_nm" placeholder="" required>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_tmptlhrRightSide">Tempat Lahir</label>
                
                                <input type="text" class="form-control" id="prsn_tmptlhrRightSide" name="prsn_tmptlhr" placeholder="" required>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_tgllhrRightSide">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="prsn_tgllhrRightSide" name="prsn_tgllhr" placeholder="" required>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_jkRightSide">Jenis Kelamin</label>
                                <select class="form-control" id="prsn_jkRightSide" name="prsn_jk" required>
                                    <option hidden value="">Pilih Salah Satu Pilihan</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_altRightSide">Alamat</label>
                                <textarea class="form-control" id="prsn_altRightSide" name="prsn_alt" placeholder="" required rows="2"></textarea>
                                <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_kecRightSide">Kecamatan</label>
                                <select class="form-control" id="prsn_kecRightSide" name="prsn_kec" required onfocus="ambilDataSelect('prsn_kecRightSide', '{{url('kec/getDataJson')}}/', 'Pilih Salah Satu Kecamatan', toRemove=['prsn_kecRightSide'], removeMessage=['Pilih Salah Satu Kecamatan'])" onchange="ambilDataSelect('prsn_desaRightSide', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desaRightSide'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kecRightSide')">
                                    <option hidden value="">Pilih Salah Satu Kecamatan</option>
                                   
                                </select>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_desaRightSide">Desa/Kelurahan</label>
                                <select class="form-control" id="prsn_desaRightSide" name="prsn_desa" required>
                                    <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                                </select>
                            </div>
            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_golRightSide">Golongan Darah</label>
                                <select class="form-control" id="prsn_golRightSide" name="prsn_gol" required onfocus="ambilDataSelect('prsn_golRightSide', '{{url('gol/getDataJson')}}/', 'Pilih Salah Satu Golongan Darah', toRemove=['prsn_golRightSide'], removeMessage=['Pilih Salah Satu Golongan Darah'])">
                                    <option hidden value="">Pilih Salah Satu Pilihan</option>
                                   
                                </select>
                            </div>
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_krjRightSide">Pekerjaan</label>
                                <select class="form-control" id="prsn_krjRightSide" name="prsn_krj" required onfocus="ambilDataSelect('prsn_krjRightSide', '{{url('krj/getDataJson')}}/', 'Pilih Salah Satu Pekerjaan', toRemove=['prsn_krjRightSide'], removeMessage=['Pilih Salah Satu Pekerjaan'])">
                                    <option hidden value="">Pilih Salah Satu Pilihan</option>
                                    
                                </select>
                            </div>
                           
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_telpRightSide">Nomor Telepon</label>
                                <input type="text" class="form-control" id="prsn_telpRightSide" name="prsn_telp" placeholder="">
                            </div>
                            
                            <div class="form-group p-4 mb-0 pb-0 required">
                                <label class="control-label" for="prsn_waRightSide">Nomor Telepon Terhubung Whatsapp</label>
                                <select class="form-control" id="prsn_waRightSide" name="prsn_wa" required>
                                    <option hidden value="">Pilih Salah Satu Pilihan</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" id="searchBtnRight" onclick="" class="btn btn-info mx-1"><i class="fa fa-search"></i> SIMPAN</button>
                                <button type="button" onclick="showSearchRight()" class="btn btn-danger mx-1">BATAL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="item form-group">
                    
                    <button type="button" class="btn btn-danger btn-sm" onclick="resetForm('<?= $IdForm ?>addFormSide');" data-dismiss="modal">TUTUP <i class="fa fa-angle-double-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showAddRight(){
        $('#modalAddPrsnRight').modal('show');
        $('#modalViewPrsnRight').modal('hide');
    }
    $(function() {
        $(document).ready(function() {
            var {{$IdForm}}addFormSide = $('#{{$IdForm}}addFormSide');
            {{$IdForm}}addFormSide.submit(function(e) {
                showAnimated();   
                e.preventDefault();
                if ($('#{{$IdForm}}addFormSide').parsley().isValid) {
                    $('#{{$IdForm}}addFormSide :input').prop("disabled", false);
                    $(this).attr('disabled', 'disabled');
                    e.stopPropagation();
                    $.ajax({
                        type: {{$IdForm}}addFormSide.attr('method'),
                        url: {{$IdForm}}addFormSide.attr('action'),
                        enctype: 'multipart/form-data',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            hideAnimated();
                            $('#modalAddPrsnRight').modal('hide');
                            showToast(data.response.message, 'success');
                            $('#modalViewPrsnRight').modal('show');
                            getDetailPrsnSide(data.response.id);
                        },
                        error: function(xhr) {
                            hideAnimated();                        
                            showToast(xhr.responseJSON.response.message, 'error');
                        }
                    });
                }
            });
        });
    });
</script>