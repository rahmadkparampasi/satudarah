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
<div class="modal right fade" id="modalViewPrsnRight" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewPrsnRightLabel">LIHAT DATA PERSONAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <button type="button" onclick="showAddRight()" class="btn btn-info btn-sm mx-1"><i class="fa fa-plus"></i></button>

                    <button type="button" area-hidden="true" class="btn btn-danger btn-sm" onclick="$('#viewPrsnRight').html('');resetForm('<?= $IdForm ?>searchFormSide');" data-dismiss="modal"><i class="fa fa-angle-double-right"></i></button>
                    {{-- <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span> --}}
                </button>
            </div>
            <div class="modal-body overflow-scroll" >
                <div class="row">
                    <div class="col-12 mb-5">
                        <form  action="{{route('prsn.searchSide')}}" data-load="true" id="<?= $IdForm ?>searchFormSide" method="post" enctype="multipart/form-data" data-parsley-validate="">
                            <div class="form-group pb-2 px-2 mb-0 required col-12">
                                <label for="search_nmRight">Nama</label>
                                <input type="text" class="form-control" id="search_nmRight" name="search_nmRight" placeholder="Masukan Nama" required oninput="">

                            </div>
                            <div class="form-group pt-2  px-2 mb-0 mt-0 pb-2 required col-12">
                                <label for="search_tglRight">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="search_tglRight" name="search_tglRight" placeholder="Masukan Tanggal Lahir" required oninput="">

                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" id="searchBtnRight" onclick="" class="btn btn-danger"><i class="fa fa-search"></i> CARI</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12" id="viewPrsnRight"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="item form-group">
                    
                    <button type="button" class="btn btn-danger btn-sm" onclick="$('#viewPrsnRight').html(''); resetForm('<?= $IdForm ?>searchFormSide');" data-dismiss="modal">TUTUP <i class="fa fa-angle-double-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showSearchRight(){
        $('#modalAddPrsnRight').modal('hide');
        $('#modalViewPrsnRight').modal('show');
    }
    function getDetailPrsnSide(id)
    {
        showAnimated();
        $.ajax({
            type: 'GET',
            url: '{{route('prsn.viewSide')}}/'+id,
            enctype: 'multipart/form-data',
            success: function(data) {
                hideAnimated();
                $('#viewPrsnRight').html(data);
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
            }
        });
    }
    function getSearchPrsnSide()
    {
        showAnimated();   
        myData = new FormData();
        myData.append('search_nm', $('#search_nmRight').val());
        myData.append('search_tgl', $('#search_tglRight').val());
        myData.append('_token', '{{csrf_token()}}');
        $.ajax({
            type: 'POST',
            url: '{{url('prsn/searchSide')}}',
            enctype: 'multipart/form-data',
            data: myData,
            contentType: false,
            processData: false,
            success: function(data) {
                hideAnimated();
                $('#viewPrsnRight').html(data);
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
            }
        });
    }
    $(function() {
        $(document).ready(function() {
            var {{$IdForm}}searchFormSide = $('#{{$IdForm}}searchFormSide');
            {{$IdForm}}searchFormSide.submit(function(e) {
                showAnimated();   
                $(this).attr('disabled', 'disabled');
                e.stopPropagation();
                e.preventDefault();
                myData = new FormData();
                myData.append('search_nm', $('#search_nmRight').val());
                myData.append('search_tgl', $('#search_tglRight').val());
                myData.append('_token', '{{csrf_token()}}');
                $.ajax({
                    type: {{$IdForm}}searchFormSide.attr('method'),
                    url: {{$IdForm}}searchFormSide.attr('action'),
                    enctype: 'multipart/form-data',
                    data: myData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        hideAnimated();
                        $('#viewPrsnRight').html(data);
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