<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;

use App\Http\Controllers\frontend\IndexController;



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

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard1');

 /*****************************Admin Related All Route*************************/

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');


/*****************************user profile and change the password***********************/

Route::prefix('profile')->group(function(){

    Route::get('/view',[AdminProfileController::class, 'ProfileView'])->name('admin.profile.view');

    Route::get('/edit',[AdminProfileController::class, 'ProfileEdit'])->name('admin.profile.edit');

    Route::post('/store',[AdminProfileController::class, 'ProfileStore'])->name('admin.profile.store');

    Route::get('/password/view',[AdminProfileController::class, 'PasswordView'])->name('admin.password.view');

    Route::post('/password/update',[AdminProfileController::class, 'PasswordUpdate'])->name('admin.password.update');

});

/***************************Admin Brand All Routes******************************************/

Route::prefix('brand')->group(function(){

  Route::get('/view',[BrandController::class, 'BrandView'])->name('all.brand');

  Route::post('/store',[BrandController::class, 'BrandStore'])->name('brand.store');

  Route::get('/edit/{id}',[BrandController::class, 'BrandEdit'])->name('brand.edit');

  Route::post('/update',[BrandController::class, 'BrandUpdate'])->name('brand.update');

  Route::get('/delete/{id}',[BrandController::class, 'BrandDelete'])->name('brand.delete');

});


/***************************Admin Category Routes******************************************/

Route::prefix('category')->group(function(){

  Route::get('/view',[CategoryController::class, 'CategoryView'])->name('all.category');

  Route::post('/store',[CategoryController::class, 'CategoryStore'])->name('category.store');

  Route::get('/edit/{id}',[CategoryController::class, 'CategoryEdit'])->name('category.edit');

  Route::post('/update',[CategoryController::class, 'CategoryUpdate'])->name('category.update');

  Route::get('/delete/{id}',[CategoryController::class, 'CategoryDelete'])->name('category.delete');

});



/*****************************User Related All Route*************************/

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');


Route::get('/',[IndexController::class,'index']);

Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');

Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');

Route::post('user/profile/update',[IndexController::class, 'UserProfileUpdate'])->name('user.profile.update');

Route::get('/user/change/password',[IndexController::class,'UserChangePassword'])->name('change.password');

Route::post('user/password/update',[IndexController::class, 'UserPasswordUpdate'])->name('user.password.change');


