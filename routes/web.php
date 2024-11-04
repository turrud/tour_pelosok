<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TaghomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagaboutController;
use App\Http\Controllers\TagpackageController;
use App\Http\Controllers\TagexploreController;
use App\Http\Controllers\PermissionController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('homes', HomeController::class);
        Route::resource('taghomes', TaghomeController::class);
        Route::resource('abouts', AboutController::class);
        Route::resource('tagabouts', TagaboutController::class);

        // Team People
        Route::get('all-people', [PeopleController::class, 'index'])->name('all-people.index');
        Route::post('all-people', [PeopleController::class, 'store'])->name('all-people.store');
        Route::get('all-people/create', [PeopleController::class,'create',])->name('all-people.create');
        Route::get('all-people/{people}', [PeopleController::class,'show',])->name('all-people.show');
        Route::get('all-people/{people}/edit', [PeopleController::class,'edit',])->name('all-people.edit');
        Route::put('all-people/{people}', [PeopleController::class,'update',])->name('all-people.update');
        Route::delete('all-people/{people}', [PeopleController::class,'destroy',])->name('all-people.destroy');

        Route::resource('packages', PackageController::class);
        Route::resource('tagpackages', TagpackageController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('explores', ExploreController::class);
        Route::resource('tagexplores', TagexploreController::class);
        Route::resource('contacts', ContactController::class);
    });
