<form  action="{{route('prsn.search')}}" data-load="true" id="<?= $IdForm ?>searchForm" method="post" enctype="multipart/form-data" data-parsley-validate="" style="display: none" onsubmit="return false;">
    <div class="card-body">
        @csrf
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
            <button type="button" onclick="cariPrsn()" class="btn btn-info mx-1">CARI</button>
            <button type="button" onclick="closeForm('<?= $IdForm ?>searchForm', '<?= $IdForm ?>searchForm', '{{route('prsn.search')}}'); $('#{{$IdForm}}').attr('data-url-load', '');" class="btn btn-danger mx-1">TUTUP</button>
        </div>
        
    </div>
    
</form>
<script>
    function cariPrsn()
    {
        var {{$IdForm}}searchForm = $('#{{$IdForm}}searchForm');
        myData = new FormData();
        myData.append('search_nm', $('#search_nm').val());
        myData.append('search_tgl', $('#search_tgl').val());
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
    }
    function changeSeachData() {
        
        
    }
    // $(function() {
    //     $(document).ready(function() {
    //     });
    // });
</script>