<div class="row w-100">
    @if ($mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrk.update')}}'); addFill('dnr_id', '{{$Dnrk->dnr_id}}'); addFill('dnr_keg', '{{$Dnrk->dnr_keg}}'); addFill('dnr_nm', '{{$Dnrk->dnr_nm}}'); addFill('dnr_tgl', '{{$Dnrk->dnr_tgl}}'); addFill('dnr_telp', '{{$Dnrk->dnr_telp}}'); addFill('dnr_bth', '{{$Dnrk->dnr_bth}}'); addFill('dnr_tmpt', '{{$Dnrk->dnr_tmpt}}'); addFill('dnr_kec', '{{$Dnrk->kec_id}}'); getSelect('{{$Dnrk->kec_id}}', '{{$Dnrk->desa_id}}', 'dnr_desa'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrk/loadView/'.$dnr_id)}}')"><i class="fa fa-pen"></i> UBAH</button>
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
                            <label class="col-sm-3 col-form-label font-weight-bolder">Kebutuhan</label>
                            <div class="col-sm-9">
                                Butuh : {{$Dnrk->dnr_bth}} <br />
                                
                                Terpenuhi : {{$Dnrk->total}} <br />
                                
                            </div>
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
    @if (!$mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('dnrk.update')}}'); addFill('dnr_id', '{{$Dnrk->dnr_id}}'); addFill('dnr_keg', '{{$Dnrk->dnr_keg}}'); addFill('dnr_nm', '{{$Dnrk->dnr_nm}}'); addFill('dnr_tgl', '{{$Dnrk->dnr_tgl}}'); addFill('dnr_telp', '{{$Dnrk->dnr_telp}}'); addFill('dnr_bth', '{{$Dnrk->dnr_bth}}'); addFill('dnr_tmpt', '{{$Dnrk->dnr_tmpt}}'); addFill('dnr_kec', '{{$Dnrk->kec_id}}'); getSelect('{{$Dnrk->kec_id}}', '{{$Dnrk->desa_id}}', 'dnr_desa'); $('#{{$IdForm}}').attr('data-url-load', '{{url('dnrk/loadView/'.$dnr_id)}}')"><i class="fa fa-pen"></i> UBAH</button>
                    <a href="{{route('dnrk.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 
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