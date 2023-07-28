<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Golongan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Gol as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td>{{$tk['gol_nm']}}</td>
            <td>{!!$tk['gol_actAltBu']!!}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('gol.update')}}'); addFill('gol_id', '{{$tk['gol_id']}}'); addFill('gol_nm', '{{$tk['gol_nm']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Golongan Darah','{{url('gol/delete/'.$tk['gol_id'])}}', '{{url('gol/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
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