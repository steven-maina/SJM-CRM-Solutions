<?php


use App\Http\Controllers\Ticketing\CategoriesController;
use App\Http\Controllers\Ticketing\CommentsController;
use App\Http\Controllers\Ticketing\PrioritiesController;
use App\Http\Controllers\Ticketing\StatusesController;
use App\Http\Controllers\Ticketing\TicketController;
use App\Http\Controllers\Ticketing\TicketsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/tickets/create',  [TicketController::class,'create'])->name('tickets.create');
//Route::get('/home', function () {
//  $route = Auth::check() ? 'tickets.index' : 'home';
//  if (session('status')) {
//    return redirect()->route($route)->with('status', session('status'));
//  }
//
//  return redirect()->route($route);
//});
//Route::get('/admin/tickets', [TicketController::class,'index'])->name('tickets.index');

//Auth::routes(['register' => false]);

Route::post('tickets/media', [TicketController::class, 'storeMedia'])->name('tickets.storeMedia');
Route::post('tickets/comment/{ticket}',  [TicketController::class, 'storeComment'])->name('tickets.storeComment');
Route::resource('ticket', 'Ticketing\TicketController')->only(['show', 'create', 'store']);

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
  Route::delete('statuses/destroy', [StatusesController::class,'massDestroy'])->name('statuses.massDestroy');
  Route::resource('statuses', StatusesController::class);

  // Priorities
  Route::delete('priorities/destroy', [PrioritiesController::class, 'massDestroy'])->name('priorities.massDestroy');
  Route::resource('priorities', PrioritiesController::class);

  // Categories
  Route::delete('categories/destroy', [CategoriesController::class,'massDestroy'])->name('categories.massDestroy');
  Route::resource('categories', CategoriesController::class);

  // Tickets
  Route::delete('tickets/destroy', [TicketsController::class, 'massDestroy'])->name('tickets.massDestroy');
  Route::post('tickets/media', [TicketsController::class, 'storeMedia'])->name('tickets.storeMedia');
  Route::post('tickets/comment/{ticket}', [TicketsController::class, 'storeComment'])->name('tickets.storeComment');
  Route::resource('tickets', TicketsController::class);

  // Comments
  Route::delete('comments/destroy', [CommentsController::class,'massDestroy'])->name('comments.massDestroy');
  Route::resource('comments', CommentsController::class);

  // Audit Logs
  Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
//});
