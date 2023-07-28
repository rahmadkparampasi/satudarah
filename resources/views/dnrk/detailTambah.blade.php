<form >
    <div class="form-group row align-items-center">
        <label class="col-12 col-form-label font-weight-bolder">Pengusul Inovasi</label>
        <div class="col-12">
            @php
                $inum_inoflImg = '';
                if ($Inum->inum_katpu != '0') {
                    if ($Inum->inum_katpu == 'P') {
                        if ($Inum->prsn['prsn_pic']!='') {
                            $inum_inoflImg = url('uploads/'.$Inum->prsn['prsn_pic']);
                        }else{
                            $inum_inoflImg = url('assets/img/group.png');
                        }
                    }else{
                        if ($Inum->klp['klp_pic']!='') {
                            $inum_inoflImg = url('uploads/'.$Inum->klp['klp_pic']);
                        }else{
                            $inum_inoflImg = url('assets/img/group.png');
                        }
                    }
                }
            @endphp
            <img src="{{$inum_inoflImg}}" width="100" class="img-fluid" alt="Profil Pengusul Inovasi" /><br/>
            <p class=""><h5>{{$Inum->inum_katpunm}}</h5></p>
            @if ($Pgn->users_id==$Inum->inum_users)
                <button type="button" class="btn btn-sm btn-success pr-1" data-toggle="modal" data-target="#modalAddKatpu" onclick="addFill('modalAddKatpuId', '{{$Inum->inum_id}}'); addFill('modalAddKatpuDet', 'det')"><i class="fa fa-sync"></i></button>
            @endif
            
            <br/>
            {{-- <small>
                Catatan:<br/>
                <ul class="text-justify pl-3">
                    <li>Jika ingin menjadikan personal sebagai inovator, silahkan unggah foto dan nama dari inovator.</li>
                    <li>Jika perosonal menjadi inovator dan ingin menjadikan kembali lembaga sebagai inovator, silahkan hapus foto dan nama inovator.</li>

                </ul>

            </small> --}}
        </div>
    </div>
    <hr/>
    {{-- <div class="form-group row align-items-center">
        <label class="col-12 col-form-label font-weight-bolder">Inisiator Inovasi</label>
        <div class="col-12">
            {{$Inum->inum_katpunm}}
        </div>
    </div> --}}
    @if ($Inum->inum_katpu == 'KLP')
        <div class="form-group row align-items-center">
            <label class="col-12 col-form-label font-weight-bolder">Kategori Kelompok</label>
            <div class="col-12">
                {{$Inum->klp['katklp_nm']}}
            </div>
        </div>
    @endif
    <div class="form-group row align-items-center">
        <label class="col-12 col-form-label font-weight-bolder">Alamat</label>
        <div class="col-12">
            @if ($Inum->inum_katpu == 'KLP')
                {{$Inum->klp['klp_altAltT']}}
            @elseif ($Inum->inum_katpu == 'P')
                {{$Inum->prsn['prsn_altAltT']}}
            @endif
        </div>
    </div>
    @if ($Inum->inum_katpu == 'KLP')
        <div class="form-group row align-items-center">
            <label class="col-12 col-form-label font-weight-bolder">Tanggal Terbentuk</label>
            <div class="col-12">
                {{ucwords(strtolower($Inum->klp['klp_tglAltT']))}}
            </div>
        </div>
    @elseif ($Inum->inum_katpu == 'P')
        <div class="form-group row align-items-center">
            <label class="col-12 col-form-label font-weight-bolder">Tempat Tanggal Lahir</label>
            <div class="col-12">
                {{ucwords(strtolower($Inum->prsn['prsn_tgllhrAltT']))}}
            </div>
        </div>
    
    @endif
    <div class="form-group row align-items-center">
        <label class="col-12 col-form-label font-weight-bolder">Kontak</label>
        <div class="col-12">
            @if ($Inum->inum_katpu == 'KLP')
                <ul class="pl-3">
                    <li>
                        Telp: {{$Inum->klp['klp_telp']}}
                    </li>
                    <li>
                        Email: {{$Inum->klp['klp_mail']}}
                    </li>
                </ul>
            @elseif ($Inum->inum_katpu == 'P')
                <ul class="pl-3">
                    <li>
                        Telp: {{$Inum->prsn['prsn_telp']}}
                    </li>
                    <li>
                        Email: {{$Inum->prsn['prsn_mail']}}
                    </li>
                </ul>
            @endif
        </div>
    </div>
    @if ($Inum->inum_katpu == 'P')
        <div class="form-group row align-items-center">
            <label class="col-12 col-form-label font-weight-bolder">Jenis Kelamin</label>
            <div class="col-12">
                {{$Inum->prsn['prsn_jkAltT']}}
            </div>
        </div>
    @endif
</form>