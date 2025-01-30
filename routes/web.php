<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\DftrController;
use App\Http\Controllers\DnrController;
use App\Http\Controllers\DnrkController;
use App\Http\Controllers\DnrkrtController;
use App\Http\Controllers\DnrlokController;
use App\Http\Controllers\DnrmController;
use App\Http\Controllers\DnrpController;
use App\Http\Controllers\FakeController;
use App\Http\Controllers\GolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KabController;
use App\Http\Controllers\KecController;
use App\Http\Controllers\KorgController;
use App\Http\Controllers\KrjController;
use App\Http\Controllers\KtkController;
use App\Http\Controllers\MskController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\PrsnController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\SegController;
use App\Http\Controllers\SegkecController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WaSendController;
use App\Models\SegkecModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
Route::get('register', [DftrController::class, 'index'])->name('register');
// Route::get('register/sendWa', [DftrController::class, 'sendWa'])->name('daftar.sendwa');
Route::post('register/insert', [PrsnController::class, 'insertDataReg'])->name('register.insert');
Route::get('register/success/{id}', [DftrController::class, 'success']);
Route::get('register/reload-captcha', [PrsnController::class, 'reloadCaptcha']);

Route::controller(MskController::class)->group(function(){
    Route::get('/masuk', 'index')->name('masuk');
    Route::post('masuk/authMasuk', 'authMasuk')->name('masuk.auth');
    Route::get('/masuk/authKeluar', 'logout');
    Route::get('/reload-captcha', 'reloadCaptcha');

    Route::get('/login', 'login')->name('login');
    Route::post('login/authLogin', 'authLogin')->name('login.auth');
    Route::get('/login/logout', 'logout');
    Route::get('/reload-captcha', 'reloadCaptcha');
});

Route::get('referensi', [RefController::class, 'index'])->middleware('auth')->name('ref.index');
Route::get('fake/comp', [FakeController::class, 'comp'])->middleware('auth');
Route::get('fake/person', [FakeController::class, 'person'])->middleware('auth');

Route::get('/kab/getDataJson/{kab_prov}', [KabController::class, 'getDataJson'])->middleware('auth');
Route::get('kec/getDataJson', [KecController::class, 'getDataJson'])->middleware('auth');
Route::get('kec/getDataJsonExcSeg', [KecController::class, 'getDataJsonExcSeg'])->middleware('auth');
Route::get('desa/getDataJson/{desa_kec}', [DesaController::class, 'getDataJson']);

