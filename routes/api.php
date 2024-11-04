<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\TaghomeController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ExploreController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\TagaboutController;
use App\Http\Controllers\Api\HomeImageController;
use App\Http\Controllers\Api\AboutImageController;
use App\Http\Controllers\Api\TagpackageController;
use App\Http\Controllers\Api\TagexploreController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\HomeTaghomesController;
use App\Http\Controllers\Api\home_taghomeController;
use App\Http\Controllers\Api\TaghomeHomesController;
use App\Http\Controllers\Api\PackageImageController;
use App\Http\Controllers\Api\ExploreImageController;
use App\Http\Controllers\Api\HomeHomeImagesController;
use App\Http\Controllers\Api\AboutTagaboutsController;
use App\Http\Controllers\Api\TagaboutAboutsController;
use App\Http\Controllers\Api\about_tagaboutController;
use App\Http\Controllers\Api\AboutAboutImagesController;
use App\Http\Controllers\Api\PackageTagpackagesController;
use App\Http\Controllers\Api\TagpackagePackagesController;
use App\Http\Controllers\Api\package_tagpackageController;
use App\Http\Controllers\Api\ExploreTagexploresController;
use App\Http\Controllers\Api\TagexploreExploresController;
use App\Http\Controllers\Api\explore_tagexploreController;
use App\Http\Controllers\Api\PackagePackageImagesController;
use App\Http\Controllers\Api\ExploreExploreImagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('homes', HomeController::class);

        // Home Home Images
        Route::get('/homes/{home}/home-images', [
            HomeHomeImagesController::class,
            'index',
        ])->name('homes.home-images.index');
        Route::post('/homes/{home}/home-images', [
            HomeHomeImagesController::class,
            'store',
        ])->name('homes.home-images.store');

        // Home Taghomes
        Route::get('/homes/{home}/taghomes', [
            HomeTaghomesController::class,
            'index',
        ])->name('homes.taghomes.index');
        Route::post('/homes/{home}/taghomes/{taghome}', [
            HomeTaghomesController::class,
            'store',
        ])->name('homes.taghomes.store');
        Route::delete('/homes/{home}/taghomes/{taghome}', [
            HomeTaghomesController::class,
            'destroy',
        ])->name('homes.taghomes.destroy');

        Route::apiResource('taghomes', TaghomeController::class);

        // Taghome Homes
        Route::get('/taghomes/{taghome}/homes', [
            TaghomeHomesController::class,
            'index',
        ])->name('taghomes.homes.index');
        Route::post('/taghomes/{taghome}/homes/{home}', [
            TaghomeHomesController::class,
            'store',
        ])->name('taghomes.homes.store');
        Route::delete('/taghomes/{taghome}/homes/{home}', [
            TaghomeHomesController::class,
            'destroy',
        ])->name('taghomes.homes.destroy');

        Route::apiResource('abouts', AboutController::class);

        // About About Images
        Route::get('/abouts/{about}/about-images', [
            AboutAboutImagesController::class,
            'index',
        ])->name('abouts.about-images.index');
        Route::post('/abouts/{about}/about-images', [
            AboutAboutImagesController::class,
            'store',
        ])->name('abouts.about-images.store');

        // About Tagabouts
        Route::get('/abouts/{about}/tagabouts', [
            AboutTagaboutsController::class,
            'index',
        ])->name('abouts.tagabouts.index');
        Route::post('/abouts/{about}/tagabouts/{tagabout}', [
            AboutTagaboutsController::class,
            'store',
        ])->name('abouts.tagabouts.store');
        Route::delete('/abouts/{about}/tagabouts/{tagabout}', [
            AboutTagaboutsController::class,
            'destroy',
        ])->name('abouts.tagabouts.destroy');

        Route::apiResource('tagabouts', TagaboutController::class);

        // Tagabout Abouts
        Route::get('/tagabouts/{tagabout}/abouts', [
            TagaboutAboutsController::class,
            'index',
        ])->name('tagabouts.abouts.index');
        Route::post('/tagabouts/{tagabout}/abouts/{about}', [
            TagaboutAboutsController::class,
            'store',
        ])->name('tagabouts.abouts.store');
        Route::delete('/tagabouts/{tagabout}/abouts/{about}', [
            TagaboutAboutsController::class,
            'destroy',
        ])->name('tagabouts.abouts.destroy');

        Route::apiResource('all-people', PeopleController::class);

        Route::apiResource('packages', PackageController::class);

        // Package Package Images
        Route::get('/packages/{package}/package-images', [
            PackagePackageImagesController::class,
            'index',
        ])->name('packages.package-images.index');
        Route::post('/packages/{package}/package-images', [
            PackagePackageImagesController::class,
            'store',
        ])->name('packages.package-images.store');

        // Package Tagpackages
        Route::get('/packages/{package}/tagpackages', [
            PackageTagpackagesController::class,
            'index',
        ])->name('packages.tagpackages.index');
        Route::post('/packages/{package}/tagpackages/{tagpackage}', [
            PackageTagpackagesController::class,
            'store',
        ])->name('packages.tagpackages.store');
        Route::delete('/packages/{package}/tagpackages/{tagpackage}', [
            PackageTagpackagesController::class,
            'destroy',
        ])->name('packages.tagpackages.destroy');

        Route::apiResource('tagpackages', TagpackageController::class);

        // Tagpackage Packages
        Route::get('/tagpackages/{tagpackage}/packages', [
            TagpackagePackagesController::class,
            'index',
        ])->name('tagpackages.packages.index');
        Route::post('/tagpackages/{tagpackage}/packages/{package}', [
            TagpackagePackagesController::class,
            'store',
        ])->name('tagpackages.packages.store');
        Route::delete('/tagpackages/{tagpackage}/packages/{package}', [
            TagpackagePackagesController::class,
            'destroy',
        ])->name('tagpackages.packages.destroy');

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('explores', ExploreController::class);

        // Explore Explore Images
        Route::get('/explores/{explore}/explore-images', [
            ExploreExploreImagesController::class,
            'index',
        ])->name('explores.explore-images.index');
        Route::post('/explores/{explore}/explore-images', [
            ExploreExploreImagesController::class,
            'store',
        ])->name('explores.explore-images.store');

        // Explore Tagexplores
        Route::get('/explores/{explore}/tagexplores', [
            ExploreTagexploresController::class,
            'index',
        ])->name('explores.tagexplores.index');
        Route::post('/explores/{explore}/tagexplores/{tagexplore}', [
            ExploreTagexploresController::class,
            'store',
        ])->name('explores.tagexplores.store');
        Route::delete('/explores/{explore}/tagexplores/{tagexplore}', [
            ExploreTagexploresController::class,
            'destroy',
        ])->name('explores.tagexplores.destroy');

        Route::apiResource('tagexplores', TagexploreController::class);

        // Tagexplore Explores
        Route::get('/tagexplores/{tagexplore}/explores', [
            TagexploreExploresController::class,
            'index',
        ])->name('tagexplores.explores.index');
        Route::post('/tagexplores/{tagexplore}/explores/{explore}', [
            TagexploreExploresController::class,
            'store',
        ])->name('tagexplores.explores.store');
        Route::delete('/tagexplores/{tagexplore}/explores/{explore}', [
            TagexploreExploresController::class,
            'destroy',
        ])->name('tagexplores.explores.destroy');

        Route::apiResource('contacts', ContactController::class);
    });
