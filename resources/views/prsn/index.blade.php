@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('prsn.addData')
@include('prsn.addDataExcel')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
            <div class="card-header-right">
                <button class='btn btn-primary' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('prsn.insert')}}'); resetForm('{{$IdForm}}')"><i class="fa fa-plus"></i> TAMBAH</button>
                
                <button class='btn btn-primary mr-1' style="float: right;" onclick="showForm('{{$IdForm}}cardExcel', 'flex'); cActForm('{{$IdForm}}Excel', '{{route('prsn.excelForm')}}'); resetForm('{{$IdForm}}Excel')"><i class="fa fa-file-excel"></i> TAMBAH EXCEL</button>
                <button class='btn btn-primary mr-1' style="float: right;" onclick="showForm('{{$IdForm}}cardExcel', 'flex'); cActForm('{{$IdForm}}Excel', '{{route('prsn.excelNForm')}}'); resetForm('{{$IdForm}}Excel')"><i class="fa fa-file-excel"></i> TAMBAH EXCEL</button>

                <button class='btn btn-success mr-1' style="float: right;" onclick="showForm('{{$IdForm}}searchForm', 'block'); cActForm('{{$IdForm}}searchForm', '{{route('prsn.search')}}'); resetForm('{{$IdForm}}searchForm')"><i class="fa fa-search"></i> CARI</button>
            </div>
        </div>
        <div class="card-body" id="{{$IdForm}}searchData">
            @include('prsn.searchData')
        </div>
        <div class="card-body" id="{{$IdForm}}data">
            @include('prsn.data')
        </div>
    </div>
</div>
<script>
    function getSelect(kec_id_ex = '', desa_id_ex = '') {
        ambilDataSelect('prsn_desa', '/desa/getDataJson/'+kec_id_ex, 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], '', desa_id_ex);
    }
</script>
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection