<div class="row w-100">
    @if ($mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    @if ($Utama)
                        <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrk.update')}}'); addFill('dnr_id', '{{$Dnrk->dnr_id}}'); addFill('dnr_keg', '{{$Dnrk->dnr_keg}}'); addFill('dnr_nm', '{{$Dnrk->dnr_nm}}'); addFill('dnr_tgl', '{{$Dnrk->dnr_tgl}}'); addFill('dnr_telp', '{{$Dnrk->dnr_telp}}'); addFill('dnr_bth', '{{$Dnrk->dnr_bth}}'); addFill('dnr_tmpt', '{{$Dnrk->dnr_tmpt}}'); addFill('dnr_kec', '{{$Dnrk->kec_id}}'); getSelect('{{$Dnrk->kec_id}}', '{{$Dnrk->desa_id}}', 'dnr_desa'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrk/loadView/'.$dnr_id)}}')"><i class="fa fa-pen"></i> UBAH</button>
                    @endif
                    <a href="{{route('dnrp.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 
                </div>
            </div>
            
        </div>                  
    @endif
    <div class="col-md-8 order-md-2">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="detail-tab">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-1">Data Kegiatan Donor Darah
                                    @php
                                        $SisaBadge = "badge-danger";
                                        
                                        if ((int)$Dnrk->total>0) {
                                            $SisaBadge = "badge-warning";
                                        }elseif((int)$Dnrk->total>=$Dnrk->dnr_bth){
                                            $SisaBadge = "badge-success";
                                        }
                                    @endphp
                                    <span class="badge {{$SisaBadge}} font-weight-bold f-20">{{$Dnrk->total}}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Kegiatan</label>
                            <div class="col-sm-9">
                                {{$Dnrk->dnr_keg}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Penyelenggara</label>
                            <div class="col-sm-9">
                                {{$Dnrk->dnr_nm}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Target</label>
                            <div class="col-sm-9">{{$Dnrk->dnr_bth}} Kantung</div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal kegiatan</label>
                            <div class="col-sm-9">
                                {{ucwords(strtolower($Dnrk->dnr_tglAltT))}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Tempat Kegiatan</label>
                            <div class="col-sm-9">
                                {{$Dnrk->dnr_tmptAltT}}
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bolder">Kontak</label>
                            <div class="col-sm-9">
                                {{$Dnrk->dnr_telp}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <div class="col-md-4 order-md-1">
        @if (!$mobile)
            <div class="card">
                <div class="card-body">
                    @if ($Utama)
                        <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrk.update')}}'); addFill('dnr_id', '{{$Dnrk->dnr_id}}'); addFill('dnr_keg', '{{$Dnrk->dnr_keg}}'); addFill('dnr_nm', '{{$Dnrk->dnr_nm}}'); addFill('dnr_tgl', '{{$Dnrk->dnr_tgl}}'); addFill('dnr_telp', '{{$Dnrk->dnr_telp}}'); addFill('dnr_bth', '{{$Dnrk->dnr_bth}}'); addFill('dnr_tmpt', '{{$Dnrk->dnr_tmpt}}'); addFill('dnr_kec', '{{$Dnrk->kec_id}}'); getSelect('{{$Dnrk->kec_id}}', '{{$Dnrk->desa_id}}', 'dnr_desa'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrk/loadView/'.$dnr_id)}}')"><i class="fa fa-pen"></i> UBAH</button>
                    @endif
                    <a href="{{route('dnrk.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5>Kontributor</h5>
            </div>
            <div class="card-body">
                <div class="form-group row align-items-center">
                    <label class="col-12 col-form-label font-weight-bolder">Kontributor Utama</label>
                    <div class="col-12">
                        @foreach ($Dnrlok['DnrlokUtm'] as $tk)
                            {{$tk->org_nm}}<br/>
                        @endforeach
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-12 col-form-label font-weight-bolder">Kontributor Bantuan</label>
                    @if ($Utama)
                        <div class="col-12">
                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalAddDnrlok" onclick="resetForm('modalAddDnrlokF'); cActForm('modalAddDnrlokF', '{{route('dnrlok.insertK')}}'); $('#modalAddDnrlokF').attr('data-div-load', '{{$IdForm}}data'); $('#modalAddDnrlokF').attr('data-url-load', '{{url('dnrlok/loadDnrk/'.$dnr_id)}}'); addFill('dnrlok_dnr', '{{$dnr_id}}'); addFill('dnrlok_nm', '{{$Dnrk->dnr_keg}}'); $('#modalAddDnrlokTitle').html('Tambah Kontributor Donor Darah'); $('#dnrlok_nm_label').html('Nama Kegiatan'); $('#dnrlok_org_label').html('UTD / Organisasi');"><i class="fa fa-hospital"></i> Tambah</button><br/><br/>
                        </div>
                    @endif
                    <div class="col-12">
                        <ol type="1" class="px-2">
                            @foreach ($Dnrlok['DnrlokNUtm'] as $tk)
                                <li><p>{{$tk->org_nm}} 
                                    @if ($Utama)
                                        <button type="button" class="btn btn-danger btn-sm mx-2" onclick="callOtherTWF('Menghapus Data Kontributor Donor Darah','{{url('dnrlok/deleteK/'.$tk['dnrlok_id'])}}', loadDetail)"><i class="fas fa-trash"></i></button>
                                    @endif
                                </p></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function table(){
        setTimeout(() => {
            dTD('table#kegdDetailTable');
        }, 500);
    };
</script> --}}