@if (count($Kred)!=0)
    <div class="card-header">
        <h5 class="mb-0">Pencapaian</h5>

    </div>
    <div class="card-body" id="detailArchive">
        <table id="detailAchievdT" data-searching="false" data-paging="false" data-ordering="false" data-responsive='true' class="display table align-items-centertable-striped table-hover responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="text-wrap">Tahun Inovasi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($Kred as $tk) @php $no++ @endphp 
                
                <tr>
                    <td>{{$no}}</td>
                    <td class="text-wrap">
                        {{$tk['thn_nm']}}<br/>
                        {{-- <a target="_blank" href="{{route('kred.index', [$tk['kre_id']])}}" class="btn btn-sm btn-info"><i class="fa fa-external-link-alt"></i></a> --}}
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            dTD('table#detailAchievdT', 100);
        });
    </script>
@endif
