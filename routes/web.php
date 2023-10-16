<?php

use App\Http\Controllers\Pricing\PricingContoller;
use App\Http\Controllers\settings\BillingContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;


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
Route::redirect('/', 'login');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  require __DIR__ . '/ticketing.php';
  require __DIR__ . '/dev.php';


  $controller_path = 'App\Http\Controllers';

// Main Page Route
  Route::get('/home', $controller_path . '\dashboard\Analytics@index')->name('home');
  Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard');
  Route::get('/dashboard/analytics', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
  Route::get('/dashboard/crm', $controller_path . '\dashboard\Crm@index')->name('dashboard-crm');
  Route::get('/dashboard/ecommerce', $controller_path . '\dashboard\Ecommerce@index')->name('dashboard-ecommerce');

// locale
  Route::get('lang/{locale}', $controller_path . '\language\LanguageController@swap');

// users
  Route::get('/laravel/user-management', [UserManagement::class, 'UserManagement'])->name('laravel-example-user-management');
  Route::resource('/user-list', UserManagement::class);
//billing
Route::get('/billing/pricing/index',[BillingContoller::class, 'index'])->name('billing-pricing');
Route::resource('/billing',BillingContoller::class);
//pricing
Route::get('/pricing/show',[PricingContoller::class, 'index'])->name('pricing');
  Route::resource('/pricing',PricingContoller::class);
//});
});
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
//});
