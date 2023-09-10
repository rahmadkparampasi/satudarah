<div class="row w-100">
    @if ($mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('prsn.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 

                    <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$Prsn->prsn_id}}'); addFill('prsn_nm', '{{$Prsn->prsn_nm}}'); addFill('prsn_tmptlhr', '{{$Prsn->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$Prsn->prsn_tgllhr}}');  addFill('prsn_gol', '{{$Prsn->prsn_gol}}'); addFill('prsn_jk', '{{$Prsn->prsn_jk}}'); addFill('prsn_alt', '{{$Prsn->prsn_alt}}'); addFill('prsn_wa', '{{$Prsn->prsn_wa}}'); addFill('prsn_telp', '{{$Prsn->prsn_telp}}'); addFill('prsn_krj', '{{$Prsn->prsn_krj}}'); addFill('prsn_kec', '{{$Prsn->kec_id}}'); getSelect('{{$Prsn->kec_id}}', '{{$Prsn->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('prsn/loadView/'.$prsn_id)}}');"><i class="fas fa-pen"></i> UBAH DATA</button>
                </div>
            </div>
            
        </div>                  
    @endif
    <div class="col-md-8 order-md-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="mb-1">Data Personal
                            
                            <span class="badge badge-info font-weight-bold f-20">{{$Prsn->total}}</span>
                        </h4>
                    </div>
                    <div class="col">
                        <h1 class="mb-1 text-right font-weight-bold text-danger">{{$Prsn->gol_nm}}</h1>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">ID</label>
                    <div class="col-sm-9">
                        {{$Prsn->prsn_kd}}<br/>
                        @if ($Prsn->prsn_bc!='')
                            <a href="{{url('prsn/cetakKrt/'.$Prsn->prsn_id)}}" class="btn btn-primary"><i class="fa fa-id-card"></i></a>
                        @else
                            <button type="button" class="btn btn-success" onclick="callOtherTWF('Verifikasi Data Personal','{{url('prsn/verification/'.$Prsn->prsn_id)}}', loadDetail)"><i class="fas fa-check"></i></button>
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Nama</label>
                    <div class="col-sm-9">
                        {{ucwords(strtolower(stripslashes($Prsn->prsn_nm)))}}
                    </div>
                </div>
                <hr/>
                
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Kontak</label>
                    <div class="col-sm-9">
                        {{$Prsn->prsn_telp}}<br/>
                        @if ($Prsn->prsn_telp!='')
                            <button type="button" class="btn btn-info" onclick="callOtherTWPNR('Melakukan Reset Pengguna Dan Mengirimkan Pesan Konfirmasi','{{url('prsn/resetSendWa/'.$Prsn->prsn_id)}}')"><i class="fas fa-paper-plane"></i></button>
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">TTL/Umur</label>
                    <div class="col-sm-9">
                        {{$Prsn->prsn_tmptlhr}}, {{$Prsn->prsn_tgllhrAltT}}<br/>
                        Umur: {{$Prsn->umur}}
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        {{$Prsn->prsn_jkAltT}}
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Pekerjaan</label>
                    <div class="col-sm-9">
                        {{$Prsn->krj_nm}}
                    </div>
                </div>
                <hr/>
                <div class="form-group row align-items-center">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
                    <div class="col-sm-9">
                        {{$Prsn->prsn_altAltT}}
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    </div>
    @if (!$mobile)
        <div class="col-md-4 order-md-1">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('prsn.index')}}" class="btn btn-danger w-100 my-1"><i class="fa fa-reply"></i> KEMBALI</a> 

                    <button type="button" class="btn btn-warning w-100 my-1" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('prsn.update')}}'); addFill('prsn_id', '{{$Prsn->prsn_id}}'); addFill('prsn_nm', '{{$Prsn->prsn_nm}}'); addFill('prsn_tmptlhr', '{{$Prsn->prsn_tmptlhr}}'); addFill('prsn_tgllhr', '{{$Prsn->prsn_tgllhr}}');  addFill('prsn_gol', '{{$Prsn->prsn_gol}}'); addFill('prsn_jk', '{{$Prsn->prsn_jk}}'); addFill('prsn_alt', '{{$Prsn->prsn_alt}}'); addFill('prsn_wa', '{{$Prsn->prsn_wa}}'); addFill('prsn_telp', '{{$Prsn->prsn_telp}}'); addFill('prsn_krj', '{{$Prsn->prsn_krj}}'); addFill('prsn_kec', '{{$Prsn->kec_id}}'); getSelect('{{$Prsn->kec_id}}', '{{$Prsn->desa_id}}'); $('#{{$IdForm}}').attr('data-url-load', '{{url('prsn/loadView/'.$prsn_id)}}');"><i class="fas fa-pen"></i> UBAH DATA</button>
                </div>
            </div>
        </div>
    @endif
</div>