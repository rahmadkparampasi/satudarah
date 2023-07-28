<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('org.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="org_id" name="org_id">

                <div class="form-group row p-4 mb-0 pb-0">
                    <label for="korg_nm">Kategori Organisasi</label>
                    <select class="form-control" id="org_korg" name="org_korg" required>
                        <option value="" hidden>Pilih Salah Satu Kategori Organisasi</option>
                        @foreach ($Korg as $tk)
                            <option value="{{$tk['korg_id']}}">{{$tk['korg_nm']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row p-4 mb-0 pb-0">
                    <label for="org_nm">Nama Organisasi</label>
                    <input type="text" class="form-control" id="org_nm" name="org_nm" placeholder="Masukan Nama Organisasi" required>
                </div>

                <div class="form-group row p-4 mb-0 pb-0">
                    <label for="org_alt">Alamat Organisasi</label>
                    <textarea type="text" class="form-control" id="org_alt" name="org_alt" placeholder="Masukan Alamat Organisasi" required></textarea>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="org_kec">Kecamatan</label>
                    <select class="form-control" id="org_kec" name="org_kec" required onchange="ambilDataSelect('org_desa', '{{url('desa/getDataJson')}}/', 'Pilih Salah Satu Desa/Kelurahan', toRemove=['org_desa'], removeMessage=['Pilih Salah Satu Desa/Kelurahan'], 'org_kec')">
                        <option hidden value="">Pilih Salah Satu Kecamatan</option>
                        @foreach ($Kec as $tk)
                            <option value="{{$tk['id']}}">{{$tk['namaAlt']}}</option>
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="org_desa">Desa/Kelurahan</label>
                    <select class="form-control" id="org_desa" name="org_desa" required>
                        <option hidden value="">Pilih Salah Satu Desa/Kelurahan</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('org.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>