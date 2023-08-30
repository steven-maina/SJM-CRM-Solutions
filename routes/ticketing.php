<?php


use App\Http\Controllers\Ticketing\TicketController;
use App\Http\Controllers\Ticketing\TicketsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/tickets/create',  [TicketController::class,'create'])->name('tickets.create');
//Route::get('/home', function () {
//  $route = Gate::denies('dashboard_access') ? 'admin.tickets.index' : 'admin.home';
//  if (session('status')) {
//    return redirect()->route($route)->with('status', session('status'));
//  }
//
//  return redirect()->route($route);
//});

//Auth::routes(['register' => false]);

Route::post('tickets/media', [TicketController::class, 'storeMedia'])->name('tickets.storeMedia');
Route::post('tickets/comment/{ticket}',  [TicketController::class, 'storeComment'])->name('tickets.storeComment');
Route::resource('tickets', 'Ticketing\TicketController')->only(['show', 'create', 'store']);

//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
//  Route::get('/', 'HomeController@index')->name('home');
  // Permissions
  Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
  Route::resource('permissions', 'PermissionsController');

  // Roles
  Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
  Route::resource('roles', 'RolesController');

  // Users
  Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
  Route::resource('users', 'UsersController');

  // Statuses
  Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
  Route::resource('statuses', 'StatusesController');

  // Priorities
  Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
  Route::resource('priorities', 'PrioritiesController');

  // Categories
  Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
  Route::resource('categories', 'CategoriesController');

  // Tickets
  Route::delete('tickets/destroy', [TicketsController::class, 'massDestroy'])->name('tickets.massDestroy');
  Route::post('tickets/media', [TicketsController::class, 'storeMedia'])->name('tickets.storeMedia');
  Route::post('tickets/comment/{ticket}', [TicketsController::class, 'storeComment'])->name('tickets.storeComment');
  Route::resource('tickets', TicketsController::class);

  // Comments
  Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
  Route::resource('comments', 'CommentsController');

  // Audit Logs
  Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
//});
