<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-1">Riwayat Donor</h4>
        <button type="button" class="btn btn-success rounded m-0 float-end" data-toggle="modal" data-target="#modalAddDnr" onclick="resetForm('modalAddDnrF'); $('#modalAddDnrTitle').html('Tambah Data Donor Mandiri'); cActForm('modalAddDnrF', '{{route('dnrm.insertM')}}'); addFill('prsn_golDnrm', '{{$Prsn->prsn_gol}}')">
            <i class="fa fa-plus"></i> Tambah
        </button>
    </div>
    <div class="card-body">
        <table id="{{$IdForm}}dTPrsnDnrm" class=" display table align-items-centertable-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="text-wrap">Kategori Donor</th>
                    <th class="text-wrap">Lokasi/Nama Kegiatan</th>
                    <th class="text-wrap">Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($Dnrm as $tk) @php $no++ @endphp
                    <tr>
                        <td>{{$no}}</td>
                        <td class="text-wrap">{{$tk->dnrm_katAltT}}</td>
                        <td class="text-wrap">
                            @if ($tk->dnrm_kat=="K")
                                {{$tk->dnr_nm}}
                            @else
                                {{$tk->dnrm_lok}}
                            @endif
                        </td>
                        <td class="text-wrap">{{$tk->dnrm_tglAltT}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="callOtherTWF('Menghapus Data Riwayat Donor Darah','{{url('dnrm/delete/'.$tk['dnrm_id'])}}', loadDetail)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        dTD('table#{{$IdForm}}dTPrsnDnrm');
    });
</script>