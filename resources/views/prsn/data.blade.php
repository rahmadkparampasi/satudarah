
<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            
            <th class="text-wrap">ID</th>
            <th class="text-wrap">Nama Lengkap</th>
            <th class="text-wrap">TTL/UMUR</th>
            <th class="text-wrap">Jenis Kelamin</th>
            <th class="text-wrap">Golongan Darah</th>
            <th class="text-wrap">Pekerjaan</th>
            <th class="text-wrap">Telepon</th>
            <th class="text-wrap">Verifikasi</th>
            <th class="text-wrap">Whatsapp</th>
            <th class="text-wrap">Alamat</th>
            <th class="text-wrap">Detail</th>
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
            
            <td class="text-wrap">{{$tk->prsn_kd}}</td>
            <td ><p class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_nm)))}}</p></td>
            <td class="text-wrap">{{ucwords(strtolower(stripslashes($tk->prsn_tmptlhr).', '.$tk->prsn_tgllhrAltT))}}<br/>Umur : {{$tk->umur}}</td>
            <td class="text-wrap">{{$tk->prsn_jkAltT}}</td>
            <td class="text-wrap">{{$tk->gol_nm}}</td>
            <td class="text-wrap">{{$tk->krj_nm}}</td>
            
            <td class="text-wrap">
                {{$tk->prsn_telp}}<br/>
                @if ($tk->prsn_telp!='')
                    <button type="button" class="btn btn-info" onclick="callOtherTWPNR('Melakukan Reset Pengguna Dan Mengirimkan Pesan Konfirmasi','{{url('prsn/resetSendWa/'.$tk->prsn_id)}}')"><i class="fas fa-paper-plane"></i></button>
                @endif
            </td>
            <td>
                @if ($tk->gol_nm!=""&&$tk->krj_nm!=''&&$tk->prsn_alt!=""&&$tk->prsn_tmptlhr!="")
                    @if ($tk->prsn_bc!='')
                        <a href="{{url('prsn/cetakKrt/'.$tk->prsn_id)}}" class="btn btn-primary"><i class="fa fa-id-card"></i></a>
                    @else
                        @if (isset($search))
                            <button type="button" class="btn btn-success" onclick="callOtherTWLoad('Verifikasi Data Personal','{{url('prsn/verification/'.$tk->prsn_id)}}', '{{url('prsn/load/'.$search_nm.'/'.$search_tgl)}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-check"></i></button>
                        @else
                            
                            <button type="button" class="btn btn-success" onclick="callOtherTWLoad('Verifikasi Data Personal','{{url('prsn/verification/'.$tk->prsn_id)}}', '{{url('prsn/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-check"></i></button>
                        @endif
                    @endif
                @endif
            </td>
            <td class="text-wrap">{{$tk->prsn_waAltT}}</td>
            
            <td class="text-wrap">{!!stripslashes($tk->prsn_altAltT)!!}</td>
            <td>
                @if ($tk->gol_nm!=""&&$tk->krj_nm!=''&&$tk->prsn_alt!=""&&$tk->prsn_tmptlhr!="")
                    <a href="{{route('prsn.view', [$tk->prsn_id])}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                @endif
            </td>
            <td>
                @if (isset($search))
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$tk->prsn_id}}'); addFill('prsn_nm', '{{$tk->prsn_nm}}'); addFill('prsn_tmptlhr', '{{$tk->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$tk->prsn_tgllhr}}');  addFill('prsn_gol', '{{$tk->prsn_gol}}'); addFill('prsn_jk', '{{$tk->prsn_jk}}'); addFill('prsn_alt', '{{$tk->prsn_alt}}'); addFill('prsn_wa', '{{$tk->prsn_wa}}'); addFill('prsn_telp', '{{$tk->prsn_telp}}'); addFill('prsn_krj', '{{$tk->prsn_krj}}'); addFill('prsn_kec', '{{$tk->kec_id}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('prsn/load/'.$search_nm.'/'.$search_tgl)}}')"><i class="fas fa-pen"></i></button>
                @else
                    <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$tk->prsn_id}}'); addFill('prsn_nm', '{{$tk->prsn_nm}}'); addFill('prsn_tmptlhr', '{{$tk->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$tk->prsn_tgllhr}}');  addFill('prsn_gol', '{{$tk->prsn_gol}}'); addFill('prsn_jk', '{{$tk->prsn_jk}}'); addFill('prsn_alt', '{{$tk->prsn_alt}}'); addFill('prsn_wa', '{{$tk->prsn_wa}}'); addFill('prsn_telp', '{{$tk->prsn_telp}}'); addFill('prsn_krj', '{{$tk->prsn_krj}}'); addFill('prsn_kec', '{{$tk->kec_id}}'); getSelect('{{$tk->kec_id}}', '{{$tk->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '');"><i class="fas fa-pen"></i></button>
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
        dTD('table#{{$IdForm}}dT', 5);
    });
</script>