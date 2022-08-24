<?php

use App\Http\Controllers\AboutController;
use App\Models\About;
use App\Models\Status;
use Illuminate\Support\Facades\Route;

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

    // disini karna saya pakai halaman awal jadi saya get semua di route ini
    
    $data['about'] = About::paginate(10);
    $data['aboutLates'] = About::latest('id')->first();
    $data['countAbout'] = About::get()->count();
    $data['status'] = Status::first();
    $data['count'] = Status::get()->count();

    return view('welcome',$data);
});

Route::post('create', [AboutController::class, 'store'])->name('create');
Route::post('status', [AboutController::class, 'setStatus'])->name('set-status');
Route::post('status-update', [AboutController::class, 'updateStatus'])->name('update-status');
Route::delete('delete-about', [AboutController::class, 'destroy'])->name('delete-about');

