@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<!-- quill-1.3.6 -->

<div class="row w-100">
    <div class="col-12" >
        @include('prsn.addData')
    </div>
    <div class="col-12" id="{{$IdForm}}data">
        @include('prsn.detailDetail')
    </div>
    <div class="col-12" id="dnrmAddDatadata">
        @include('prsn.detailDnr')
    </div>
</div>
<script>
    function getSelect(kec_id_ex = '', desa_id_ex = '') {
        ambilDataSelect('prsn_desa', '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
    function loadDetail(){
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
    }
</script>
@include('prsn.modalAddDnr')

@include('includes.anotherscript')
@include('includes.ajaxinsertTV')

@endsection