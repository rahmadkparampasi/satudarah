<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\KorgModel;
use Illuminate\Http\Request;

class KorgController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOKorg',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'KATEGORI ORGANISASI',
            'PageTitle' => 'Kategori Organisasi',
            'BasePage' => 'korg',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'korgAddData';
        $this->data['UrlForm'] = 'korg';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Korg'] = KorgModel::select(['korg_id', 'korg_nm', 'korg_act'])->orderBy('korg_ord', 'desc')->get();
        $this->data['Korg'] = $this->setData($this->data['Korg']);

        return view('korg.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'korgAddData';
        $this->data['UrlForm'] = 'korg';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Korg'] = KorgModel::select(['korg_id', 'korg_nm', 'korg_act'])->orderBy('korg_ord', 'desc')->get();
        $this->data['Korg'] = $this->setData($this->data['Korg']);

        return view('korg.data', $this->data);
    }

    public function insertData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KorgModel = new KorgModel();

        $this->data['Pgn'] = $this->getUser();

        $KorgModel->korg_nm = $request->korg_nm;
        $KorgModel->korg_ucreate = $this->data['Pgn']->users_id;
        $KorgModel->korg_uupdate = $this->data['Pgn']->users_id;
        $KorgModel->korg_act = "1";

        $save = $KorgModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kategori Organisasi Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kategori Organisasi Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KorgModel = new KorgModel();

        $this->data['Pgn'] = $this->getUser();

        $korg_id = $request->korg_id;

        $update = $KorgModel::where('korg_id', $korg_id)->update([
            'korg_nm' => $request->korg_nm,
            'korg_uupdate' => $this->data['Pgn']->users_id
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kategori Organisasi Berhasil Diubah"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kategori Organisasi Tidak Dapat Diubah'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($korg_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KorgModel = new KorgModel;

        $delete = $KorgModel::where('korg_id', $korg_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kategori Organisasi Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kategori Organisasi Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($korg_act, $korg_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $KorgModel = new KorgModel();

        $message = "Dinonaktifkan";
        if ($korg_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $KorgModel::where('korg_id', $korg_id)->update([
            'korg_act' => $korg_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kategori Organisasi Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kategori Organisasi Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]['korg_actAltT'] = "Aktif";
            $data[$i]['korg_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['korg_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Kategori Organisasi\", \"".url('korg/setAct/0/'.$data[$i]['korg_id'])."\", \"".url('korg/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['korg_act']=="0") {
                $data[$i]['korg_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['korg_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Kategori Organisasi\", \"".url('korg/setAct/1/'.$data[$i]['korg_id'])."\", \"".url('korg/load')."\", \"".$this->data['IdForm']."\", \"".$this->data['IdForm']."data\", \"".$this->data['IdForm']."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['korg_actAltT'] = "Tidak Aktif";                
            }
        }
        return $data;
    }
}
