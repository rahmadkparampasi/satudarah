@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
@include('users.addData')
<div class="col-sm-12" >
    <div class="card">
        <div class="card-header">
            <h6>Data {{$PageTitle}}</h6>
            <div class="card-header-right">
                
                <button class='btn btn-primary mx-1' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('users.insertUTD')}}'); resetForm('{{$IdForm}}'); showFormUsersInsertUTD();"><i class="fa fa-hospital"></i> TAMBAH UTD</button>
                @if ($Pgn->users_tipe=="ADM")
                    <button class='btn btn-primary mx-1' style="float: right;" onclick="showForm('{{$IdForm}}card', 'flex'); cActForm('{{$IdForm}}', '{{route('users.insert')}}'); resetForm('{{$IdForm}}'); showFormUsersInsert();"><i class="fa fa-plus"></i> TAMBAH</button>
                @endif
               
            </div>
        </div>
        <div class="card-body" id="{{$IdForm}}data">
            @include('users.data')
        </div>
    </div>
</div>
<script>
    function showFormUsersInsert(){
        $('#users_orgFormGroup').hide(); 
        $('#users_org').removeAttr('required');
        $('#passwordFormGroup').show(); 
        $('#password').attr('required', '');
        $('#password1FormGroup').show(); 
        $('#password1').attr('required', '');
    }
    function showFormUsersUpdate(){
        $('#users_orgFormGroup').hide(); 
        $('#users_org').removeAttr('required');
        $('#passwordFormGroup').hide(); 
        $('#password').removeAttr('required');
        $('#password1FormGroup').hide(); 
        $('#password1').removeAttr('required');
    }
    function showFormUsersInsertUTD(){
        $('#users_orgFormGroup').show(); 
        $('#users_org').attr('required', '');
        $('#passwordFormGroup').show(); 
        $('#password').attr('required', '');
        $('#password1FormGroup').show(); 
        $('#password1').attr('required', '');
    }
    function showFormUsersUpdateUTD(){
        $('#users_orgFormGroup').show(); 
        $('#users_org').attr('required', '');
        $('#passwordFormGroup').hide(); 
        $('#password').removeAttr('required');
        $('#password1FormGroup').hide(); 
        $('#password1').removeAttr('required');
    }
</script>
@include('users.modalChangeReset')
@include('includes.anotherscript')
@include('includes.ajaxinsertTV')
@endsection