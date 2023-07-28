<?php

namespace App\Http\Controllers;

use App\Models\DnrModel;
use App\Models\PrsnModel;
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
        $this->data['Pgn'] = $this->getUser();
        if ($this->data['Pgn']==null) {
            $this->data['mobile'] = $this->isMobile();

            $this->data['countPrsn'] = PrsnModel::count();
            $this->data['countPrsnJkL'] = PrsnModel::where('prsn_jk', 'L')->count();
            $this->data['countPrsnJkP'] = PrsnModel::where('prsn_jk', 'P')->count();
            
            $this->data['countPrsnGol'] = DB::table('prsn')->join('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')
            ->select('gol_nm', DB::raw('count(*) as total'))
            ->groupBy('gol_nm')
            ->get();

            return view('home.indexReg', $this->data);
        }
        
        $this->data['countPrsn'] = PrsnModel::count();
        $this->data['countDnrPrsn'] = DnrModel::where('dnr_kat', 'P')->count();
        $this->data['countDnrKeg'] = DnrModel::where('dnr_kat', 'K')->count();
        $this->data['countPrsnJkL'] = PrsnModel::where('prsn_jk', 'L')->count();
        $this->data['countPrsnJkP'] = PrsnModel::where('prsn_jk', 'P')->count();
        
        $this->data['countPrsnGol'] = DB::table('prsn')->join('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')
        ->select('gol_nm', DB::raw('count(*) as total'))
        ->groupBy('gol_nm')
        ->get();
        // dd($this->data);
        return view('home.index', $this->data);
    }
}
