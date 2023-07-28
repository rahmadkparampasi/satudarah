@php
    $idKlp = '';
    if (isset($klp_id)) {
        $idKlp = $klp_id;
    }
@endphp
<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100" @if ($idKlp=='') data-exp="true" @endif>
    <thead>
        <tr>
            <th>No</th>
            
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">NIK</th>
            <th class="text-wrap">TTL/UMUR</th>
            <th class="text-wrap">Jenis Kelamin</th>
            <th class="text-wrap">Golongan Darah</th>
            <th class="text-wrap">Telepon</th>
            <th class="text-wrap">Whatsapp</th>
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
            
            <td ><p class="text-wrap">{{stripslashes($tk->prsn_nm)}}</p></td>
            <td class="text-wrap">{{$tk->prsn_nik}}</td>
            <td class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_tmptlhr).', '.$tk->prsn_tgllhrAltT))}}<br/>Umur : {{$tk->umur}}</td>
            <td class="text-wrap">{{$tk->prsn_jkAltT}}</td>
            <td class="text-wrap">{{$tk->gol_nm}}</td>
            
            <td class="text-wrap">{{$tk->prsn_telp}}</td>
            <td class="text-wrap">{{$tk->prsn_waAltT}}</td>
            
            <td class="text-wrap">{!!stripslashes($tk->prsn_altAltT)!!}</td>
            
            <td>
                @if (isset($search))
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$tk->prsn_id}}'); addFill('prsn_nm', '{{$tk->prsn_nm}}'); addFill('prsn_nik', '{{$tk->prsn_nik}}'); addFill('prsn_tmptlhr', '{{$tk->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$tk->prsn_tgllhr}}');  addFill('prsn_gol', '{{$tk->prsn_gol}}'); addFill('prsn_jk', '{{$tk->prsn_jk}}'); addFill('prsn_alt', '{{$tk->prsn_alt}}'); addFill('prsn_wa', '{{$tk->prsn_wa}}'); addFill('prsn_telp', '{{$tk->prsn_telp}}'); addFill('prsn_kec', '{{$tk->kec_id}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('prsn/load/'.$search_key.'/'.$search_val)}}')"><i class="fas fa-pen"></i></button>
                @else
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$tk->prsn_id}}'); addFill('prsn_nm', '{{$tk->prsn_nm}}'); addFill('prsn_nik', '{{$tk->prsn_nik}}'); addFill('prsn_tmptlhr', '{{$tk->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$tk->prsn_tgllhr}}');  addFill('prsn_gol', '{{$tk->prsn_gol}}'); addFill('prsn_jk', '{{$tk->prsn_jk}}'); addFill('prsn_alt', '{{$tk->prsn_alt}}'); addFill('prsn_wa', '{{$tk->prsn_wa}}'); addFill('prsn_telp', '{{$tk->prsn_telp}}'); addFill('prsn_kec', '{{$tk->kec_id}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '');"><i class="fas fa-pen"></i></button>
                @endif

                <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Personal','{{url('prsn/delete/'.$tk->prsn_id)}}', '{{url('prsn/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if (isset($search))
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" onclick="closeForm('<?= $IdForm ?>searchForm', '<?= $IdForm ?>searchForm', '{{route('prsn.search')}}'); cancelSearch(); $('#{{$IdForm}}').attr('data-url-load', '');" class="btn btn-danger">TUTUP HASIL PENCARIAN</button>
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