<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Template\Component;

class WaWHController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mOUsers',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'WEBHOOK',
            'PageTitle' => 'Webhook',
            'BasePage' => 'WaWH',
        ];
    }

    public function index()
    {

        $webhook = new WebHook();
        echo $webhook->verify($_GET, "25101994");
    }
}
