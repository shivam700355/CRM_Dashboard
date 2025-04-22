<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerticalController;
use App\Http\Controllers\SpocController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\VendorusersController;
use Session;
use App\Models\Vassociation;
use App\Models\Vendor;
use App\Models\FileUpload;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/upload', 'FileController@index')->name('upload');
Route::post('/upload', 'FileController@fileUploader')->name('uploadfile');
Route::get('/upload-list', 'FileController@filelist')->name('filelist');
Route::get('/fileshow/{filename}', 'FileController@getFile')->name('getFile');

Route::get('/show/{filename}', function ($filename) {
    // Assuming the file is stored in the 'document' directory
    $filePath = storage_path('app/document/' . $filename);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    } else {
        abort(404, 'File not found');
    }
});

Route::get('logout', function () {
    // Artisan::call('route:clear');
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
    Session::flush();
    Auth::logout();
    return redirect('/login');
});

// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('/register', 'Auth\RegisterController@register');

Route::group(['prefix' => 'vendor-login'], function () {
    Route::get('/', 'VendorusersController@index')->name('vendor-login');
    Route::post('/login', 'VendorusersController@login')->name('vendor-login.login');
    Route::get('/dashboard', 'VendorusersController@dashboard')->name('vendor-login.dashboard');
    Route::get('/media/{id}', 'VendorusersController@createMedia')->name('vendor-login.media');
    Route::post('/media', 'VendorusersController@storeMedia')->name('vendor-login.saveMedia');
    Route::get('/logout', 'VendorusersController@logout')->name('vendor-login.logout');
});

Route::get('/', function () {
    return view('mainpage');
})->name('mainpage');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'director'], function () {
    Route::get('/', 'DirectorController@index')->name('director.sadmin');
    Route::get('/project', 'DirectorController@projects')->name('director.projects');
    Route::get('/project/{id}', 'DirectorController@getProject')->name('director.getProject');
    Route::get('/vendor', 'DirectorController@vendors')->name('director.vendors');
    Route::get('/vendor/{id}', 'DirectorController@getVendor')->name('director.getVendor');
    Route::get('/vertical/{id}', 'DirectorController@getVertical')->name('director.getVertical');
    Route::get('/user', 'DirectorController@users')->name('director.users');
    Route::get('/form', 'DirectorController@forms')->name('director.form');
    Route::get('team/:id', 'DirectorController@getTeam')->name('director.getTeam');

    Route::get('/view/{id}', 'DirectorController@show')->name('director.view');
    Route::delete('/director/{id}', 'DirectorController@destroy')->name('director.delete');

    Route::get('/change-password', 'DirectorController@changePass')->name('director.changePassword');
    Route::post('/change-password', 'DirectorController@UpdatePass')->name('director.change.password');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/add', 'AdminController@create')->name('admin.add');
    Route::post('/add', 'AdminController@store')->name('admin.save');

    Route::get('/add-project', 'AdminController@createP')->name('admin.addProject');
    Route::post('/add-project', 'AdminController@storeP')->name('admin.saveProject');
    Route::get('/add-team', 'AdminController@createT')->name('admin.addTeam');
    Route::post('/add-team', 'AdminController@storeT')->name('admin.saveTeam');

    Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
    Route::post('/edit/{id}', 'AdminController@update')->name('admin.update');
    Route::get('/view/{id}', 'AdminController@show')->name('admin.view');
    Route::get('/change-password', 'AdminController@changePass')->name('admin.changePassword');
    Route::post('/change-password', 'AdminController@UpdatePass')->name('admin.change.password');
});

Route::group(['prefix' => 'vertical'], function () {
    Route::get('/', 'VerticalController@index')->name('vertical.index');
    Route::get('/add-project', 'VerticalController@createP')->name('vertical.addProject');
    Route::post('/add-project', 'VerticalController@storeP')->name('vertical.saveProject');
    Route::get('/add-team', 'VerticalController@createT')->name('vertical.addTeam');
    Route::post('/add-team', 'VerticalController@storeT')->name('vertical.saveTeam');
    Route::get('/add-member', 'VerticalController@createM')->name('vertical.addMember');
    Route::post('/add-member', 'VerticalController@storeM')->name('vertical.saveMember');

    //Route::get('/project', 'VerticalController@projects')->name('vertical.projects');
    Route::get('/project/{id}', 'VerticalController@getProject')->name('vertical.getProject');
    Route::get('/vendor/{id}', 'VerticalController@getVendor')->name('vertical.getVendor');

    Route::get('/status-project', 'VerticalController@showReport')->name('vertical.statusP');

    Route::get('/internal-reports', 'VerticalController@internalReports')->name('vertical.internalReports');
    Route::get('/vendor-reports', 'VerticalController@vendorReports')->name('vertical.vendorReports');

    Route::get('/change-password', 'VerticalController@changePass')->name('vertical.changePassword');
    Route::post('/change-password', 'VerticalController@UpdatePass')->name('vertical.change.password');
    Route::post('/project/updateproject', 'VerticalController@updateproject')->name('project.updateproject');

});

