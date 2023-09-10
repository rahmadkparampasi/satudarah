<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-1">Data Pendonor</h4>
        <button type="button" class="btn btn-success rounded m-0 float-end" onclick="resetForm('{{$IdForm}}Dnr'); cActForm('{{$IdForm}}Dnr', '{{route('dnrm.insertK')}}'); addFill('dnrm_tglDnrm', '{{$Dnrk->dnr_tgl}}'); showForm('{{$IdForm}}Dnrcard', 'flex', 'no')">
            <i class="fa fa-plus"></i> Tambah
        </button>
    </div>
    <div class="card-body">
        <table id="{{$IdForm}}dTDnrm" class=" display table align-items-centertable-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No</th>
                    
                    <th class="text-wrap">ID</th>
                    <th class="text-wrap">Nama Lengkap</th>
                    <th class="text-wrap">Golongan</th>
                    <th class="text-wrap">Jumlah Donor</th>
                    <th class="text-wrap">Tanggal Donor</th>
                    <th class="text-wrap">Tanggal Lahir</th>
                   
                    <th>Aksi</th>
                   
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($Dnrm as $tk) @php $no++ @endphp 
                
                <tr>
                    <td>{{$no}}</td>
                    
                    <td class="text-wrap">{{$tk->prsn_kd}}</td>
                    <td ><p class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_nm)))}}</p></td>
                    <td class="text-wrap text-danger font-weight-bold f-14">{{$tk->gol_nm}}</td>
                    <td class="text-wrap f-14 font-weight-bold">{{$tk->dnrm_jmlh}}</td>
                    <td class="text-wrap">{{$tk->dnrm_tglAltT}}</td>
                    <td class="text-wrap">
                        {{$tk->prsn_tgllhrAltT}}<br/>
                        Umur: {{$tk->umur}}
                    </td>
                    
                    <td>
                        
                        <button type="button" class="btn btn-danger" onclick="callOtherTWF('Menghapus Data Penddonor Darah','{{url('dnrm/delete/'.$tk['dnrm_id'])}}', loadDetail)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dTDnrm');
    });
</script>