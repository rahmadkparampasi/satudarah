<?php

namespace App\Http\Controllers;

use App\Models\DnrktkModel;
use App\Models\DnrlokModel;
use App\Models\DnrmModel;
use App\Models\DnrModel;
use App\Models\DnrprsnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DnrpController extends Controller
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

            'WebTitle' => 'PERMINTAAN DARAH',
            'PageTitle' => 'Permintaan Darah',
            'BasePage' => 'dnrp',
        ];
    }

    public function index()
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="UTD"&&$this->data['Pgn']->users_tipe!="ADM") {
            return redirect()->intended();
        }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrpAddData';
        $this->data['UrlForm'] = 'dnrp';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        
        $this->data['Dnrp'] = DnrModel::leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('ktk', 'dnr.dnr_ktk', '=', 'ktk.ktk_id')->where('dnr_lok', $this->data['Pgn']->users_org)->where('dnr_kat', 'P')->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'gol_nm', 'dnr_send', 'dnrprsn_prsn', 'dnr_org', 'prsn_tgllhr', 'prsn_kd', 'ktk_nm', 'dnr_nm', 'dnr_telp'])->orderBy('dnr_ord', 'desc')->limit(20)->get();
        $this->data['Dnrp'] = DnrController::setData($this->data['Dnrp']);

        $this->data['Org'] = OrgController::getDataByRs('1');
        $this->data['Ktk'] = KtkController::getDataActStat();

        return view('dnrp.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrpAddData';
        $this->data['UrlForm'] = 'dnrp';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrp'] = DnrModel::leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('ktk', 'dnr.dnr_ktk', '=', 'ktk.ktk_id')->where('dnr_lok', $this->data['Pgn']->users_org)->where('dnr_kat', 'P')->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'gol_nm', 'dnr_send', 'dnrprsn_prsn', 'dnr_org', 'prsn_tgllhr', 'prsn_kd', 'ktk_nm', 'dnr_nm', 'dnr_telp'])->orderBy('dnr_ord', 'desc')->limit(20)->get();
        $this->data['Dnrp'] = DnrController::setData($this->data['Dnrp']);

        return view('dnrp.data', $this->data);
    }

    public function viewData($dnr_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="UTD") {
            return redirect()->intended();
        }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrpAddData';
        $this->data['UrlForm'] = 'dnrp';
        $this->data['dnr_id'] = $dnr_id;
        $this->data['Utama'] = DnrlokController::getUtmByOrgDnr($dnr_id, $this->data['Pgn']->users_org);

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrp'] = DnrModel::leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('ktk', 'dnr.dnr_ktk', '=', 'ktk.ktk_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->leftJoin('dnrktk', 'dnrktk.dnrktk_dnr', '=', 'dnr.dnr_id')->where('dnr_id', $dnr_id)->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'prsn_nik', 'gol_nm', 'dnr_tmbh', 'dnr_send', 'dnrprsn_prsn', 'dnrktk_prsn', 'dnr_org', 'prsn_tgllhr', 'prsn_jk', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_alt', 'prsn_tmptlhr', 'ktk_nm', 'prsn_krj', 'krj_nm', 'prsn_kd'])->orderBy('dnr_ord', 'desc')->get()->first();
        if ($this->data['Dnrp']==null) {
            $this->data['Message'] = 'Data Donor Darah Pribadi Tidak Ditemukan';
            return view('layouts.notFound', $this->data);
        }
        
        if (!DnrlokController::getByOrgDnr($dnr_id, $this->data['Pgn']->users_org)) {
            return redirect()->intended('/dnrp');
        }

        $this->data['Org'] = OrgController::getDataByRs('1');
        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Kec'] = KecController::getData();
        $this->data['Ktk'] = KtkController::getDataActStat();
        $this->data['Krj'] = KrjController::getDataActStat();

        $this->data['Dnrm'] = DnrmModel::leftJoin('org', 'dnrm.dnrm_org', '=', 'org.org_id')->leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnrm_dnr', $dnr_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'dnrm_id', 'dnrm_dnr', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'org_nm', 'dnrm_prsn', 'dnrm_org', 'prsn_kd'])->orderBy('dnrm_ord', 'desc')->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        $this->data['Dnrp'] = DnrController::setData($this->data['Dnrp'], 'D');

        $this->data['Dnrlok'] = DnrlokController::getByDnr($dnr_id);
        return view('dnrp.detail', $this->data);
    }

    public function loadView($dnr_id)
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

        $this->data['Dnrp'] = DnrModel::leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('ktk', 'dnr.dnr_ktk', '=', 'ktk.ktk_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->leftJoin('dnrktk', 'dnrktk.dnrktk_dnr', '=', 'dnr.dnr_id')->where('dnr_id', $dnr_id)->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'prsn_nik', 'gol_nm', 'dnr_tmbh', 'dnr_send', 'dnrprsn_prsn', 'dnrktk_prsn', 'dnr_org', 'prsn_tgllhr', 'prsn_jk', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_alt', 'prsn_tmptlhr', 'ktk_nm', 'prsn_krj', 'krj_nm', 'prsn_kd'])->orderBy('dnr_ord', 'desc')->get()->first();
        $this->data['Dnrp'] = DnrController::setData($this->data['Dnrp'], 'D');
        $this->data['Dnrlok'] = DnrlokController::getByDnr($dnr_id);

        return view('dnrp.detailDetail', $this->data);
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

        $DnrModel = new DnrModel();
        $DnrPrsnModel = new DnrprsnModel();
       
        $this->data['Pgn'] = $this->getUser();

        $DnrModel->dnr_org = $request->dnr_org;
        $DnrModel->dnr_sft = $request->dnr_sft;
        $DnrModel->dnr_tgl = $request->dnr_tgl;
        $DnrModel->dnr_ktk = $request->dnr_ktk;
        $DnrModel->dnr_bth = $request->dnr_bth;
        $DnrModel->dnr_nm = $request->dnr_nm;
        $DnrModel->dnr_telp = $request->dnr_telp;
        $DnrModel->dnr_lok = $this->data['Pgn']->users_org;
        $DnrModel->dnr_kat = "P";
        $DnrModel->dnr_ucreate = $this->data['Pgn']->users_id;
        $DnrModel->dnr_uupdate = $this->data['Pgn']->users_id;

        $save = $DnrModel->save();
        if ($save) {
            // $prsn_id = '';
            $Dnr = DnrModel::where('dnr_ord', $DnrModel->dnr_id)->select(['dnr_id'])->get()->first();
            $DnrPrsnModel->dnrprsn_dnr = $Dnr->dnr_id;
            $DnrPrsnModel->dnrprsn_prsn = $request->dnrprsn_prsn;
            $DnrPrsnModel->dnrprsn_ucreate = $this->data['Pgn']->users_id;
            $DnrPrsnModel->dnrprsn_uupdate = $this->data['Pgn']->users_id;
            $saveDnrPrsn = $DnrPrsnModel->save();

            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Donor Darah Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrPrsnModel = new DnrprsnModel();
        $DnrktkModel = new DnrktkModel();

        $this->data['Pgn'] = $this->getUser();
        try {
            $update = DB::table('dnr')->where('dnr_id', $request->dnr_id)->update([
                'dnr_org' => $request->dnr_org,
                'dnr_sft' => $request->dnr_sft,
                'dnr_tgl' => $request->dnr_tgl,
                'dnr_ktk' => $request->dnr_ktk,
                'dnr_bth' => $request->dnr_bth,
                'dnr_nm' => $request->dnr_nm,
                'dnr_telp' => $request->dnr_telp,
                'dnr_uupdate' => $this->data['Pgn']->users_id
            ]);
            $delete = $DnrPrsnModel::where('dnrprsn_dnr', $request->dnr_id)->delete([]);
            // $prsn_id = '';
            $DnrPrsnModel->dnrprsn_dnr = $request->dnr_id;
            $DnrPrsnModel->dnrprsn_prsn = $request->dnrprsn_prsn;
            $DnrPrsnModel->dnrprsn_ucreate = $this->data['Pgn']->users_id;
            $DnrPrsnModel->dnrprsn_uupdate = $this->data['Pgn']->users_id;
            $saveDnrPrsn = $DnrPrsnModel->save();

            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Donor Darah Berhasil Disimpan"
            ];
        } catch (\Exception $e) {
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }
}
