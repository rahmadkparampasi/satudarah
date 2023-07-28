<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            <th class="text-wrap">Nama Kegiatan</th>
            <th class="text-wrap">Penyelenggara</th>
            <th class="text-wrap">Tanggal Kegiatan</th>
            <th class="text-wrap">Kontak</th>
            <th class="text-wrap">Target</th>
            <th class="text-wrap">Tempat</th>
            <th>Kirim</th>
            <th>Detail</th>
            <th>Aksi</th>
           
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Dnrk as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            <td ><p class="text-wrap">{{$tk->dnr_keg}}</p></td>
            <td ><p class="text-wrap">{{$tk->dnr_nm}}</p></td>
            <td class="text-wrap">
                {{ucwords(strtolower($tk->dnr_tglAltT))}}
            </td>
            <td class="text-wrap">{{$tk->dnr_telp}}</td>
            <td class="text-wrap">{{$tk->dnr_bth}} Kantung</td>
            <td class="text-wrap">{{$tk->dnr_tmptAltT}}</td>
            
            <td>
                <button type="button" class="btn btn-info" onclick=""><i class="fas fa-paper-plane"></i></button>
            </td>
            <td>
                <a href="{{route('dnrk.view', [$tk['dnr_id']])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
            </td>
            <td>
                @if ($tk['dnr_send']=="0")
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrk.update')}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}', 'dnr_desa'); addFill('dnr_id', '{{$tk->dnr_id}}'); addFill('dnr_keg', '{{$tk->dnr_keg}}'); addFill('dnr_nm', '{{$tk->dnr_nm}}'); addFill('dnr_tgl', '{{$tk->dnr_tgl}}'); addFill('dnr_telp', '{{$tk->dnr_telp}}'); addFill('dnr_bth', '{{$tk->dnr_bth}}'); addFill('dnr_tmpt', '{{$tk->dnr_tmpt}}'); addFill('dnr_kec', '{{$tk->kec_id}}');"><i class="fas fa-pen"></i></button>

                    <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Kegiatan Donor Darah','{{url('dnr/delete/'.$tk['dnr_id'])}}', '{{url('dnrk/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
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