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

Route::get('admin/login',[App\Http\Controllers\WebController::class, 'admin_login']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Auth::routes();
Route::get('admin/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'admin_dashboard']);
Route::get('admin/view_categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
Route::get('admin/view_industries', [App\Http\Controllers\Admin\IndustryController::class, 'index']);
Route::get('admin/view_portfolios', [App\Http\Controllers\Admin\PortfolioController::class, 'index']);
Route::get('admin/view_websites', [App\Http\Controllers\Admin\WebsiteController::class, 'index']);
Route::post('admin/delete_portfolio_image', [App\Http\Controllers\Admin\PortfolioController::class, 'delete_portfolio_image']);
Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
Route::resource('industries', App\Http\Controllers\Admin\IndustryController::class);
Route::resource('websites', App\Http\Controllers\Admin\WebsiteController::class);
Route::prefix('admin')->name('admin.')->group(function () {
  Route::resource('portfolios', App\Http\Controllers\Admin\PortfolioController::class);
});
