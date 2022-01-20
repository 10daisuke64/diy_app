<?php

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
    return view('welcome');
});

Auth::routes();

// ホーム
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// マルチ認証
// ログイン
Route::get('/multi_login', [\App\Http\Controllers\MultiAuthController::class, 'showLoginForm']);
Route::post('/multi_login', [\App\Http\Controllers\MultiAuthController::class, 'login']);

// ログアウト
Route::get('/multi_login/logout', [\App\Http\Controllers\MultiAuthController::class, 'logout']);

// ログイン後のページ
// diyer
Route::prefix('diyers')->middleware('auth:diyers')->group(function(){

    Route::get('/dashboard', [App\Http\Controllers\MultiAuthController::class, 'get_diyer_dashboard'])->name('diyer_dashboard');

    Route::get('/ask', [App\Http\Controllers\PagesController::class, 'get_ask'])->name('ask');

    // 質問ページの送信先
    Route::post('/register_question', [App\Http\Controllers\PagesController::class, 'register_question'])->name('register_question');

});

// mentor
Route::prefix('mentors')->middleware('auth:mentors')->group(function(){

    Route::get('/dashboard', [App\Http\Controllers\MultiAuthController::class, 'get_mentor_dashboard'])->name('mentor_dashboard');

    Route::get('/answer', [App\Http\Controllers\PagesController::class, 'get_answer'])->name('answer');

    // 質問ページの送信先
    Route::post('/register_answer', [App\Http\Controllers\PagesController::class, 'register_answer'])->name('register_answer');

});
