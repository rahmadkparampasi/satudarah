<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('dnrp.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
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
                    <label class="control-label" for="dnrprsn_prsnkd">ID</label>
                    <input type="text" class="form-control" id="dnrprsn_prsnkd" name="dnrprsn_prsnkd" placeholder="" required readonly>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_bth">Kebutuhan Darah</label>
                    <input type="number" class="form-control" id="dnr_bth" name="dnr_bth" placeholder="" required>
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
                        <option value="U">Urgent</option>
                        <option value="B">Tidak Urgent</option>
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
                        @foreach ($Ktk as $tk)
                            <option value="{{$tk['ktk_id']}}">{{$tk['ktk_nm']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_nm">Nama Kontak</label>
                    <input type="text" class="form-control" id="dnr_nm" name="dnr_nm" placeholder="" required>
                </div>

                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_telp">Nomor Kontak</label>
                    <input type="text" class="form-control" id="dnr_telp" name="dnr_telp" placeholder="" required>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrp.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>