<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('dnr.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="dnr_id" name="dnr_id">
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrprsn_prsnnm">Nama Lengkap</label>
                    <input type="hidden" id="dnrprsn_prsn" name="dnrprsn_prsn" placeholder="" required>
                    <div class="row">
                        <div class="col-11">
                            <input type="text" class="form-control" id="dnrprsn_prsnnm" name="dnrprsn_prsnnm" placeholder="" required readonly>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddPrsn" onclick="addFill('search_for', 'P'); $('#formSearchPrsn').html('');"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrprsn_prsnnik">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" class="form-control" id="dnrprsn_prsnnik" name="dnrprsn_prsnnik" placeholder="" required readonly>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_bth">Kebutuhan Darah</label>
                    <input type="text" class="form-control" id="dnr_bth" name="dnr_bth" placeholder="" required>
                </div>

                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_org">Tempat Rawat</label>
                    <select class="form-control" id="dnr_org" name="dnr_org" required >
                        <option hidden value="">Pilih Salah Satu Kecamatan</option>
                        @foreach ($Org as $tk)
                            <option value="{{$tk['org_id']}}">{{$tk['org_nm']}}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_sft">Sifat</label>
                    <select class="form-control" id="dnr_sft" name="dnr_sft" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="B">Biasa</option>
                        <option value="U">Urgent</option>
                    </select>
                </div>
                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_tgl">Tanggal Rawat</label>
                    <input type="date" class="form-control" id="dnr_tgl" name="dnr_tgl" placeholder="" required>
                </div>
               
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_ktk">Jenis Kontak</label>
                    <select class="form-control" id="dnr_ktk" name="dnr_ktk" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="Keluarga">Keluarga</option>
                        <option value="Teman">Teman</option>
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrktk_prsnnm">Nama Kontak</label>
                    <input type="hidden" id="dnrktk_prsn" name="dnrktk_prsn" placeholder="" required>
                    <div class="row">
                        <div class="col-11">
                            <input type="text" class="form-control" id="dnrktk_prsnnm" name="dnrktk_prsnnm" placeholder="" required readonly>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddPrsn" onclick="addFill('search_for', 'K'); $('#formSearchPrsn').html('');"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnrktk_prsnnmr">Nomor Kontak</label>
                    <input type="text" class="form-control" id="dnrktk_prsnnmr" name="dnrktk_prsnnmr" placeholder="" required readonly>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnr.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>