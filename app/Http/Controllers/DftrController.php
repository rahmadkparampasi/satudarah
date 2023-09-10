<?php

namespace App\Http\Controllers;

use App\Models\PrsnModel;
use App\Models\UsersModel;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DftrController extends Controller
{
    protected $data;
    protected $Da;
    protected $session;

    public function __construct(Request $request)
    {
        $this->data = [
            'WebTitle' => 'DAFTAR',
            'PageTitle' => 'Daftar',
            'BasePage' => 'dftr',
        ];
    }

    public function index(Request $request)
    {
        // if (Auth::user()) {
        //     return redirect()->intended();
        // }

        $this->data['mobile'] = $this->isMobile();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'dftrAddData';
        $this->data['UrlForm'] = 'dftr';

        $this->data['Gol'] = GolController::getDataActStatPublik();
        $this->data['Krj'] = KrjController::getDataActStat();
        $this->data['Kec'] = KecController::getData();

        $this->data['MethodForm1'] = substr($this->data['MethodForm'], 0, 10);

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        return view('dftr.index', $this->data);
    }

    public function success($token)
    {
        if (Auth::user()) {
            return redirect()->intended();
        }

        $this->data['tab'] = '';

        try {
            // Men-decode token. Dalam library ini juga sudah sekaligus memverfikasinya
            // Data game yang akan dikirim jika token valid
            $data = JWT::decode($token, new Key(env('ACCESS_TOKEN_SECRET'), 'HS256'));

            $PrsnModel = new PrsnModel();
            $Prsn = $PrsnModel::where('prsn_id', $data->id)->select('prsn_id', 'prsn_conf')->first();
            if ($Prsn!=null) {
                if ($Prsn->prsn_conf=="0") {
                    $PrsnModel::where('prsn_id', $data->id)->update([
                        'prsn_conf' => '1',
                    ]);
                    $this->data['ButtonMethod'] = 'SIMPAN';
                    $this->data['MethodForm'] = 'insertData';
                    $this->data['pass'] = $data->pass;
                    $this->data['kd'] = $data->kd;

                    return view('dftr.success', $this->data);
                }else{
                    return redirect()->intended();
                }
            }else{
                return redirect()->to(url('register'))->with(['registerError'=> 'Data Personal Tidak Ditemukan']);
            }
        } catch (Exception $e) {
            $this->data['msg'] = $e->getMessage();
            return redirect()->to(url('register'))->with(['registerError'=> $e->getMessage()]);

        }
    }
}
