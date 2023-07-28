<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use Illuminate\Http\Request;
use App\Models\DesaModel;

class DesaController extends Controller
{
    protected $data;
    
    public function __construct()
    {
        $this->data = [
            'mOp' => 'mODesa',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'DESA / KELURAHAN',
            'PageTitle' => 'Desa / Kelurahan',
            'BasePage' => 'desa',
        ];
    }

    public function getDataJson($desa_kec)
    {
        $this->data['Desa'] = DesaModel::where('desa_kec', $desa_kec)->select('id', 'nama', 'jenis')->get();
        $this->data['Desa'] = $this->setData($this->data['Desa']);

        $this->data['DesaN'] = [];
        for ($i=0; $i < count($this->data['Desa']); $i++) { 
            $this->data['DesaN'][$i]['optValue'] = '';
            $this->data['DesaN'][$i]['optValue'] = $this->data['Desa'][$i]['id'];

            $this->data['DesaN'][$i]['optText'] = '';
            $this->data['DesaN'][$i]['optText'] = $this->data['Desa'][$i]['namaAlt'];
        }
        return $this->data['DesaN'];
    }

    public function setData($data)
    {
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['jenisAlt'] = 'Desa';
            if ($data[$i]['jenis']=="K") {
                $data[$i]['jenisAlt'] = 'Kelurahan';
            }

            $data[$i]['namaAlt'] = ucwords(strtolower($data[$i]['nama']));
            $data[$i]['namaAltJns'] = $data[$i]['jenisAlt']." ".ucwords(strtolower($data[$i]['nama']));

            
        }
        return $data;
    }
}
