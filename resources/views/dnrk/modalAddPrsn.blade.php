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
                    <form action="{{route('prsn.searchDnr')}}" data-load="true" id="<?= $IdForm ?>searchForm" method="post" enctype="multipart/form-data" data-parsley-validate="">
                        <div class="card-body">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-4 col-lg-2">
                                    <select class="form-control" id="search_key" name="search_key" required>
                                        <option value="Nama">Nama</option>
                                        <option value="NIK">NIK</option>
                                        {{-- <option value="Telp">Nomor Telepon</option> --}}
                                    </select>
                                </div>
                                <div class="form-group col-md-8 col-lg-10 fill">
                                    <input type="hidden" id="search_for" name="search_for">
                                    <input type="text" class="form-control" id="search_val" name="search_val" placeholder="Masukan Kata Kunci" required oninput="">
                                </div>
                                
                            </div>
                           
                            
                        </div>
                        
                    </form>
                    <script>
                        $("#search_val").on("input", function(){
                            var {{$IdForm}}searchForm = $('#{{$IdForm}}searchForm');
                            myData = new FormData();
                            myData.append('search_key', $('#search_key').val());
                            myData.append('search_val', $('#search_val').val());
                            myData.append('search_for', $('#search_for').val());
                            myData.append('_token', '{{csrf_token()}}');
                            $.ajax({
                                type: {{$IdForm}}searchForm.attr('method'),
                                url: {{$IdForm}}searchForm.attr('action'),
                                enctype: 'multipart/form-data',
                                data: myData,
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
                        });
                    </script>
                   <div id="formSearchPrsn"></div>
                </div>
                <div class="modal-footer">
                    <div class="item form-group">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    </div>
                </div>
            </div>
        
    </div>
</div>
