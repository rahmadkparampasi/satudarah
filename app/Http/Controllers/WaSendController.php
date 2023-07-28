<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class WaSendController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOWasend',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'KIRIM WHATSAPP',
            'PageTitle' => 'Kirim Whatsapp',
            'BasePage' => 'WaSend',
        ];
    }

    static function sendTemp($nama, $tmptrwt, $tglrwt, $gol, $butuh, $kontak, $jnskontak, $tujuan){
        $component_header = [];
        $component_body = [
            [
                'type' => 'text',
                'text' => $nama,
            ],
            [
                'type' => 'text',
                'text' => $tmptrwt,
            ],
            [
                'type' => 'text',
                'text' => $tglrwt,
            ],
            [
                'type' => 'text',
                'text' => $gol,
            ],
            [
                'type' => 'text',
                'text' => $butuh,
            ],
            [
                'type' => 'text',
                'text' => $kontak.'('.$jnskontak.')',
            ],
        ];
        $component_buttons = [];

        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => '122464347518591',
            'access_token' => 'EAAIehKX29x4BANQPJZA4clihYW25zcIxUfzVz3UQLshbtA0tnWB6Oi0cpgOAJ04Lh1gwYAaiZBFu3ZAn37ZBNoGv2Hb2P0pQD6si3x0Pd0ZBRTV7cWtX7WnPLuWWEcZARXXhFBP128jUGZCqVzC2usUEDP5ZBMZChycTZBdhQ2CaZBhvqzDTTPNWX33Syt98NVV1H21sSjo5FYWXAZDZD',
        ]);
        

        $components = new Component($component_header, $component_body, $component_buttons);
        $whatsapp_cloud_api->sendTemplate($tujuan, 'broadcast_donor_urgent', 'id', $components);
    }
}
