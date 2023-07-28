<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('prsn.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="prsn_id" name="prsn_id">
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_nm">Nama Lengkap</label>
    
                    <input type="text" class="form-control" id="prsn_nm" name="prsn_nm" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_nik">NIK (Nomor Induk Kependudukan)</label>
    
                    <input type="text" class="form-control" id="prsn_nik" name="prsn_nik" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_tmptlhr">Tempat Lahir</label>
    
                    <input type="text" class="form-control" id="prsn_tmptlhr" name="prsn_tmptlhr" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_tgllhr">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="prsn_tgllhr" name="prsn_tgllhr" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_jk">Jenis Kelamin</label>
                    <select class="form-control" id="prsn_jk" name="prsn_jk" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_alt">Alamat</label>
                    <textarea class="form-control" id="prsn_alt" name="prsn_alt" placeholder="" required rows="2"></textarea>
                    <small>Isikan Alamat Tanpa Kecamatan Dan Desa</small>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_kec">Kecamatan</label>
                    <select class="form-control" id="prsn_kec" name="prsn_kec" required onchange="ambilDataSelect('prsn_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['prsn_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'prsn_kec')">
                        <option hidden value="">Pilih Salah Satu Kecamatan</option>
                        @foreach ($Kec as $tk)
                            <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_desa">Desa/Kelurahan</label>
                    <select class="form-control" id="prsn_desa" name="prsn_desa" required>
                        <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_gol">Golongan Darah</label>
                    <select class="form-control" id="prsn_gol" name="prsn_gol" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        @foreach ($Gol as $tk)
                            <option value="{{$tk['gol_id']}}">{{$tk['gol_nm']}}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_telp">Nomor Telepon</label>
                    <input type="text" class="form-control" id="prsn_telp" name="prsn_telp" placeholder="" required>
                </div>
                
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="prsn_wa">Nomor Telepon Terhubung Whatsapp</label>
                    <select class="form-control" id="prsn_wa" name="prsn_wa" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('prsn.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>