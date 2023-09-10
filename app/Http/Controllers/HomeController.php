<?php

namespace App\Http\Controllers;

use App\Models\DnrModel;
use App\Models\OrgModel;
use App\Models\PrsnModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $data;

    public function __construct()
    {

        $this->data = [
            'mOp' => 'mOHome',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'BERANDA',
            'PageTitle' => 'Beranda',
            'BasePage' => '/',
        ];
    }

    public function index()
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        
        if ($this->data['Pgn']==null) {
            $this->data['mobile'] = $this->isMobile();

            $this->data['countPrsn'] = PrsnModel::count();
            $this->data['countPrsn'] = PrsnModel::count();
            $this->data['countPrsnJkL'] = PrsnModel::where('prsn_jk', 'L')->count();
            $this->data['countPrsnJkP'] = PrsnModel::where('prsn_jk', 'P')->count();
            
            $this->data['countPrsnGol'] = DB::table('prsn')->join('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')
            ->select('gol_grup', DB::raw('count(*) as total'))
            ->groupBy('gol_grup')->orderBy('gol_grup', 'desc')
            ->get();

            return view('home.indexReg', $this->data);
        }

        if ($this->data['Pgn']->users_tipe=="U") {
            $this->data['IdForm'] = 'home';
            $this->data['UrlForm'] = '/';
            $this->data['mobile'] = $this->isMobile();

            $this->data['Prsn'] = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $this->data['Pgn']->users_prsn)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();

            $this->data['Prsn']->total = DnrmController::countDnrPrsn($this->data['Pgn']->users_prsn);
            $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);
            $this->data['Dnrm'] = DnrmController::loadPrsn($this->data['Pgn']->users_prsn);
            $this->data['token'] = PrsnController::token($this->data['Pgn']->users_prsn);

            return view('home.indexU', $this->data);
        }
        $this->data['IdForm'] = 'home';
        $this->data['UrlForm'] = '/';
        
        $this->data['countPrsn'] = PrsnModel::count();
        $this->data['countDnrPrsn'] = DnrModel::where('dnr_kat', 'P')->count();
        $this->data['countDnrKeg'] = DnrModel::where('dnr_kat', 'K')->count();
        $this->data['countUTD'] = OrgModel::where('org_utd', '1')->count();

        $this->data['countUsers'] = 0;
        $this->data['Dnrp'] = [];
        $this->data['Dnrk'] = [];
        if ($this->data['Pgn']->users_tipe=="UTD") {
            $this->data['countUsers'] = UsersModel::where('users_org', $this->data['Pgn']->users_org)->count();

            // $this->data['Dnrp'] = DnrModel::join('dnrlok', 'dnr.dnr_id', '=', 'dnrlok.dnrlok_dnr')->leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('dnrktk', 'dnrktk.dnrktk_dnr', '=', 'dnr.dnr_id')->where('dnrlok_org', $this->data['Pgn']->users_org)->where('dnr_kat', 'P')->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'prsn_nik', 'gol_nm', 'dnr_tmbh', 'dnr_send', 'dnrprsn_prsn', 'dnrktk_prsn', 'dnr_org', 'prsn_tgllhr', 'dnrlok_utm', 'prsn_kd'])->orderBy('dnr_ord', 'desc')->limit(5)->get();

            $this->data['Dnrp'] = DnrModel::leftJoin('org', 'dnr.dnr_org', '=', 'org.org_id')->leftJoin('dnrprsn', 'dnrprsn.dnrprsn_dnr', '=', 'dnr.dnr_id')->leftJoin('prsn', 'dnrprsn.dnrprsn_prsn', '=', 'prsn.prsn_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('ktk', 'dnr.dnr_ktk', '=', 'ktk.ktk_id')->where('dnr_lok', $this->data['Pgn']->users_org)->where('dnr_kat', 'P')->select(['dnr_id', 'org_nm', 'dnr_bth', 'dnr_tgl', 'dnr_sft', 'dnr_ktk', 'prsn_nm', 'gol_nm', 'dnr_send', 'dnrprsn_prsn', 'dnr_org', 'prsn_tgllhr', 'prsn_kd', 'ktk_nm', 'dnr_nm', 'dnr_telp'])->orderBy('dnr_ord', 'desc')->limit(5)->get();
            $this->data['Dnrp'] = DnrController::setData($this->data['Dnrp']);

            $this->data['Dnrk'] = DnrModel::join('dnrlok', 'dnr.dnr_id', '=', 'dnrlok.dnrlok_dnr')->leftJoin('desa', 'dnr.dnr_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('dnrlok_org', $this->data['Pgn']->users_org)->where('dnr_kat', 'K')->select(['dnr_id', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'desa.id as desa_id', 'kec.id as kec_id', 'dnr_bth', 'dnr_tgl', 'dnr_keg', 'dnr_nm', 'dnr_telp', 'dnr_tmpt', 'dnr_send', 'dnrlok_utm'])->orderBy('dnr_ord', 'desc')->limit(5)->get();
            $this->data['Dnrk'] = DnrController::setData($this->data['Dnrk']);
        }
        $this->data['countPrsnJkL'] = PrsnModel::where('prsn_jk', 'L')->count();
        $this->data['countPrsnJkP'] = PrsnModel::where('prsn_jk', 'P')->count();
        
        $this->data['countPrsnGol'] = DB::table('prsn')->join('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')
        ->select('gol_grup', DB::raw('count(*) as total'))
        ->groupBy('gol_grup')->orderBy('gol_grup', 'desc')
        ->get();
        // dd($this->data);
        return view('home.index', $this->data);
    }
}
