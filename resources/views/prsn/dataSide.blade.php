<table id="{{$IdForm}}dTSearchSide" class=" display table align-items-centertable-striped table-hover w-100" data-paging="false">
    <thead>
        <tr>
            <th>No</th>
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">ID</th>
            <th class="text-wrap">TTL</th>
            <th class="text-wrap">Jenis Kelamin</th>
            <th class="text-wrap">Golongan Darah</th>
            <th class="text-wrap">Pekerjaan</th>
            <th class="text-wrap">Telepon</th>
            <th class="text-wrap">Alamat</th>
            <th>Aksi</th>
           
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Prsn as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            
            <td class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_nm)))}}</td>
            <td class="text-wrap">{{$tk->prsn_kd}}</td>
            <td class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_tmptlhr).', '.$tk->prsn_tgllhrAltT))}}</td>
            <td class="text-wrap">{{$tk->prsn_jkAltT}}</td>
            <td class="text-wrap">{{$tk->gol_nm}}</td>
            <td class="text-wrap">{{$tk->krj_nm}}</td>
            <td class="text-wrap">{{$tk->prsn_telp}}</td>
            
            <td class="text-wrap">{!!stripslashes($tk->prsn_altAltT)!!}</td>
            
            <td>
                <button type="button" class="btn btn-primary" onclick="getDetailPrsnSide('{{$tk->prsn_id}}')"><i class="fas fa-eye"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dTSearchSide');
    });
</script>