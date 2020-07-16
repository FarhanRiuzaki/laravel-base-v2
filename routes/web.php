<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('login'));
});

Auth::routes();

//JADI INI GROUPING ROUTE, SEHINGGA SEMUA ROUTE YANG ADA DIDALAMNYA
//SECARA OTOMATIS AKAN DIAWALI DENGAN administrator
//CONTOH: /administrator/category ATAU /administrator/product, DAN SEBAGAINYA
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('apps/theme', 'AppsController@theme')->name('apps.theme');

    // API
        // import excel
            Route::get('/import_excel', 'ApisController@importExcel');

    Route::get('api/cif', 'ApisController@cif')->name('api.cif');           // get CIF
    Route::get('api/get_lc', 'ApisController@get_lc')->name('api.get_lc');  // get LC
    Route::get('api/mt700', 'ApisController@mt700')->name('api.mt700');     // get mt700
    Route::get('api/mt707', 'ApisController@mt707')->name('api.mt707');     // get mt707

    // PDF
    Route::get('/pdf/notifications-letter/{id}', 'ApisController@pdfNotifLetter')->name('api.pdfNotifLetter');
    Route::get('/pdf/nota-debet/{id}', 'ApisController@pdfNotaDebet')->name('api.pdfNotaDebet');
    // END DF

    //Route yang berada dalam group ini hanya dapat diakses oleh Admin|super-admin|User|Counter|Trade-maker|Trade-approver
    Route::group(['middleware' => ['role:Admin|super-admin']], function () {

        //route yang berada dalam group ini, hanya bisa diakses oleh user
        //yang memiliki permission yang telah disebutkan dibawah
        Route::group(['middleware' => ['permission:apps-show']], function() {
            // App setting
            Route::resource('apps', 'AppsController');
        });

        Route::group(['middleware' => ['permission:role-show']], function() {
            //ROLE
            Route::resource('roles', 'RolesController')->except([
                'create', 'show', 'edit', 'update'
            ]);
        });

        Route::group(['middleware' => ['permission:role permission-show']], function() {
            Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
            Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
            Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
        });

        Route::group(['middleware' => ['permission:users-show']], function() {
            // USER
            Route::resource('users', 'UserController')->except([
                'show'
            ]);
            Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
            Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        });
    });

    Route::group(['middleware' => ['role:Admin|super-admin|User|Counter|Trade-maker|Trade-approver']], function () {
        // MASTER
        Route::group(['middleware' => ['permission:master']], function() {

            //FLAG
            Route::resource('flag', 'MasterFlagController');
            // CURRENCY
            Route::resource('currency', 'MasterCurrencyController');
            // BRANCH CABANG
            Route::resource('branch', 'MasterBranchController');
            // Document Parameters
            Route::resource('documentParameter', 'MasterDocumentParametersController');
            // Product
            Route::resource('product', 'MasterProductController');
        });

        // FACILITY
        Route::group(['middleware' => ['permission:facility-maker']], function() {
            //FACILITY
            Route::resource('facility', 'Facility\FacilityController');
        });
        //APPROVE FACILITY
        Route::group(['middleware' => ['permission:facility-approve']], function() {
            Route::resource('approveFacility', 'Facility\ApproveFacilityController');
        });

        // ADVISE MAKER
        Route::group(['middleware' => ['permission:advise-maker']], function() {
            //Summary
            Route::get('/transactions/list', 'Advise\TransactionController@list')->name('transactions.list');
            Route::resource('transactions', 'Advise\TransactionController');
        });
        // ADVISE APPROVE
        Route::group(['middleware' => ['permission:advise-approve']], function() {
            Route::resource('approverAdvise', 'Advise\ApproverAdviseController');

        });

         // AMENDMENT MAKER
        Route::group(['middleware' => ['permission:amendment-maker']], function() {
            Route::resource('amend', 'Amendment\AmendController');
        });
        // AMENDMENT APPROVE
        Route::group(['middleware' => ['permission:amendment-approve']], function() {
            Route::resource('approveAmend', 'Amendment\ApproveAmendController');
        });

        // DOCUMENT
        Route::group(['middleware' => ['permission:document-maker']], function() {
            // Upload Document
            Route::get('/uploadDocument/sor-list/{id}', 'Document\UploadDocumentController@sorList')->name('uploadDocument.sorList');
            Route::resource('uploadDocument', 'Document\UploadDocumentController');
        });

        // UJI DOCUMENT MAKER
        Route::group(['middleware' => ['permission:uji-document-maker']], function() {
            Route::get('/ujiDocument/sor-list/{id}', 'Uji\UjiDocumentController@sorList')->name('ujiDocument.sorList');
            Route::resource('ujiDocument', 'Uji\UjiDocumentController');
        });
        // UJI DOCUMENT APPROVE
        Route::group(['middleware' => ['permission:uji-document-approve']], function() {
            Route::post('/approverUji/upload-document/', 'Uji\ApproverUjiController@storeDocument')->name('approverUji.storeDocument');
            Route::get('/approverUji/upload-document/{id}', 'Uji\ApproverUjiController@uploadDocument')->name('approverUji.uploadDocument');
            Route::get('/approverUji/view-document/{id}', 'Uji\ApproverUjiController@viewDocument')->name('approverUji.viewDocument');
            Route::get('/approverUji/sor-list/{id}', 'Uji\ApproverUjiController@sorList')->name('approverUji.sorList');
            Route::resource('approverUji', 'Uji\ApproverUjiController');
        });

        // TRANSACTION MAKER
        Route::group(['middleware' => ['permission:transaction-maker']], function() {
            Route::get('/trx/sor-list/{id}', 'Transactions\TrxController@sorList')->name('trx.sorList');
            Route::get('/trx/sor-list/trx-list/{id}', 'Transactions\TrxController@trxList')->name('trx.trxList');
            Route::resource('trx', 'Transactions\TrxController');
        });
        // TRANSACTION APPROVE
        Route::group(['middleware' => ['permission:transaction-approve']], function() {
            Route::get('/approve-trx/sor-list/{id}', 'Transactions\ApproveTrxController@sorList')->name('approveTrx.sorList');
            Route::get('/approve-trx/sor-list/trx-list/{id}', 'Transactions\ApproveTrxController@trxList')->name('approveTrx.trxList');
            Route::resource('approveTrx', 'Transactions\ApproveTrxController');
        });

        // REPORT
        Route::group(['middleware' => ['permission:report']], function() {

            // Status
            Route::get('/reportStatus/show-sor/trx-list/{id}', 'Report\ReportStatusController@trxList')->name('reportStatus.trxList');
            Route::get('/reportStatus/show-sor/trx-list/show-trx/{id}', 'Report\ReportStatusController@showTrx')->name('reportStatus.showTrx');
            Route::get('/reportStatus/show-sor/{id}', 'Report\ReportStatusController@showSor')->name('reportStatus.showSor');
            Route::resource('reportStatus', 'Report\ReportStatusController');

            //SLA
            Route::resource('reportSla', 'Report\ReportSlaController');
        });
    });

// SETTING User
Route::get('/app-setting/{id}', 'UserController@editUser')->name('user_setting');
Route::put('/app-setting/{id}', 'UserController@updateUser')->name('update_user');

});

