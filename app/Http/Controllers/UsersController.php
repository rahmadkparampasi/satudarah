<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class UsersController extends Controller
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

            'WebTitle' => 'PENGGUNA',
            'PageTitle' => 'Pengguna',
            'BasePage' => 'users',
        ];
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function insertData(Request $request)
    {
        $request->validate([
            'users_nm' => 'required',
            'users_wa' => 'required|unique:users,users_wa',
            'username' => 'required|min:6|max:20|alpha_num|unique:users,username',
            'password' => 'required|min:6|max:20',
            "password1" => "same:password",
            'captcha1' => 'required|captcha'
        ]);

        $options = [
            'cost' => 10,
        ];

        $UsersModel = new UsersModel();
        
        $UsersModel->users_nm = $request->users_nm;
        $UsersModel->username = $request->username;
        $UsersModel->password = $request->password;
        $UsersModel->users_wa = $request->users_wa;
        $UsersModel->users_tipe = 'U';
        $UsersModel->users_act = '1';
        $UsersModel->users_reg = '1';
        // $UsersModel->users_mailconf = '0';
        // $UsersModel->users_mailconf = '1';

        $password_baru = password_hash($UsersModel->password, PASSWORD_BCRYPT, $options);

        $UsersModel->password = $password_baru;
        $save = $UsersModel->save();
        if ($save) {
            $whatsapp_cloud_api = new WhatsAppCloudApi([
                'from_phone_number_id' => '122464347518591',
                'access_token' => 'EAAIehKX29x4BANQPJZA4clihYW25zcIxUfzVz3UQLshbtA0tnWB6Oi0cpgOAJ04Lh1gwYAaiZBFu3ZAn37ZBNoGv2Hb2P0pQD6si3x0Pd0ZBRTV7cWtX7WnPLuWWEcZARXXhFBP128jUGZCqVzC2usUEDP5ZBMZChycTZBdhQ2CaZBhvqzDTTPNWX33Syt98NVV1H21sSjo5FYWXAZDZD',
            ]);
            // $whatsapp_cloud_api->sendTemplate()
            $whatsapp_cloud_api->sendTextMessage('6282293526956', 'Hey there! I\'m using WhatsApp Cloud API. Visit https://www.netflie.es');
            $Pgn = $UsersModel::where('username', $request->username)->select('users_id')->first();
            
            return redirect()->to(url('register/success/'.$Pgn['users_id']));
            
        }else{
            return back()->with(['registerError'=> 'Data Pengguna Tidak Dapat Disimpan']);
        }
    }
}
