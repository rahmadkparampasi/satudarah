<form  action="{{route('prsn.search')}}" data-load="true" id="<?= $IdForm ?>searchForm" method="post" enctype="multipart/form-data" data-parsley-validate="" style="display: none">
    <div class="card-body">
        @csrf
        <div class="form-row align-items-center">
            <div class="form-group col-md-4 col-lg-2">
                <select class="form-control" id="search_key" name="search_key" required>
                    <option value="Nama">Nama</option>
                    <option value="NIK">NIK</option>
                    <option value="Telp">Nomor Telepon</option>
                </select>
            </div>
            <div class="form-group col-md-8 col-lg-10 fill">
                <input type="text" class="form-control" id="search_val" name="search_val" placeholder="Masukan Kata Kunci" required oninput="">

            </div>
            
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <button type="button" onclick="closeForm('<?= $IdForm ?>searchForm', '<?= $IdForm ?>searchForm', '{{route('prsn.search')}}'); $('#{{$IdForm}}').attr('data-url-load', '');" class="btn btn-danger">TUTUP</button>
        </div>
        
    </div>
    
</form>
<script>
    $("#search_val").on("input", function(){
        var {{$IdForm}}searchForm = $('#{{$IdForm}}searchForm');
        myData = new FormData();
        myData.append('search_key', $('#search_key').val());
        myData.append('search_val', $('#search_val').val());
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
                $('#{{$IdForm}}data').html(data);
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
            }
        });
    });
    function changeSeachData() {
        
        
    }
    // $(function() {
    //     $(document).ready(function() {
    //     });
    // });
</script>