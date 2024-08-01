<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\MarchendiseController;
use App\Http\Controllers\api\MemberController;
use App\Http\Controllers\api\MemberMarchendiseController;
use App\Http\Controllers\api\MemberPointController;
use App\Http\Controllers\api\StoreController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    /*
    | ---------------------------------------------------
    | Role : Mall
    | ---------------------------------------------------
    | CRUD category -> point criteria
    | CRUD store -> store registration
    | CRUD marchendise -> marchendise
    | CR Point -> member_point
    | CR Member [store, member]
    */
    Route::group(['middleware' => 'role:mall'], function () {
        Route::group(['controller' => CategoryController::class, 'prefix' => '/store/category'], function () {
            Route::get('/', 'index')->name('category-list');
            Route::get('/create', 'create')->name('category-add'); //to do
            Route::post('/', 'store')->name('category-store');
            Route::get('/{id}', 'show')->name('category-detail-list');
            Route::get('/{id}/edit', 'edit')->name('category-edit'); //to do
            Route::put('/{id}', 'update')->name('category-update');
            Route::delete('/{id}', 'delete')->name('category-delete');
        });
        Route::group(['controller' => StoreController::class, 'prefix' => '/store'], function () {
            Route::get('/', 'index')->name('store-list');
            Route::get('/create', 'create')->name('store-add'); //to do
            Route::post('/', 'store')->name('store-store');
            Route::get('/{id}', 'show')->name('store-detail-list');
            Route::get('/{id}/edit', 'edit')->name('store-edit'); //to do
            Route::put('/{id}', 'update')->name('store-update');
            Route::delete('/{id}', 'delete')->name('store-delete');
        });
        Route::group(['controller' => MarchendiseController::class, 'prefix' => '/marchendise'], function () {
            Route::get('/', 'index')->name('store-list');
            Route::get('/create', 'create')->name('store-add'); //to do
            Route::post('/', 'store')->name('store-store');
            Route::get('/{id}', 'show')->name('store-detail-list');
            Route::get('/{id}/edit', 'edit')->name('store-edit'); //to do
            Route::put('/{id}', 'update')->name('store-update');
            Route::delete('/{id}', 'delete')->name('store-delete');
        });
        Route::group(['controller' => MemberPointController::class, 'prefix' => '/point'], function(){
            Route::get('/', 'index')->name('memberpoint-list');
            Route::get('/{id}', 'show')->name('memberpoint-detail-list');
            Route::post('/', 'store')->name('memberpoint-store');
        });
        Route::group(['controller'=> MemberController::class, 'prefix' => '/member'], function() {
            Route::get('/', 'index')->name('member-list');
            Route::post('/', 'store')->name('member-add');
            Route::get('/{id}', 'show')->name('member-detail-list');
        });
    });

    /*
    | ---------------------------------------------------
    | Role : Store
    | ---------------------------------------------------
    | CR Point -> member_point for store self
    */
    Route::group(['middleware' => 'role:store'], function () {
        Route::group(['controller' => MemberPointController::class, 'prefix' => '/point'], function(){
            Route::get('/', 'index')->name('memberpoint-list');
            Route::get('/{id}', 'show')->name('memberpoint-detail-list');
            Route::post('/', 'store')->name('memberpoint-store');
        });
    });

    /*
    | ---------------------------------------------------
    | Role : Member
    | ---------------------------------------------------
    | CRUD member_marchendise -> exchange point
    | R Point -> member_point read
    | CR Member [member]
    */
    Route::group(['middleware' => 'role:member'], function () {
        Route::group(['controller' => MemberPointController::class, 'prefix' => '/point'], function(){
            Route::get('/', 'index')->name('memberpoint-list');
        });
        Route::group(['controller' => MemberMarchendiseController::class, 'prefix' => '/point'], function(){
            Route::get('/', 'index')->name('memberpoint-list');
            Route::get('/{id}', 'show')->name('memberpoint-detail-list');
            Route::post('/', 'store')->name('memberpoint-store');
        });
    });
});
