<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jenis</th>
            <th>Profesi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Krj as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td>{{$tk['krj_nm']}}</td>
            <td>{!!$tk['krj_profAltBu']!!}</td>
            <td>{!!$tk['krj_actAltBu']!!}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('krj.update')}}'); addFill('krj_id', '{{$tk['krj_id']}}'); addFill('krj_nm', '{{$tk['krj_nm']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Jenis Kerja','{{url('krj/delete/'.$tk['krj_id'])}}', '{{url('krj/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
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