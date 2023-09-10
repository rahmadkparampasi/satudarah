<?php

namespace App\Http\Controllers;

use App\Models\DnrlokModel;
use App\Models\DnrModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class DnrlokController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mODnr',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'DONOR DARAH LOKASI',
            'PageTitle' => 'Donor Darah Lokasi',
            'BasePage' => 'dnrlok',
        ];
    }

    static function getByDnr($dnrlok_dnr)
    {
        $Dnrlok = [];
        $Dnrlok['DnrlokUtm'] = DnrlokModel::leftJoin('org', 'dnrlok.dnrlok_org', '=', 'org.org_id')->where('dnrlok_dnr', $dnrlok_dnr)->where('dnrlok_utm', '1')->select(['dnrlok_id', 'dnrlok_dnr', 'dnrlok_org', 'dnrlok_utm', 'org_nm'])->orderBy('dnrlok_ord', 'desc')->get();
        $Dnrlok['DnrlokUtm'] = DnrmController::setData($Dnrlok['DnrlokUtm']);
        
        $Dnrlok['DnrlokNUtm'] = DnrlokModel::leftJoin('org', 'dnrlok.dnrlok_org', '=', 'org.org_id')->where('dnrlok_dnr', $dnrlok_dnr)->where('dnrlok_utm', '0')->select(['dnrlok_id', 'dnrlok_dnr', 'dnrlok_org', 'dnrlok_utm', 'org_nm'])->orderBy('dnrlok_ord', 'desc')->get();
        $Dnrlok['DnrlokNUtm'] = DnrmController::setData($Dnrlok['DnrlokNUtm']);

        return $Dnrlok;
    }

    static function getByOrgDnr($dnrlok_dnr, $dnrlok_org):bool{
        $Dnrlok = DnrlokModel::where('dnrlok_dnr', $dnrlok_dnr)->where('dnrlok_org', $dnrlok_org)->select(['dnrlok_id'])->orderBy('dnrlok_ord', 'desc')->get()->first();
        if ($Dnrlok==null) {
            return false;
        }
        return true;
    }

    static function getUtmByOrgDnr($dnrlok_dnr, $dnrlok_org):bool{
        $Dnrlok = DnrlokModel::where('dnrlok_dnr', $dnrlok_dnr)->where('dnrlok_org', $dnrlok_org)->select(['dnrlok_utm'])->orderBy('dnrlok_ord', 'desc')->get()->first();
        if ($Dnrlok==null) {
            return false;
        }
        if ($Dnrlok['dnrlok_utm']=="1") {
            return true;
        }
        return false;
    }

    public function loadDataDnrp($dnr_id)
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrmAddData';
        $this->data['UrlForm'] = 'dnrm';
        $this->data['dnr_id'] = $dnr_id;
        $this->data['Utama'] = DnrlokController::getUtmByOrgDnr($dnr_id, $this->data['Pgn']->users_org);

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrp'] = DnrModel::leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->where('dnr_id', $dnr_id)->select(['dnr_id', 'prsn_nm', ])->orderBy('dnr_ord', 'desc')->get()->first();

        $this->data['Dnrlok'] = [];
        $this->data['Dnrlok']['DnrlokUtm'] = DnrlokModel::leftJoin('org', 'dnrlok.dnrlok_org', '=', 'org.org_id')->where('dnrlok_dnr', $dnr_id)->where('dnrlok_utm', '1')->select(['dnrlok_id', 'dnrlok_dnr', 'dnrlok_org', 'dnrlok_utm', 'org_nm'])->orderBy('dnrlok_ord', 'desc')->get();
        $this->data['Dnrlok']['DnrlokUtm'] = DnrmController::setData($this->data['Dnrlok']['DnrlokUtm']);
        
        $this->data['Dnrlok']['DnrlokNUtm'] = DnrlokModel::leftJoin('org', 'dnrlok.dnrlok_org', '=', 'org.org_id')->where('dnrlok_dnr', $dnr_id)->where('dnrlok_utm', '0')->select(['dnrlok_id', 'dnrlok_dnr', 'dnrlok_org', 'dnrlok_utm', 'org_nm'])->orderBy('dnrlok_ord', 'desc')->get();
        $this->data['Dnrlok']['DnrlokNUtm'] = DnrmController::setData($this->data['Dnrlok']['DnrlokNUtm']);
        
        return view('dnrp.detailLok', $this->data);
    }

    public function loadDataDnrk($dnr_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrpAddData';
        $this->data['UrlForm'] = 'dnrp';
        $this->data['dnr_id'] = $dnr_id;
        $this->data['Utama'] = DnrlokController::getUtmByOrgDnr($dnr_id, $this->data['Pgn']->users_org);

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_id', $dnr_id)->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->get()->first();
        $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk'], 'K');
        $this->data['Dnrlok'] = DnrlokController::getByDnr($dnr_id);

        return view('dnrk.detailDetail', $this->data);
    }

    static function insertDataUtm($dnrlok_dnr, $Pgn) 
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrlokModel = new DnrlokModel();

        $DnrlokModel->dnrlok_dnr = $dnrlok_dnr;
        $DnrlokModel->dnrlok_org = $Pgn->users_org;
        $DnrlokModel->dnrlok_utm = "1";
        
        $DnrlokModel->dnrlok_ucreate = $Pgn->users_id;
        $DnrlokModel->dnrlok_uupdate = $Pgn->users_id;

        $save = $DnrlokModel->save();
        if ($save) {
            return [true];
        }else{
            return [false, 'Data Lokasi Donor Darah Tidak Dapat Disimpan'];
        }
    }

    public function insertDataLok(Request $request) 
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrlokModel = new DnrlokModel();

        $this->data['Pgn'] = $this->getUser();

        $Dnrlok = DnrlokModel::where('dnrlok_dnr', $request->dnrlok_dnr)->where('dnrlok_org', $request->dnrlok_org)->select(['dnrlok_id'])->orderBy('dnrlok_ord', 'desc')->get();

        if (count($Dnrlok)>0) {
            $data['response'] = ['status' => 422, 'response' => 'error','type' => "danger", 'message' => 'UTD Telah Dijadikan Lokasi Donor Darah'];
        }else{
            $DnrlokModel->dnrlok_dnr = $request->dnrlok_dnr;
            $DnrlokModel->dnrlok_org = $request->dnrlok_org;
            
            $DnrlokModel->dnrlok_ucreate = $this->data['Pgn']->users_id;
            $DnrlokModel->dnrlok_uupdate = $this->data['Pgn']->users_id;
    
            $save = $DnrlokModel->save();
            if ($save) {
    
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Lokasi Donor Darah Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Lokasi Donor Darah Tidak Dapat Disimpan'];
            }
        }

        return response()->json($data, $data['response']['status']);
    }

    public function insertDataK(Request $request) 
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrlokModel = new DnrlokModel();

        $this->data['Pgn'] = $this->getUser();
        $Dnrlok = DnrlokModel::where('dnrlok_dnr', $request->dnrlok_dnr)->where('dnrlok_org', $request->dnrlok_org)->select(['dnrlok_id'])->orderBy('dnrlok_ord', 'desc')->get();

        if (count($Dnrlok)>0) {
            $data['response'] = ['status' => 422, 'response' => 'error','type' => "danger", 'message' => 'UTD Telah Dijadikan Lokasi Donor Darah'];
        }else{
            $DnrlokModel->dnrlok_dnr = $request->dnrlok_dnr;
            $DnrlokModel->dnrlok_org = $request->dnrlok_org;
            
            $DnrlokModel->dnrlok_ucreate = $this->data['Pgn']->users_id;
            $DnrlokModel->dnrlok_uupdate = $this->data['Pgn']->users_id;
    
            $save = $DnrlokModel->save();
            if ($save) {
    
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Keterlibatan Donor Darah Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Keterlibatan Donor Darah Tidak Dapat Disimpan'];
            }
        }

        return response()->json($data, $data['response']['status']);
    }

    public function deleteDataLok($dnrlok_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrlokModel = new DnrlokModel();

        $delete = $DnrlokModel::where('dnrlok_id', $dnrlok_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Lokasi Donor Darah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Lokasi Donor Darah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteDataK($dnrlok_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrlokModel = new DnrlokModel();

        $delete = $DnrlokModel::where('dnrlok_id', $dnrlok_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Keterlibatan Donor Darah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Keterlibatan Donor Darah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    static function setData($data)
    {
        if (is_countable($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]->dnrlok_utmAltT = "Ya";
                if ($data[$i]->dnrlok_utm!='1') {
                    $data[$i]->dnrlok_utmAltT = "Tidak";
                }
            }
        }else{
            $data->dnrlok_utmAltT = "Ya";
            if ($data->dnrlok_utm!='1') {
                $data->dnrlok_utmAltT = "Tidak";
            }
        }
        return $data;
    }
}
