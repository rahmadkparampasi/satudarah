@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('ktk.addData')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
            <div class="card-header-right">
                <button class='btn btn-primary' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('ktk.insert')}}'); resetForm('{{$IdForm}}')"><i class="fa fa-plus"></i> TAMBAH</button>

                <a class='btn btn-danger mr-1' style="float: right;" href="/referensi"><i class="fa fa-reply"></i> KEMBALI</a>
            </div>
        </div>
        <div class="card-body" id="{{$IdForm}}data">
            @include('ktk.data')
        </div>
    </div>
</div>
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection