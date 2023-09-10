<?php

namespace App\Http\Controllers;

use App\Models\AIModel;
use App\Models\DnrktkModel;
use App\Models\DnrModel;
use App\Models\DnrprsnModel;
use Illuminate\Http\Request;

class DnrController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'mOp' => 'mODnr',
            'pAct' => '',
            'cAct' => '',
            'cmAct' => '',
            'scAct' => '',

            'WebTitle' => 'DONOR DARAH',
            'PageTitle' => 'Donor Darah',
            'BasePage' => 'dnr',
        ];
    }

    function tesSend() {
        dd(WaSendController::sendTemp('Rahayu', 'RSUD Anuntaloko', '19 Juni 2023', 'O+', '6 Kantung', '0800-000-00', 'Keluarga', '6285255511151'));
    }

    public function deleteData($dnr_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        $DnrModel = new DnrModel;

        $delete = $DnrModel::where('dnr_id', $dnr_id)->delete([]);
        if ($delete) {
            $data['response'] = [
                'status' => 200,
                'response' => "success",
                'type' => "success",
                'message' => "Data Donor Darah Berhasil Dihapus"
            ];
        }else{
            $data['response'] = ['status' => 500, 'response' => 'error','type' => "danger", 'message' => 'Data Donor Darah Tidak Dapat Dihapus'];
        }
        return response()->json($data, $data['response']['status']);
    }

    static function setData($data, $j = 'All')
    {
        $today = date("Y-m-d");
        if (is_countable($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]->dnr_tglAltT = "";
                if ($data[$i]->dnr_tgl!='0000-00-00') {
                    $data[$i]->dnr_tglAltT = ucwords(strtolower(AIModel::changeDateNFSt($data[$i]->dnr_tgl)));
                }
                $data[$i]->prsn_altAltT = "Desa ";
                if ($data[$i]->jenis=="K") {
                    $data[$i]->prsn_altAltT = "Kel. ";
                }
                $data[$i]->prsn_altAltT = $data[$i]->prsn_alt.", ".$data[$i]->prsn_altAltT.$data[$i]->desa_nama.", Kec. ".$data[$i]->kec_nama;

                $data[$i]->dnr_tmptAltT = "Desa ";
                if ($data[$i]->jenis=="K") {
                    $data[$i]->dnr_tmptAltT = "Kel. ";
                }
                $data[$i]->dnr_tmptAltT = $data[$i]->dnr_tmpt.", ".$data[$i]->dnr_tmptAltT.$data[$i]->desa_nama.", Kec. ".$data[$i]->kec_nama;

                $data[$i]->dnr_sftAltT = "Tidak Urgent";
                if ($data[$i]->dnr_sft!='U') {
                    $data[$i]->dnr_sftAltT = "Urgent";
                }

                $data[$i]->uT = "0 Tahun";
                $data[$i]->uB = "0 Bulan";
                $data[$i]->uH = "0 Hari";
                $data[$i]->umur = "0 Tahun, 0 Bulan, 0 Hari";
                $data[$i]->prsn_tgllhrAltT = "";
                if ($data[$i]->prsn_tgllhr!='0000-00-00') {
                    $data[$i]->prsn_tgllhrAltT = ucwords(strtolower(AIModel::changeDateNFSt($data[$i]->prsn_tgllhr)));
                    $diff = date_diff(date_create($data[$i]->prsn_tgllhr), date_create($today));
                    $data[$i]->uT = (string)$diff->format('%y')." Tahun";
                    $data[$i]->uB = (string)$diff->format('%m')." Bulan";
                    $data[$i]->uH = (string)$diff->format('%d')." Hari";
                    $data[$i]->umur = (string)$diff->format('%y')." Tahun, ".(string)$diff->format('%m')." Bulan, ".(string)$diff->format('%d')." Hari";
                }

                // $data[$i]->total = 0;
                $data[$i]->total = (int)DnrmController::countDnr($data[$i]->dnr_id);
            }
        }else{
            $data->dnr_tglAltT = "";
            if ($data->dnr_tgl!='0000-00-00') {
                $data->dnr_tglAltT = AIModel::changeDateNFSt($data->dnr_tgl);
            }
            $data->prsn_altAltT = "Desa ";
            if ($data->jenis=="K") {
                $data->prsn_altAltT = "Kel. ";
            }
            $data->prsn_altAltT = $data->prsn_alt.", ".$data->prsn_altAltT.$data->desa_nama.", Kec. ".$data->kec_nama;

            $data->dnr_tmptAltT = "Desa ";
            if ($data->jenis=="K") {
                $data->dnr_tmptAltT = "Kel. ";
            }
            $data->dnr_tmptAltT = $data->dnr_tmpt.", ".$data->dnr_tmptAltT.$data->desa_nama.", Kec. ".$data->kec_nama;


            $data->dnr_sftAltT = "Tidak Urgent";
            if ($data->dnr_sft!='U') {
                $data->dnr_sftAltT = "Urgent";
            }

            $data->prsn_jkAltT = "Laki-Laki";
            if ($data->prsn_jk!='L') {
                $data->prsn_jkAltT = "Perempuan";
            }

            $data->prsn_waAltT = "Ya";
            if ($data->prsn_wa!='1') {
                $data->prsn_waAltT = "Tidak";
            }

            $data->uT = "0 Tahun";
            $data->uB = "0 Bulan";
            $data->uH = "0 Hari";
            $data->umur = "0 Tahun, 0 Bulan, 0 Hari";
            $data->prsn_tgllhrAltT = "";
            if ($data->prsn_tgllhr!='0000-00-00') {
                $data->prsn_tgllhrAltT = ucwords(strtolower(AIModel::changeDateNFSt($data->prsn_tgllhr)));
                $diff = date_diff(date_create($data->prsn_tgllhr), date_create($today));
                $data->uT = (string)$diff->format('%y')." Tahun";
                $data->uB = (string)$diff->format('%m')." Bulan";
                $data->uH = (string)$diff->format('%d')." Hari";
                $data->umur = (string)$diff->format('%y')." Tahun, ".(string)$diff->format('%m')." Bulan, ".(string)$diff->format('%d')." Hari";
            }

            $data->total = (int)DnrmController::countDnr($data->dnr_id);

            if ($j=='D') {
                $data->Ktk = PrsnController::loadPrsn($data->dnrktk_prsn);
            }
        }
        return $data;
    }
}
