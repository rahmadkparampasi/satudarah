@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="col-lg col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-yellow">{{$countPrsn}}</h4>
                            <h6 class="text-muted m-b-0">Jumlah Personal</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-user f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-yellow">
                    <div class="align-items-center">
                        <a href="{{route('prsn.index')}}" class="row">
                            <div class="col-9">
                                <p class="text-white m-b-0">Lihat Selengkapnya</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-arrow-right text-white f-16"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-green">{{$countDnrPrsn}}</h4>
                            <h6 class="text-muted m-b-0">Donor Personal</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-user-plus f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="align-items-center">
                        <a href="{{route('dnrp.index')}}" class="row">
                            <div class="col-9">
                                <p class="text-white m-b-0">Lihat Selengkapnya</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-arrow-right text-white f-16"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-red">{{$countDnrKeg}}</h4>
                            <h6 class="text-muted m-b-0">Kegiatan Donor</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-award f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-red">
                    <div class="align-items-center">
                        <a href="" class="row">
                            <div class="col-9">
                                <p class="text-white m-b-0">Lihat Selengkapnya</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-arrow-right text-white f-16"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if ($Pgn->users_tipe=="ADM")
            <div class="col-lg col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$countUTD}}</h4>
                                <h6 class="text-muted m-b-0">UTD / Organisasi</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fa fa-hospital-user f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue">
                        <div class="align-items-center">
                            <a href="{{url('org')}}" class="row">
                                <div class="col-9">
                                    <p class="text-white m-b-0">Lihat Selengkapnya</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-arrow-right text-white f-16"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($Pgn->users_tipe=="UTD")
            <div class="col-lg col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-blue">{{$countUsers}}</h4>
                                <h6 class="text-muted m-b-0">Pengguna</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fa fa-hospital-user f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue">
                        <div class="align-items-center">
                            <a href="{{url('users')}}" class="row">
                                <div class="col-9">
                                    <p class="text-white m-b-0">Lihat Selengkapnya</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-arrow-right text-white f-16"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue">{{$HakiCount}}</h4>
                            <h6 class="text-muted m-b-0">Hak Atas Kekayaan Intelektual (HAKI)</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="fa fa-award f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="align-items-center">
                        <a href="{{route('haki.index')}}" class="row">
                            <div class="col-9">
                                <p class="text-white m-b-0">Lihat Selengkapnya</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-arrow-right text-white f-16"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@if ($Pgn->users_tipe=="UTD")
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h6>Data Permintaan Darah</h6></div>
                    <div class="col"><a href="{{route('dnrp.index')}}" class="btn btn-info float-right"><i class="fa fa-eye"></i> LIHAT</a></div>
                </div>
            </div>
            <div class="card-body">
                <table id="{{$IdForm}}dTDnrp" class=" display table align-items-centertable-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-wrap">ID</th>
                            <th class="text-wrap">Nama Lengkap</th>
                            <th class="text-wrap">Golongan</th>
                            <th class="text-wrap">Tanggal Lahir</th>
                            <th class="text-wrap">Tempat Rawat</th>
                            <th class="text-wrap">Tanggal Rawat</th>
                            <th class="text-wrap">Kebutuhan</th>
                            <th class="text-wrap">Sifat</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($Dnrp as $tk) @php $no++ @endphp 
                        
                        <tr>
                            <td>{{$no}}</td>
                            
                            <td ><p class="text-wrap">{{$tk->prsn_kd}}</p></td>
                            <td ><p class="text-wrap">{{$tk->prsn_nm}}</p></td>
                            <td class="text-wrap text-danger font-weight-bold f-14">{{$tk->gol_nm}}</td>
                            <td class="text-wrap">
                                {{$tk->prsn_tgllhrAltT}}<br/>
                                Umur: {{$tk->umur}}
                            </td>
                            <td class="text-wrap">{{$tk->org_nm}}</td>
                            <td class="text-wrap">
                                {{ucwords(strtolower($tk->dnr_tglAltT))}}
                                
                            </td>
                            <td class="text-wrap">
                                <p>Butuh: {{$tk->dnr_bth}}</p>
                                <p>Tambah: {{$tk->dnr_tmbh}}</p>
                                <p>Terpenuhi: {{$tk->total}}</p>
                
                            </td>
                           
                            <td class="text-wrap">{{$tk->dnr_sftAltT}}</td>
                            
                           
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        dTD('table#{{$IdForm}}dTDnrp');
                    });
                </script>
            </div>
        </div>
    </div>
