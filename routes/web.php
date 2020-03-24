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
    Route::get('/home', 'HomeController@index')->name('home'); //JADI ROUTING INI SUDAH ADA DARI ARTIKEL SEBELUMNYA TAPI KITA PINDAHKAN KEDALAM GROUPING
    Route::post('apps/theme', 'AppsController@theme')->name('apps.theme');

    // API
    Route::get('api/cif', 'ApisController@cif')->name('api.cif');
    Route::get('api/lc_code', 'ApisController@lc_code')->name('api.lc_code');

    //Route yang berada dalam group ini hanya dapat diakses oleh Admin|super-admin
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

        // MASTER
        Route::group(['middleware' => ['permission:master-app']], function() {
            
            //FLAG
            Route::resource('flag', 'MasterFlagController');
            // CURRENCY
            Route::resource('currency', 'MasterCurrencyController');
            // BRANCH CABANG
            Route::resource('branch', 'MasterBranchController');
            // TERMS
            Route::resource('terms', 'MasterTermsController');
        });

        // MASTER OPEN
        Route::group(['middleware' => ['permission:master-open']], function() {
            //TRANSAKSI
            Route::resource('transaction', 'TransactionController');

            // Approve leeter of credits
            Route::resource('approveLc', 'MasterOpen\ApproveLcController');

            // Approve Facility
            Route::resource('approveFacility', 'MasterOpen\ApproveFacilityController');
        });
    });
});


// SETTING User
Route::get('/app-setting{id}', 'UserController@editUser')->name('user_setting');
Route::put('/app-setting{id}', 'UserController@updateUser')->name('update_user');