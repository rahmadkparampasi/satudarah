<div class="col-sm-12">
    <div class="card" style="<?= $DisplayForm ?>" id="<?= $IdForm ?>card">
        <div class="card-header">
            <h5>Form Tambah {{$PageTitle}}</h5>
        </div>
        <form class="" action="{{route('users.insert')}}" data-load="true" id="<?= $IdForm ?>" method="post" enctype="multipart/form-data" data-parsley-validate="">
            <div class="card-body">
                @csrf
                <input type="hidden" class="form-control" id="users_id" name="users_id">
                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="users_nm">Nama Pengguna</label>
                    <input type="text" class="form-control" id="users_nm" name="users_nm" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required">
                    <label class="control-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="" minlength="6" maxlength="20" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required" id="passwordFormGroup">
                    <label class="control-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required" id="password1FormGroup">
                    <label class="control-label" for="password1">Ulangi Password</label>
                    <input type="password" class="form-control" id="password1" name="password1" minlength="6" placeholder="" required>
                </div>

                <div class="form-group p-4 mb-0 pb-0 required" id="users_orgFormGroup">
                    <label class="control-label" for="users_org">Organisasi / UTD</label>
                    <select class="form-control" id="users_org" name="users_org" required>
                        <option hidden value="">Pilih Salah Satu Pilihan</option>
                        @foreach ($Org as $tk)
                            @if ($Pgn->users_tipe!="ADM")
                                @if ($Pgn->users_org!=$tk['org_id'])
                                    @php
                                        continue;
                                    @endphp
                                @endif
                            @endif
                            <option value="{{$tk['org_id']}}">{{$tk['org_nm']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <button type="button" onclick="closeForm('<?= $IdForm ?>card', '<?= $IdForm ?>', '{{route('users.insert')}}')" class="btn btn-danger">BATAL</button>
            </div>
        </form>
    </div>
</div>