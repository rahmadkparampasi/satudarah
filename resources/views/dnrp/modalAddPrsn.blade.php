<div id="modalAddPrsn" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalAddPrsnTitle" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPrsnTitle">Tambah Pasien</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('prsn.searchDnr')}}" data-load="true" id="<?= $IdForm ?>searchForm" method="post" enctype="multipart/form-data" data-parsley-validate="" onsubmit="">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" class="form-control" id="search_for" name="search_for" placeholder="Masukan Nama" required oninput="">
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-4 col-lg-2">
                                    <label for="search_nm">Nama</label>
                                </div>
                                <div class="form-group col-md-8 col-lg-10 fill">
                                    <input type="text" class="form-control" id="search_nm" name="search_nm" placeholder="Masukan Nama" required oninput="">
                    
                                </div>
                                
                            </div>
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-4 col-lg-2">
                                    <label for="search_tgl">Tanggal Lahir</label>
                                </div>
                                <div class="form-group col-md-8 col-lg-10 fill">
                                    <input type="date" class="form-control" id="search_tgl" name="search_tgl" placeholder="Masukan Tanggal Lahir" required oninput="">
                    
                                </div>
                                
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" onclick="" class="btn btn-info mx-1">CARI</button>
                               
                            </div>
                            
                        </div>
                        
                    </form>
                    <script>
                        $(function() {
                            $(document).ready(function() {
                                $('#{{$IdForm}}').parsley();
                                var {{$IdForm}}searchForm = $('#{{$IdForm}}searchForm');
                                {{$IdForm}}searchForm.submit(function(e) {
                                    showAnimated();
                                    e.preventDefault();
                                    if ($('#{{$IdForm}}searchForm').parsley().isValid) {
                                        $('#{{$IdForm}}searchForm :input').prop("disabled", false);
                                        $(this).attr('disabled', 'disabled');
                                        e.stopPropagation();
                                        $.ajax({
                                            type: {{$IdForm}}searchForm.attr('method'),
                                            url: {{$IdForm}}searchForm.attr('action'),
                                            enctype: 'multipart/form-data',
                                            data: new FormData(this),
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
                                                hideAnimated();
                                                $('#formSearchPrsn').html(data);
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
                   <div id="formSearchPrsn"></div>
                </div>
                <div class="modal-footer">
                    <div class="item form-group">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
                    </div>
                </div>
            </div>
        
    </div>
</div>
