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

    public function sendWa(){
        $component_header = [];
        $component_body = [
            [
                'type' => 'text',
                'text' => 'Rahmad Kurniawan',
            ],
            [
                'type' => 'text',
                'text' => 'RSUD Anuntaloko',
            ],
            [
                'type' => 'text',
                'text' => '07 Agustus 2023',
            ],
            [
                'type' => 'text',
                'text' => 'O+',
            ],
            [
                'type' => 'text',
                'text' => '2 Kantung',
            ],
            [
                'type' => 'text',
                'text' => 'Rahmad Kurniawan(Diri Sendiri)',
            ],
        ];
        $component_buttons = [];

        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => '122464347518591',
            'access_token' => 'EAAIehKX29x4BO89s4ZBoNZAr7x4MdKStXDJ4Bmg6cuCPvdBFzPrOb83gqY4YWj64JUyiXFx2ZAFhWLV8W2xZA6nexNKsO7n0SIfxe4OwIGxU2t0YA5izbULM6Xf0sDDpaqlPuZBBSh0pRmHVT754Ei3z4aEhI3oMg5Qa9GXRir3RZCAedvmgZBfHdBBHhn0KZCXZAqapsZBtwDg4Xnsv0d',
        ]);
        

        $components = new Component($component_header, $component_body, $component_buttons);
        $whatsapp_cloud_api->sendTemplate('6281341118442', 'broadcast_donor_urgent', 'id', $components);
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

    static function sendDftr($kd, $pass, $tujuan)
    {
        $component_header = [];
        $component_body = [
            [
                'type' => 'text',
                'text' => $kd,
            ],
            [
                'type' => 'text',
                'text' => $pass,
            ],
        ];
        $component_buttons = [];

        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => '122464347518591',
            'access_token' => 'EAAIehKX29x4BO89s4ZBoNZAr7x4MdKStXDJ4Bmg6cuCPvdBFzPrOb83gqY4YWj64JUyiXFx2ZAFhWLV8W2xZA6nexNKsO7n0SIfxe4OwIGxU2t0YA5izbULM6Xf0sDDpaqlPuZBBSh0pRmHVT754Ei3z4aEhI3oMg5Qa9GXRir3RZCAedvmgZBfHdBBHhn0KZCXZAqapsZBtwDg4Xnsv0d',
        ]);
        

        $components = new Component($component_header, $component_body, $component_buttons);
        $whatsapp_cloud_api->sendTemplate($tujuan, 'terima_kasih_telah_baik', 'id', $components);
    }
}
