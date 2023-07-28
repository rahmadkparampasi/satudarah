@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('dnrk.addData')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
                <button class='btn btn-primary' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('dnrk.insert')}}'); resetForm('{{$IdForm}}');"><i class="fa fa-plus"></i> TAMBAH</button>
            <div class="card-header-right">

            </div>
        </div>
        
        <div class="card-body" id="{{$IdForm}}data">
            @include('dnrk.data')
        </div>
    </div>
</div>
<script>
    
    function getSelect(kec_id_ex = '', desa_id_ex = '', idSelectDesa = '') {
        ambilDataSelect(idSelectDesa, '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=[idSelectDesa], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection