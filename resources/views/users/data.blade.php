
<table id="{{$IdForm}}dT" class=" display table align-items-centertable-striped table-hover w-100" >
    <thead>
        <tr>
            <th>No</th>
            
            <th class="text-wrap">Nama Pengguna</th>
            <th class="text-wrap">Username</th>
            <th class="text-wrap">Kategori</th>
            <th class="text-wrap">Organisasi / UTD</th>
            <th class="text-wrap">Kata Sandi</th>
            <th class="text-wrap">Status</th>
            <th>Aksi</th>
           
        </tr>
    </thead>
    <tbody>
        @php
            $no = 0;
        @endphp
        @foreach ($Users as $tk) @php $no++ @endphp 
        
        <tr>
            <td>{{$no}}</td>
            
            <td ><p class="text-wrap">{{stripslashes($tk->users_nm)}}</p></td>
            <td class="text-wrap">{{$tk->username}}</td>
            
            <td class="text-wrap">{{$tk->users_tipeAltT}}</td>
            <td class="text-wrap">{{$tk->org_nm}}</td>
            <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalChangePwd" onclick="resetForm('modalChangePwdF'); addFill('users_nmPwd', '{{$tk->users_nm}}'); addFill('users_idPwd', '{{$tk->users_id}}'); addFill('tipePwd', 'D'); "><i class="fa fa-sync"></i> Ubah Password</button>
                @if ($Pgn->users_tipe=="ADM")
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalChangeReset" onclick="resetForm('modalChangeResetF'); addFill('users_nmReset', '{{$tk->users_nm}}'); addFill('users_idReset', '{{$tk->users_id}}'); addFill('tipeReset', 'D'); "><i class="fa fa-sync"></i> Reset Password</button>
                @endif
            </td>
            <td class="text-wrap">
                @if ($tk->users_id != $Pgn->users_id)
                    {!!$tk->users_actAltBu!!}
                @endif
            </td>
            <td>
                @if ($tk->users_id != $Pgn->users_id)
                    @if ($tk->users_tipe=="ADM")
                        <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('users.update')}}'); addFill('users_id', '{{$tk->users_id}}'); addFill('users_nm', '{{$tk->users_nm}}'); addFill('username', '{{$tk->username}}'); showFormUsersUpdate()"><i class="fas fa-pen"></i></button>
                    @else
                        <button type="button" class="btn btn-warning" onclick="showForm('{{$IdForm}}card', 'block'); cActForm('{{$IdForm}}', '{{route('users.updateUTD')}}'); addFill('users_id', '{{$tk->users_id}}'); addFill('users_nm', '{{$tk->users_nm}}'); addFill('username', '{{$tk->username}}'); addFill('users_org', '{{$tk->users_org}}'); showFormUsersUpdateUTD()"><i class="fas fa-pen"></i></button>
                    @endif

                    <button type="button" class="btn btn-danger" onclick="callOtherTWLoad('Menghapus Data Pengguna','{{url('users/delete/'.$tk->users_id)}}', '{{url('users/load')}}', '{{$IdForm}}', '{{$IdForm}}data', '{{$IdForm}}card')"><i class="fas fa-trash"></i></button>
                    
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dT');
    });
</script>