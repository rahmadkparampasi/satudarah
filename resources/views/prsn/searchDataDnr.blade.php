Tes {{ $search_for }}
<table id="{{$IdForm}}dTSearch" class=" display table align-items-centertable-striped table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">NIK</th>
            <th class="text-wrap">TTL</th>
            <th class="text-wrap">Jenis Kelamin</th>
            <th class="text-wrap">Golongan Darah</th>
            <th class="text-wrap">Telepon</th>
            <th class="text-wrap">Whatsapp</th>
            <th class="text-wrap">Alamat</th>
           
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Prsn as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td>
                <button type="button" class="btn btn-success" onclick="insertVal('{{$tk->prsn_nm}}','{{$tk->prsn_id}}', '{{$tk->prsn_nik}}', '{{$tk->prsn_telp}}')"><i class="fas fa-check"></i></button>
            </td>
            <td ><p class="text-wrap">{{$tk->prsn_nm}}</p></td>
            <td class="text-wrap">{{$tk->prsn_nik}}</td>
            <td class="text-wrap">{{ucwords(strtolower($tk->prsn_tmptlhr.', '.$tk->prsn_tgllhrAltT))}}</td>
            <td class="text-wrap">{{$tk->prsn_jkAltT}}</td>
            <td class="text-wrap">{{$tk->gol_nm}}</td>
            
            <td class="text-wrap">{{$tk->prsn_telp}}</td>
            <td class="text-wrap">{{$tk->prsn_waAltT}}</td>
            
            <td class="text-wrap">{!!stripslashes($tk->prsn_altAltT)!!}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
    @if ($search_for == "P")
        <script>
            
            function insertVal(nama, id, nik) {
                $('#dnrprsn_prsnnm').val(nama);
                $('#dnrprsn_prsn').val(id);
                $('#dnrprsn_prsnnik').val(nik);
                $('#modalAddPrsn').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }    
        </script>
    @else
        <script>
            
            function insertVal(nama, id, nik, telp) {
                $('#dnrktk_prsnnm').val(nama);
                $('#dnrktk_prsn').val(id);
                $('#dnrktk_prsnnmr').val(telp);
                $('#modalAddPrsn').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }    
        </script>
        
    @endif
<script>
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dTSearch');
    });
</script>