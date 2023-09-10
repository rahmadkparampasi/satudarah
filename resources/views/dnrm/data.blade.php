<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            <th class="text-wrap">ID</th>
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">NIK</th>
            <th class="text-wrap">Golongan</th>
            <th class="text-wrap">Tanggal Lahir</th>
            <th class="text-wrap">Tempat Donor</th>
            <th class="text-wrap">Tanggal Donor</th>
            <th class="text-wrap">Jumlah</th>
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
            <td class="text-wrap">{{$tk->prsn_nik}}</td>
            <td class="text-wrap text-danger font-weight-bold f-14">{{$tk->gol_nm}}</td>
            <td class="text-wrap">
                {{$tk->prsn_tgllhrAltT}}<br/>
                Umur: {{$tk->umur}}
            </td>
            <td class="text-wrap">{{$tk->org_nm}}</td>
            <td class="text-wrap">
                {{ucwords(strtolower($tk->dnrm_tglAltT))}}
                
            </td>
            <td class="text-wrap">{{$tk->dnrm_jmlh}} Kantung</td>
           
           
            <td>   
                <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrm.updateM')}}'); loadStepPrsn('{{$tk['prsn_id']}}');  addFill('dnrm_tglDnrm', '{{$tk['dnrm_tgl']}}'); addFill('dnrm_idDnrm', '{{$tk['dnrm_id']}}');  addFill('dnrm_jmlhDnrm', '{{$tk['dnrm_jmlh']}}');"><i class="fas fa-pen"></i></button>

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Donor Darah Mandiri','{{url('dnrm/delete/'.$tk['dnrm_id'])}}', '{{url('dnrm/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if (isset($search))
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" onclick="closeForm('<?= $IdForm ?>searchForm', '<?= $IdForm ?>searchForm', '{{route('dnr.search')}}'); cancelSearch(); $('#{{$IdForm}}').attr('data-url-load', '');" class="btn btn-danger">TUTUP HASIL PENCARIAN</button>
    </div>
    <script>
        function cancelSearch() {
            $.ajax({
                url:"{{url($BasePage.'/load')}}",
                success: function(data1) {
                    $('#{{$IdForm}}data').html(data1);
                },
                error:function(xhr) {
                    window.location = "{{url($UrlForm)}}";
                }
            });
        }
    </script>
@endif
<script>
    
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dT');
    });
</script>