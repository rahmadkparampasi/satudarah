@extends('layouts.mainlayout')

@section('title', $WebTitle)

@section('content')
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="row">
        <div class="col-sm-6">
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
        
        <div class="col-sm-6">
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
        <div class="col-sm-6">
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
<div class="col-lg-6 col-md-4 col-sm-12">
    <div class="card">
        <div class="card-body">
            <canvas id="chartPrsnJk" class="w-100 " height="200px"></canvas>
        </div>
        
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="col-lg-6 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="chartPrsnGol" class="w-100 " height="200px"></canvas>
                </div>
                
            </div>
        </div>
    </div>
</div>
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
                }
            });
            const dataGol = {
                labels: [
                    @foreach ($countPrsnGol as $tk)
                        '{{$tk->gol_nm}}',

                    @endforeach
                ],
                datasets: [{
                    label: 'Data Personal Berdasarkan Golongan Darah',
                    data: [
                        @foreach ($countPrsnGol as $tk)
                            '{{$tk->total}}',

                        @endforeach
                    ],
                    // backgroundColor: [
                    // 'rgb(255, 99, 132)',
                    // 'rgb(54, 162, 235)',
                    // ],
                    hoverOffset: 4
                }]
            };
            new Chart('chartPrsnGol', {
                type: 'doughnut', 
                data: dataGol, 
                options: {
                    maintainAspectRatio: false,
                }
            });
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/vendors/script/apexcharts-bundle/dist/apexcharts.min.js"></script>
@include('includes.anotherscript')

@endsection