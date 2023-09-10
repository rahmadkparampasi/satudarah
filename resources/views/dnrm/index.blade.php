@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('dnrm.addData')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
            <button class='btn btn-primary' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('dnrm.insertM')}}'); resetForm('{{$IdForm}}');dateNowTgl();"><i class="fa fa-plus"></i> TAMBAH</button>
        </div>
        
        <div class="card-body" id="{{$IdForm}}data">
            @include('dnrm.data')
        </div>
    </div>
</div>
<script>
    function dateNowTgl()
    {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $('#dnrm_tglDnrm').val(today);
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
                $('#prsn_dnrDnrm').val('S');
                $('#prsn_nikDnrm').val(data.prsn_nik);
                $('#prsn_idDnrm').val(data.prsn_id);
                $('#prsn_nmDnrm').val(data.prsn_nm);
                $('#prsn_tmptlhrDnrm').val(data.prsn_tmptlhr);
                $('#prsn_tgllhrDnrm').val(data.prsn_tgllhr);
                $('#prsn_jkDnrm').val(data.prsn_jk);
                $('#prsn_altDnrm').val(data.prsn_alt);
                $('#prsn_kecDnrm').val(data.kec_id);
                $('#prsn_golDnrm').val(data.prsn_gol);
                $('#prsn_krjDnrm').val(data.prsn_krj);
                $('#prsn_telpDnrm').val(data.prsn_telp);
                $('#prsn_waDnrm').val(data.prsn_wa);

                getSelect(data.kec_id, data.desa_id, 'prsn_desaDnrm');
            },
            error: function(xhr) {
                hideAnimated();                        
                showToast(xhr.responseJSON.response.message, 'error');
                $('#prsn_dnr').val('B');
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
                $('#prsn_krjDnrm').val('');
                $('#prsn_telpDnrm').val('');
                $('#prsn_waDnrm').val('');
            }
        });
    }
    function getSelect(kec_id_ex = '', desa_id_ex = '', idSelectDesa = '') {
        ambilDataSelect(idSelectDesa, '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=[idSelectDesa], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection