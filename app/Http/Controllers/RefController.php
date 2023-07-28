<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mORef',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'TINGKAT DAERAH',
            'PageTitle' => 'Tingkat Daerah',
            'BasePage' => 'ref',
        ];
    }

    public function index()
    {
        $this->data['Pgn'] = $this->getUser();
        
        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'refAddData';
        $this->data['UrlForm'] = 'ref';
 
        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        return view('ref.index', $this->data);
    }
}
