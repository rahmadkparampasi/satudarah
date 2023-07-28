@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('dnrp.addDataStep')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
                <button class='btn btn-primary' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('dnrp.insert')}}'); resetForm('{{$IdForm}}'); $('#prsn_nik').removeAttr('readonly'); $('#ktk_prsn_nik').removeAttr('readonly');"><i class="fa fa-plus"></i> TAMBAH</button>
            <div class="card-header-right">

            </div>
        </div>
        
        <div class="card-body" id="{{$IdForm}}data">
            @include('dnrp.data')
        </div>
    </div>
</div>
<script>
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
            }
        });
    }
    function getSelect(kec_id_ex = '', desa_id_ex = '', idSelectDesa = '') {
        ambilDataSelect(idSelectDesa, '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=[idSelectDesa], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
@include('dnrp.modalAddTmbh')
@include('dnrp.modalAddPrsn')
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection