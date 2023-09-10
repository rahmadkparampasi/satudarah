<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\KrjModel;
use Illuminate\Http\Request;

class KrjController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOKrj',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'JENIS PEKERJAAN',
            'PageTitle' => 'Jenis Pekerjaan',
            'BasePage' => 'krj',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="ADM") {
            return redirect()->intended();
        }
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'krjAddData';
        $this->data['UrlForm'] = 'krj';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Krj'] = KrjModel::select(['krj_id', 'krj_nm', 'krj_act', 'krj_prof'])->orderBy('krj_ord', 'desc')->get();
        $this->data['Krj'] = $this->setData($this->data['Krj']);

        return view('krj.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'krjAddData';
        $this->data['UrlForm'] = 'krj';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Krj'] = KrjModel::select(['krj_id', 'krj_nm', 'krj_act', 'krj_prof'])->orderBy('krj_ord', 'desc')->get();
        $this->data['Krj'] = $this->setData($this->data['Krj']);

        return view('krj.data', $this->data);
    }

    public function getDataJson()
    {
        $this->data['Krj'] = KrjModel::where('krj_act', '1')->where('krj_prof', '0')->select(['krj_id', 'krj_nm'])->orderBy('krj_ord', 'asc')->get();
        $this->data['KrjN'] = [];
        for ($i=0; $i < count($this->data['Krj']); $i++) { 
            $this->data['KrjN'][$i]['optValue'] = '';
            $this->data['KrjN'][$i]['optValue'] = $this->data['Krj'][$i]['krj_id'];

            $this->data['KrjN'][$i]['optText'] = '';
            $this->data['KrjN'][$i]['optText'] = $this->data['Krj'][$i]['krj_nm'];
        }
        return $this->data['KrjN'];
    }

    static function getDataActStat()
    {
        return KrjModel::where('krj_act', '1')->where('krj_prof', '0')->select(['krj_id', 'krj_nm'])->orderBy('krj_ord', 'asc')->get();
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KrjModel = new KrjModel();

        $this->data['Pgn'] = $this->getUser();

        $KrjModel->krj_nm = $request->krj_nm;
        $KrjModel->krj_ucreate = $this->data['Pgn']->users_id;
        $KrjModel->krj_uupdate = $this->data['Pgn']->users_id;
        $KrjModel->krj_act = "1";

        $save = $KrjModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kerja Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kerja Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KrjModel = new KrjModel();

        $this->data['Pgn'] = $this->getUser();

        $krj_id = $request->krj_id;

        $update = $KrjModel::where('krj_id', $krj_id)->update([
            'krj_nm' => $request->krj_nm,
            'krj_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kerja Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kerja Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($krj_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KrjModel = new KrjModel;

        $delete = $KrjModel::where('krj_id', $krj_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kerja Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kerja Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($krj_act, $krj_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KrjModel = new KrjModel();

        $message = "Dinonaktifkan";
        if ($krj_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $KrjModel::where('krj_id', $krj_id)->update([
            'krj_act' => $krj_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kerja Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kerja Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setProf($krj_prof, $krj_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KrjModel = new KrjModel();

        $message = "Bukan Profesi";
        if ($krj_prof=="1") {
            $message = "Dijadikan Profesi";
        }

        $update = $KrjModel::where('krj_id', $krj_id)->update([
            'krj_prof' => $krj_prof
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kerja Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kerja Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]['krj_actAltT'] = "Aktif";
            $data[$i]['krj_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['krj_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Jenis Kerja\", \"".url('krj/setAct/0/'.$data[$i]['krj_id'])."\", \"".url('krj/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['krj_act']=="0") {
                $data[$i]['krj_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['krj_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Jenis Kerja\", \"".url('krj/setAct/1/'.$data[$i]['krj_id'])."\", \"".url('krj/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['krj_actAltT'] = "Tidak Aktif";                
            }

            $data[$i]['krj_profAltT'] = "Profesi";
            $data[$i]['krj_profAltBa'] = "<span class='badge badge-info font-weight-bold'>Profesi</span>";
            $data[$i]['krj_profAltBu'] = "<span onclick='callOtherTWLoad(\"Menjadikan Status Jenis Kerja Menjadi Bukan Profesi\", \"".url('krj/setProf/0/'.$data[$i]['krj_id'])."\", \"".url('krj/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-info font-weight-bold'>Profesi</span>";
            if ($data[$i]['krj_prof']=="0") {
                $data[$i]['krj_profAltBa'] = "<span class='badge badge-primary font-weight-bold'>Pekerjaan</span>";

                $data[$i]['krj_profAltBu'] = "<span onclick='callOtherTWLoad(\"Menjadikan Status Jenis Kerja Menjadi Profesi\", \"".url('krj/setProf/1/'.$data[$i]['krj_id'])."\", \"".url('krj/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-primary font-weight-bold'>Pekerjaan</span>";

                $data[$i]['krj_profAltT'] = "Pekerjaan";                
            }
        }
        return $data;
    }
}
