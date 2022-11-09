<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

//________users
Route::get('/login', function () {
    return view('login');
});
Route::post('/login',[usercontroller::class,'login']);

Route::get('/sign-in', function () {
    return view('signin');
});
Route::post('/sign-in',[usercontroller::class,'signin']);

Route::get('/logout',[usercontroller::class,'logout']);
Route::post('/user-panel',[usercontroller::class,'user_info_edit']);
//________Products
Route::get('/',[productController::class,'index']);
Route::get('/products/{category}',[productController::class,'products']);
Route::get('/details/{id}',[productController::class,'details']);
Route::post('/details/{id}',[productController::class,'add_comment']);
Route::get('/addtocart/{id}',[productController::class,'add_to_cart']);
Route::get('/cart-list',[productController::class,'cart_list']);
Route::get('/remove-cart/{id}',[productController::class,'remove_cart']);
Route::get('/order-place',[productController::class,'order_place']);
Route::post('/order-place',[productController::class,'order_now']);
Route::get('/search',[productController::class,'search']);
Route::get('/rate',[productController::class,'rate']);
Route::get('/user-panel',[productController::class,'user_panel']);
Route::get('/order-list/{group}',[productController::class,'order_list']);
Route::get('/comment-rate',[productController::class,'comment_rate']);
//________Admins
Route::get('/admin-panel',[adminController::class,'admin_panel']);
Route::post('/add-product',[adminController::class,'add_product']);
Route::get('/remove-product/{id}',[adminController::class,'remove_product']);
Route::get('/edit-product/{id}',[adminController::class,'edit_product']);
Route::post('/edit/{id}',[adminController::class,'edit']);
Route::get('/add-admin',[adminController::class,'admin_register']);
Route::post('/add-admin',[adminController::class,'admin_signin']);