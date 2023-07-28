<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Korg as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td>{{$tk['korg_nm']}}</td>
            <td>{!!$tk['korg_actAltBu']!!}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('korg.update')}}'); addFill('korg_id', '{{$tk['korg_id']}}'); addFill('korg_nm', '{{$tk['korg_nm']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Kategori Organisasi','{{url('korg/delete/'.$tk['korg_id'])}}', '{{url('korg/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                
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