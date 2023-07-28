<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>cardExcel">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('prsn.excelForm')}}" data-load="true" id="<?= $IdForm ?>Excel" method="post" enctype="multipart/form-data" data-parsley-validate="" data-url-load="">
            <div class="card-body">
                @csrf
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="excelFile">Berkas Excel</label>
                    <input type="file" class="form-control" id="excelFile" name="excelFile" placeholder="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>cardExcel', '<?= $IdForm ?>Excel', '{{route('prsn.excelForm')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>