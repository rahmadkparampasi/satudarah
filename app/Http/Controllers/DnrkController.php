<?php

namespace App\Http\Controllers;

use App\Models\DnrmModel;
use App\Models\DnrModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DnrkController extends Controller
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

            'WebTitle' => 'DONOR DARAH KEGIATAN',
            'PageTitle' => 'Donor Darah Kegiatan',
            'BasePage' => 'dnrk',
        ];
    }

    public function index()
    {
        // dd($kat);
        $this->data['Pgn'] = $this->getUser();
        // if ($kat!="P"||$kat!="K"||$kat != '') {
        //     return redirect()->intended();
        // }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrkAddData';
        $this->data['UrlForm'] = 'dnrk';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        
        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_kat', 'K')->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->limit(20)->get();
        $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk']);

        $this->data['Kec'] = KecController::getData();

        return view('dnrk.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrkAddData';
        $this->data['UrlForm'] = 'dnrk';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_kat', 'K')->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->limit(20)->get();
        $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk']);

        return view('dnrk.data', $this->data);
    }

    public function viewData($dnr_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrpAddData';
        $this->data['UrlForm'] = 'dnrp';
        $this->data['dnr_id'] = $dnr_id;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_kat', 'K')->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->get()->first();
        if ($this->data['Dnrk']==null) {
            $this->data['Message'] = 'Data Donor Darah Pribadi Tidak Ditemukan';
            return view('layouts.notFound', $this->data);
        }
        
        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Kec'] = KecController::getData();
        $this->data['Krj'] = KrjController::getDataActStat();

        $this->data['Dnrm'] = DnrmModel::leftJoin('org', 'dnrm.dnrm_org', '=', 'org.org_id')->leftJoin('prsn', 'dnrm.dnrm_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnrm_dnr', $dnr_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'dnrm_id', 'dnrm_dnr', 'dnrm_jmlh', 'dnrm_tgl', 'dnrm_trm', 'org_nm', 'dnrm_prsn', 'dnrm_org'])->orderBy('dnrm_ord', 'desc')->get();
        $this->data['Dnrm'] = DnrmController::setData($this->data['Dnrm']);

        $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk'], 'K');
        return view('dnrk.detail', $this->data);
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

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Dnrk'] = DnrModel::leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnr_kat', 'K')->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send'])->orderBy('dnr_ord', 'desc')->get()->first();
        $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk'], 'K');

        return view('dnrk.detailDetail', $this->data);
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

        $this->data['Pgn'] = $this->getUser();

        $DnrModel->dnr_keg = $request->dnr_keg;
        $DnrModel->dnr_nm = $request->dnr_nm;
        $DnrModel->dnr_tgl = $request->dnr_tgl;
        $DnrModel->dnr_telp = $request->dnr_telp;
        $DnrModel->dnr_bth = $request->dnr_bth;
        $DnrModel->dnr_tmpt = $request->dnr_tmpt;
        $DnrModel->dnr_desa = $request->dnr_desa;
        $DnrModel->dnr_kat = "K";
        $DnrModel->dnr_ucreate = $this->data['Pgn']->users_id;
        $DnrModel->dnr_uupdate = $this->data['Pgn']->users_id;

        $save = $DnrModel->save();
        if ($save) {
            // $prsn_id = '';
            
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kegiatan Donor Darah Berhasil Disimpan"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kegiatan Donor Darah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrModel = new DnrModel();

        $this->data['Pgn'] = $this->getUser();
        
        try {
            $update = DB::table('dnr')->where('dnr_id', $request->dnr_id)->update([
                'dnr_keg' => $request->dnr_keg,
                'dnr_nm' => $request->dnr_nm,
                'dnr_tgl' => $request->dnr_tgl,
                'dnr_telp' => $request->dnr_telp,
                'dnr_bth' => $request->dnr_bth,
                'dnr_tmpt' => $request->dnr_tmpt,
                'dnr_desa' => $request->dnr_desa,
                'dnr_uupdate' => $this->data['Pgn']->users_id
            ]);

            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Kegiatan Donor Darah Berhasil Disimpan"
            ];
        } catch (\Exception $e) {
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Kegiatan Donor Darah Tidak Dapat Disimpan'];
        }
        return response()->json($data, $data['response']['status']);
    }
}
