<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\DesaModel;
use App\Models\GolModel;
use App\Models\KecModel;
use App\Models\PrsnModel;
use App\Models\SegModel;
use App\Models\UsersModel;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
use Picqer\Barcode\Barcode;
use Picqer\Barcode\BarcodeGeneratorPNG;
use TCPDF;

class MYPDF extends TCPDF
{
    public function Header()
    {
        
    }
    public function footer()
    {
        $this->setY(-15);
        $this->setFont('helvetica', 'I', 8);
        // $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '    ' . '*** ' . date("Y-m-d") . ' ***', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $footer = '<p align="center">Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '    ' . '*** ' . date("Y-m-d") . ' ***</p><br/><p align="center"><b>E-INM</b></p>';
        $this->writeHTML($footer, true, false, false, false, '');
    }
}

class PrsnController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOPrsn',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'PERSONAL',
            'PageTitle' => 'Personal',
            'BasePage' => 'prsn',
        ];
    }

    public function index()
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="ADM"&&$this->data['Pgn']->users_tipe!="UTD") {
            return redirect()->intended();
        }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['klp_id'] = '';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->limit(100)->get();
        $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);

        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Krj'] = KrjController::getDataActStat();
        $this->data['Kec'] = KecController::getData();

        return view('prsn.index', $this->data);
    }

    public function load($search_nm = '', $search_tgl = '')
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        if($search_nm!=''&&$search_tgl!=''){
            $this->data['search'] = "";
            $this->data['search_nm'] = $search_nm;
            $this->data['search_tgl'] = $search_tgl;
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            $Prsn = $Prsn->where(function($query) use ($search_nm){
                $query->where('prsn_nm', 'like', '%'.$search_nm.'%');
                $namaBaru = explode(" ", $search_nm);
                if (count($namaBaru)>1) {
                    for ($i=1; $i < count($namaBaru); $i++) { 
                        $query->orWhere('prsn_nm', 'like', '%'.$namaBaru[$i].'%');
                    }
                }
            })
            ->where('prsn_tgllhr', $search_tgl);
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_nm', 'asc')->limit(20)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.data', $this->data);
    }

    public function viewData($prsn_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']->users_tipe!="ADM"&&$this->data['Pgn']->users_tipe!="UTD") {
            return redirect()->intended();
        }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';
        $this->data['prsn_id'] = $prsn_id;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();
        if ($this->data['Prsn']==null) {
            $this->data['Message'] = 'Data Personal Tidak Ditemukan';
            return view('layouts.notFound', $this->data);
        }
        $this->data['Prsn']->total = DnrmController::countDnrPrsn($prsn_id);
        $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);
        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Krj'] = KrjController::getDataActStat();
        $this->data['Kec'] = KecController::getData();
        $this->data['Dnrm'] = DnrmController::loadPrsn($prsn_id);

        return view('prsn.detail', $this->data);
    }

    public function loadViewData($prsn_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';
        $this->data['prsn_id'] = $prsn_id;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();
        
        $this->data['Prsn']->total = DnrmController::countDnrPrsn($prsn_id);
        $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);

        return view('prsn.detailDetail', $this->data);
    }

    function loadViewDnr($prsn_id)
    {
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';
        $this->data['prsn_id'] = $prsn_id;

        $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();
        $this->data['Dnrm'] = DnrmController::loadPrsn($prsn_id);
        return view('prsn.detailDnr', $this->data);
    }

    public function viewDataSide($prsn_id)
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dnrkAddData';
        $this->data['UrlForm'] = 'dnrk';
        $this->data['prsn_id'] = $prsn_id;

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();
        
        $this->data['Prsn']->total = DnrmController::countDnrPrsn($prsn_id);
        $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);
        $this->data['Dnrm'] = DnrmController::loadPrsn($prsn_id);

        return view('prsn.detailSide', $this->data);
    }

    static function loadPrsn($prsn_id)
    {
        return PrsnController::setData(PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first());
    }

    public function searchData(Request $request) 
    {
        $this->data['Pgn'] = $this->getUser();
        $this->data['search'] = "";

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $search_nm = $request->search_nm;
        $search_tgl = $request->search_tgl;

        $this->data['search_nm'] = $search_nm;
        $this->data['search_tgl'] = $search_tgl;

        if ($search_nm==""||$search_tgl=="") {
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            $Prsn = $Prsn->where(function($query) use ($search_nm){
                $query->where('prsn_nm', 'like', '%'.$search_nm.'%');
                $namaBaru = explode(" ", $search_nm);
                if (count($namaBaru)>1) {
                    for ($i=1; $i < count($namaBaru); $i++) { 
                        $query->orWhere('prsn_nm', 'like', '%'.$namaBaru[$i].'%');
                    }
                }
            })
            ->where('prsn_tgllhr', $search_tgl);
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_nm', 'asc')->limit(20)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.data', $this->data);    
    }

    public function searchDataDnr(Request $request) 
    {
        $this->data['Pgn'] = $this->getUser();
        $this->data['search'] = "";

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $search_nm = $request->search_nm;
        $search_tgl = $request->search_tgl;
        $search_for = $request->search_for;

        $this->data['search_nm'] = $search_nm;
        $this->data['search_tgl'] = $search_tgl;
        $this->data['search_for'] = $search_for;

        if ($search_nm==""||$search_tgl=="") {
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis',  'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            $Prsn = $Prsn->where(function($query) use ($search_nm){
                $query->where('prsn_nm', 'like', '%'.$search_nm.'%');
                $namaBaru = explode(" ", $search_nm);
                if (count($namaBaru)>1) {
                    for ($i=1; $i < count($namaBaru); $i++) { 
                        $query->orWhere('prsn_nm', 'like', '%'.$namaBaru[$i].'%');
                    }
                }
            })
            ->where('prsn_tgllhr', $search_tgl);
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_nm', 'asc')->limit(20)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.searchDataDnr', $this->data);    
    }

    public function searchDataSide(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();
        $this->data['search'] = "";

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $search_nm = $request->search_nm;
        $search_tgl = $request->search_tgl;
        $search_for = $request->search_for;

        $this->data['search_nm'] = $search_nm;
        $this->data['search_tgl'] = $search_tgl;
        $this->data['search_for'] = $search_for;

        if ($search_nm==""||$search_tgl=="") {
            $Prsn = [];
        }else{
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            $Prsn = $Prsn->where(function($query) use ($search_nm){
                $query->where('prsn_nm', 'like', '%'.$search_nm.'%');
                $namaBaru = explode(" ", $search_nm);
                if (count($namaBaru)>1) {
                    for ($i=1; $i < count($namaBaru); $i++) { 
                        $query->orWhere('prsn_nm', 'like', '%'.$namaBaru[$i].'%');
                    }
                }
            })
            ->where('prsn_tgllhr', $search_tgl);
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_nm', 'asc')->limit(5)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.dataSide', $this->data);
    } 

    public function searchDataJson(Request $request){
        
        $search_key = $request->search_key;
        $search_val = $request->search_val;

        $this->data['search_val'] = $search_val;

        $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
        if ($search_key=="Nama") {
            $Prsn = $Prsn->where('prsn_nm', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="NIK") {
            $Prsn = $Prsn->where('prsn_nik', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="Telp") {
            $Prsn = $Prsn->where('prsn_telp', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="ID") {
            $Prsn = $Prsn->where('prsn_id', $search_val);
        }

        $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis',  'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();

        if ($Prsn==null) {
            $data['response'] = ['status' => 404, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Belum Ada'];
            return response()->json($data, 404);
        }

        return response()->json($Prsn, 200);
    }

    static function generateTablePDF($data, $pb = '', $dateA = '', $dateB = '')
    {
        $dpri = '<br '.$pb.'><p><strong><font size="12" >DATA PERSONAL PENDAFTAR PERIODE '.$dateA.' - '.$dateB.'<font></strong></p>';

        $tblhar = '<table nobr="false" cellspacing="0" cellpadding="6" border="1" width="100%" style="font-size:9pt;">
            <thead>
                <tr>
                    <th align="center" width="5%">No</th>
                    <th align="center" width="12%" class="text-wrap">Tanggal Daftar</th>
                    <th align="center" width="14%" class="text-wrap">Kode</th>
                    <th align="center" width="18%" class="text-wrap">Nama Lengkap</th>
                    <th align="center" width="15%" class="text-wrap">Telepon</th>
                    <th align="center" width="16%" class="text-wrap">TTL / Umur</th>
                    <th align="center" width="10%" class="text-wrap">Jenis Kelamin</th>
                    <th align="center" width="10%" class="text-wrap">Golongan Darah</th>
                </tr>
            </thead>
            <tbody>';
        if (count($data)==0) {
            $tblhar .= '<tr><td colspan="8" align="center" width="100%">Tidak Ada Data</td></tr>';
        }else{
        
            $no = 1;
            foreach ($data as $tk) {
                
                $tblhar .= '<tr nobr="true">
                <td align="center" width="5%">' . $no++ . '</td>
                <td align="left" width="12%">' . $tk->prsn_create . '</td>
                <td align="left" width="14%">' . $tk->prsn_kd . '</td>
                <td align="left" width="18%">' . ucwords(strtolower(stripslashes($tk->prsn_nm))) . '</td>
                <td align="left" width="15%">' . $tk->prsn_telp . '</td>
                <td align="left" width="16%">' . ucwords(strtolower(stripslashes($tk->prsn_tmptlhr).', '.$tk->prsn_tgllhrAltT)) . '<br/>Umur'.$tk->umur.'</td>
                <td align="left" width="10%">' . $tk->prsn_jkAltT . '</td>
                <td align="left" width="10%">' . $tk->gol_nm . '</td>
                </tr>';
            }
        }

        $tblhar .= '</tbody><tfoot>
        <tr>
        <td colspan="5" align="center" width="64%"><strong>Jumlah Pendaftar</strong></td>
        <td colspan="3" align="center" width="36%"><strong>'.(string)count($data).'</strong></td>
        </tr>
        </tfoot></table>';
        
        return [$dpri, $tblhar];
    }

    public function viewPdf($dateA = '', $dateB = '')
    {
        ob_start();

        $pdf = new MYPDF('L', 'mm', 'Legal', true, 'UTF-8', false);

        $pdf->setCreator(PDF_CREATOR);
        //Bug
        $pdf->setAuthor('Kirana Tri Gemilang');
        $pdf->setTitle('E-INM');
        $pdf->setSubject('Indikator Mutu Nasional');
        $pdf->setKeywords('E-INM');

        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->setMargins(12, 20, 12);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->setAutoPageBreak(true, 20);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->AddPage();
        $pdf->setFont('helvetica', '', 9);

        $urlLogo = public_path('assets/img/Logo-L-1.png');
        $urlLine = public_path('assets/img/line.png');
        $urlLogoKab = public_path('assets/img/sulteng.png');
        $tblpri = '<div class="container-fluid"> <table cellspacing="0" cellpadding="2" >
                <tr>';
        $tblpri .= '<td rowspan="2" align="center" width="45"><img src="' . $urlLogoKab . '" width="180" alt="Logo / Lambang SIMETRI"></td>';
        $tblpri .= '<td rowspan="2" align="center" width="150"><img src="' . $urlLogo . '" width="180" alt="Logo / Lambang SIMETRI"></td>';
        $tblpri .= '<td rowspan="2" align="center" width="8.5"><img src="' . $urlLine . '" width="180" alt="Logo / Lambang SIMETRI"></td>';
        $tblpri .= '
                <td width="500"><font size="17" style="text-transform:uppercase"><b>SATU DARAH</b></font></td>
            </tr>
            <tr>
                <td width="500"><font size="12" style="text-transform:uppercase"><b>SISTEM AKOMODASI TERPADU DONOR DARAH</b></font></td>
            </tr>
            </table></div>';
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $tblpri, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        
        if ($dateA == ''||$dateB == '') {
            $dpri = '<br><br><p align="center" ><font size="12" style="text-transform:uppercase"><b>TIDAK ADA DATA</b></font></p>';
            $pdf->writeHTML($dpri, true, false, false, false, '');

            $pdf->Output('Satu Darah - Data Personal.pdf', 'I');
            exit;
        }
        $this->data['Pgn'] = $this->getUser();
        
        $Prsn = PrsnModel::whereBetween('prsn_create', [$dateA, $dateB])->whereNotIn('prsn_telp', [''])->leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc', 'prsn_create'])->orderBy('prsn_ord', 'desc')->get();
        
        if ($Prsn==null) {
            $dpri = '<br><br><p align="center" ><font size="12" style="text-transform:uppercase"><b>TIDAK ADA DATA</b></font></p>';
            $pdf->writeHTML($dpri, true, false, false, false, '');

            $pdf->Output('Satu Darah - Data Personal.pdf', 'I');
            exit;
        }

        $Prsn = PrsnController::setData($Prsn);

        $TabelPrsn = PrsnController::generateTablePDF($Prsn, '', $dateA, $dateB);
        
        $pdf->writeHTML($TabelPrsn[0], true, false, false, false, '');
        
        $pdf->writeHTML($TabelPrsn[1], true, false, false, false, '');

        $pdf->Output('Satu Darah - Data Personal -' . $dateA . ' - '.$dateB.'.pdf', 'I');
        exit;
    }

    public function loadExcelForm(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        date_default_timezone_set("Asia/Makassar");
        $ExcelReader = new Reader();
        $file = $request->file('excelFile');
        $fileLocation = $file->getPathname();
        $objPhpExcel = $ExcelReader->load($fileLocation);
        $sheet = $objPhpExcel->getActiveSheet()->toArray(null, true, true, true);
        // dd($sheet);
        $success = 0;
        $error = 0;
        $rowError = [];
        $rowNumError = [];
        // $count = count($sheet) + 1;
        $countSheet = count($sheet);
        for ($i=1; $i < count($sheet)+1; $i++) { 
            if ($i==1) {
                continue;
            }

            $Prsn = PrsnModel::where('prsn_nik', substr($sheet[$i]["C"], 0, 16))->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
            if (count($Prsn)>0) {
                $error +=1;
                array_push($rowError, $sheet[$i]["C"]);
                array_push($rowNumError, $i);
                continue;
            }
            $PrsnModel = new PrsnModel();

            $prsn_gol = null;
            $Gol = null;
            if ($sheet[$i]["G"]=="O") {
                $Gol = GolModel::where('gol_nm', 'O+')->select(['gol_id'])->orderBy('gol_ord', 'asc')->get()->first();
                if ($Gol!=null) {
                    $prsn_gol = $Gol->gol_id;
                }
            }elseif ($sheet[$i]["G"]=="A") {
                $Gol = GolModel::where('gol_nm', 'A+')->select(['gol_id'])->orderBy('gol_ord', 'asc')->get()->first();
                if ($Gol!=null) {
                    $prsn_gol = $Gol->gol_id;
                }
            }elseif ($sheet[$i]["G"]=="AB") {
                $Gol = GolModel::where('gol_nm', 'AB+')->select(['gol_id'])->orderBy('gol_ord', 'asc')->get()->first();
                if ($Gol!=null) {
                    $prsn_gol = $Gol->gol_id;
                }
            }elseif ($sheet[$i]["G"]=="B") {
                $Gol = GolModel::where('gol_nm', 'B+')->select(['gol_id'])->orderBy('gol_ord', 'asc')->get()->first();
                if ($Gol!=null) {
                    $prsn_gol = $Gol->gol_id;
                }
            }

            $prsn_jk = "L";
            if ($sheet[$i]["F"]=="Perempuan") {
                $prsn_jk = "P";
            }

            $prsn_wa = "1";
            if ($sheet[$i]["I"]=="Tidak") {
                $prsn_wa = "0";
            }

            $prsn_telp = str_replace(["-", " "], ["", ""], $sheet[$i]["H"]) ;
            if (substr($prsn_telp, 0, 2)=="62") {
                $prsn_telp = substr_replace($prsn_telp, "0", 0, 2);
                $prsn_telp = substr($prsn_telp, 0, 12);
            }else{
                $prsn_telp = substr($prsn_telp, 0, 12);
            }

            $prsn_nik = $sheet[$i]["C"];
            if ($prsn_nik=="-"||$prsn_nik==" ") {
                $prsn_nik = null;
            }elseif (strlen($prsn_nik)>16) {
                $prsn_nik = null;
            }
            
            
            $prsn_desa = null;
            $Kec = KecModel::where('nama', $sheet[$i]["K"])->where('kec_kab', 'FGU01')->select(['id'])->orderBy('ord', 'asc')->get()->first();
            if ($Kec!=null) {
                if($Kec->id!=''){
                    $searchprsn_desa = str_replace(["Desa ", "DESA ", "desa ", "Kel ", "KEL ", "kel ", "Kel. ", "KEL. ", "kel. ", "KELURAHAN ", "Kelurahan ", "kelurahan"], ["", "", "", "", "", "", "", "", "", "", "", ""], $sheet[$i]["L"]);
                    $searchprsn_desa = explode(' ',$searchprsn_desa) ;
                    $Desa = DesaModel::where('nama', 'LIKE', '%'. ucwords(strtolower($searchprsn_desa[0])) .'%')->where('desa_kec', $Kec->id)->select(['id'])->orderBy('ord', 'asc')->get()->first();
                    if ($Desa!=null) {
                        $prsn_desa = $Desa->id;
                    }
                }

            }

            $PrsnModel->prsn_nm = addslashes($sheet[$i]["B"]);
            $PrsnModel->prsn_nik = $prsn_nik;
            $PrsnModel->prsn_tmptlhr = addslashes($sheet[$i]["D"]);
            $PrsnModel->prsn_tgllhr = date("Y-m-d", strtotime($sheet[$i]["E"]) );
            $PrsnModel->prsn_gol = $prsn_gol;
            $PrsnModel->prsn_jk = $prsn_jk;
            $PrsnModel->prsn_alt = addslashes($sheet[$i]["J"]);
            $PrsnModel->prsn_desa = $prsn_desa;
            $PrsnModel->prsn_wa = $prsn_wa;
            $PrsnModel->prsn_telp = $prsn_telp;
            
            $PrsnModel->prsn_ucreate = $this->data['Pgn']->users_id;
            $PrsnModel->prsn_uupdate = $this->data['Pgn']->users_id;
            
            $save = $PrsnModel->save();
            if ($save) {
                $success+=1;
            }else{
                array_push($rowError, $sheet[$i]["C"]);
                array_push($rowNumError, $i);
            }
        }
        dd($success, $error, $rowError);
    }

    public function loadExcelNForm(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        date_default_timezone_set("Asia/Makassar");
        $ExcelReader = new Reader();
        $file = $request->file('excelFile');
        $fileLocation = $file->getPathname();
        $objPhpExcel = $ExcelReader->load($fileLocation);
        $sheet = $objPhpExcel->getActiveSheet()->toArray(null, true, true, true);
        // dd($sheet);
        $success = 0;
        $error = 0;
        $rowError = [];
        $rowNumError = [];
        // $count = count($sheet) + 1;
        $countSheet = count($sheet);
        for ($i=1; $i < count($sheet)+1; $i++) { 
            
            $PrsnModel = new PrsnModel();

            $prsn_gol = null;
            if ($sheet[$i]["E"]!="") {
                $prsn_gol = $sheet[$i]["E"];
            }elseif ($sheet[$i]["F"]!="") {
                $prsn_gol = $sheet[$i]["F"];
            }elseif ($sheet[$i]["G"]!="") {
                $prsn_gol = $sheet[$i]["G"];
            }elseif ($sheet[$i]["H"]!="") {
                $prsn_gol = $sheet[$i]["G"];
            }

            $prsn_jk = "L";
            if ($sheet[$i]["J"]=="") {
                $prsn_jk = "P";
            }

            $prsn_wa = "0";
            

            $prsn_telp = null;

            $prsn_nik = null;
            
            
            
            $prsn_desa = $sheet[$i]["D"];
            $Desa = DesaModel::where('id', $prsn_desa)->select(['id', 'desa_kec'])->orderBy('ord', 'asc')->get()->first();
            if ($Desa==null) {
                $error +=1;
                array_push($rowError, [$sheet[$i]["B"], $i, "Desa Tidak Di Temukan"]);
                array_push($rowNumError, $i);
                continue;
            }

            $first_name = explode(' ',$sheet[$i]["B"]);
            $Prsn = PrsnModel::where('prsn_nm', 'LIKE', '%'. $first_name[0] .'%')->where('prsn_desa', $prsn_desa)->where('prsn_tgllhr', date("Y-m-d", strtotime($sheet[$i]["I"])))->where('prsn_jk', $prsn_jk)->where('prsn_gol', $prsn_gol)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
            if (count($Prsn)>0) {
                $error +=1;
                array_push($rowError, [$sheet[$i]["B"], $i, "Nama Dan Bio Sama"]);
                array_push($rowNumError, $i);
                continue;
            }
            
            $prsn_kd = PrsnController::getKode($sheet[$i]["I"], $Desa->desa_kec);
            // $prsn_bc = PrsnController::generateBarcodePri($prsn_kd);
            $PrsnModel->prsn_kd = $prsn_kd;
            $PrsnModel->prsn_nm = addslashes($sheet[$i]["B"]);
            $PrsnModel->prsn_nik = $prsn_nik;
            $PrsnModel->prsn_tmptlhr = "";
            $PrsnModel->prsn_tgllhr = date("Y-m-d", strtotime($sheet[$i]["I"]) );
            $PrsnModel->prsn_gol = $prsn_gol;
            $PrsnModel->prsn_jk = $prsn_jk;
            $PrsnModel->prsn_alt = "";
            $PrsnModel->prsn_desa = $prsn_desa;
            $PrsnModel->prsn_wa = $prsn_wa;
            $PrsnModel->prsn_telp = $prsn_telp;
            // $PrsnModel->prsn_bc = $prsn_bc;
            
            $PrsnModel->prsn_ucreate = $this->data['Pgn']->users_id;
            $PrsnModel->prsn_uupdate = $this->data['Pgn']->users_id;
            
            $save = $PrsnModel->save();
            if ($save) {
                $success+=1;
            }else{
                $error += 1;
                array_push($rowError, [$sheet[$i]["B"], $i, "Tidak Dapat Menyimpan"]);
                array_push($rowNumError, $i);
            }
        }
        dd($success, $error, $rowError, $rowNumError);
    }

    public function insertData(Request $request)
    {
        // header('Content-Type: application/json; charset=utf-8');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: *");         

        $this->data['Pgn'] = $this->getUser();

        $PrsnModel = new PrsnModel();

        $prsn_id = $request->prsn_id;

        $PrsnTelp = false;
        
        if ($request->prsn_telp=="") {
            $PrsnTelp = true;
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if($Prsn==null){
                $PrsnTelp = true;
            }
        }

        $PrsmSama = PrsnController::checkPrsn(addslashes($request->prsn_nm), $request->prsn_tgllhr);
        if (count($PrsmSama)>0) {
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Sudah Ada'];
        }else{
            if ($PrsnTelp!=true) {
                $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                $prsn_telp = null;
                if($request->prsn_telp!=''){
                    $prsn_telp = $request->prsn_telp;
                }

                $prsn_wa = "0";
                if($request->prsn_wa!='1'){
                    if($request->prsn_telp!=''){
                        $prsn_wa = $request->prsn_wa;
                    }
                }
    
                $prsn_kd = PrsnController::getKode($request->prsn_tgllhr, $request->prsn_kec);
                // $prsn_bc = PrsnController::generateBarcodePri($prsn_kd);
                $PrsnModel->prsn_kd = $prsn_kd;
                $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
                $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
                $PrsnModel->prsn_gol = $request->prsn_gol;
                $PrsnModel->prsn_jk = $request->prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
                $PrsnModel->prsn_desa = $request->prsn_desa;
                $PrsnModel->prsn_wa = $prsn_wa;
                $PrsnModel->prsn_krj = $request->prsn_krj;
                $PrsnModel->prsn_telp = $prsn_telp;
                // $PrsnModel->prsn_bc = $prsn_bc;
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();

                    $deleteUsers = UsersModel::where('username', $prsn_kd)->delete([]);
                    $Password = AIModel::getRandStrStat();
                    $Users = UsersController::insertDataU(addslashes($request->prsn_nm), $Prsn->prsn_id, $prsn_kd, $Password);

    
                    $tujuan = "";
                    $lengthTujuan = strlen($request->prsn_telp);
                    if (substr($request->prsn_telp, 0, 2)=="08") {
                        $tujuan = "62".substr($request->prsn_telp, 0, $lengthTujuan);
                    }elseif (substr($request->prsn_telp, 0, 2)=="62") {
                        $tujuan = $request->prsn_telp;
                    }
    
                    if ($prsn_telp!=null) {
                        $WaSend = WaSendController::sendDftr($prsn_kd, $Password, $tujuan);
                    }
                    $data['response'] = [
                        'status' => 200,
                        'response' => "success",
                        'type' => "success",
                        'message' => "Data Personal Berhasil Disimpan"
                    ];
                }else{
                    $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Dapat Disimpan'];
                }
            }
        }

        
        return response()->json($data, $data['response']['status']);
    }

    public function insertDataSide(Request $request)
    {
        // header('Content-Type: application/json; charset=utf-8');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: *");         

        $this->data['Pgn'] = $this->getUser();

        $PrsnModel = new PrsnModel();

        $prsn_id = $request->prsn_id;

        $PrsnTelp = false;
        
        if ($request->prsn_telp=="") {
            $PrsnTelp = true;
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if($Prsn==null){
                $PrsnTelp = true;
            }
        }

        $PrsmSama = PrsnController::checkPrsn(addslashes($request->prsn_nm), $request->prsn_tgllhr);
        if (count($PrsmSama)>0) {
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Sudah Ada'];
        }else{
            if ($PrsnTelp!=true) {
                $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                $prsn_telp = null;
                if($request->prsn_telp!=''){
                    $prsn_telp = $request->prsn_telp;
                }

                $prsn_wa = "0";
                if($request->prsn_wa!='1'){
                    if($request->prsn_telp!=''){
                        $prsn_wa = $request->prsn_wa;
                    }
                }
    
                $prsn_kd = PrsnController::getKode($request->prsn_tgllhr, $request->prsn_kec);
                // $prsn_bc = PrsnController::generateBarcodePri($prsn_kd);
                $PrsnModel->prsn_kd = $prsn_kd;
                $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
                $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
                $PrsnModel->prsn_gol = $request->prsn_gol;
                $PrsnModel->prsn_jk = $request->prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
                $PrsnModel->prsn_desa = $request->prsn_desa;
                $PrsnModel->prsn_wa = $prsn_wa;
                $PrsnModel->prsn_krj = $request->prsn_krj;
                $PrsnModel->prsn_telp = $prsn_telp;
                // $PrsnModel->prsn_bc = $prsn_bc;
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();

                    $deleteUsers = UsersModel::where('username', $prsn_kd)->delete([]);
                
                    $Password = AIModel::getRandStrStat();
                    $Users = UsersController::insertDataU(addslashes($request->prsn_nm), $Prsn->prsn_id, $prsn_kd, $Password);
    
                    $tujuan = "";
                    $lengthTujuan = strlen($request->prsn_telp);
                    if (substr($request->prsn_telp, 0, 2)=="08") {
                        $tujuan = "62".substr($request->prsn_telp, 0, $lengthTujuan);
                    }elseif (substr($request->prsn_telp, 0, 2)=="62") {
                        $tujuan = $request->prsn_telp;
                    }
    
                    if ($prsn_telp!=null) {
                        $WaSend = WaSendController::sendDftr($prsn_kd, $Password, $tujuan);
                    }
                    $data['response'] = [
                        'status' => 200,
                        'response' => "success",
                        'type' => "success",
                        'message' => "Data Personal Berhasil Disimpan",
                        'id' => $Prsn->prsn_id
                    ];
                }else{
                    $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Dapat Disimpan'];
                }
            }
        }

        
        return response()->json($data, $data['response']['status']);
    }

    public function insertDataReg(Request $request)
    {
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
        $rules = [
            'prsn_nm' => 'required|alpha_spaces',
            'prsn_tmptlhr' => 'required',
            'prsn_tgllhr' => 'required',
            'prsn_jk' => 'required',
            'prsn_alt' => 'required',
            'prsn_desa' => 'required',
            'prsn_wa' => 'required',
            'prsn_krj' => 'required',
            'prsn_consent' => 'required',
            'prsn_telp' => 'nullable|max:14|alpha_num|unique:prsn,prsn_telp',
            'captcha1' => 'required|captcha'
        ];
        $attributes = [
            'prsn_nm' => 'Nama Lengkap',
            'prsn_tmptlhr' => 'Tempat Lahir',
            'prsn_tgllhr' => 'Tanggal Lahir',
            'prsn_jk' => 'Jenis Kelamin',
            'prsn_alt' => 'Alamat',
            'prsn_desa' => 'Nama Desa',
            'prsn_telp' => 'Nomor Telepon',
            'prsn_krj' => 'Pekerjaan',
            'prsn_consent' => 'Silahkan centang setujui dengan membaca form persetujuan yang telah disediakan',
            'captcha1' => 'Captha'
        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            $PrsnModel = new PrsnModel();
            $prsn_gol = null;
            if($request->prsn_gol!=''){
                $prsn_gol = $request->prsn_gol;
            }

            $prsn_telp = null;
            if($request->prsn_telp!=''){
                $prsn_telp = $request->prsn_telp;
            }

            $prsn_wa = "0";
            if($request->prsn_wa!='1'){
                if($request->prsn_telp!=''){
                    $prsn_wa = $request->prsn_wa;
                }
            }
            $PrsmSama = PrsnController::checkPrsn(addslashes($request->prsn_nm), $request->prsn_tgllhr);
            if (count($PrsmSama)>0) {
                return back()->with(['registerError'=> 'Data Personal Sudah Ada, Silahkan Hubungi Pihak UTD Untuk Melihat Data Anda']);
            }
            $prsn_kd = PrsnController::getKode($request->prsn_tgllhr, $request->prsn_kec);
            // $prsn_bc = PrsnController::generateBarcode($prsn_kd);
            $PrsnModel->prsn_kd = $prsn_kd;
            $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
            $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
            $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
            $PrsnModel->prsn_gol = $prsn_gol;
            $PrsnModel->prsn_jk = $request->prsn_jk;
            $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
            $PrsnModel->prsn_desa = $request->prsn_desa;
            $PrsnModel->prsn_wa = $prsn_wa;
            $PrsnModel->prsn_krj = $request->prsn_krj;
            $PrsnModel->prsn_telp = $prsn_telp;
            // $PrsnModel->prsn_bc = $prsn_bc;
            
            
            $save = $PrsnModel->save();
            if ($save) {
                $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
                $deleteUsers = UsersModel::where('username', $prsn_kd)->delete([]);
                
                $Password = AIModel::getRandStrStat();
                $token = PrsnController::token($Prsn->prsn_id, $Password, $prsn_kd);
                $Users = UsersController::insertDataU(addslashes($request->prsn_nm), $Prsn->prsn_id, $prsn_kd, $Password);

                $tujuan = "";
                $lengthTujuan = strlen($request->prsn_telp);
                if (substr($request->prsn_telp, 0, 2)=="08") {
                    $tujuan = "62".substr($request->prsn_telp, 0, $lengthTujuan);
                }elseif (substr($request->prsn_telp, 0, 2)=="62") {
                    $tujuan = $request->prsn_telp;
                }

                if ($prsn_telp!=null) {
                    $WaSend = WaSendController::sendDftr($prsn_kd, $Password, $tujuan);
                }

                return redirect()->to(url('register/success/'.$token));
            }else{
                return back()->with(['registerError'=> 'Data Personal Tidak Dapat Disimpan']);
            }
        }

    }

    public function testSearchPrsn(Request $request)
    {
        dd($request->get('nama'), $request->get('tgl'), $request->get('jk'), PrsnController::checkPrsn($request->get('nama'), $request->get('tgl'), $request->get('jk')));
    }

    public function testSearchPrsnByTgl(Request $request)
    {
        $Prsn = DB::table('prsn')->where('prsn_tgllhr', $request->get('tgl'))->orderBy('prsn_ord', 'asc')
        ->get();
        dd($Prsn);
    }

    public function testSearchPrsnByLastKd(Request $request)
    {
        $Prsn = DB::table('prsn')->where('prsn_kd', 'like', '%'.$request->get('kd'))->orderBy('prsn_ord', 'asc')
        ->get();
        dd($Prsn);
    }

    public function testSearchPrsnBySameDate()
    {
        $Prsn = DB::table('prsn')
        ->select('prsn_tgllhr', DB::raw('count(*) as total'))
        ->groupBy('prsn_tgllhr')->orderBy('total', 'desc')
        ->get();
        dd($Prsn);
    }

    static function checkPrsn($nama, $tgl_lhr)
    {
        return DB::table('prsn')
        ->where(function($query) use ($nama){
            $query->where('prsn_nm', 'like', '%'.$nama.'%');
            $namaBaru = explode(" ", $nama);
            if (count($namaBaru)>1) {
                for ($i=1; $i < count($namaBaru); $i++) { 
                    $query->orWhere('prsn_nm', 'like', '%'.$namaBaru[$i].'%');
                }
            }
        })
        ->where('prsn_tgllhr', $tgl_lhr)->orderBy('prsn_nm', 'asc')
        ->limit(20)
        ->get();
    }

    static function token($id, $pass = '', $kd = '')
    {
        $expired_time = time() + (1440 * 30); // 1 hari token
        $payload = [
            'id' => $id,
            'exp' => $expired_time
        ];
        if ($pass!=''&&$kd!='') {
            $payload = [
                'id' => $id,
                'pass' => $pass,
                'kd' => $kd,
                'exp' => $expired_time
            ];
        }
        
        return JWT::encode($payload, env('ACCESS_TOKEN_SECRET'), 'HS256');
    }

    static function getKode($prsn_tgllhr, $kec)
    {
        $Kode = null;
        $KdSeg = '01';
        $prsn_kd = 0;
        $Seg = SegModel::leftJoin('segkec', 'seg.seg_id', '=', 'segkec.segkec_seg')->where('segkec_kec', $kec)->select(['seg_kd'])->get()->first();
        if ($Seg!=null) {
            $KdSeg = $Seg['seg_kd'];
        }

        $Kode = $KdSeg.(string)date("dmy", strtotime($prsn_tgllhr));

        $Prsn = PrsnModel::where('prsn_kd', 'LIKE',  $Kode .'%')->select(['prsn_id', 'prsn_kd'])->orderBy('prsn_ord', 'desc')->get()->first();
        if ($Prsn==null) {
            $Kode = $Kode."001";
        }else{
            $prsn_kd = (int)substr($Prsn['prsn_kd'], 8, 10)+1;
            for ($i=0; $i < 4 - strlen((string)$prsn_kd); $i++) { 
                $prsn_kd = "0".(string)$prsn_kd;
            }

            $Kode = $Kode.$prsn_kd;
        }

        return $Kode;
    }

    public function changeKode()
    {
        $success = 0;
        $error = 0;
        $this->data['Prsn'] = PrsnModel::leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->select(['prsn_id', 'prsn_nm', 'prsn_kd', 'prsn_tgllhr', 'kec.id as kec_id', 'desa.id as desa_id'])->orderBy('prsn_ord', 'desc')->get();

        for ($i=0; $i < count($this->data['Prsn']); $i++) { 
            if ($this->data['Prsn'][$i]['prsn_kd']!="") {
                continue;
            }

            $prsn_kd = PrsnController::getKode($this->data['Prsn'][$i]['prsn_tgllhr'], $this->data['Prsn'][$i]['kec_id']);
            $prsn_bc = PrsnController::generateBarcode($prsn_kd);
            try {

                $update = DB::table('prsn')->where('prsn_id', $this->data['Prsn'][$i]['prsn_id'])->update([
                    'prsn_kd' => $prsn_kd,
                ]);
                $success +=1;
            } catch (\Exception $e) {
                $error +=1;
            }
        }

        dd($success, $error);
    }

    static function insertDataDnr($request, $Pgn)
    {
        $PrsnModel = new PrsnModel();

        $Prsn = PrsnModel::where('prsn_nik', $request->prsn_nik)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
        if (count($Prsn)>0) {
            return [false, 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = PrsnModel::where('prsn_telp', $request->prsn_telp)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
            if (count($Prsn)>0) {
                return [false, 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                $prsn_kd = PrsnController::getKode($request->prsn_tgllhr, $request->prsn_kec);
                // $prsn_bc = PrsnController::generateBarcodePri($prsn_kd);
                $PrsnModel->prsn_kd = $prsn_kd;
                $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
                $PrsnModel->prsn_nik = $request->prsn_nik;
                $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
                $PrsnModel->prsn_gol = $request->prsn_gol;
                $PrsnModel->prsn_jk = $request->prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
                $PrsnModel->prsn_desa = $request->prsn_desa;
                $PrsnModel->prsn_wa = '0';
                $PrsnModel->prsn_krj = $request->prsn_krj;
                // $PrsnModel->prsn_bc = $prsn_bc;
                $PrsnModel->prsn_ucreate = $Pgn->users_id;
                $PrsnModel->prsn_uupdate = $Pgn->users_id;
                
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
                    $Password = AIModel::getRandStrStat();
                    $deleteUsers = UsersModel::where('username', $prsn_kd)->delete([]);
                    $Users = UsersController::insertDataU(addslashes($request->prsn_nm), $Prsn->prsn_id, $prsn_kd, $Password);
                    return [true, $Prsn->prsn_id];
                }else{
                    return [false, 'Data Personal Tidak Dapat Disimpan'];
                }
            }
        }
    }

    static function updateDataDnr($request, $Pgn)
    {
        $prsn_id = $request->prsn_id;
        
        $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_nik', $request->prsn_nik)->select()->get()->toArray();
        if ($Prsn!=null) {
            return [false, 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if ($Prsn!=null) {
                return [false, 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                try {
                    $update = DB::table('prsn')->where('prsn_id', $prsn_id)->update([
                        'prsn_nm' => addslashes($request->prsn_nm),
                        'prsn_nik' => $request->prsn_nik,
                        'prsn_tmptlhr' => addslashes($request->prsn_tmptlhr),
                        'prsn_tgllhr' => $request->prsn_tgllhr,
                        'prsn_gol' => $request->prsn_gol,
                        'prsn_jk' => $request->prsn_jk,
                        'prsn_alt' => addslashes($request->prsn_alt),
                        'prsn_desa' => $request->prsn_desa,
                        'prsn_krj' => $request->prsn_krj,
                        'prsn_uupdate' => $Pgn->users_id
                    ]);
                    return [true];
                } catch (\Exception $e) {
                    return [false, 'Data Personal Tidak Dapat Diubah, Pesan '.$e->getMessage()];
                }
            }
        }
    }

    static function insertDataKtk($request, $Pgn)
    {
        $PrsnModel = new PrsnModel();

        $Prsn = PrsnModel::where('prsn_nik', $request->prsn_nik)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
        if (count($Prsn)>0) {
            return [false, 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = PrsnModel::where('prsn_telp', $request->prsn_telp)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
            if (count($Prsn)>0) {
                return [false, 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                $prsn_kd = PrsnController::getKode($request->prsn_tgllhr, $request->prsn_kec);
                // $prsn_bc = PrsnController::generateBarcodePri($prsn_kd);
                $PrsnModel->prsn_kd = $prsn_kd;
                $PrsnModel->prsn_nm = addslashes($request->ktk_prsn_nm);
                $PrsnModel->prsn_nik = $request->ktk_prsn_nik;
                $PrsnModel->prsn_tmptlhr = addslashes($request->ktk_prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->ktk_prsn_tgllhr;
                $PrsnModel->prsn_jk = $request->ktk_prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->ktk_prsn_alt);
                $PrsnModel->prsn_desa = $request->ktk_prsn_desa;
                $PrsnModel->prsn_telp = $request->ktk_prsn_telp;
                $PrsnModel->prsn_wa = $request->ktk_prsn_wa;
                $PrsnModel->prsn_krj = $request->ktk_prsn_krj;
                // $PrsnModel->prsn_bc = $prsn_bc;
                $PrsnModel->prsn_ucreate = $Pgn->users_id;
                $PrsnModel->prsn_uupdate = $Pgn->users_id;
                
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
                    $Password = AIModel::getRandStrStat();
                    $deleteUsers = UsersModel::where('username', $prsn_kd)->delete([]);
                    $Users = UsersController::insertDataU(addslashes($request->prsn_nm), $Prsn->prsn_id, $prsn_kd, $Password);
                    return [true, $Prsn->prsn_id];
                }else{
                    return [false, 'Data Personal Tidak Dapat Disimpan'];
                }
            }
        }
    }

    static function updateDataKtk($request, $Pgn)
    {
        $prsn_id = $request->prsn_id;
        
        $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_nik', $request->prsn_nik)->select()->get()->toArray();
        if ($Prsn!=null) {
            return [false, 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if ($Prsn!=null) {
                return [false, 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                try {
                    $update = DB::table('prsn')->where('prsn_id', $prsn_id)->update([
                        'prsn_nm' => addslashes($request->ktk_prsn_nm),
                        'prsn_nik' => $request->ktk_prsn_nik,
                        'prsn_tmptlhr' => addslashes($request->ktk_prsn_tmptlhr),
                        'prsn_tgllhr' => $request->ktk_prsn_tgllhr,
                        'prsn_jk' => $request->ktk_prsn_jk,
                        'prsn_alt' => addslashes($request->ktk_prsn_alt),
                        'prsn_desa' => $request->ktk_prsn_desa,
                        'prsn_telp' => $request->ktk_prsn_telp,
                        'prsn_wa' => $request->ktk_prsn_wa,
                        'prsn_krj' => $request->ktk_prsn_krj,
                        'prsn_uupdate' => $Pgn->users_id
                    ]);
                    return [true];
                } catch (\Exception $e) {
                    return [false, 'Data Personal Tidak Dapat Diubah, Pesan '.$e->getMessage()];
                }
            }
        }
    }

    public function updateData(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $PrsnModel = new PrsnModel();

        $this->data['Pgn'] = $this->getUser();

        $prsn_id = $request->prsn_id;

        $PrsnTelp = false;
        
        if ($request->prsn_telp=="") {
            $PrsnTelp = true;
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if($Prsn==null){
                $PrsnTelp = true;
            }
        }

        if ($PrsnTelp!=true) {
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
        }else{
            try {
                $update = DB::table('prsn')->where('prsn_id', $prsn_id)->update([
                    'prsn_nm' => addslashes($request->prsn_nm),
                    'prsn_nik' => $request->prsn_nik,
                    'prsn_tmptlhr' => addslashes($request->prsn_tmptlhr),
                    'prsn_tgllhr' => $request->prsn_tgllhr,
                    'prsn_gol' => $request->prsn_gol,
                    'prsn_jk' => $request->prsn_jk,
                    'prsn_alt' => addslashes($request->prsn_alt),
                    'prsn_desa' => $request->prsn_desa,
                    'prsn_wa' => $request->prsn_wa,
                    'prsn_telp' => $request->prsn_telp,
                    'prsn_krj' => $request->prsn_krj,
                    'prsn_uupdate' => $this->data['Pgn']->users_id
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Personal Berhasil Diubah"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Dapat Diubah, Pesan '.$e->getMessage()];
            }
        }

        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($prsn_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $PrsnModel = new PrsnModel();
        $UsersModel = new UsersModel();

        $delete = $PrsnModel::where('prsn_id', $prsn_id)->delete([]);
        $deleteUsers = $UsersModel::where('users_prsn', $prsn_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Personal Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Dapat Dihapus'];
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
        }
        return $data;
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    static function generateBarcode($kd = '')
    {
        $redColor = [0,0,0];
        $generator = new BarcodeGeneratorPNG();
        $bc = 'bc-'.$kd.'-'.date("YmdHis").'.png';
        
        file_put_contents('./bc/'.$bc, $generator->getBarcode((string)$kd, $generator::TYPE_CODE_128, 3, 50, $redColor));

        return $bc;
    }

    static function generateBarcodePri($kd = '')
    {
        $redColor = [0,0,0];
        $generator = new BarcodeGeneratorPNG();
        $bc = 'bc-'.$kd.'-'.date("YmdHis").'.png';
        
        file_put_contents('../bc/'.$bc, $generator->getBarcode((string)$kd, $generator::TYPE_CODE_128, 3, 50, $redColor));

        return $bc;
    }

    public function cetakKrtAdm($id)
    {
        $token = PrsnController::token($id);
        return redirect()->to('https://satudarahparigimoutong.com/printCard/'.$token);
    }

    public function verificationData($prsn_id)
    {
        // header('Content-Type: application/json; charset=utf-8');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: *");
        $PrsnModel = new PrsnModel();

        $Prsn = PrsnModel::where('prsn_id', $prsn_id)->select(['prsn_kd'])->orderBy('prsn_ord', 'desc')->get()->first();
        if ($Prsn==null) {
            $data['response'] = ['status' => 404, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Ditemukan'];
        }else{
            $prsn_bc = PrsnController::generateBarcodePri($Prsn->prsn_kd);
            // $PrsnModel->prsn_bc = $prsn_bc;
            try {

                $update = DB::table('prsn')->where('prsn_id', $prsn_id)->update([
                    'prsn_bc' => $prsn_bc
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Personal Berhasil Diverifikasi"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 404, 'response' => 'error','type' => "danger", 'message' => 'Personal Tidak Dapat Diverifikasi'];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function resetUserAndSendWa($prsn_id)
    {
        $Prsn = PrsnModel::where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_telp', 'prsn_kd'])->orderBy('prsn_ord', 'desc')->get()->first();
        if ($Prsn==null) {
            $data['response'] = ['status' => 404, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Tidak Ditemukan'];
        }else{
            $deleteUsers = UsersModel::where('username', $Prsn->prsn_kd)->delete([]);
            $Password = AIModel::getRandStrStat();
            $Users = UsersController::insertDataU(addslashes($Prsn->prsn_nm), $Prsn->prsn_id, $Prsn->prsn_kd, $Password);

            $tujuan = "";
            $lengthTujuan = strlen($Prsn->prsn_telp);
            if (substr($Prsn->prsn_telp, 0, 2)=="08") {
                $tujuan = "62".substr($Prsn->prsn_telp, 0, $lengthTujuan);
            }elseif (substr($Prsn->prsn_telp, 0, 2)=="62") {
                $tujuan = $Prsn->prsn_telp;
            }
            $WaSend = WaSendController::sendDftr($Prsn->prsn_kd, $Password, $tujuan);
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Pesan Konfirmasi Pengguna Personal Telah Dikirimkan"
            ];
        }
        return response()->json($data, $data['response']['status']);
    }
}
