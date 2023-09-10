<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\GolModel;
use Illuminate\Http\Request;

class GolController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOGol',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'GOLONGAN DARAH',
            'PageTitle' => 'Golongan Darah',
            'BasePage' => 'gol',
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
        $this->data['IdForm'] = 'golAddData';
        $this->data['UrlForm'] = 'gol';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Gol'] = GolModel::select(['gol_id', 'gol_nm', 'gol_act'])->orderBy('gol_ord', 'desc')->get();
        $this->data['Gol'] = $this->setData($this->data['Gol']);

        return view('gol.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'golAddData';
        $this->data['UrlForm'] = 'gol';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Gol'] = GolModel::select(['gol_id', 'gol_nm', 'gol_act'])->orderBy('gol_ord', 'desc')->get();
        $this->data['Gol'] = $this->setData($this->data['Gol']);

        return view('gol.data', $this->data);
    }

    public function getDataJson()
    {
        $this->data['Gol'] = GolModel::where('gol_act', '1')->select(['gol_id', 'gol_nm', 'gol_act'])->orderBy('gol_ord', 'desc')->get();

        $this->data['GolN'] = [];
        for ($i=0; $i < count($this->data['Gol']); $i++) { 
            $this->data['GolN'][$i]['optValue'] = '';
            $this->data['GolN'][$i]['optValue'] = $this->data['Gol'][$i]['gol_id'];

            $this->data['GolN'][$i]['optText'] = '';
            $this->data['GolN'][$i]['optText'] = $this->data['Gol'][$i]['gol_nm'];
        }
        return $this->data['GolN'];
    }

    static function getDataActStat()
    {
        return GolModel::where('gol_act', '1')->select(['gol_id', 'gol_nm',])->orderBy('gol_ord', 'asc')->get();
    }
    static function getDataActStatPublik()
    {
        return GolModel::where('gol_act', '1')->where('gol_pub', '1')->select(['gol_id', 'gol_nm',])->orderBy('gol_ord', 'asc')->get();
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $GolModel = new GolModel();

        $this->data['Pgn'] = $this->getUser();

        $GolModel->gol_nm = $request->gol_nm;
        $GolModel->gol_ucreate = $this->data['Pgn']->users_id;
        $GolModel->gol_uupdate = $this->data['Pgn']->users_id;
        $GolModel->gol_act = "1";

        $save = $GolModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Golongan Darah Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Golongan Darah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $GolModel = new GolModel();

        $this->data['Pgn'] = $this->getUser();

        $gol_id = $request->gol_id;

        $update = $GolModel::where('gol_id', $gol_id)->update([
            'gol_nm' => $request->gol_nm,
            'gol_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Golongan Darah Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Golongan Darah Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($gol_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $GolModel = new GolModel;

        $delete = $GolModel::where('gol_id', $gol_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Golongan Darah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Golongan Darah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($gol_act, $gol_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $GolModel = new GolModel();

        $message = "Dinonaktifkan";
        if ($gol_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $GolModel::where('gol_id', $gol_id)->update([
            'gol_act' => $gol_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Golongan Darah Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Golongan Darah Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]['gol_actAltT'] = "Aktif";
            $data[$i]['gol_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['gol_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Golongan Darah\", \"".url('gol/setAct/0/'.$data[$i]['gol_id'])."\", \"".url('gol/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['gol_act']=="0") {
                $data[$i]['gol_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['gol_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Golongan Darah\", \"".url('gol/setAct/1/'.$data[$i]['gol_id'])."\", \"".url('gol/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['gol_actAltT'] = "Tidak Aktif";                
            }
        }
        return $data;
    }
}
