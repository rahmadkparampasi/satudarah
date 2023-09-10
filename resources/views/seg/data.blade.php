<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th class="text-wrap">No</th>
            <th class="text-wrap">Nama Segmen</th>
            <th class="text-wrap">Kode Segmen</th>
            <th class="text-wrap">Daerah (Kecamatan)</th>
            <th class="text-wrap">Status</th>
            <th class="text-wrap">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Seg as $tk) @php $no++ @endphp 
        
        <tr>
            <td class="text-wrap">{{$no}}</td>
            <td class="text-wrap">{{$tk['seg_nm']}}</td>
            <td class="text-wrap">{{$tk['seg_kd']}}</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddSegkec" onclick="addFill('seg_nmSegkec', '{{$tk['seg_nm']}}'); addFill('segkec_seg', '{{$tk['seg_id']}}'); $('#modalAddSegkecF').attr('data-div', '{{$IdForm}}data'); changeSelect()"><i class="fas fa-plus"></i></button><br />
                @if (isset($tk['Segkec']))
                    <ol type="1" class="pl-2">
                        @php
                            $numTkd = count($tk['Segkec']);
                            $iTkd = 0;
                        @endphp
                        @foreach ($tk['Segkec'] as $tkd)
                            <li>
                                <p class="mb-0">
                                    {{$tkd['kec_nama']}}
                                    <button type="button" class="btn btn-danger btn-sm" onclick="callOtherTWLoad('Menghapus Data Kecamatan Dalam Segmentasi Daerah','{{url('segkec/delete/'.$tkd['segkec_id'])}}', '{{url('seg/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                                </p>
                            </li>
                            @if(++$iTkd !== $numTkd)
                                <hr class="my-1" />
                            @endif
                        @endforeach
                    </ol>
                @endif
            </td>
            <td class="text-wrap">{!!$tk['seg_actAltBu']!!}</td>
            <td class="text-wrap">
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('seg.update')}}'); addFill('seg_id', '{{$tk['seg_id']}}'); addFill('seg_nm', '{{$tk['seg_nm']}}'); addFill('seg_kd', '{{$tk['seg_kd']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Segmentasi Daerah','{{url('seg/delete/'.$tk['seg_id'])}}', '{{url('seg/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dT');
    });
</script>