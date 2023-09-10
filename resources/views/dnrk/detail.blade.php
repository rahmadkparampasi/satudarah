@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<!-- quill-1.3.6 -->
@include('dnrk.addData')

<div class="row w-100">
    {{-- <div class="col-12">
        <div class="user-profile card mb-4">
            <div class="card-body py-0">
                <div class="user-about-block m-0">
                    <div class="row" id="detailAbout">
                        @include('dnrp.detailAbout')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-12" id="{{$IdForm}}data">
        @include('dnrk.detailDetail')
    </div>
    <div class="col-12" id="dnrmFormAddDatadata">
        @include('dnrk.addDataDnr')
    </div>
    <div class="col-12" id="dnrmAddDatadata">
        @include('dnrk.detailDnr')
    </div>
</div>
<script>
    function loadDetail(){
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
    }
   
    function loadDnrm(id) {
        showAnimated();
        myData = new FormData();
        myData.append('search_val', id);
        myData.append('search_key', 'ID');
        myData.append('_token', '{{csrf_token()}}');
        $.ajax({
            type: 'POST',
            url: '{{route('prsn.searchJson')}}',
            enctype: 'multipart/form-data',
            data: myData,
            contentType: false,
            processData: false,
            success: function(data) {
                hideAnimated();
                // $('#prsn_nik').attr('readonly', "");
                $('#prsn_nikDnrm').val(data.prsn_nik);
                $('#prsn_idDnrm').val(data.prsn_id);
                $('#prsn_nmDnrm').val(data.prsn_nm);
                $('#prsn_tmptlhrDnrm').val(data.prsn_tmptlhr);
                $('#prsn_tgllhrDnrm').val(data.prsn_tgllhr);
                $('#prsn_jkDnrm').val(data.prsn_jk);
                $('#prsn_altDnrm').val(data.prsn_alt);
                $('#prsn_kecDnrm').val(data.kec_id);
                $('#prsn_golDnrm').val(data.prsn_gol);
                $('#prsn_telpDnrm').val(data.prsn_telp);
                $('#prsn_waDnrm').val(data.prsn_wa);
                getSelect(data.kec_id, data.desa_id, 'prsn_desaDnrm');
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
                // $('#prsn_nik').removeAttr('readonly');
                $('#prsn_nikDnrm').val('');
                $('#prsn_idDnrm').val('');
                $('#prsn_nmDnrm').val('');
                $('#prsn_tmptlhrDnrm').val('');
                $('#prsn_tgllhrDnrm').val('');
                $('#prsn_jkDnrm').val('');
                $('#prsn_altDnrm').val('');
                $('#prsn_kecDnrm').val('');
                $('#prsn_desaDnrm')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                    .val('');
                $('#prsn_golDnrm').val('');
                $('#prsn_telpDnrm').val('');
                $('#prsn_waDnrm').val('');
            }
        });
    }
    function getSelect(kec_id_ex = '', desa_id_ex = '', idSelectDesa = '') {
        ambilDataSelect(idSelectDesa, '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=[idSelectDesa], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
{{-- @include('dnrk.modalAddDnr') --}}
@include('dnrlok.modalAddDnrlok')
@include('dnrk.modalAddPrsn')

@include('includes.anotherscript')
@include('includes.ajaxinsertTV')

@endsection