Route::get('korg', [KorgController::class, 'index'])->middleware('auth')->name('korg.index');
Route::get('korg/load', [KorgController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('korg/insert', [KorgController::class, 'insertData'])->middleware('auth')->name('korg.insert');
Route::post('korg/update', [KorgController::class, 'updateData'])->middleware('auth')->name('korg.update');
Route::get('korg/delete/{korg_id}', [KorgController::class, 'deleteData'])->middleware('auth');
Route::get('korg/setAct/{korg_act}/{korg_id}', [KorgController::class, 'setAct'])->middleware('auth');

Route::get('org', [OrgController::class, 'index'])->middleware('auth')->name('org.index');
Route::get('org/load', [OrgController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('org/insert', [OrgController::class, 'insertData'])->middleware('auth')->name('org.insert');
Route::post('org/update', [OrgController::class, 'updateData'])->middleware('auth')->name('org.update');
Route::get('org/delete/{org_id}', [OrgController::class, 'deleteData'])->middleware('auth');
Route::get('org/setAct/{org_act}/{org_id}', [OrgController::class, 'setAct'])->middleware('auth');
Route::get('org/setRs/{org_rs}/{org_id}', [OrgController::class, 'setRs'])->middleware('auth');
Route::get('org/setUtd/{org_utd}/{org_id}', [OrgController::class, 'setUtd'])->middleware('auth');
Route::get('org/getDataByTextS', [OrgController::class, 'getDataByTextS'])->name('org.getDataText');

Route::get('gol', [GolController::class, 'index'])->middleware('auth')->name('gol.index');
Route::get('gol/getDataJson', [GolController::class, 'getDataJson'])->middleware('auth');
Route::get('gol/load', [GolController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('gol/insert', [GolController::class, 'insertData'])->middleware('auth')->name('gol.insert');
Route::post('gol/update', [GolController::class, 'updateData'])->middleware('auth')->name('gol.update');
Route::get('gol/delete/{gol_id}', [GolController::class, 'deleteData'])->middleware('auth');
Route::get('gol/setAct/{gol_act}/{gol_id}', [GolController::class, 'setAct'])->middleware('auth');

Route::get('prsn', [PrsnController::class, 'index'])->middleware('auth')->name('prsn.index');
Route::get('prsn/load/{search_key?}/{search_val?}', [PrsnController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::get('prsn/pdf/{dateA}/{dateB?}', [PrsnController::class, 'viewPdf'])->middleware('auth')->name('prsn.pdf');

Route::post('prsn/search', [PrsnController::class, 'searchData'])->middleware('auth')->middleware('ajax')->name('prsn.search');
Route::post('prsn/searchSide', [PrsnController::class, 'searchDataSide'])->middleware('auth')->middleware('ajax')->name('prsn.searchSide');
Route::get('prsn/view/{prsn_id?}', [PrsnController::class, 'viewData'])->middleware('auth')->name('prsn.view');
Route::get('prsn/loadView/{prsn_id?}', [PrsnController::class, 'loadViewData'])->middleware('auth')->middleware('ajax');
Route::get('prsn/loadDnr/{prsn_id?}', [PrsnController::class, 'loadViewDnr'])->middleware('auth')->middleware('ajax');
Route::get('prsn/viewSide/{prsn_id?}', [PrsnController::class, 'viewDataSide'])->middleware('auth')->name('prsn.viewSide');
Route::post('prsn/insert', [PrsnController::class, 'insertData'])->middleware('auth')->name('prsn.insert');
Route::post('prsn/insertSide', [PrsnController::class, 'insertDataSide'])->middleware('auth')->name('prsn.insertSide');
Route::post('prsn/update', [PrsnController::class, 'updateData'])->middleware('auth')->name('prsn.update');
Route::get('prsn/delete/{prsn_id}', [PrsnController::class, 'deleteData'])->middleware('auth');
Route::post('prsn/searchDnr', [PrsnController::class, 'searchDataDnr'])->middleware('auth')->middleware('ajax')->name('prsn.searchDnr');
Route::post('prsn/searchJson', [PrsnController::class, 'searchDataJson'])->middleware('auth')->middleware('ajax')->name('prsn.searchJson');
Route::post('prsn/excelForm', [PrsnController::class, 'loadExcelForm'])->middleware('auth')->name('prsn.excelForm');
Route::post('prsn/excelNForm', [PrsnController::class, 'loadExcelNForm'])->middleware('auth')->name('prsn.excelNForm');
Route::get('prsn/changeKode', [PrsnController::class, 'changeKode'])->middleware('auth');
Route::get('prsn/testSearchPrsn', [PrsnController::class, 'testSearchPrsn']);
Route::get('prsn/testSearchPrsnByTgl', [PrsnController::class, 'testSearchPrsnByTgl']);
Route::get('prsn/testSearchPrsnByLastKd', [PrsnController::class, 'testSearchPrsnByLastKd']);
Route::get('prsn/testSearchPrsnBySameDate', [PrsnController::class, 'testSearchPrsnBySameDate']);
Route::get('prsn/resetSendWa/{prsn_id}', [PrsnController::class, 'resetUserAndSendWa'])->middleware('auth');
Route::get('prsn/cetakKrt/{prsn_id}', [PrsnController::class, 'cetakKrtAdm'])->middleware('auth');
Route::get('prsn/verification/{prsn_id}', [PrsnController::class, 'verificationData'])->middleware('auth');

Route::get('seg', [SegController::class, 'index'])->middleware('auth')->name('seg.index');
Route::get('seg/load', [SegController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('seg/insert', [SegController::class, 'insertData'])->middleware('auth')->name('seg.insert');
Route::post('seg/update', [SegController::class, 'updateData'])->middleware('auth')->name('seg.update');
Route::get('seg/delete/{seg_id}', [SegController::class, 'deleteData'])->middleware('auth');
Route::get('seg/setAct/{seg_act}/{seg_id}', [SegController::class, 'setAct'])->middleware('auth');

Route::post('segkec/insert', [SegkecController::class, 'insertData'])->middleware('auth')->name('segkec.insertData');
Route::get('segkec/delete/{segkec_id}', [SegkecController::class, 'deleteData'])->middleware('auth');

// Route::get('dnr/view/{kat?}', [DnrController::class, 'viewData'])->middleware('auth')->name('dnr.index');
// Route::get('dnr/load/{kat?}', [DnrController::class, 'load'])->middleware('auth')->middleware('ajax');
// Route::get('dnr/tesSend', [DnrController::class, 'tesSend'])->middleware('auth');
// Route::post('dnr/insertP', [DnrController::class, 'insertDataP'])->middleware('auth')->name('dnr.insertP');
// Route::post('dnr/updateP', [DnrController::class, 'updateDataP'])->middleware('auth')->name('dnr.updateP');
Route::get('dnr/delete/{dnr_id}', [DnrController::class, 'deleteData'])->middleware('auth');

Route::get('dnrp', [DnrpController::class, 'index'])->middleware('auth')->name('dnrp.index');
Route::get('dnrp/load', [DnrpController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::get('dnrp/view/{dnr_id?}', [DnrpController::class, 'viewData'])->middleware('auth')->name('dnrp.view');
Route::get('dnrp/loadView/{dnr_id?}', [DnrpController::class, 'loadView'])->middleware('auth')->middleware('ajax');
Route::post('dnrp/insert', [DnrpController::class, 'insertData'])->middleware('auth')->name('dnrp.insert');
Route::post('dnrp/update', [DnrpController::class, 'updateData'])->middleware('auth')->name('dnrp.update');
Route::post('dnrp/updateTmbh', [DnrpController::class, 'updateDataTambah'])->middleware('auth')->name('dnrp.updateTmbh');

Route::get('dnrk', [DnrkController::class, 'index'])->middleware('auth')->name('dnrk.index');
Route::get('dnrk/load', [DnrkController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::get('dnrk/view/{dnr_id?}', [DnrkController::class, 'viewData'])->middleware('auth')->name('dnrk.view');
Route::get('dnrk/loadView/{dnr_id?}', [DnrkController::class, 'loadView'])->middleware('auth')->middleware('ajax');
Route::post('dnrk/insert', [DnrkController::class, 'insertData'])->middleware('auth')->name('dnrk.insert');
Route::post('dnrk/update', [DnrkController::class, 'updateData'])->middleware('auth')->name('dnrk.update');

Route::get('dnrm', [DnrmController::class, 'index'])->middleware('auth')->name('dnrm.index');
Route::get('dnrm/load', [DnrmController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::get('dnrm/loadDnrp/{dnrm_dnr?}', [DnrmController::class, 'loadDnrp'])->middleware('auth')->middleware('ajax');
Route::get('dnrm/loadDnrk/{dnrm_dnr?}', [DnrmController::class, 'loadDnrk'])->middleware('auth')->middleware('ajax');
Route::get('dnrm/loadDnrM/{dnrm_prsn?}', [DnrmController::class, 'loadDnrm'])->middleware('auth')->middleware('ajax');
Route::post('dnrm/insert', [DnrmController::class, 'insertData'])->middleware('auth')->name('dnrm.insert');
Route::post('dnrm/insertK', [DnrmController::class, 'insertDataK'])->middleware('auth')->name('dnrm.insertK');
Route::post('dnrm/insertM', [DnrmController::class, 'insertDataM'])->middleware('auth')->name('dnrm.insertM');
Route::post('dnrm/update', [DnrmController::class, 'updateData'])->middleware('auth')->name('dnrm.update');
Route::post('dnrm/updateK', [DnrmController::class, 'updateDataK'])->middleware('auth')->name('dnrm.updateK');
Route::post('dnrm/updateM', [DnrmController::class, 'updateDataM'])->middleware('auth')->name('dnrm.updateM');
Route::get('dnrm/delete/{dnrm_id}', [DnrmController::class, 'deleteData'])->middleware('auth');

Route::get('dnrlok/loadDnrp/{dnrlok_dnr?}', [DnrlokController::class, 'loadDataDnrp'])->middleware('auth')->middleware('ajax');
Route::get('dnrlok/loadDnrk/{dnrlok_dnr?}', [DnrlokController::class, 'loadDataDnrk'])->middleware('auth')->middleware('ajax');
Route::post('dnrlok/insertLok', [DnrlokController::class, 'insertDataLok'])->middleware('auth')->name('dnrlok.insertLok');
Route::post('dnrlok/insertK', [DnrlokController::class, 'insertDataK'])->middleware('auth')->name('dnrlok.insertK');
Route::get('dnrlok/deleteLok/{dnrlok_id}', [DnrlokController::class, 'deleteDataLok'])->middleware('auth');
Route::get('dnrlok/deleteK/{dnrlok_id}', [DnrlokController::class, 'deleteDataK'])->middleware('auth');

Route::get('printCard/{token}', [DnrkrtController::class, 'print'])->name('printCard');

Route::get('ktk', [KtkController::class, 'index'])->middleware('auth')->name('ktk.index');
Route::get('ktk/load', [KtkController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('ktk/insert', [KtkController::class, 'insertData'])->middleware('auth')->name('ktk.insert');
Route::post('ktk/update', [KtkController::class, 'updateData'])->middleware('auth')->name('ktk.update');
Route::get('ktk/delete/{ktk_id}', [KtkController::class, 'deleteData'])->middleware('auth');
Route::get('ktk/setAct/{ktk_act}/{ktk_id}', [KtkController::class, 'setAct'])->middleware('auth');

Route::get('krj', [KrjController::class, 'index'])->middleware('auth')->name('krj.index');
Route::get('krj/getDataJson', [KrjController::class, 'getDataJson'])->middleware('auth');
Route::get('krj/load', [KrjController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('krj/insert', [KrjController::class, 'insertData'])->middleware('auth')->name('krj.insert');
Route::post('krj/update', [KrjController::class, 'updateData'])->middleware('auth')->name('krj.update');
Route::get('krj/delete/{krj_id}', [KrjController::class, 'deleteData'])->middleware('auth');
Route::get('krj/setAct/{ktrj_act}/{krj_id}', [KrjController::class, 'setAct'])->middleware('auth');
Route::get('krj/setProf/{krj_prof}/{krj_id}', [KrjController::class, 'setProf'])->middleware('auth');

Route::get('users', [UsersController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('users/load', [UsersController::class, 'load'])->middleware('auth')->middleware('ajax');
Route::post('users/insert', [UsersController::class, 'insertData'])->middleware('auth')->name('users.insert');
Route::post('users/insertUTD', [UsersController::class, 'insertDataUTD'])->middleware('auth')->name('users.insertUTD');
Route::post('users/update', [UsersController::class, 'updateData'])->middleware('auth')->name('users.update');
Route::post('users/updateUTD', [UsersController::class, 'updateDataUTD'])->middleware('auth')->name('users.updateUTD');
Route::post('users/updatePwd', [UsersController::class, 'updateDataPWD'])->middleware('auth')->name('users.updatePwd');
Route::post('users/updateReset', [UsersController::class, 'updateDataReset'])->middleware('auth')->name('users.updateReset');
Route::get('users/delete/{users_id}', [UsersController::class, 'deleteData'])->middleware('auth');
Route::get('users/setAct/{users_act}/{users_id}', [UsersController::class, 'setAct'])->middleware('auth');

Route::get('waSend', [WaSendController::class, 'sendWa'])->middleware('auth');

