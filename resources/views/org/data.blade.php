<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th class="text-wrap">Tingkat Daerah</th>
            <th class="text-wrap">Nama Organisasi</th>
            <th class="text-wrap">UTD</th>
            <th class="text-wrap">RS</th>
            <th class="text-wrap">Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Org as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td class="text-wrap">{{$tk['korg_nm']}}</td>
            <td class="text-wrap">{{$tk['org_nm']}}</td>
            
            <td>{!!$tk['org_utdAltBu']!!}</td>
            <td>{!!$tk['org_rsAltBu']!!}</td>
            <td class="text-wrap">{{stripslashes($tk['org_altAltT'])}}</td>
            <td>{!!$tk['org_actAltBu']!!}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('org.update')}}'); addFill('org_id', '{{$tk['org_id']}}'); addFill('org_korg', '{{$tk['org_korg']}}'); addFill('org_nm', '{{$tk['org_nm']}}'); addFill('org_alt', '{{$tk['org_alt']}}'); addFill('org_kec', '{{$tk->kec_id}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}'); "><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Organisasi','{{url('org/delete/'.$tk['org_id'])}}', '{{url('org/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
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