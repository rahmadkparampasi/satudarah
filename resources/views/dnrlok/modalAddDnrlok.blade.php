<div id="modalAddDnrlok" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddDnrlokTitle" aria-modal="true">
    <div class="modal-dialog" role="document">
        <form id="modalAddDnrlokF" method="POST" action="{{route('dnrlok.insertLok')}}" enctype="multipart/form-data" data-load="true" data-url-load="" data-div-load="">
            @csrf
            <input type="hidden" id="dnrlok_dnr" name="dnrlok_dnr" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddDnrlokTitle">Tambah Lokasi Donor Darah</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="dnrlok_nm" id="dnrlok_nm_label">Nama Penerima Darah</label>
                        <input type="text" readonly class="form-control" id="dnrlok_nm" name="dnrlok_nm" placeholder="" required />
                            
                    </div>
                    <div class="form-group p-4 mb-0 pb-0 required col-12">
                        <label class="control-label" for="dnrlok_org" id="dnrlok_org_label">Lokasi Donor Darah</label>
                        <select class="form-control" id="dnrlok_org" name="dnrlok_org" placeholder="" required>
                            <option value="" hidden>Pilih Salah Satu Pilihan</option>
                            @foreach ($Org as $tk)
                                <option value="{{$tk->org_id}}">{{$tk->org_nm}}</option>
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
            var modalAddDnrlokF = $('#modalAddDnrlokF');
            modalAddDnrlokF.submit(function(e) {
                showAnimated();
                //$('#addChildRmr :input').prop("disabled", false);
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                $.ajax({
                    type: modalAddDnrlokF.attr('method'),
                    url: modalAddDnrlokF.attr('action'),
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        hideAnimated();
                        $('#modalAddDnrlok').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        if(typeof modalAddDnrlokF.attr('data-load')!=='undefined'){
                            if (modalAddDnrlokF.attr('data-load')==='true') {
                                if(typeof modalAddDnrlokF.attr('data-url-load')!=='undefined'){
                                    if (modalAddDnrlokF.attr('data-url-load')==='') {
                                        swal.fire({
                                        title: "Terima Kasih",
                                        text: data.response.message,
                                        icon: data.response.response
                                        }).then(function() {
                                            window.location.reload();
                                        });
                                    }else{
                                        if(typeof modalAddDnrlokF.attr('data-div-load')!=='undefined'){
                                            if (modalAddDnrlokF.attr('data-div-load')==='') {
                                                swal.fire({
                                                title: "Terima Kasih",
                                                text: data.response.message,
                                                icon: data.response.response
                                                }).then(function() {
                                                    window.location.reload();
                                                });
                                            }else{
                                                $.ajax({
                                                    url:modalAddDnrlokF.attr('data-url-load'),
                                                    success: function(data1) {
                                                        $('#'+modalAddDnrlokF.attr('data-div-load')).html(data1);
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
                                    }
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