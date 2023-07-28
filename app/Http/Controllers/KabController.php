<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use Illuminate\Http\Request;
use App\Models\KabModel;

class KabController extends Controller
{
    protected $data;
    
    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOKab',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'KABUPATEN / KOTA',
            'PageTitle' => 'Kabupaten / Kota',
            'BasePage' => 'kab',
        ];
    }

    public function getDataJson($kab_prov)
    {
        $this->data['Kab'] = KabModel::where('kab_prov', $kab_prov)->select('kab.id as kab_id_ex', 'kab.nama as kab_nm', 'kab.jenis as kab_jns')->get();
        $this->data['Kab'] = $this->setData($this->data['Kab']);

        $this->data['KabN'] = [];
        for ($i=0; $i < count($this->data['Kab']); $i++) { 
            $this->data['KabN'][$i]['optValue'] = '';
            $this->data['KabN'][$i]['optValue'] = $this->data['Kab'][$i]['kab_id_ex'];

            $this->data['KabN'][$i]['optText'] = '';
            $this->data['KabN'][$i]['optText'] = $this->data['Kab'][$i]['kab_nmAlt'];
        }
        return $this->data['KabN'];
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['kab_jnsAlt'] = 'Kabupaten';
            if ($data[$i]['kab_jns']=="KOTA") {
                $data[$i]['kab_jnsAlt'] = 'Kota';
            }elseif ($data[$i]['kab_jns']=="KOTAADM") {
                $data[$i]['kab_jnsAlt'] = 'Kota Administrasi';
            }

            $data[$i]['kab_nmAlt'] = ucwords(strtolower($data[$i]['kab_nm']));
            $data[$i]['kab_nmAltJns'] = $data[$i]['kab_jnsAlt']." ".ucwords(strtolower($data[$i]['kab_nm']));

            
        }
        return $data;
    }

}
