<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\DesaModel;
use App\Models\GolModel;
use App\Models\KecModel;
use App\Models\PrsnModel;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

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
        $this->data['Pgn'] = $this->getUser();
        // if ($this->data['Pgn']->users_tipe!="ADM") {
        //     return redirect()->intended();
        // }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['klp_id'] = '';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        $this->data['Prsn'] = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(100)->get();
        $this->data['Prsn'] = PrsnController::setData($this->data['Prsn']);

        $this->data['Gol'] = GolController::getDataActStat();
        $this->data['Kec'] = KecController::getData();

        return view('prsn.index', $this->data);
    }

    public function load($search_key = '', $search_val = '')
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'prsnAddData';
        $this->data['UrlForm'] = 'prsn';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        if($search_key!=''&&$search_val!=''){
            $this->data['search'] = "";
            $this->data['search_key'] = $search_key;
            $this->data['search_val'] = $search_val;
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            if ($search_key=="Nama") {
                $Prsn = $Prsn->where('prsn_nm', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="NIK") {
                $Prsn = $Prsn->where('prsn_nik', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="Telp") {
                $Prsn = $Prsn->where('prsn_telp', 'LIKE', '%'. $search_val .'%');
            }
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(100)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.data', $this->data);
    }

    static function loadPrsn($prsn_id)
    {
        return PrsnController::setData(PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $prsn_id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->get()->first());
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

        $search_key = $request->search_key;
        $search_val = $request->search_val;

        $this->data['search_key'] = $search_key;
        $this->data['search_val'] = $search_val;

        if ($search_val=="") {
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(100)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            if ($search_key=="Nama") {
                $Prsn = $Prsn->where('prsn_nm', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="NIK") {
                $Prsn = $Prsn->where('prsn_nik', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="Telp") {
                $Prsn = $Prsn->where('prsn_telp', 'LIKE', '%'. $search_val .'%');
            }
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
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

        $search_key = $request->search_key;
        $search_val = $request->search_val;
        $search_for = $request->search_for;

        $this->data['search_key'] = $search_key;
        $this->data['search_val'] = $search_val;
        $this->data['search_for'] = $search_for;

        if ($search_val=="") {
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(100)->get();
        }else{
            $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
            if ($search_key=="Nama") {
                $Prsn = $Prsn->where('prsn_nm', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="NIK") {
                $Prsn = $Prsn->where('prsn_nik', 'LIKE', '%'. $search_val .'%');
            }elseif ($search_key=="Telp") {
                $Prsn = $Prsn->where('prsn_telp', 'LIKE', '%'. $search_val .'%');
            }
    
            $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->limit(20)->get();
        }

        $this->data['Prsn'] = PrsnController::setData($Prsn);

        return view('prsn.searchDataDnr', $this->data);    
    }

    public function searchDataJson(Request $request){
        
        $search_key = $request->search_key;
        $search_val = $request->search_val;

        $this->data['search_val'] = $search_val;

        $Prsn = PrsnModel::leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id');
    
        if ($search_key=="Nama") {
            $Prsn = $Prsn->where('prsn_nm', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="NIK") {
            $Prsn = $Prsn->where('prsn_nik', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="Telp") {
            $Prsn = $Prsn->where('prsn_telp', 'LIKE', '%'. $search_val .'%');
        }elseif ($search_key=="ID") {
            $Prsn = $Prsn->where('prsn_id', $search_val);
        }

        $Prsn = $Prsn->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis'])->orderBy('prsn_ord', 'desc')->get()->first();

        if ($Prsn==null) {
            $data['response'] = ['status' => 404, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Belum Ada'];
            return response()->json($data, 404);
        }

        return response()->json($Prsn, 200);
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
            $Desa = DesaModel::where('id', $prsn_desa)->select(['id'])->orderBy('ord', 'asc')->get()->first();
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
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");         

        $this->data['Pgn'] = $this->getUser();

        $PrsnModel = new PrsnModel();

        $Prsn = PrsnModel::where('prsn_nik', $request->prsn_nik)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
        if (count($Prsn)>0) {
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = PrsnModel::where('prsn_telp', $request->prsn_telp)->select(['prsn_id'])->orderBy('prsn_ord', 'desc')->get();
            if (count($Prsn)>0) {
                $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan Nomor Telepon Sudah Ada'];
            }else{
                $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
                $PrsnModel->prsn_nik = $request->prsn_nik;
                $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
                $PrsnModel->prsn_gol = $request->prsn_gol;
                $PrsnModel->prsn_jk = $request->prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
                $PrsnModel->prsn_desa = $request->prsn_desa;
                $PrsnModel->prsn_wa = $request->prsn_wa;
                $PrsnModel->prsn_telp = $request->prsn_telp;
                
                $PrsnModel->prsn_ucreate = $this->data['Pgn']->users_id;
                $PrsnModel->prsn_uupdate = $this->data['Pgn']->users_id;
                
                $save = $PrsnModel->save();
                if ($save) {
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

    public function insertDataReg(Request $request)
    {
        $rules = [
            'prsn_nm' => 'required',
            'prsn_nik' => 'required|unique:prsn,prsn_nik',
            'prsn_tmptlhr' => 'required',
            'prsn_tgllhr' => 'required',
            'prsn_jk' => 'required',
            'prsn_alt' => 'required',
            'prsn_desa' => 'required',
            'prsn_wa' => 'required',
            'prsn_consent' => 'required',
            'prsn_telp' => 'required|max:14|alpha_num|unique:prsn,prsn_telp',
            'captcha1' => 'required|captcha'
        ];
        $attributes = [
            'prsn_nm' => 'Nama Lengkap',
            'prsn_nik' => 'NIK',
            'prsn_tmptlhr' => 'Tempat Lahir',
            'prsn_tgllhr' => 'Tanggal Lahir',
            'prsn_jk' => 'Jenis Kelamin',
            'prsn_alt' => 'Alamat',
            'prsn_desa' => 'Nama Desa',
            'prsn_telp' => 'Nomor Telepon',
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
            $prsn_wa = "0";
            if($request->prsn_wa!='1'){
                $prsn_wa = $request->prsn_wa;
            }
            $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
            $PrsnModel->prsn_nik = $request->prsn_nik;
            $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
            $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
            $PrsnModel->prsn_gol = $prsn_gol;
            $PrsnModel->prsn_jk = $request->prsn_jk;
            $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
            $PrsnModel->prsn_desa = $request->prsn_desa;
            $PrsnModel->prsn_wa = $prsn_wa;
            $PrsnModel->prsn_telp = $request->prsn_telp;
            
            
            $save = $PrsnModel->save();
            if ($save) {
                $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
    
                $token = PrsnController::token($Prsn->prsn_id);
                return redirect()->to(url('register/success/'.$token));
            }else{
                return back()->with(['registerError'=> 'Data Personal Tidak Dapat Disimpan']);
            }
        }

    }

    static function token($id)
    {
        $expired_time = time() + (1440 * 30); // 1 hari token
        $payload = [
            'id' => $id,
            'exp' => $expired_time
        ];
        
        return JWT::encode($payload, env('ACCESS_TOKEN_SECRET'), 'HS256');
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
                $PrsnModel->prsn_nm = addslashes($request->prsn_nm);
                $PrsnModel->prsn_nik = $request->prsn_nik;
                $PrsnModel->prsn_tmptlhr = addslashes($request->prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->prsn_tgllhr;
                $PrsnModel->prsn_gol = $request->prsn_gol;
                $PrsnModel->prsn_jk = $request->prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->prsn_alt);
                $PrsnModel->prsn_desa = $request->prsn_desa;
                $PrsnModel->prsn_wa = '0';
                
                $PrsnModel->prsn_ucreate = $Pgn->users_id;
                $PrsnModel->prsn_uupdate = $Pgn->users_id;
                
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
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
                $PrsnModel->prsn_nm = addslashes($request->ktk_prsn_nm);
                $PrsnModel->prsn_nik = $request->ktk_prsn_nik;
                $PrsnModel->prsn_tmptlhr = addslashes($request->ktk_prsn_tmptlhr);
                $PrsnModel->prsn_tgllhr = $request->ktk_prsn_tgllhr;
                $PrsnModel->prsn_jk = $request->ktk_prsn_jk;
                $PrsnModel->prsn_alt = addslashes($request->ktk_prsn_alt);
                $PrsnModel->prsn_desa = $request->ktk_prsn_desa;
                $PrsnModel->prsn_telp = $request->ktk_prsn_telp;
                $PrsnModel->prsn_wa = $request->ktk_prsn_wa;
                
                $PrsnModel->prsn_ucreate = $Pgn->users_id;
                $PrsnModel->prsn_uupdate = $Pgn->users_id;
                
                $save = $PrsnModel->save();
                if ($save) {
                    $Prsn = PrsnModel::where('prsn_ord', $PrsnModel->prsn_id)->select(['prsn_id'])->get()->first();
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

        
        $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_nik', $request->prsn_nik)->select()->get()->toArray();
        if ($Prsn!=null) {
            $data['response'] = ['status' => 409, 'response' => 'error','type' => "danger", 'message' => 'Data Personal Berdasarkan NIK Sudah Ada'];
        }else{
            $Prsn = DB::table('prsn')->whereNotIn('prsn_id', [$prsn_id])->where('prsn_telp', $request->prsn_telp)->select(['prsn_id', 'prsn_nm'])->get()->toArray();
            if ($Prsn!=null) {
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
        }

        return response()->json($data, $data['response']['status']);
    }

    public function deleteData($prsn_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $PrsnModel = new PrsnModel();

        $delete = $PrsnModel::where('prsn_id', $prsn_id)->delete([]);
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
}