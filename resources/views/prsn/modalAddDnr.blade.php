<div id="modalAddDnr" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddDnrTitle" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="modalAddDnrF" method="POST" action="{{route('dnrm.insertM')}}" enctype="multipart/form-data" data-load="true">
            @csrf
            <input type="hidden" id="dnrm_id" name="dnrm_id" value="" />
            <input type="hidden" id="dnrm_prsn" name="dnrm_prsn" value="{{$Prsn->prsn_id}}" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddDnrTitle">Tambah Data Riwayat Donor Darah</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" class="form-control" id="prsn_idDnrm" name="prsn_id">
                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_kdDnrm">ID</label>
                        <input type="text" class="form-control" id="prsn_kdDnrm" name="prsn_nik" placeholder="" required readonly value="{{$Prsn->prsn_kd}}">
                    </div>
                    
                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_nmDnrm">Nama Lengkap</label>
                        <input type="text" class="form-control" id="prsn_nmDnrm" name="prsn_nm" placeholder="" required readonly value="{{$Prsn->prsn_nm}}">
                    </div>

                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_tmptlhrDnrm">Tempat Lahir</label>
                        <input type="text" class="form-control" id="prsn_tmptlhrDnrm" name="prsn_tmptlhr" placeholder="" required readonly value="{{$Prsn->prsn_tmptlhr}}">
                    </div>

                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_tgllhrDnrm">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="prsn_tgllhrDnrm" name="prsn_tgllhr" placeholder="" required readonly value="{{$Prsn->prsn_tgllhr}}">
                    </div>

                    <div class="form-group p-4 mb-0 pb-0 required col-md-6 col-sm-12">
                        <label class="control-label" for="prsn_golDnrm">Golongan Darah</label>
                        <select class="form-control" id="prsn_golDnrm" name="prsn_gol" required readonly>
                            <option hidden value="">Pilih Salah Satu Pilihan</option>
                            @foreach ($Gol as $tk)
                                <option value="{{$tk['gol_id']}}">{{$tk['gol_nm']}}</option>
                            @endforeach
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
                        <label class="control-label" for="dnrm_lokDnrm">Lokasi Donor</label>
                        <input type="text" class="form-control" id="dnrm_lokDnrm" name="dnrm_lok" placeholder="" required>
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
                                    url:"{{url('prsn/loadDnr/'.$prsn_id)}}",
                                    success: function(data1) {
                                        $('#dnrmAddDatadata').html(data1);
                                        // showToast(data.response.message, 'success');
                                    },
                                    error:function(xhr) {
                                        window.location.reload();
                                    }
                                });
                                $.ajax({
                                    url:"{{url('prsn/loadView/'.$prsn_id)}}",
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