<div class="form-group row align-items-center">
    <label class="col-sm-3 col-form-label font-weight-bolder">Lokasi Donor Utama</label>
    <div class="col-sm-9">
        @foreach ($Dnrlok['DnrlokUtm'] as $tk)
            {{$tk->org_nm}}
        @endforeach
    </div>
</div>
<hr/>
<div class="form-group row align-items-center">
    <label class="col-sm-3 col-form-label font-weight-bolder">Lokasi Donor Bantuan</label>
    <div class="col-sm-9">
        @if ($Utama)
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalAddDnrlok" onclick="$('#modalAddDnrlokF').attr('data-div-load', 'lokasi'); $('#modalAddDnrlokF').attr('data-url-load', '{{url('dnrlok/loadDnrp/'.$dnr_id)}}'); addFill('dnrlok_dnr', '{{$dnr_id}}'); addFill('dnrlok_nm', '{{$Dnrp->prsn_nm}}')"><i class="fa fa-hospital"></i> Tambah Lokasi</button><br/><br/>
        @endif
        <ol type="1" class="px-2">
            @foreach ($Dnrlok['DnrlokNUtm'] as $tk)
                <li><p>{{$tk->org_nm}} 
                    @if ($Utama)
                        <button type="button" class="btn btn-danger btn-sm mx-2" onclick="callOtherTWLoad('Menghapus Data Lokasi Donor Darah','{{url('dnrlok/deleteLok/'.$tk['dnrlok_id'])}}', '{{url('dnrlok/loadDnrp/'.$dnr_id)}}', '', 'lokasi')"><i class="fas fa-trash"></i></button>
                    @endif
                </p></li>
            @endforeach
        </ol>
    </div>
</div>
<hr/>