@endif
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="col-lg col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Data Personal Berdasarkan Jenis Kelamin</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartPrsnJk" class="w-100 " height="200px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Data Personal Berdasarkan Golongan Darah</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartPrsnGol" class="w-100 " height="200px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($Pgn->users_tipe=="UTD")
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h6>Data Kegiatan Donor Darah</h6></div>
                    <div class="col"><a href="{{route('dnrk.index')}}" class="btn btn-info float-right"><i class="fa fa-eye"></i> LIHAT</a></div>
                </div>
            </div>
            <div class="card-body">
                <table id="{{$IdForm}}dTDnrk" class=" display table align-items-centertable-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-wrap">Nama Kegiatan</th>
                            <th class="text-wrap">Penyelenggara</th>
                            <th class="text-wrap">Tanggal Kegiatan</th>
                            <th class="text-wrap">Kontak</th>
                            <th class="text-wrap">Target</th>
                            <th class="text-wrap">Tempat</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($Dnrk as $tk) @php $no++ @endphp 
                        
                        <tr>
                            <td>{{$no}}</td>
                            <td ><p class="text-wrap">{{$tk->dnr_keg}}</p></td>
                            <td ><p class="text-wrap">{{$tk->dnr_nm}}</p></td>
                            <td class="text-wrap">
                                {{ucwords(strtolower($tk->dnr_tglAltT))}}
                            </td>
                            <td class="text-wrap">{{$tk->dnr_telp}}</td>
                            <td class="text-wrap">{{$tk->dnr_bth}} Kantung</td>
                            <td class="text-wrap">{{$tk->dnr_tmptAltT}}</td>
                            <td>
                                <a href="{{route('dnrk.view', [$tk['dnr_id']])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        dTD('table#{{$IdForm}}dTDnrk');
                    });
                </script>
            </div>
        </div>
    </div>
@endif
<script>
     $(document).ready(function() {
        setTimeout(function() {
            homeChart()
        }, 100);
    });
    function homeChart() {
        $(function() {
            const dataJk = {
                labels: [
                    'Laki-Laki',
                    'Perempuan',
                ],
                datasets: [{
                    label: 'Data Personal Berdasarkan Jenis Kelamin',
                    data: [{{$countPrsnJkL}}, {{$countPrsnJkP}}],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    ],
                    hoverOffset: 4
                }]
            };
            new Chart('chartPrsnJk', {
                type: 'doughnut', 
                data: dataJk, 
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        labels: {
                            render: (args) => {
                                return " "+args.label+" "+args.value+" "
                            },
                            fontSize: 14,
                            fontColor: '#2b2b2b',
                            position: 'outside'
                        }
                    }
                }
            });
            const dataGol = {
                labels: [
                    @foreach ($countPrsnGol as $tk)
                        '{{$tk->gol_grup}}',

                    @endforeach
                ],
                datasets: [{
                    label: 'Data Personal Berdasarkan Golongan Darah',
                    data: [
                        @foreach ($countPrsnGol as $tk)
                            '{{$tk->total}}',

                        @endforeach
                    ],
                    backgroundColor: [
                    'rgb(54,162,235)',
                    'rgb(255,99,132)',
                    'rgb(255,255,255)',
                    'rgb(255,205,86)',
                    ],
                    borderColor: ['rgb(0,0,0)'],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            };
            new Chart('chartPrsnGol', {
                type: 'doughnut', 
                data: dataGol, 
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        labels: {
                            render: (args) => {
                                return " "+args.label+" "+args.value+" "
                            },
                            fontSize: 14,
                            fontColor: '#2b2b2b',
                            position: 'outside'
                        }
                    }
                }
            });
        });
    }
</script>
@include('includes.anotherscript')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script src="/vendors/script/apexcharts-bundle/dist/apexcharts.min.js"></script>

@endsection