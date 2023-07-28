<div class="row w-100">
    @if ($mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    @if ($Dnrp->dnr_send=="0")
                        <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrp.update')}}'); $('.slide-page').css('margin-left', '0'); $('.display1').show();loadStepPrsn('{{$Dnrp['dnrprsn_prsn']}}'); loadStepKtk('{{$Dnrp['dnrktk_prsn']}}'); addFill('dnr_ktk', '{{$Dnrp['dnr_ktk']}}'); addFill('dnr_bth', '{{$Dnrp['dnr_bth']}}'); addFill('dnr_org', '{{$Dnrp['dnr_org']}}'); addFill('dnr_sft', '{{$Dnrp['dnr_sft']}}'); addFill('dnr_tgl', '{{$Dnrp['dnr_tgl']}}'); addFill('dnr_id', '{{$Dnrp['dnr_id']}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrp/loadView/'.$dnr_id)}}');"><i class="fa fa-pen"></i> UBAH</button>
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
                                <h4 class="mb-1">Data Penerima Darah
                                    @php
                                        $SisaBadge = "badge-danger";
                                        
                                        if ((int)$Dnrp->total>0) {
                                            $SisaBadge = "badge-warning";
                                        }elseif((int)$Dnrp->total>=$Dnrp->dnr_bth){
                                            $SisaBadge = "badge-success";
                                        }
                                    @endphp
                                    <span class="badge {{$SisaBadge}} font-weight-bold f-20">{{$Dnrp->total}}</span>
                                </h4>
                            </div>
                            <div class="col">
                                <h1 class="mb-1 text-right font-weight-bold text-danger">{{$Dnrp->gol_nm}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        
                            <li class="nav-item">
                                <a class="nav-link text-reset active" id="pasien-tab" data-toggle="tab" href="#pasien" role="tab" aria-controls="pasien" aria-selected="false"><i class="fa fa-user-injured me-2"></i> Pasien</a>
                            </li>
                            @if ($mobile)
                                <li class="nav-item">
                                    <a class="nav-link text-reset" id="pasiendet-tab" data-toggle="tab" href="#pasiendet" role="tab" aria-controls="pasiendet" aria-selected="false"><i class="fa fa-list me-2"></i> Detail Pasien</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link text-reset" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab" aria-controls="kontak" aria-selected="false" onclick="table()"><i class="fa fa-phone me-2"></i> Kontak</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="pasien-tab">
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nama Pasien</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->prsn_nm}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">NIK</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->prsn_nik}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Kebutuhan</label>
                                    <div class="col-sm-9">
                                        Butuh : {{$Dnrp->dnr_bth}} <br />
                                        Tambah : {{$Dnrp->dnr_tmbh}}<br/> 
                                        Terpenuhi : {{$Dnrp->total}} <br />
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalAddTmbh" onclick="resetForm('modalAddTmbhF'); addFill('dnr_idTmbh', '{{$Dnrp->dnr_id}}'); addFill('prsn_nikTmbh', '{{$Dnrp->prsn_nik}}'); addFill('prsn_nmTmbh', '{{$Dnrp->prsn_nm}}'); addFill('dnr_bthTmbh', '{{$Dnrp->dnr_bth}}'); addFill('tipeTmbh', 'D');"><i class="fas fa-sync"></i></button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal Rawat</label>
                                    <div class="col-sm-9">
                                        {{ucwords(strtolower($Dnrp->dnr_tglAltT))}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Tempat Rawat</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->org_nm}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Sifat</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->dnr_sftAltT}}
                                    </div>
                                </div>
                                
                            </div>
                            @if ($mobile)
                                <div class="tab-pane fade show active" id="pasiendet" role="tabpanel" aria-labelledby="pasiendet-tab">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Tempat Tanggal Lahir/Umur</label>
                                        <div class="col-sm-9">
                                            {{$Dnrp->prsn_tmptlhr}}, {{$Dnrp->prsn_tgllhrAltT}}<br/>
                                            Umur: {{$Dnrp->umur}}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            {{$Dnrp->prsn_jkAltT}}<br/>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
                                        <div class="col-sm-9">
                                            {{$Dnrp->prsn_altAltT}}
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            @endif
                            <div class="tab-pane fade" id="kontak" role="tabpanel" aria-labelledby="kontak-tab" >
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Jenis Kontak</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->ktk_nm}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nama Kontak</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_nm}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">NIK</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_nik}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Kontak</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_telp}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">TTL/Umur</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_tmptlhr}}, {{$Dnrp->Ktk->prsn_tgllhrAltT}}<br/>
                                        Umur: {{$Dnrp->Ktk->umur}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_jkAltT}}
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
                                    <div class="col-sm-9">
                                        {{$Dnrp->Ktk->prsn_altAltT}}
                                    </div>
                                </div>
                                <hr/>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    @if (!$mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrp.update')}}'); $('.slide-page').css('margin-left', '0'); $('.display1').show();loadStepPrsn('{{$Dnrp['dnrprsn_prsn']}}'); loadStepKtk('{{$Dnrp['dnrktk_prsn']}}'); addFill('dnr_ktk', '{{$Dnrp['dnr_ktk']}}'); addFill('dnr_bth', '{{$Dnrp['dnr_bth']}}'); addFill('dnr_org', '{{$Dnrp['dnr_org']}}'); addFill('dnr_sft', '{{$Dnrp['dnr_sft']}}'); addFill('dnr_tgl', '{{$Dnrp['dnr_tgl']}}'); addFill('dnr_id', '{{$Dnrp['dnr_id']}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrp/loadView/'.$dnr_id)}}');"><i class="fas fa-pen"></i> UBAH</button>
                    <a href="{{route('dnrp.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form >
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-form-label font-weight-bolder">Tempat Tanggal Lahir/Umur</label>
                            <div class="col-12">
                                {{$Dnrp->prsn_tmptlhr}}, {{$Dnrp->prsn_tgllhrAltT}}<br/>
                                Umur: {{$Dnrp->umur}}
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-form-label font-weight-bolder">Jenis Kelamin</label>
                            <div class="col-12">
                                {{$Dnrp->prsn_jkAltT}}<br/>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-form-label font-weight-bolder">Alamat</label>
                            <div class="col-12">
                                {{$Dnrp->prsn_altAltT}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- <script>
    function table(){
        setTimeout(() => {
            dTD('table#kegdDetailTable');
        }, 500);
    };
</script> --}}