Route::group(['prefix' => 'spoc'], function () {
    Route::get('/', 'SpocController@index')->name('spoc.index');
    Route::get('/add', 'SpocController@create')->name('spoc.add');
    Route::post('/add', 'SpocController@store')->name('spoc.save');

    Route::get('/assign', 'SpocController@createAssign')->name('spoc.assignP');
    Route::post('/assign', 'SpocController@storeAssign')->name('spoc.saveAssign');

    Route::get('/vendor', 'SpocController@createVendor')->name('spoc.vendorLogin');
    Route::post('/vendor', 'SpocController@storeVendor')->name('spoc.saveVendor');

    Route::get('/project/{id}', 'SpocController@getProject')->name('spoc.getProject');
    Route::get('/vendor/{id}', 'SpocController@getVendor')->name('spoc.getVendor');

    Route::get('/media/{id}', 'SpocController@createMedia')->name('spoc.media');
    Route::post('/media', 'SpocController@storeMedia')->name('spoc.saveMedia');

    Route::get('/internal-reports', 'SpocController@internalReports')->name('spoc.internalReports');
    Route::get('/vendor-reports', 'SpocController@vendorReports')->name('spoc.vendorReports');

    Route::get('/change-password', 'SpocController@changePass')->name('spoc.changePassword');
    Route::post('/change-password', 'SpocController@UpdatePass')->name('spoc.change.password');
});

Route::group(['prefix' => 'team'], function () {
    Route::get('/', 'TeamController@index')->name('team.index');
    Route::get('/getProject/{id}', 'TeamController@getProject')->name('team.getProject');

    Route::get('/add', 'TeamController@create')->name('team.add');
    Route::post('/add', 'TeamController@store')->name('team.save');

    Route::get('/upload', 'TeamController@createUpload')->name('team.upload');
    Route::post('/upload', 'TeamController@storeUpload')->name('team.saveUpload');

    Route::get('/change-password', 'TeamController@changePass')->name('team.changePassword');
    Route::post('/change-password', 'TeamController@UpdatePass')->name('team.change.password');
});

Route::group(['prefix' => 'vendor'], function () {
    Route::get('/', 'VendorController@index')->name('vendor.index');
    Route::get('/add', 'VendorController@create')->name('vendor.addPunch');
    Route::post('/add', 'VendorController@store')->name('vendor.savePunch');

    Route::get('/change-password', 'VendorController@changePass')->name('vendor.changePassword');
    Route::post('/change-password', 'VendorController@UpdatePass')->name('vendor.change.password');
});

Route::group(['prefix' => 'beneficiary'], function () {
    Route::get('/', 'BeneficiaryController@index')->name('beneficiary.index');
    Route::get('/index', 'BeneficiaryController@index')->name('beneficiary.list');
});

Route::get('/optimize-clear', function () {
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');
    \Artisan::call('route:cache');
    \Artisan::call('optimize:clear');
    \Auth::logout();
    return 'View cache cleared';
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/projectVendors/{id}', function (int $id) {
        $vendors = Vassociation::where('p_id', $id)->get()->unique('v_id');
        $response = array();
        foreach ($vendors as $vendor) {
            $temp = [
                'id' => $vendor->v_id,
                'name' => Vendor::find($vendor->v_id)->name,
            ];
            $response[] = $temp;
        }
        return response()->json($response);
    });
    Route::get('/project/{p_id}/vendor/{v_id}', function (int $p_id, int $v_id) {
        $vendors = Vassociation::where('p_id', $p_id)->where('v_id', $v_id)->get();
        $response = array();
        foreach ($vendors as $vendor) {
            $temp = [
                'id' => $vendor->id,
                'name' => Vendor::find($vendor->v_id)->name,
                'state' => $vendor->state,
                'district' => $vendor->district,
                'start_date' => $vendor->start_date,
                'end_date' => $vendor->end_date,
                'status' => $vendor->status,
            ];
            $response[] = $temp;
        }
        return response()->json($response);
    });
});
