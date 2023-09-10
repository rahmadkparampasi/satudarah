<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\SegkecModel;
use Illuminate\Http\Request;

class SegkecController extends Controller
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

            'WebTitle' => 'KECAMATAN SEGMENTASI DAERAH',
            'PageTitle' => 'Kecamatan Segmentasi Daerah',
            'BasePage' => 'segkec',
        ];
    }
    
    static function getDataStat($segkec_seg) {
        $Segkec = SegkecModel::leftJoin('kec', 'segkec.segkec_kec', '=', 'kec.id')->where('segkec_seg', $segkec_seg)->select('segkec_id', 'kec.nama as kec_nama')->orderBy('segkec_ord', 'asc')->get();

        return $Segkec;
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegkecModel = new SegkecModel();

        $this->data['Pgn'] = $this->getUser();
        $this->data['Segkec'] = SegkecModel::where('segkec_kec', $request->segkec_kec)->select('segkec_id')->orderBy('segkec_ord', 'asc')->get();
        if (count($this->data['Segkec'])>0) {
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kecamatan Pada Segmen Daerah Telah Ada'];
        }else{
            $SegkecModel->segkec_seg = $request->segkec_seg;
            $SegkecModel->segkec_kec = $request->segkec_kec;
            $SegkecModel->segkec_ucreate = $this->data['Pgn']->users_id;
            $SegkecModel->segkec_uupdate = $this->data['Pgn']->users_id;
    
            $save = $SegkecModel->save();
            if ($save) {
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Kecamatan Segmentasi Daerah Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kecamatan Segmentasi Daerah Tidak Dapat Disimpan'];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($segkec_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $SegkecModel = new SegkecModel;

        $delete = $SegkecModel::where('segkec_id', $segkec_id)->delete([]);

        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kecamatan Segmentasi Daerah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kecamatan Segmentasi Daerah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }
}
