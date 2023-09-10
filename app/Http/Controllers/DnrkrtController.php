<?php

namespace App\Http\Controllers;

use App\Models\PrsnModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use TCPDF;

class MYPDF extends TCPDF
{
    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image

        // $img_file = 'https://satudarahparigimoutong.com/assets/img/kartu_donor_d.png';
        // $this->Image($img_file, 0, 0, 210, 148);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
    public function footer()
    {
        

    }
}

class DnrkrtController extends Controller
{
    public function print($token){
        ob_start();
        try {
            $pdf = new MYPDF('L', 'mm', [85.60, 53.98], true, 'UTF-8', false);
    
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Pemerintah Daerah Kabupaten Parigi Moutong');
            $pdf->SetTitle('Satu Darah');
            $pdf->SetSubject('Sistem Akomodasi Terpadu Donor Darah Kabupaten Parigi Moutong');
            $pdf->SetKeywords('Satu Darah');
    
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(0);
            $pdf->SetFooterMargin(0);
    
            // remove default footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
    
            // set auto page breaks
            $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
    
            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
    
            // set font
            $pdf->SetFont('helvetica', '');
    
            $data = JWT::decode($token, new Key(env('ACCESS_TOKEN_SECRET'), 'HS256'));
    
            $Prsn = PrsnModel::leftJoin('krj', 'prsn.prsn_krj', '=', 'krj.krj_id')->leftJoin('gol', 'prsn.prsn_gol', '=', 'gol.gol_id')->leftJoin('desa', 'prsn.prsn_desa', '=', 'desa.id')->leftJoin('kec', 'desa.desa_kec', '=', 'kec.id')->leftJoin('kab', 'kec.kec_kab', '=', 'kab.id')->where('prsn_id', $data->id)->select(['prsn_id', 'prsn_nm', 'prsn_nik', 'prsn_tmptlhr', 'prsn_tgllhr', 'gol_nm', 'prsn_gol', 'prsn_jk', 'prsn_alt', 'desa.nama as desa_nama', 'kec.nama as kec_nama', 'prsn_telp', 'prsn_wa', 'kec.id as kec_id', 'desa.id as desa_id', 'desa.jenis as jenis', 'prsn_krj', 'krj_nm', 'prsn_kd', 'prsn_bc'])->orderBy('prsn_ord', 'desc')->get()->first();
            
            $Prsn = PrsnController::setData($Prsn);
    
            // add a page
            $pdf->AddPage();
            $img_file = 'https://satudarahparigimoutong.com/assets/img/kartu_donor_d.png';
            $pdf->Image($img_file, 0, 0, 85.60, 53.98, '', '', '', true, 300, '', false, false, 0, true);
            $pdf->setXY(0,16);
            // $html = '<span style="background-color:yellow;color:blue; font-size:2pt;">&nbsp;PAGE 1&nbsp;</span><p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:helvetica;font-weight:bold;font-size:2pt;">You can set a full page background.</p>';
            //  //Where x and y are the offset (probably 0, 0)
            // $pdf->writeHTML($html, true, false, true, false, '');
    
            $tblPrsn = '<table cellspacing="0" cellpadding="0" border="1" width="100%" style="font-size:9pt;">
                    <tr style="line-height: 100%;">
                        <td width="14"></td>
                        <td width="54"><strong><font size="6.5">No. ID</font></strong></td>
                        <td width="10"><strong><font size="6.5">:</font></strong></td>
                        <td width="125"><strong><font size="6.5">' . $Prsn->prsn_kd . '</font></strong></td>';
            $tblPrsn .= '<td rowspan="6" align="center" width="60" style="vertical-align: middle; line-height:8px;"><strong><font size="30"><br/>' . $Prsn->gol_nm . '</font></strong></td>';
            $tblPrsn .= '</tr>
                <tr style="line-height: 105%;">
                    <td width="14"></td>
                    <td width="54"><strong><font size="6.5">Nama</font></strong></td>
                    <td width="10"><strong><font size="6.5">:</font></strong></td>
                    <td width="125"><strong><font size="6.5">' . ucwords(strtolower(stripslashes($Prsn->prsn_nm))) . '</font></strong></td>
                </tr>
                <tr style="line-height: 105%;">
                    <td width="14"></td>
                    <td width="54"><strong><font size="6.5">TTL</font></strong></td>
                    <td width="10"><strong><font size="6.5">:</font></strong></td>
                    <td width="125"><strong><font size="6.5">' . ucwords(strtolower(stripslashes($Prsn->prsn_tmptlhr).", ".$Prsn->prsn_tgllhrAltT)). '</font></strong></td>
                </tr>
                <tr style="line-height: 105%;">
                    <td width="14"></td>
                    <td width="54"><strong><font size="6.5">Desa</font></strong></td>
                    <td width="10"><strong><font size="6.5">:</font></strong></td>
                    <td width="125"><strong><font size="6.5">'.ucwords(strtolower(stripslashes($Prsn->desa_nama))). '</font></strong></td>
                </tr>
                <tr style="line-height: 105%;"> 
                    <td width="14"></td>
                    <td width="54"><strong><font size="6.5">Kecamatan</font></strong></td>
                    <td width="10"><strong><font size="6.5">:</font></strong></td>
                    <td width="125"><strong><font size="6.5">'.ucwords(strtolower(stripslashes($Prsn->kec_nama))).'</font></strong></td>
                </tr>
                <tr style="line-height: 105%;">
                    <td width="14"></td>
                    <td width="54"><strong><font size="6.5">Jns Kelamin</font></strong></td>
                    <td width="10"><strong><font size="6.5">:</font></strong></td>
                    <td width="125"><strong><font size="6.5">' . $Prsn->prsn_jkAltT . '</font></strong></td>
                </tr></table>';
            $pdf->writeHTML($tblPrsn, true, true, true, false, '');
            
            $img_file = 'https://satudarahparigimoutong.com/bc/'.$Prsn->prsn_bc;

            $tblBc = '<img src="' . $img_file . '" height="20px" alt="Barcode" />';
            // $pdf->writeHTMLCell($w = 0, $h = 0, $x = 34, $y = 45, $tblBc);
            $pdf->Image($img_file, 35, 45.4, 39, 20, '', '', '', false, 300, '', false, false, 0, true);


            $pdf->AddPage();
            $img_file = 'https://satudarahparigimoutong.com/assets/img/kartu_donor_b.png';
            $pdf->Image($img_file, 0, 0, 85.60, 53.98, '', '', '', true, 300, '', false, false, 0, true);
            // $html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span><p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:helvetica;font-weight:bold;font-size:26pt;">You can set a full page background.</p>';
             //Where x and y are the offset (probably 0, 0)
            
            $pdf->Output('kartudonor_' . $Prsn->prsn_kd . '_'.date("YmdHis").'.pdf', 'D'); //To force download
            exit;

        
        } catch ( \Firebase\JWT\ExpiredException $exception ) {
            return redirect()->intended();
        }
       
    }

}
