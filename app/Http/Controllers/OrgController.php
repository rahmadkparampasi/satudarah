<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\KorgModel;
use App\Models\OrgModel;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    protected $data;
    protected $Korg;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOOrg',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'ORGANISASI',
            'PageTitle' => 'Organisasi',
            'BasePage' => 'org',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();

        $this->Korg = new KorgModel();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'orgAddData';
        $this->data['UrlForm'] = 'org';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Korg'] = $this->Korg::select(['korg_id', 'korg_nm', 'korg_act'])->orderBy('korg_ord', 'desc')->get();

        $this->data['Org'] = OrgModel::leftJoin('korg', 'org.org_korg', '=', 'korg.korg_id')->leftJoin('desa', 'org.org_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['org_id', 'korg_nm', 'org_nm', 'org_alt', 'org_act', 'org_korg', 'org_utd', 'org_utdnm', 'org_rs', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'desa.nama as desa_nama', 'kec.nama as kec_nama'])->orderBy('org_ord', 'desc')->get();
        $this->data['Org'] = $this->setData($this->data['Org']);

        $this->data['Kec'] = KecController::getDataByKab('FGU01');

        return view('org.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'orgAddData';
        $this->data['UrlForm'] = 'org';

        $this->data['Org'] = OrgModel::leftJoin('korg', 'org.org_korg', '=', 'korg.korg_id')->leftJoin('desa', 'org.org_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['org_id', 'korg_nm', 'org_nm', 'org_alt', 'org_act', 'org_korg', 'org_utd', 'org_utdnm', 'org_rs', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'desa.nama as desa_nama', 'kec.nama as kec_nama'])->orderBy('org_ord', 'desc')->get();
        $this->data['Org'] = $this->setData($this->data['Org']);

        $this->data['Kec'] = KecController::getDataByKab('FGU01');

        return view('org.data', $this->data);
    }

    static function getDataStat($org_id)
    {
        return OrgModel::leftJoin('korg', 'org.org_korg', '=', 'korg.korg_id')->where('org_id', $org_id)->select(['org_id', 'korg_nm', 'org_nm', 'org_alt', 'org_act', 'org_korg', 'org_utd', 'org_utdnm', 'org_rs'])->orderBy('org_ord', 'desc')->get()->first();
    }

    static function getDataByRs($org_rs) {
        $Org = OrgModel::where('org_rs', $org_rs)->select('org_id', 'org_nm')->orderBy('org_ord', 'asc')->get();

        return $Org;
    }

    static function getDataByUtd($org_utd) {
        $Org = OrgModel::where('org_utd', $org_utd)->select('org_id', 'org_nm')->orderBy('org_ord', 'asc')->get();

        return $Org;
    }

    public function getDataByTextS(Request $request)
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        $search = $request->get('search');
        $this->data['Org'] = OrgModel::where('org_act', '1')->where('org_nm', 'like', '%' .$search. '%')
        ->get();
        $this->data['data'] = [];

        for ($i = 0; $i < count($this->data['Org']); $i++) {
            $this->data['data'][$i]['id'] = $this->data['Org'][$i]['org_id'];
            $this->data['data'][$i]['text'] = $this->data['Org'][$i]['org_nm'];             
        }
        return response()->json($this->data['data'], 200);        
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel();

        $this->data['Pgn'] = $this->getUser();

        $OrgModel->org_korg = $request->org_korg;
        $OrgModel->org_nm = $request->org_nm;
        $OrgModel->org_alt = addslashes($request->org_alt);
        $OrgModel->org_desa = $request->org_desa;
        $OrgModel->org_ucreate = $this->data['Pgn']->users_id;
        $OrgModel->org_uupdate = $this->data['Pgn']->users_id;
        $OrgModel->org_act = "1";

        $save = $OrgModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel();

        $this->data['Pgn'] = $this->getUser();

        $org_id = $request->org_id;

        $update = $OrgModel::where('org_id', $org_id)->update([
            'org_korg' => $request->org_korg,
            'org_nm' => $request->org_nm,
            'org_alt' => addslashes($request->org_alt),
            'org_desa' => $request->org_desa,
            'org_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($org_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel;

        $delete = $OrgModel::where('org_id', $org_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($org_act, $org_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel();

        $message = "Dinonaktifkan";
        if ($org_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $OrgModel::where('org_id', $org_id)->update([
            'org_act' => $org_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setRs($org_rs, $org_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel();

        $message = "Dinonaktifkan Menjadi Rumah Sakit";
        if ($org_rs=="1") {
            $message = "Diaktifkan Menjadi Rumah Sakit";
        }

        $update = $OrgModel::where('org_id', $org_id)->update([
            'org_rs' => $org_rs
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setUtd($org_utd, $org_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $OrgModel = new OrgModel();

        $message = "Dinonaktifkan Menjadi UTD";
        if ($org_utd=="1") {
            $message = "Diaktifkan Menjadi UTD";
        }

        $update = $OrgModel::where('org_id', $org_id)->update([
            'org_utd' => $org_utd
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Organisasi Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Organisasi Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {

        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]['org_actAltT'] = "Aktif";
            $data[$i]['org_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";

            $data[$i]['org_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Organisasi\", \"".url('org/setAct/0/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";


            if ($data[$i]['org_act']=="0") {
                $data[$i]['org_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['org_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Organisasi\", \"".url('org/setAct/1/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['org_actAltT'] = "Tidak Aktif";                
            }


            $data[$i]['org_rsAltT'] = "Ya";
            $data[$i]['org_rsAltBa'] = "<span class='badge badge-success font-weight-bold'>YA</span>";

            $data[$i]['org_rsAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Organisasi Sebagai Rumah Sakit\", \"".url('org/setRs/0/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>YA</span>";


            if ($data[$i]['org_rs']=="0") {
                $data[$i]['org_rsAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK</span>";

                $data[$i]['org_rsAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Organisasi Sebagai Rumah Sakit\", \"".url('org/setRs/1/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK</span>";

                $data[$i]['org_rsAltT'] = "Tidak";                
            }


            $data[$i]['org_utdAltT'] = "Ya";
            $data[$i]['org_utdAltBa'] = "<span class='badge badge-success font-weight-bold'>YA</span>";

            $data[$i]['org_utdAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Organisasi Sebagai UTD\", \"".url('org/setUtd/0/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>YA</span>";


            if ($data[$i]['org_utd']=="0") {
                $data[$i]['org_utdAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK</span>";

                $data[$i]['org_utdAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Organisasi Sebagai UTD\", \"".url('org/setUtd/1/'.$data[$i]['org_id'])."\", \"".url('org/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK</span>";

                $data[$i]['org_utdAltT'] = "Tidak";                
            }

            $data[$i]['org_altAltT'] = "Desa ";
            if ($data[$i]['jenis']=="K") {
                $data[$i]['org_altAltT'] = "Kel. ";
            }
            $data[$i]['org_altAltT'] = $data[$i]['org_alt'].", ".$data[$i]['org_altAltT'].$data[$i]['desa_nama'].", Kec. ".$data[$i]['kec_nama'];
        }
        return $data;
    }
}
