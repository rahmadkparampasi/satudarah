<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jenis</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Ktk as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td>{{$tk['ktk_nm']}}</td>
            <td>{!!$tk['ktk_actAltBu']!!}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('ktk.update')}}'); addFill('ktk_id', '{{$tk['ktk_id']}}'); addFill('ktk_nm', '{{$tk['ktk_nm']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Jenis Kontak','{{url('ktk/delete/'.$tk['ktk_id'])}}', '{{url('ktk/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
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