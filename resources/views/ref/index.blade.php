@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')


<div class="col-xl-12">
    <h5>Pengaturan Umum</h5>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Kategori Organisasi</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{route('korg.index')}}" class="btn  btn-primary">Lebih Lanjut <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Golongan Darah</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{route('gol.index')}}" class="btn  btn-primary">Lebih Lanjut <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Segmentasi Daerah</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{route('seg.index')}}" class="btn  btn-primary">Lebih Lanjut <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Kontak Person</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{route('ktk.index')}}" class="btn  btn-primary">Lebih Lanjut <i class="fa fa-arrow-right"></i></a>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Pekerjaan</h5>
                    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{route('krj.index')}}" class="btn  btn-primary">Lebih Lanjut <i class="fa fa-arrow-right"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.anotherScript')
@endsection