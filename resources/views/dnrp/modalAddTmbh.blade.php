<div id="modalAddTmbh" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddTmbhTitle" aria-modal="true">
    <div class="modal-dialog" role="document">
        <form id="modalAddTmbhF" method="POST" action="{{route('dnrp.updateTmbh')}}" enctype="multipart/form-data" data-load="true">
            @csrf
            <input type="hidden" id="dnr_idTmbh" name="dnr_id" />
            <input type="hidden" id="tipeTmbh" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTmbhTitle">Tambah Jumlah Kebutuhan Darah</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="prsn_nikTmbh">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control" id="prsn_nikTmbh" name="prsn_nik" placeholder="" required readonly>
                    </div>
                    
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="prsn_nmTmbh">Nama Lengkap</label>
                        <input type="text" class="form-control" id="prsn_nmTmbh" name="prsn_nm" placeholder="" required readonly>
                    </div>
                   
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="dnr_bthTmbh">Kebutuhan Awal (Kantung)</label>
                        <input type="number" class="form-control" id="dnr_bthTmbh" name="dnr_bth" placeholder="" required readonly>
                    </div>
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="dnr_tmbhTmbh">Penambahan (Kantung)</label>
                        <input type="number" class="form-control" id="dnr_tmbhTmbh" name="dnr_tmbh" placeholder="" required>
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
            var modalAddTmbhF = $('#modalAddTmbhF');
            modalAddTmbhF.submit(function(e) {
                showAnimated();
                //$('#addChildRmr :input').prop("disabled", false);
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                $.ajax({
                    type: modalAddTmbhF.attr('method'),
                    url: modalAddTmbhF.attr('action'),
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        hideAnimated();
                        $('#modalAddTmbh').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        if(typeof modalAddTmbhF.attr('data-load')!=='undefined'){
                            if (modalAddTmbhF.attr('data-load')==='true') {
                                var tipeTmbh = $('#tipeTmbh').val();
                                if (tipeTmbh==''||tipeTmbh!='D') {
                                    $.ajax({
                                        url:"{{url($BasePage.'/load')}}",
                                        success: function(data1) {
                                            $('#{{$IdForm}}data').html(data1);
                                            resetForm('modalAddTmbhF')
                                            showToast(data.response.message, 'success');
                                        },
                                        error:function(xhr) {
                                            window.location = "{{url($UrlForm)}}";
                                        }
                                    });
                                }else{
                                    $.ajax({
                                        url:"{{url($BasePage.'/loadView/')}}/"+$('#dnr_idTmbh').val(),
                                        success: function(data1) {
                                            $('#{{$IdForm}}data').html(data1);
                                            resetForm('modalAddTmbhF')
                                            showToast(data.response.message, 'success');
                                        },
                                        error:function(xhr) {
                                            window.location = "{{url($UrlForm)}}";
                                        }
                                    });
                                }
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