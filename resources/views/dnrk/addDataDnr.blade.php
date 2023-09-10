<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="{{$IdForm}}Dnrcard">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('dnrm.insertK')}}" data-load="true" id="{{$IdForm}}Dnr" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" value="{{$Dnrk->dnr_id}}" name="dnr_id">
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrm_prsnNm">Nama Lengkap</label>
                    <input type="hidden" id="dnrm_prsnId" name="prsn_id" placeholder="" required>
                    <div class="row">
                        <div class="col-11">
                            <input type="text" class="form-control" id="dnrm_prsnNm" name="dnrm_prsnNm" placeholder="" required readonly>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddPrsn" onclick="addFill('search_for', 'K'); $('#formSearchPrsn').html('');"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrm_prsnKd">ID</label>
                    <input type="text" class="form-control" id="dnrm_prsnKd" name="dnrm_prsnKd" placeholder="" required readonly>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrm_jmlhDnrm">Jumlah Donor</label>
                    <input type="number" class="form-control" id="dnrm_jmlhDnrm" name="dnrm_jmlh" placeholder="" required>
                </div>
                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrm_tglDnrm">Tanggal Donor</label>
                    <input type="date" class="form-control" id="dnrm_tglDnrm" name="dnrm_tgl" placeholder="" required>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('{{$IdForm}}Dnrcard', '{{$IdForm}}Dnr', '{{route('dnrm.insertK')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $(document).ready(function() {
            var {{$IdForm}}Dnr = $('#{{$IdForm}}Dnr');
            {{$IdForm}}Dnr.submit(function(e) {
                showAnimated();
                //$('#addChildRmr :input').prop("disabled", false);
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                $.ajax({
                    type: {{$IdForm}}Dnr.attr('method'),
                    url: {{$IdForm}}Dnr.attr('action'),
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        hideAnimated();
                        closeForm('{{$IdForm}}Dnrcard', '{{$IdForm}}Dnr', '{{route('dnrm.insertK')}}');
                        if(typeof {{$IdForm}}Dnr.attr('data-load')!=='undefined'){
                            if ({{$IdForm}}Dnr.attr('data-load')==='true') {
                                showToast(data.response.message, 'success');

                                $.ajax({
                                    url:"{{url('dnrm/loadDnrk/'.$dnr_id)}}",
                                    success: function(data1) {
                                        $('#dnrmAddDatadata').html(data1);
                                    },
                                    error:function(xhr) {
                                        window.location.reload();
                                    }
                                });
                                $.ajax({
                                    url:"{{url('dnrk/loadView/'.$dnr_id)}}",
                                    success: function(data1) {
                                        $('#{{$IdForm}}data').html(data1);
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