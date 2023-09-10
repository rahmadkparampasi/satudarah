<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function index()
    {
        $this->data['mobile'] = $this->isMobile();

        $this->data['Pgn'] = $this->getUser();
        // if ($this->data['Pgn']->users_tipe!="ADM") {
        //     return redirect()->intended();
        // }

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'usersAddData';
        $this->data['UrlForm'] = 'users';

        $this->data['klp_id'] = '';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);

        if ($this->data['Pgn']->users_tipe=="ADM") {
            $this->data['Users'] = UsersModel::leftJoin('org', 'users.users_org', '=', 'org.org_id')->select(['users_id', 'users_nm', 'username', 'users_org', 'org_nm', 'users_tipe', 'users_act'])->orderBy('users_ord', 'desc')->get();
        }elseif ($this->data['Pgn']->users_tipe=="UTD") {
            $this->data['Users'] = UsersModel::leftJoin('org', 'users.users_org', '=', 'org.org_id')->where('users_org', $this->data['Pgn']->users_org)->select(['users_id', 'users_nm', 'username', 'users_org', 'org_nm', 'users_tipe', 'users_act'])->orderBy('users_ord', 'desc')->get();
        }
        $this->data['Users'] = UsersController::setData($this->data['Users']);

        $this->data['Org'] = OrgController::getDataByUtd('1');

        return view('users.index', $this->data);
    }

    public function load()
    {
        $this->data['Pgn'] = $this->getUser();

        $this->data['ButtonMethod'] = 'SIMPAN';
        $this->data['MethodForm'] = 'insertData';
        $this->data['IdForm'] = 'usersAddData';
        $this->data['UrlForm'] = 'users';

        $this->data['DisplayForm'] = $this->setDisplay($this->data['MethodForm']);
        
        if ($this->data['Pgn']->users_tipe=="ADM") {
            $this->data['Users'] = UsersModel::leftJoin('org', 'users.users_org', '=', 'org.org_id')->select(['users_id', 'users_nm', 'username', 'users_org', 'org_nm', 'users_tipe', 'users_act'])->orderBy('users_ord', 'desc')->get();
        }elseif ($this->data['Pgn']->users_tipe=="UTD") {
            $this->data['Users'] = UsersModel::leftJoin('org', 'users.users_org', '=', 'org.org_id')->where('users_org', $this->data['Pgn']->users_org)->select(['users_id', 'users_nm', 'username', 'users_org', 'org_nm', 'users_tipe', 'users_act'])->orderBy('users_ord', 'desc')->get();
        }

        $this->data['Users'] = UsersController::setData($this->data['Users']);

        return view('users.data', $this->data);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function insertData(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'users_nm' => 'required',
            'username' => 'required|min:6|max:20|alpha_num|unique:users,username',
            'password' => 'required|min:6|max:20',
            "password1" => "same:password",
        ];
        $attributes = [
            'users_nm' => 'Nama Pengguna',
            'username' => 'Username',
            'password' => 'Password',
            'password1' => 'Ulangi Password',
        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);
        if ($validator->fails()) {
            $errorString = implode(",",$validator->messages()->all());
            $data['response'] = [
                'status' =>  Response::HTTP_BAD_REQUEST,
                'response' => "danger",
                'type' => "danger",
                'message' => $errorString
            ];
        }else{
            $options = [
                'cost' => 10,
            ];
    
            $UsersModel = new UsersModel();
            
            $UsersModel->users_nm = $request->users_nm;
            $UsersModel->username = $request->username;
            $UsersModel->password = $request->password;
    
            $UsersModel->users_tipe = 'ADM';
            $UsersModel->users_act = '1';
            $UsersModel->users_ucreate = $this->data['Pgn']->users_id;
            $UsersModel->users_uupdate = $this->data['Pgn']->users_id;
            $password_baru = password_hash($UsersModel->password, PASSWORD_BCRYPT, $options);
    
            $UsersModel->password = $password_baru;
            $save = $UsersModel->save();
            if ($save) {
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Pengguna Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Tidak Dapat Disimpan'];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateData(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'users_nm' => 'required',
            'username' => 'required|min:6|max:20|alpha_num|unique:users,username,'.$request->users_id.',users_id',
        ];
        $attributes = [
            'users_nm' => 'Nama Pengguna',
            'username' => 'Username',
        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);
        if ($validator->fails()) {
            $errorString = implode(",",$validator->messages()->all());
            $data['response'] = [
                'status' =>  Response::HTTP_BAD_REQUEST,
                'response' => "danger",
                'type' => "danger",
                'message' => $errorString
            ];
        }else{
            try {
                $update = DB::table('users')->where('users_id', $request->users_id)->update([
                    'users_nm' => addslashes($request->users_nm),
                    'username' => $request->username,
                    'users_uupdate' => $this->data['Pgn']->users_id
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Pengguna Berhasil Diubah"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Tidak Dapat Disimpan, '.$e->getMessage()];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function insertDataUTD(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'users_nm' => 'required',
            'users_org' => 'required',
            'username' => 'required|min:6|max:20|alpha_num|unique:users,username',
            'password' => 'required|min:6|max:20',
            "password1" => "same:password",
        ];
        $attributes = [
            'users_nm' => 'Nama Pengguna',
            'username' => 'Username',
            'password' => 'Password',
            'password1' => 'Ulangi Password',
            'users_org' => 'Organisasi / UTD',

        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);
        if ($validator->fails()) {
            $errorString = implode(",",$validator->messages()->all());
            $data['response'] = [
                'status' =>  Response::HTTP_BAD_REQUEST,
                'response' => "danger",
                'type' => "danger",
                'message' => $errorString
            ];
        }else{
            $options = [
                'cost' => 10,
            ];
    
            $UsersModel = new UsersModel();
            
            $UsersModel->users_nm = $request->users_nm;
            $UsersModel->users_org = $request->users_org;
            $UsersModel->username = $request->username;
            $UsersModel->password = $request->password;
    
            $UsersModel->users_tipe = 'UTD';
            $UsersModel->users_act = '1';
            $UsersModel->users_ucreate = $this->data['Pgn']->users_id;
            $UsersModel->users_uupdate = $this->data['Pgn']->users_id;
            $password_baru = password_hash($UsersModel->password, PASSWORD_BCRYPT, $options);
    
            $UsersModel->password = $password_baru;
            $save = $UsersModel->save();
            if ($save) {
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Pengguna Organisasi / UTD Berhasil Disimpan"
                ];
            }else{
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Organisasi / UTD Tidak Dapat Disimpan'];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateDataUTD(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'users_nm' => 'required',
            'users_org' => 'required',
            'username' => 'required|min:6|max:20|alpha_num|unique:users,username,'.$request->users_id.',users_id',
        ];
        $attributes = [
            'users_nm' => 'Nama Pengguna',
            'users_org' => 'Organisasi / UTD',
            'username' => 'Username',
        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);
        if ($validator->fails()) {
            $errorString = implode(",",$validator->messages()->all());
            $data['response'] = [
                'status' =>  Response::HTTP_BAD_REQUEST,
                'response' => "danger",
                'type' => "danger",
                'message' => $errorString
            ];
        }else{
            try {
                $update = DB::table('users')->where('users_id', $request->users_id)->update([
                    'users_nm' => addslashes($request->users_nm),
                    'users_org' => $request->users_org,
                    'username' => $request->username,
                    'users_uupdate' => $this->data['Pgn']->users_id
                ]);
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Pengguna Organisasi / UTD Berhasil Diubah"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Organisasi / UTD Tidak Dapat Disimpan, '.$e->getMessage()];
            }
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateDataPWD(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'password_new' => 'required|min:6|max:20',
            "password_new1" => "same:password_new",
            'password_old' => 'required',
        ];
        $attributes = [
            'password_old' => 'Password Lama',
            'password_new' => 'Password Baru',
            'password_new1' => 'Ulangi Password Baru',
        ];
        if (Hash::check($request->password_old, $this->data['Pgn']->password)) {
            $validator = Validator::make($request->all(), $rules, [], $attributes);

            if ($validator->fails()) {
                $errorString = implode(",",$validator->messages()->all());
                $data['response'] = [
                    'status' =>  Response::HTTP_BAD_REQUEST,
                    'response' => "danger",
                    'type' => "danger",
                    'message' => $errorString
                ];
            }else{
                try {
                    $options = [
                        'cost' => 10,
                    ];
                    $password_baru = password_hash($request->password_new, PASSWORD_BCRYPT, $options);
                    $update = DB::table('users')->where('users_id', $request->users_id)->update([
                        'password' => $password_baru,
                        'users_uupdate' => $this->data['Pgn']->users_id
                    ]);
                    if ($request->users_id == $request->users_id_session) {
                        $request->session()->flush();
                    }
                    $data['response'] = [
                        'status' => 200,
                        'response' => "success",
                        'type' => "success",
                        'message' => "Data Password Pengguna Diubah"
                    ];
                } catch (\Exception $e) {
                    $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Password Pengguna Tidak Dapat Disimpan, '.$e->getMessage()];
                }
            }
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Password Lama Tidak Sesuai'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function updateDataReset(Request $request)
    {
        $this->data['Pgn'] = $this->getUser();

        $rules = [
            'password_new' => 'required|min:6|max:20',
            "password_new1" => "same:password_new",
        ];
        $attributes = [
            'password_new' => 'Password Baru',
            'password_new1' => 'Ulangi Password Baru',
        ];
        $validator = Validator::make($request->all(), $rules, [], $attributes);

        if ($validator->fails()) {
            $errorString = implode(",",$validator->messages()->all());
            $data['response'] = [
                'status' =>  Response::HTTP_BAD_REQUEST,
                'response' => "danger",
                'type' => "danger",
                'message' => $errorString
            ];
        }else{
            try {
                $options = [
                    'cost' => 10,
                ];
                $password_baru = password_hash($request->password_new, PASSWORD_BCRYPT, $options);
                $update = DB::table('users')->where('users_id', $request->users_id)->update([
                    'password' => $password_baru,
                    'users_uupdate' => $this->data['Pgn']->users_id
                ]);
                if ($request->users_id == $request->users_id_session) {
                    $request->session()->flush();
                }
                $data['response'] = [
                    'status' => 200,
                    'response' => "success",
                    'type' => "success",
                    'message' => "Data Password Pengguna Diubah"
                ];
            } catch (\Exception $e) {
                $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Password Pengguna Tidak Dapat Disimpan, '.$e->getMessage()];
            }
        }
        
        return response()->json($data, $data['response']['status']);
    }

    static function insertDataU($users_nm, $users_prsn, $username, $password)
    {
        $options = [
            'cost' => 10,
        ];

        $UsersModel = new UsersModel();
        
        $UsersModel->users_nm = $users_nm;
        $UsersModel->users_prsn = $users_prsn;
        $UsersModel->username = $username;
        

        $UsersModel->users_tipe = 'U';
        $UsersModel->users_act = '1';
        
        $password_baru = password_hash($password, PASSWORD_BCRYPT, $options);

        $UsersModel->password = $password_baru;
        $save = $UsersModel->save();
        if ($save) {
            return true;
        }else{
            return false;
        }
    }

    public function deleteData($users_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $UsersModel = new UsersModel();

        $delete = $UsersModel::where('users_id', $users_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Pengguna Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    public function setAct($users_act, $users_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $UsersModel = new UsersModel();

        $message = "Dinonaktifkan";
        if ($users_act=="1") {
            $message = "Diaktifkan";
        }

        $update = $UsersModel::where('users_id', $users_id)->update([
            'users_act' => $users_act
        ]);
        if ($update) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Pengguna Berhasil ".$message
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Pengguna Tidak Dapat '.$message];
        }
        return response()->json($data, $data['response']['status']);
    }

    static function setData($data)
    {
        $IdForm = 'usersAddData';

        for ($i=0; $i < count($data); $i++) { 
            
            $data[$i]->users_tipeAltT = "Administrator";
            if ($data[$i]->users_tipe=='UTD') {
                $data[$i]->users_tipeAltT = "UTD";
            }

            $data[$i]['users_actAltT'] = "Aktif";
            $data[$i]['users_actAltBa'] = "<span class='badge badge-success font-weight-bold'>AKTIF</span>";
            $data[$i]['users_actAltBu'] = "<span onclick='callOtherTWLoad(\"Menonaktifkan Status Pengguna\", \"".url('users/setAct/0/'.$data[$i]['users_id'])."\", \"".url('users/load')."\", \"".$IdForm."\", \"".$IdForm."data\", \"".$IdForm."card\")' role='button' class='btn btn-success font-weight-bold'>AKTIF</span>";
            if ($data[$i]['users_act']=="0") {
                $data[$i]['users_actAltBa'] = "<span class='badge badge-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['users_actAltBu'] = "<span onclick='callOtherTWLoad(\"Mengaktifkan Status Pengguna\", \"".url('users/setAct/1/'.$data[$i]['users_id'])."\", \"".url('users/load')."\", \"".$IdForm."\", \"".$IdForm."data\", \"".$IdForm."card\")' role='button' class='btn btn-danger font-weight-bold'>TIDAK AKTIF</span>";

                $data[$i]['users_actAltT'] = "Tidak Aktif";                
            }

        }
        return $data;
    }
}
