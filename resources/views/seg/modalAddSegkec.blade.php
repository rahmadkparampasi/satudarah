<div id="modalAddSegkec" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddSegkecTitle" aria-modal="true">
    <div class="modal-dialog" role="document">
        <form id="modalAddSegkecF" method="POST" action="{{ route('segkec.insertData') }}" enctype="multipart/form-data" data-load="true" data-div="cardBodyDataIid" data-urlload="{{url('seg/load')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddSegkecTitle">Tambahkan Kecamatan Pada Segmentasi Daerah</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group required">
                        <label class="control-label" for="seg_nmSegkec">Nama Segmen</label>
                        <input type="text"  class="form-control" id="seg_nmSegkec" name="seg_nmSegkec" required readonly/>
                        <input type="hidden"  class="form-control" id="segkec_seg" name="segkec_seg" required readonly/>
                        
                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="segkec_kec">Kecamatan</label>
                        <select class="form-control" id="segkec_kec" name="segkec_kec" required>
                            <option hidden value="">Pilih Salah Satu Kecamatan</option>
                            
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
    function changeSelect()
    {
        ambilDataSelect('segkec_kec', '{{url('kec/getDataJsonExcSeg')}}/', 'Pilih Salah Satu Kecamatan', toRemove=['segkec_kec'], removeMessage=['Pilih Salah Satu Kecamatan'])
    }
    $(function() {
        $(document).ready(function() {
            var modalAddSegkecF = $('#modalAddSegkecF');
            modalAddSegkecF.submit(function(e) {
                showAnimated();
                //$('#addChildRmr :input').prop("disabled", false);
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                $.ajax({
                    type: modalAddSegkecF.attr('method'),
                    url: modalAddSegkecF.attr('action'),
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        hideAnimated();
                        $('#modalAddSegkec').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        if(typeof modalAddSegkecF.attr('data-load')!=='undefined'){
                            if (modalAddSegkecF.attr('data-load')==='true') {
                                $.ajax({
                                    url:modalAddSegkecF.attr('data-urlload'),
                                    success: function(data1) {
                                        if(typeof modalAddSegkecF.attr('data-div')!=='undefined'){
                                            $('#'+modalAddSegkecF.attr('data-div')).html(data1);
                                        }
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
                                window.location.reload();
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