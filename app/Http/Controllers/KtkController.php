<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\KtkModel;
use Illuminate\Http\Request;

class KtkController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOKtk',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'JENIS KONTAK',
            'PageTitle' => 'Jenis Kontak',
            'BasePage' => 'ktk',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'ktkAddData';
        $this->data['UrlForm'] = 'ktk';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Ktk'] = KtkModel::select(['ktk_id', 'ktk_nm', 'ktk_act'])->orderBy('ktk_ord', 'desc')->get();
        $this->data['Ktk'] = $this->setData($this->data['Ktk']);

        return view('ktk.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'ktkAddData';
        $this->data['UrlForm'] = 'ktk';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Ktk'] = KtkModel::select(['ktk_id', 'ktk_nm', 'ktk_act'])->orderBy('ktk_ord', 'desc')->get();
        $this->data['Ktk'] = $this->setData($this->data['Ktk']);

        return view('ktk.data', $this->data);
    }

    static function getDataActStat()
    {
        return KtkModel::where('ktk_act', '1')->select(['ktk_id', 'ktk_nm',])->orderBy('ktk_ord', 'asc')->get();
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KtkModel = new KtkModel();

        $this->data['Pgn'] = $this->getUser();

        $KtkModel->ktk_nm = $request->ktk_nm;
        $KtkModel->ktk_ucreate = $this->data['Pgn']->users_id;
        $KtkModel->ktk_uupdate = $this->data['Pgn']->users_id;
        $KtkModel->ktk_act = "1";

        $save = $KtkModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kontak Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kontak Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KtkModel = new KtkModel();

        $this->data['Pgn'] = $this->getUser();

        $ktk_id = $request->ktk_id;

        $update = $KtkModel::where('ktk_id', $ktk_id)->update([
            'ktk_nm' => $request->ktk_nm,
            'ktk_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kontak Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kontak Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($ktk_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KtkModel = new KtkModel;

        $delete = $KtkModel::where('ktk_id', $ktk_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kontak Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kontak Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($ktk_act, $ktk_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KtkModel = new KtkModel();

        $message = "Dinonaktifkan";
        if ($ktk_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $KtkModel::where('ktk_id', $ktk_id)->update([
            'ktk_act' => $ktk_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Jenis Kontak Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Jenis Kontak Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]['ktk_actAltT'] = "Aktif";
            $data[$i]['ktk_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['ktk_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Jenis Kontak\", \"".url('ktk/setAct/0/'.$data[$i]['ktk_id'])."\", \"".url('ktk/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['ktk_act']=="0") {
                $data[$i]['ktk_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['ktk_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Jenis Kontak\", \"".url('ktk/setAct/1/'.$data[$i]['ktk_id'])."\", \"".url('ktk/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['ktk_actAltT'] = "Tidak Aktif";                
            }
        }
        return $data;
    }
}
