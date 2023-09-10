<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use Illuminate\Http\Request;
use App\Models\KecModel;
use Illuminate\Support\Facades\DB;

class KecController extends Controller
{
    protected $data;
    
    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOKec',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'KECAMATAN',
            'PageTitle' => 'Kecamatan',
            'BasePage' => 'kec',
        ];
    }

    public function getDataJson()
    {
        $this->data['Kec'] = KecModel::select('id', 'nama')->orderBy('nama', 'asc')->get();
        $this->data['Kec'] = $this->setData($this->data['Kec']);

        $this->data['KecN'] = [];
        for ($i=0; $i < count($this->data['Kec']); $i++) { 
            $this->data['KecN'][$i]['optValue'] = '';
            $this->data['KecN'][$i]['optValue'] = $this->data['Kec'][$i]['id'];

            $this->data['KecN'][$i]['optText'] = '';
            $this->data['KecN'][$i]['optText'] = $this->data['Kec'][$i]['namaAlt'];
        }
        return $this->data['KecN'];
    }

    public function getDataJsonExcSeg()
    {
        $this->data['Kec'] = DB::table("kec")->select('*')->whereNotIn('id',function($query) {
            $query->select('segkec_kec')->from('segkec');
        })->get();

        // $this->data['Kec'] = $this->setData($this->data['Kec']);
        for ($i=0; $i < count($this->data['Kec']); $i++) { 
            $this->data['Kec'][$i]->namaAlt = ucwords(strtolower($this->data['Kec'][$i]->nama));
            $this->data['Kec'][$i]->namaAltJns = "Kecamatan ".ucwords(strtolower($this->data['Kec'][$i]->nama));
        }

        $this->data['KecN'] = [];
        for ($i=0; $i < count($this->data['Kec']); $i++) { 
            $this->data['KecN'][$i]['optValue'] = '';
            $this->data['KecN'][$i]['optValue'] = $this->data['Kec'][$i]->id;

            $this->data['KecN'][$i]['optText'] = '';
            $this->data['KecN'][$i]['optText'] = $this->data['Kec'][$i]->namaAlt;
        }

        return $this->data['KecN'];
    }

    static function getData()
    {
        $Kec = KecModel::select('id', 'nama')->orderBy('nama', 'asc')->get();
        $Kec = KecController::setDataSt($Kec);

        return $Kec;
    }

    static function getDataByKab($kec_kab) {
        $Kec = KecModel::where('kec_kab', $kec_kab)->select('id', 'nama')->orderBy('nama', 'asc')->get();
        $Kec = KecController::setDataSt($Kec);

        return $Kec;
    }

    static function setDataSt($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['namaAlt'] = ucwords(strtolower($data[$i]['nama']));
            $data[$i]['namaAltJns'] = "Kecamatan ".ucwords(strtolower($data[$i]['nama']));
        }
        return $data;
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['namaAlt'] = ucwords(strtolower($data[$i]['nama']));
            $data[$i]['namaAltJns'] = "Kecamatan ".ucwords(strtolower($data[$i]['nama']));
        }
        return $data;
    }
}
