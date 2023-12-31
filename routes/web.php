<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;

use App\Http\Controllers\Password_listController;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'google2fa'])->group(function () {

    Route::get('/dashboard', function () {

        return view('dashboard');
        //return redirect(route('home'));

    })->name('dashboard');

    Route::get('/2fa', function () {

        return redirect(route('dashboard'));

    })->name('2fa');

    Route::post('/2fa', function () {
        
        return redirect(route('dashboard'));
        //return redirect(route('home'));

    })->name('2fa');

    Route::get('/ggg', function () {

        //return view('google2fa/loginauth.blade.php');
        return view('s_user/loginauth.blade.php');
        //return redirect(route('home'));
    
    })->name('ggg');


});

/*Route::get('/ggg', function () {

    //return view('google2fa/loginauth.blade.php');
    return view('s_user/loginauth.blade.php');
    //return redirect(route('home'));

})->name('ggg');*/






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('s_users',[UserController::class,'index']);
Route::post('s_users',[UserController::class,'store']);
Route::get('passlis',[UserController::class,'password_list']);
//Route::get('home',[UserController::class,'home']);
Route::get('passmana',[UserController::class,'password_manage']);
Route::get('g_passmana',[UserController::class,'g_password_manage']);
Route::get('pass_add',[Password_listController::class,'password_add']);
Route::get('g_pass_add',[Password_listController::class,'g_password_add']);
Route::post('store',[Password_listController::class,'store']);
Route::post('g_store',[Password_listController::class,'g_store']);

Route::middleware('auth')->group(function(){
    Route::get('groups',[TeamController::class,'group_manage']);
    Route::get('groups/create',[TeamController::class,'group_create']);
    Route::post('groups/store',[TeamController::class,'store']);
    Route::get('groups/manage',[TeamController::class,'group_management']);
    Route::get('groups/manage/delete',[TeamController::class,'group_delete']);
});