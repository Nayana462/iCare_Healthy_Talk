<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PatientsController;

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
    if(\Illuminate\Support\Facades\Auth::check()){
        return view('backend.index');
    }
    return view('auth.login');
});


// Route::get('/dashboard', function () {
//     if(auth()->user()->role_id =='1'){
//          return view('backend.index);
//     }
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
   // Route::resource('/doctor', ::class);
    Route::resource('doctor', DoctorController::class);

    Route::resource('category', CategoryController::class);
    Route::resource('banner', BannerController::class);
    Route::get('view/{id}', [DoctorController::class , 'viewqualification']);
    Route::get('qualificationedit/{id}', [DoctorController::class , 'qualificationedit']);
    Route::post('updatequalification', [DoctorController::class , 'updatequalification']);
    Route::post('savequalification', [DoctorController::class , 'savequalification']);
    Route::get('deletequalification/{id}', [DoctorController::class , 'deletequalification']);
    Route::resource('patient', PatientsController::class);
});

