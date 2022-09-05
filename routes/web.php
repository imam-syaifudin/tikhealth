<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KategoriController;
use App\Http\Middleware\AdminGuard;
use Illuminate\Support\Facades\Auth;

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




Auth::routes();

// Guest Url
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/index', [App\Http\Controllers\IndexController::class, 'index']);
route::get('member/{member}/edit',[MemberController::class,'edit']);
route::get('artikel/{artikel}/edit',[ArtikelController::class,'edit']);
route::get('user/{user}/edit',[UserController::class,'edit']);
route::get('kategori/{kategori}/edit',[KategoriController::class,'edit']);
route::get('member/hapus/{member}',[MemberController::class,'destroy']);
route::get('user/hapus/{user}',[UserController::class,'destroy']);
route::get('artikel/hapus/{user}',[ArtikelController::class,'destroy']);
route::get('kategori/hapus/{user}',[KategoriController::class,'destroy']);
route::get('artikels/{artikel}',[ArtikelController::class,'show']);


route::get('artikel/view/{artikel}',[ArtikelController::class,'show'])->name('soloartikel');
route::get('artikel/view/user/{artikel}',[ArtikelController::class,'viewUser']);  
route::get('artikel/view/date/{artikel}',[ArtikelController::class,'viewDate']);  
route::get('kategori/view/{kategori}',[KategoriController::class,'solokategori'])->name('solokategori');    

Route::resource('artikel', ArtikelController::class);
Route::resource('kategori', KategoriController::class);
route::get('index/cari',[IndexController::class,'cari']);

Route::middleware('auth')->group(function () {
    route::get('/artikel',[ArtikelController::class,'index']);
    route::get('/kategori',[KategoriController::class,'index']); 
    route::get('/home/cari',[HomeController::class,'cari']);
});

Route::middleware('role:admin')->group(function () {
    Route::middleware('auth')->group(function() {
         route::resource('member',MemberController::class);
         route::resource('user', UserController::class);
         route::get('/users',[MemberController::class,'index']);
         route::get('/editors',[UserController::class,'editor']);
    }); 
});





