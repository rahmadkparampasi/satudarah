<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">NIK</th>
            <th class="text-wrap">Golongan</th>
            <th class="text-wrap">Tanggal Lahir</th>
            <th class="text-wrap">Tempat Rawat</th>
            <th class="text-wrap">Tanggal Rawat</th>
            <th class="text-wrap">Kebutuhan</th>
            <th class="text-wrap">Sifat</th>
            <th>Kirim</th>
            <th>Detail</th>
            <th>Aksi</th>
           
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Dnrp as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            
            <td ><p class="text-wrap">{{$tk->prsn_nm}}</p></td>
            <td class="text-wrap">{{$tk->prsn_nik}}</td>
            <td class="text-wrap text-danger font-weight-bold f-14">{{$tk->gol_nm}}</td>
            <td class="text-wrap">
                {{$tk->prsn_tgllhrAltT}}<br/>
                Umur: {{$tk->umur}}
            </td>
            <td class="text-wrap">{{$tk->org_nm}}</td>
            <td class="text-wrap">
                {{ucwords(strtolower($tk->dnr_tglAltT))}}
                
            </td>
            <td class="text-wrap">
                <p>Butuh: {{$tk->dnr_bth}}</p>
                <p>Tambah: {{$tk->dnr_tmbh}}</p>
                <p>Terpenuhi: {{$tk->total}}</p>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalAddTmbh" onclick="resetForm('modalAddTmbhF'); addFill('dnr_idTmbh', '{{$tk->dnr_id}}'); addFill('prsn_nikTmbh', '{{$tk->prsn_nik}}'); addFill('prsn_nmTmbh', '{{$tk->prsn_nm}}'); addFill('dnr_bthTmbh', '{{$tk->dnr_bth}}');"><i class="fas fa-sync"></i></button>

            </td>
           
            <td class="text-wrap">{{$tk->dnr_sftAltT}}</td>
            <td>
                <button type="button" class="btn btn-info" onclick=""><i class="fas fa-paper-plane"></i></button>
            </td>
            <td>
                <a href="{{route('dnrp.view', [$tk['dnr_id']])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
            </td>
            
            <td>
                @if ($tk['dnr_send']=="0")
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrp.update')}}'); $('.slide-page').css('margin-left', '0'); $('.display1').show();loadStepPrsn('{{$tk['dnrprsn_prsn']}}'); loadStepKtk('{{$tk['dnrktk_prsn']}}'); addFill('dnr_ktk', '{{$tk['dnr_ktk']}}'); addFill('dnr_bth', '{{$tk['dnr_bth']}}'); addFill('dnr_org', '{{$tk['dnr_org']}}'); addFill('dnr_sft', '{{$tk['dnr_sft']}}'); addFill('dnr_tgl', '{{$tk['dnr_tgl']}}'); addFill('dnr_id', '{{$tk['dnr_id']}}');"><i class="fas fa-pen"></i></button>

                    <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Donor Darah Personal','{{url('dnr/delete/'.$tk['dnr_id'])}}', '{{url('dnrp/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                @endif
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