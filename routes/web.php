<?php

use App\Models\Prediction;
use App\Models\UserSearch;
use Carbon\Carbon;
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
  //tutorial route:
Route::get('/tutorial', [App\Http\Controllers\ApiController::class, 'tutorial'])->name('tutorial');
Route::get('/', function () {
    return view('welcome')->with([
        'topAccidents' =>  Prediction::orderBy('accident_prediction','desc')->take(5)->get(),
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','check.active'
])->group(function () {

    Route::group(['middleware' => ['check.superadmin']], function()
    {
        Route::resource('/user-management', App\Http\Controllers\UserManagementController::class);
        Route::get('/user-management/sort/user', [App\Http\Controllers\UserManagementController::class, 'sortCount'])->name('sort.user');
        Route::get('/user-management/search/user', [App\Http\Controllers\UserManagementController::class, 'search'])->name('search.user');
    });
    //dashboard file charts route
    Route::get('/predictions', [App\Http\Controllers\ApiController::class, 'predictions'])->name('predictions');
    Route::get('/user_searches', [App\Http\Controllers\ApiController::class, 'user_searches'])->name('user_searches');
    Route::get('/total_accidents_per_location', [App\Http\Controllers\ApiController::class, 'total_accidents_per_location'])->name('total_accidents_per_location');
    Route::get('/dashboard', [App\Http\Controllers\ApiController::class, 'dashboard'])->name('dashboard');

  


    //taps api fetch
    Route::post('/taps/fetch', [App\Http\Controllers\ApiController::class, 'syncTapsApi'])->name('taps.sync');
    
    Route::get('/dashboard/sort', [App\Http\Controllers\ApiController::class, 'sortCount'])->name('sort.count');
    Route::get('/dashboard/search', [App\Http\Controllers\ApiController::class, 'search'])->name('search.count');
    
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/googlemap', [App\Http\Controllers\SettingsController::class, 'enableGoogleMap'])->name('googlemap.enable');

    Route::post('/upload/coordinates', [App\Http\Controllers\LocationController::class, 'uploadLocation'])->name('upload.location');
    Route::post('/export/coordinates', [App\Http\Controllers\LocationController::class, 'exportLocation'])->name('export.location');

    Route::get('/services', [App\Http\Controllers\PageController::class, 'services'])->name('services.index');
});

Route::get('/twitter', [App\Http\Controllers\ApiController::class, 'twitter'])->name('twitter.fetch');

Route::get('/test', [App\Http\Controllers\ApiController::class, 'test'])->name('test.twitter');


