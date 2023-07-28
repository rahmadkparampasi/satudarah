<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('ktk.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="ktk_id" name="ktk_id">
                <div class="form-group row p-4 mb-0 pb-0 required">
                    <label class="control-label" for="ktk_nm">Nama Jenis Kontak</label>
    
                    <input type="text" class="form-control" id="ktk_nm" name="ktk_nm" placeholder="Masukan Nama Jenis Kontak" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('ktk.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>