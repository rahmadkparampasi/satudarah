<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <button onclick="getSearchPrsnSide('{{$Prsn->prsn_id}}')" class="btn btn-sm btn-info"><i class="fa fa-reply"></i></button>
                <h4 class="mb-1">Data Personal</h4>
            </div>
            <div class="col">
                <h1 class="mb-1 text-right font-weight-bold text-danger">{{$Prsn->gol_nm}}</h1>
            </div>
        </div>
    </div>
    <div class="card-body pb-0">
        <form>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">ID</label>
                <div class="col-12">{{$Prsn->prsn_kd}}</div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Nama</label>
                <div class="col-12">{{ucwords(strtolower(stripslashes($Prsn->prsn_nm)))}}</div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Jumlah Donor</label>
                <div class="col-12">
                    <span class="badge badge-info font-weight-bold f-20">{{$Prsn->total}}</span>


                </div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Nomor Kontak</label>
                <div class="col-12">{{$Prsn->prsn_telp}}</div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">TTL/Umur</label>
                <div class="col-12">
                    {{$Prsn->prsn_tmptlhr}}, {{$Prsn->prsn_tgllhrAltT}}<br/>
                    Umur: {{$Prsn->umur}}
                </div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Jenis Kelamin</label>
                <div class="col-12">{{$Prsn->prsn_jkAltT}}</div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Pekerjaan</label>
                <div class="col-12">{{$Prsn->krj_nm}}</div>
            </div>
            <hr/>
            <div class="form-group row align-items-center">
                <label class="col-12 col-form-label font-weight-bolder">Alamat</label>
                <div class="col-12">{{$Prsn->prsn_altAltT}}</div>
            </div>
        </form>
    </div>
</div>