<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TaghomeController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\TagaboutController;
use App\Http\Controllers\PageAboutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TagexploreController;
use App\Http\Controllers\TagpackageController;
use App\Http\Controllers\PageContactController;
use App\Http\Controllers\PageExploreController;
use App\Http\Controllers\PackageSearchController;



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

// page view
// Route::get('/', function () {
//     return view('welcome');
// });


// Route untuk PageHomeController (public)
Route::get('/', [PageHomeController::class, 'index'])->name('page.homes.index');

// Route resource untuk homes, tetapi mengecualikan index
Route::resource('homes', PageHomeController::class)->except(['index'])->names([
    'show' => 'page.homes.show',
    'create' => 'page.homes.create',
    'store' => 'page.homes.store',
    'edit' => 'page.homes.edit',
    'update' => 'page.homes.update',
    'destroy' => 'page.homes.destroy',
]);

// Page About
Route::resource('about', PageAboutController::class)->names([
    'index' => 'page.about.index',
    'show' => 'page.about.show',
    'create' => 'page.about.create',
    'store' => 'page.about.store',
    'edit' => 'page.about.edit',
    'update' => 'page.about.update',
    'destroy' => 'page.about.destroy',
]);
// Page Explore
Route::resource('explore', PageExploreController::class)->names([
    'index' => 'page.explore.index',
    'show' => 'page.explore.show',
    'create' => 'page.explore.create',
    'store' => 'page.explore.store',
    'edit' => 'page.explore.edit',
    'update' => 'page.explore.update',
    'destroy' => 'page.explore.destroy',
]);
// Page Explore package
// Route::get('package', [PackageSearchController::class, 'index'])->name('package.index');
// Route::get('package/{package}', [PackageSearchController::class, 'show'])->name('package.show');

Route::resource('package', PackageSearchController::class)->names([
    'index' => 'package.index',
    'show' => 'package.show',
    'create' => 'package.create',
    'store' => 'package.store',
    'edit' => 'package.edit',
    'update' => 'package.update',
    'destroy' => 'package.destroy',
]);

// Page Contact
Route::resource('contact', PageContactController::class)->names([
    'index' => 'page.contact.index',
    'show' => 'page.contact.show',
    'create' => 'page.contact.create',
    'store' => 'page.contact.store',
    'edit' => 'page.contact.edit',
    'update' => 'page.contact.update',
    'destroy' => 'page.contact.destroy',
]);
// ----




Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/dashboard')->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/dashboard')
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
        //

        Route::resource('packages', PackageController::class);
        Route::resource('tagpackages', TagpackageController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('explores', ExploreController::class);
        Route::resource('tagexplores', TagexploreController::class);
        Route::resource('contacts', ContactController::class);
    });