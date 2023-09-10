<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\DnrmModel;
use App\Models\DnrModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DnrmController extends Controller
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

            'WebTitle' => 'DONOR DARAH MANDIRI',
            'PageTitle' => 'Donor Darah Mandiri',
            'BasePage' => 'dnrm',
        ];
    }

    public function index()
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="UTD") {
            return redirect()->intended();
        }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrmAddData';
        $this->data['UrlForm'] = 'dnrm';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        
        $this->data['Dnrm'] = DnrmModel::leftJoin('org', 'dnrm.dnrm_org', '=', 'org.org_id')->leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->where('dnrm_org', $this->data['Pgn']->users_org)->where('dnrm_kat', 'M')->select(['dnrm_id', 'org_nm', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'prsn_nm', 'prsn_nik', 'gol_nm', 'dnrm_org', 'prsn_tgllhr', 'prsn_id', 'prsn_kd'])->orderBy('dnrm_ord', 'desc')->limit(20)->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        $this->data['Org'] = OrgController::getDataByRs('1');
        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Kec'] = KecController::getData();
        $this->data['Krj'] = KrjController::getDataActStat();

        return view('dnrm.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrmAddData';
        $this->data['UrlForm'] = 'dnrm';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrm'] = DnrmModel::leftJoin('org', 'dnrm.dnrm_org', '=', 'org.org_id')->leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->where('dnrm_org', $this->data['Pgn']->users_org)->where('dnrm_kat', 'M')->select(['dnrm_id', 'org_nm', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'prsn_nm', 'prsn_nik', 'gol_nm', 'dnrm_org', 'prsn_tgllhr', 'prsn_id', 'prsn_kd'])->orderBy('dnrm_ord', 'desc')->limit(20)->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        return view('dnrm.data', $this->data);
    }

    public function loadDnrp($dnrm_dnr)
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrmAddData';
        $this->data['UrlForm'] = 'dnrm';
        $this->data['dnrm_dnr'] = $dnrm_dnr;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrm'] = DnrmModel::leftJoin('org', 'dnrm.dnrm_org', '=', 'org.org_id')->leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnrm_dnr', $dnrm_dnr)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'dnrm_id', 'dnrm_dnr', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'org_nm', 'dnrm_prsn', 'dnrm_org', 'prsn_kd'])->orderBy('dnrm_ord', 'desc')->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        return view('dnrp.detailDnr', $this->data);
    }

    public function loadDnrk($dnrm_dnr)
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrkAddData';
        $this->data['UrlForm'] = 'dnrk';
        $this->data['dnrm_dnr'] = $dnrm_dnr;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_id', $dnrm_dnr)->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->get()->first();
        
        $this->data['Dnrm'] = DnrmModel::leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnrm_dnr', $dnrm_dnr)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'dnrm_id', 'dnrm_dnr', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_prsn', 'prsn_kd'])->orderBy('dnrm_ord', 'desc')->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        return view('dnrk.detailDnr', $this->data);
    }

    static function countDnr($dnrm_dnr)
    {
        return DB::table('dnrm')->where('dnrm_dnr', $dnrm_dnr)->sum('dnrm_jmlh');
    }

    static function countDnrPrsn($dnrm_prsn)
    {
        return DB::table('dnrm')->where('dnrm_prsn', $dnrm_prsn)->count('dnrm_prsn');
    }

    static function loadPrsn($dnrm_prsn)
    {
        $Dnrm = DnrmModel::leftJoin('dnr', 'dnrm.dnrm_dnr', '=', 'dnr.dnr_id')->leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->where('dnrm_prsn', $dnrm_prsn)->select(['dnrm_id', 'dnrm_kat', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_lok', 'dnr_nm', 'org_nm', 'dnrm_lok'])->orderBy('dnrm_ord', 'desc')->get();
        if (count($Dnrm)==0) {
            return $Dnrm;
        }

        for ($i=0; $i < count($Dnrm); $i++) { 
           
            $Dnrm[$i]->dnrm_katAltT = "Personal";
            if ($Dnrm[$i]->dnrm_kat=='M') {
                $Dnrm[$i]->dnrm_katAltT = "Mandiri";
            }elseif ($Dnrm[$i]->dnrm_kat=='K') {
                $Dnrm[$i]->dnrm_katAltT = "Kegiatan";
            }

            $Dnrm[$i]->dnrm_tglAltT = "";
            if ($Dnrm[$i]->dnrm_tgl!='0000-00-00') {
                $Dnrm[$i]->dnrm_tglAltT = ucwords(strtolower(AIModel::changeDateNFSt($Dnrm[$i]->dnrm_tgl)));
            }

            if ($Dnrm[$i]->dnrm_kat=="K") {
                # code...
            }
        }
        return $Dnrm;
    }

    public function insertData(Request $request) {

        // Jika dia pernah donor, periksa NIK apakah ada yang sama atau tidak. Jika tidak terdapat NIK yang sama, cari berdasarkan nama, tgl lahir, jenis kelamin ,gol Darah
        // Kondisi: 
        // 1.  Jika pernah donor, Periksa NIK
        // 2.  Jika NIK ditemukan, lakukan update Data
        // 3.  Jika NIK tidak ditemukan, cari berdasarkan Nama, Tgl Lahir, Jenis Kelamin, Gol. Darah
        // 4.  Jika data sama sekali belum ada atau tidak di temukan, tandai sebagai belum pernah donor
        // Jika belum pernah donor, periksa NIK, apakah terdapat NIK yang samma. Jika terdapat NIK yang sama, lakukan update data
        // 1. Jika belum pernah donor, periksa NIK
        // 2. Jika NIK ditemukan, lakukan update
        // 3. Jika NIK tidak ditemukan, lakukan pengecekan apakah terdapat potensi Nama, Tgl Lahir, Jenis Kelamin, Gol. Darah yang sama
        // 4. Jika ditemukan data, tandai sebagai pernah donor
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $Prsn = [];
        $dnrm_prsn = '';
        if ($request->prsn_id!=''||$request->prsn_id!=null) {
            $Dnrm = DnrmModel::where('dnrm_prsn', $request->prsn_id)->where('dnrm_dnr', $request->dnrm_dnr)->select(['dnrm_prsn'])->orderBy('dnrm_ord', 'desc')->get()->first();
        }
        if ($Dnrm==null) {
            if ($request->prsn_id==''||$request->prsn_id==null) {
                $Prsn = PrsnController::insertDataDnr($request, $this->data['Pgn']);
                $dnrm_prsn = $Prsn[1];
            }else{
                $Prsn = PrsnController::updateDataDnr($request, $this->data['Pgn']);
                $dnrm_prsn = $request->prsn_id;
            }
            if ($Prsn[0]) {
                $DnrmModel->dnrm_jmlh = $request->dnrm_jmlh;
                $DnrmModel->dnrm_tgl = $request->dnrm_tgl;
                $DnrmModel->dnrm_org = $request->dnrm_org;
                $DnrmModel->dnrm_prsn = $dnrm_prsn;
                $DnrmModel->dnrm_dnr = $request->dnrm_dnr;
                $DnrmModel->dnrm_kat = "P";
                
                $DnrmModel->dnrm_ucreate = $this->data['Pgn']->users_id;
                $DnrmModel->dnrm_uupdate = $this->data['Pgn']->users_id;
    
                $save = $DnrmModel->save();
                if ($save) {
    
                    $data['response'] = [
                        'status' => 200,
                        'response' => "success",
                        'type' => "success",
                        'message' => "Data Donor Darah Berhasil Disimpan"
                    ];
                }else{
                    $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
                }
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => $Prsn[1]];
            }
        }else{
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Pendonor Sudah Ada'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $Prsn = [];
        $dnrm_prsn = '';

        if ($request->prsn_id==''||$request->prsn_id==null) {
            $Prsn = PrsnController::insertDataDnr($request, $this->data['Pgn']);
            $dnrm_prsn = $Prsn[1];
        }else{
            $Prsn = PrsnController::updateDataDnr($request, $this->data['Pgn']);
            $dnrm_prsn = $request->prsn_id;
        }

        if ($Prsn[0]) {
            try {
                $update = DB::table('dnrm')->where('dnrm_id', $request->dnrm_id)->update([
                    'dnrm_jmlh' => $request->dnrm_jmlh,
                    'dnrm_tgl' => $request->dnrm_tgl,
                    'dnrm_org' => $request->dnrm_org,
                    'dnrm_prsn' => $dnrm_prsn,
                    
                    'dnrm_uupdate' => $this->data['Pgn']->users_id
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Donor Darah Berhasil Disimpan"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
            }
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => $Prsn[1]];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function insertDataK(Request $request) {

        // Jika dia pernah donor, periksa NIK apakah ada yang sama atau tidak. Jika tidak terdapat NIK yang sama, cari berdasarkan nama, tgl lahir, jenis kelamin ,gol Darah
        // Kondisi: 
        // 1.  Jika pernah donor, Periksa NIK
        // 2.  Jika NIK ditemukan, lakukan update Data
        // 3.  Jika NIK tidak ditemukan, cari berdasarkan Nama, Tgl Lahir, Jenis Kelamin, Gol. Darah
        // 4.  Jika data sama sekali belum ada atau tidak di temukan, tandai sebagai belum pernah donor
        // Jika belum pernah donor, periksa NIK, apakah terdapat NIK yang samma. Jika terdapat NIK yang sama, lakukan update data
        // 1. Jika belum pernah donor, periksa NIK
        // 2. Jika NIK ditemukan, lakukan update
        // 3. Jika NIK tidak ditemukan, lakukan pengecekan apakah terdapat potensi Nama, Tgl Lahir, Jenis Kelamin, Gol. Darah yang sama
        // 4. Jika ditemukan data, tandai sebagai pernah donor
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $Prsn = [];

        if ($request->prsn_id!=''||$request->prsn_id!=null) {
            $Dnrm = DnrmModel::where('dnrm_prsn', $request->prsn_id)->where('dnrm_dnr', $request->dnr_id)->select(['dnrm_prsn'])->orderBy('dnrm_ord', 'desc')->get()->first();
        }
        if ($Dnrm==null) {
            $DnrmModel->dnrm_jmlh = $request->dnrm_jmlh;
            $DnrmModel->dnrm_tgl = $request->dnrm_tgl;
            $DnrmModel->dnrm_prsn = $request->prsn_id;
            $DnrmModel->dnrm_dnr = $request->dnr_id;
            $DnrmModel->dnrm_kat = "K";
            
            $DnrmModel->dnrm_ucreate = $this->data['Pgn']->users_id;
            $DnrmModel->dnrm_uupdate = $this->data['Pgn']->users_id;

            $save = $DnrmModel->save();
            if ($save) {

                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Donor Darah Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
            }
        }else{
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Pendonor Sudah Ada'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateDataK(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $Prsn = [];
        $dnrm_prsn = '';

        if ($request->prsn_id==''||$request->prsn_id==null) {
            $Prsn = PrsnController::insertDataDnr($request, $this->data['Pgn']);
            $dnrm_prsn = $Prsn[1];
        }else{
            $Prsn = PrsnController::updateDataDnr($request, $this->data['Pgn']);
            $dnrm_prsn = $request->prsn_id;
        }

        if ($Prsn[0]) {
            try {
                $update = DB::table('dnrm')->where('dnrm_id', $request->dnrm_id)->update([
                    'dnrm_jmlh' => $request->dnrm_jmlh,
                    'dnrm_tgl' => $request->dnrm_tgl,
                    'dnrm_prsn' => $dnrm_prsn,
                    
                    'dnrm_uupdate' => $this->data['Pgn']->users_id
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Donor Darah Berhasil Disimpan"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
            }
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => $Prsn[1]];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function insertDataM(Request $request)
    {
        // header('Content-Type: application/json; charset=utf-8');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $DnrmModel->dnrm_prsn = $request->dnrm_prsn;
        $DnrmModel->dnrm_jmlh = $request->dnrm_jmlh;
        $DnrmModel->dnrm_tgl = $request->dnrm_tgl;
        $DnrmModel->dnrm_lok = $request->dnrm_lok;
        $DnrmModel->dnrm_kat = "M";
        $DnrmModel->dnrm_ucreate = $this->data['Pgn']->users_id;
        $DnrmModel->dnrm_uupdate = $this->data['Pgn']->users_id;

        $save = $DnrmModel->save();
        if ($save) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Donor Darah Mandiri Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Mandiri Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateDataM(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $this->data['Pgn'] = $this->getUser();
        $Prsn = [];
        $prsn_id = '';
        if ($request->prsn_id==''||$request->prsn_id==null) {
            $Prsn = PrsnController::insertDataDnr($request, $this->data['Pgn']);
            $prsn_id = $Prsn[1];
        }else{
            $Prsn = PrsnController::updateDataDnr($request, $this->data['Pgn']);
            $prsn_id = $request->prsn_id;
        }

        if ($Prsn[0]) {
            try {
                $update = DB::table('dnrm')->where('dnrm_id', $request->dnrm_id)->update([
                    'dnrm_prsn' => $prsn_id,
                    'dnrm_jmlh' => $request->dnrm_jmlh,
                    'dnrm_tgl' => $request->dnrm_tgl,
                    'dnrm_uupdate' => $this->data['Pgn']->users_id
                ]);

                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Donor Darah Mandiri Berhasil Diubah"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Mandiri Tidak Dapat Diubah'];
            }
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => $Prsn[1]];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($dnrm_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrmModel = new DnrmModel();

        $delete = $DnrmModel::where('dnrm_id', $dnrm_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Pendonor Darah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pendonor Darah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    static function setData($data)
    {
        $today = date("Y-m-d");

        if (is_countable($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]->prsn_altAltT = "Desa ";
                if ($data[$i]->jenis=="K") {
                    $data[$i]->prsn_altAltT = "Kel. ";
                }
                $data[$i]->prsn_altAltT = $data[$i]->prsn_alt.", ".$data[$i]->prsn_altAltT.$data[$i]->desa_nama.", Kec. ".$data[$i]->kec_nama;
    
                $data[$i]->prsn_jkAltT = "Laki-Laki";
                if ($data[$i]->prsn_jk!='L') {
                    $data[$i]->prsn_jkAltT = "Perempuan";
                }
    
                $data[$i]->prsn_waAltT = "Ya";
                if ($data[$i]->prsn_wa!='1') {
                    $data[$i]->prsn_waAltT = "Tidak";
                }

                $data[$i]->uT = "0 Tahun";
                $data[$i]->uB = "0 Bulan";
                $data[$i]->uH = "0 Hari";
                $data[$i]->umur = "0 Tahun, 0 Bulan, 0 Hari";
                $data[$i]->prsn_tgllhrAltT = "";
                if ($data[$i]->prsn_tgllhr!='0000-00-00') {
                    $data[$i]->prsn_tgllhrAltT = ucwords(strtolower(AIModel::changeDateNFSt($data[$i]->prsn_tgllhr)));
                    $diff = date_diff(date_create($data[$i]->prsn_tgllhr), date_create($today));
                    $data[$i]->uT = (string)$diff->format('%y')." Tahun";
                    $data[$i]->uB = (string)$diff->format('%m')." Bulan";
                    $data[$i]->uH = (string)$diff->format('%d')." Hari";
                    $data[$i]->umur = (string)$diff->format('%y')." Tahun, ".(string)$diff->format('%m')." Bulan, ".(string)$diff->format('%d')." Hari";
                }

                $data[$i]->dnrm_tglAltT = "";
                if ($data[$i]->dnrm_tgl!='0000-00-00') {
                    $data[$i]->dnrm_tglAltT = ucwords(strtolower(AIModel::changeDateNFSt($data[$i]->dnrm_tgl)));
                }

                
            }
        }else{
            $data->prsn_tgllhrAltT = "";
            if ($data->prsn_tgllhr!='0000-00-00') {
                $data->prsn_tgllhrAltT = AIModel::changeDateNFSt($data->prsn_tgllhr);
            }

            $data->prsn_altAltT = "Desa ";
            if ($data->jenis=="K") {
                $data->prsn_altAltT = "Kel. ";
            }
            $data->prsn_altAltT = $data->prsn_alt.", ".$data->prsn_altAltT.$data->desa_nama.", Kec. ".$data->kec_nama;

            $data->prsn_jkAltT = "Laki-Laki";
            if ($data->prsn_jk!='L') {
                $data->prsn_jkAltT = "Perempuan";
            }

            $data->prsn_waAltT = "Ya";
            if ($data->prsn_wa!='1') {
                $data->prsn_waAltT = "Tidak";
            }

            $data->uT = "0 Tahun";
            $data->uB = "0 Bulan";
            $data->uH = "0 Hari";
            $data->umur = "0 Tahun, 0 Bulan, 0 Hari";
            $data->prsn_tgllhrAltT = "";
            if ($data->prsn_tgllhr!='0000-00-00') {
                $data->prsn_tgllhrAltT = ucwords(strtolower(AIModel::changeDateNFSt($data->prsn_tgllhr)));
                $diff = date_diff(date_create($data->prsn_tgllhr), date_create($today));
                $data->uT = (string)$diff->format('%y')." Tahun";
                $data->uB = (string)$diff->format('%m')." Bulan";
                $data->uH = (string)$diff->format('%d')." Hari";
                $data->umur = (string)$diff->format('%y')." Tahun, ".(string)$diff->format('%m')." Bulan, ".(string)$diff->format('%d')." Hari";
            }

            $data->dnrm_tglAltT = "";
            if ($data->dnrm_tgl!='0000-00-00') {
                $data->dnrm_tglAltT = ucwords(strtolower(AIModel::changeDateNFSt($data->dnrm_tgl)));
            }

           
        }
        return $data;
    }
}
