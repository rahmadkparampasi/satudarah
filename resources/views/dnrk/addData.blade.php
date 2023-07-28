<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('dnrk.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="dnr_id" name="dnr_id">
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_keg">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="dnr_keg" name="dnr_keg" placeholder="" required>
                </div>
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_nm">Penyelenggara Kegiatan</label>
                    <input type="text" class="form-control" id="dnr_nm" name="dnr_nm" placeholder="" required>
                </div>
                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_tgl">Tanggal Kegiatan</label>
                    <input type="date" class="form-control" id="dnr_tgl" name="dnr_tgl" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_telp">Nomor Kontak</label>
                    <input type="text" class="form-control" id="dnr_telp" name="dnr_telp" placeholder="" required>
                    <small>Nomor Kontak Jika Ada Yang Ingin Bertanya</small>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_bth">Target Darah (Kantung)</label>
                    <input type="number" class="form-control" id="dnr_bth" name="dnr_bth" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_tmpt">Tempat Kegiatan</label>
                    <input type="text" class="form-control" id="dnr_tmpt" name="dnr_tmpt" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_kec">Kecamatan</label>
                    <select class="form-control" id="dnr_kec" name="dnr_kec" required onchange="ambilDataSelect('dnr_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['dnr_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'dnr_kec')" data-parsley-group="group-2">
                        <option hidden value="">Pilih Salah Satu Kecamatan</option>
                        @foreach ($Kec as $tk)
                            <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="dnr_desa">Desa/Kelurahan</label>
                    <select class="form-control" id="dnr_desa" name="dnr_desa" required data-parsley-group="group-2">
                        <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                    </select>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('dnrk.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>