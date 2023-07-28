<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\SegModel;
use Illuminate\Http\Request;

class SegController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOSeg',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'SEGMENTASI DAERAH',
            'PageTitle' => 'Segmentasi Daerah',
            'BasePage' => 'seg',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'segAddData';
        $this->data['UrlForm'] = 'seg';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Seg'] = SegModel::select(['seg_id', 'seg_nm', 'seg_act'])->orderBy('seg_ord', 'desc')->get();
        $this->data['Seg'] = $this->setData($this->data['Seg']);

        $this->data['Kec'] = KecController::getDataByKab('FGU01');

        return view('seg.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'segAddData';
        $this->data['UrlForm'] = 'seg';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Seg'] = SegModel::select(['seg_id', 'seg_nm', 'seg_act'])->orderBy('seg_ord', 'desc')->get();
        $this->data['Seg'] = $this->setData($this->data['Seg']);

        return view('seg.data', $this->data);
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegModel = new SegModel();

        $this->data['Pgn'] = $this->getUser();

        $SegModel->seg_nm = $request->seg_nm;
        $SegModel->seg_ucreate = $this->data['Pgn']->users_id;
        $SegModel->seg_uupdate = $this->data['Pgn']->users_id;
        $SegModel->seg_act = "1";

        $save = $SegModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Segmentasi Daerah Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Segmentasi Daerah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegModel = new SegModel();

        $this->data['Pgn'] = $this->getUser();

        $seg_id = $request->seg_id;

        $update = $SegModel::where('seg_id', $seg_id)->update([
            'seg_nm' => $request->seg_nm,
            'seg_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Segmentasi Daerah Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Segmentasi Daerah Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($seg_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegModel = new SegModel;

        $delete = $SegModel::where('seg_id', $seg_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Segmentasi Daerah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Segmentasi Daerah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($seg_act, $seg_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegModel = new SegModel();

        $message = "Dinonaktifkan";
        if ($seg_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $SegModel::where('seg_id', $seg_id)->update([
            'seg_act' => $seg_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Segmentasi Daerah Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Segmentasi Daerah Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['Segkec'] = SegkecController::getDataStat($data[$i]['seg_id']);

            $data[$i]['seg_actAltT'] = "Aktif";
            $data[$i]['seg_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['seg_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Segmentasi Daerah\", \"".url('seg/setAct/0/'.$data[$i]['seg_id'])."\", \"".url('seg/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['seg_act']=="0") {
                $data[$i]['seg_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['seg_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Segmentasi Daerah\", \"".url('seg/setAct/1/'.$data[$i]['seg_id'])."\", \"".url('seg/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['seg_actAltT'] = "Tidak Aktif";                
            }
        }
        return $data;
    }
}
