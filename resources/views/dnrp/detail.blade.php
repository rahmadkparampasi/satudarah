@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<!-- quill-1.3.6 -->
@include('dnrp.addDataStep')

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
        @include('dnrp.detailDetail')
    </div>
    <div class="col-12" id="dnrmAddDatadata">
        @include('dnrp.detailDnr')
    </div>
</div>
<script>
    function loadDetail(){
        $.ajax({
            url:"{{url('dnrm/loadDnrp/'.$dnr_id)}}",
            success: function(data1) {
                $('#dnrmAddDatadata').html(data1);
            },
            error:function(xhr) {
                window.location.reload();
            }
        });
        $.ajax({
            url:"{{url('dnrp/loadView/'.$dnr_id)}}",
            success: function(data1) {
                $('#{{$IdForm}}data').html(data1);
            },
            error:function(xhr) {
                window.location.reload();
            }
        });
    }
    function loadStepPrsn(id) {
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
                $('#prsn_dnr').val('S');
                // $('#prsn_nik').attr('readonly', "");
                $('#prsn_nik').val(data.prsn_nik);
                $('#prsn_id').val(data.prsn_id);
                $('#prsn_nm').val(data.prsn_nm);
                $('#prsn_tmptlhr').val(data.prsn_tmptlhr);
                $('#prsn_tgllhr').val(data.prsn_tgllhr);
                $('#prsn_jk').val(data.prsn_jk);
                $('#prsn_alt').val(data.prsn_alt);
                $('#prsn_kec').val(data.kec_id);
                $('#prsn_gol').val(data.prsn_gol);
                $('#prsn_krj').val(data.prsn_krj);
                getSelect(data.kec_id, data.desa_id, 'prsn_desa');
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
                $('#prsn_dnr').val('B');
                // $('#prsn_nik').removeAttr('readonly');
                $('#prsn_nik').val('');
                $('#prsn_id').val('');
                $('#prsn_nm').val('');
                $('#prsn_tmptlhr').val('');
                $('#prsn_tgllhr').val('');
                $('#prsn_jk').val('');
                $('#prsn_alt').val('');
                $('#prsn_kec').val('');
                $('#prsn_desa')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                    .val('');
                $('#prsn_gol').val('');
                $('#prsn_krj').val('');
            }
        });
    }
    function loadStepKtk(id) {
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
                $('#ktk_prsn_id').val(data.prsn_id);
                // $('#ktk_prsn_nik').attr('readonly', "");
                $('#ktk_prsn_nik').val(data.prsn_nik);
                $('#ktk_prsn_nm').val(data.prsn_nm);
                $('#ktk_prsn_tmptlhr').val(data.prsn_tmptlhr);
                $('#ktk_prsn_tgllhr').val(data.prsn_tgllhr);
                $('#ktk_prsn_jk').val(data.prsn_jk);
                $('#ktk_prsn_alt').val(data.prsn_alt);
                $('#ktk_prsn_kec').val(data.kec_id);
                $('#ktk_prsn_telp').val(data.prsn_telp);
                $('#ktk_prsn_wa').val(data.prsn_wa);
                $('#ktk_prsn_krj').val(data.prsn_krj);
                getSelect(data.kec_id, data.desa_id, 'ktk_prsn_desa');
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
                $('#ktk_prsn_id').val('');
                // $('#ktk_prsn_nik').removeAttr('readonly');
                $('#ktk_prsn_nik').val('');
                $('#ktk_prsn_nm').val('');
                $('#ktk_prsn_tmptlhr').val('');
                $('#ktk_prsn_tgllhr').val('');
                $('#ktk_prsn_jk').val('');
                $('#ktk_prsn_alt').val('');
                $('#ktk_prsn_kec').val('');
                $('#ktk_prsn_desa')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>')
                    .val('');
                $('#ktk_prsn_telp').val('');
                $('#ktk_prsn_wa').val('');
                $('#ktk_prsn_krj').val('');
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
                $('#prsn_krjDnrm').val(data.prsn_krj);

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
                $('#prsn_krjDnrm').val('');
            }
        });
    }
    function getSelect(kec_id_ex = '', desa_id_ex = '', idSelectDesa = '') {
        ambilDataSelect(idSelectDesa, '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=[idSelectDesa], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
@include('dnrlok.modalAddDnrlok')
@include('dnrp.modalAddDnr')
@include('dnrp.modalAddTmbh')

@include('includes.anotherscript')
@include('includes.ajaxinsertTV')

@endsection