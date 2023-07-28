@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<div class="row w-100">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <a href="{{url()->previous()}}" class="btn btn-danger w-100"><i class="fa fa-reply"></i> KEMBALI</a> 
                    </div>
                    <div class="col-8">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="text-center">{{$Message}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection