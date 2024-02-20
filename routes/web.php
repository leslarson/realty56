<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// // Load the db from the API, 9800 listings
// Route::get('loaddb', [HomeController::class, 'home']);


// Default operation - Show paginated listings without filtering
Route::get('/', [ListingController::class, 'showAllListings'])->name('login');

// Register, log in, and sign out a new user
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

// toggle the favorite symbol on a listing
Route::post('/favorite', [UserController::class, 'toggleFavorite'])->middleware('mustBeLoggedIn');

// Show user's favorite listings
Route::get('/favorites', [ListingController::class, 'showFavoriteListings'])->middleware('mustBeLoggedIn');

// Load city and zip code data for homepage search function
Route::get('/loadcity', [ListingController::class, 'getCityData']);
Route::get('/loadpostal', [ListingController::class, 'getPostalData']);

// Send an array of conditions to the listing class
Route::get('/simple',  [ListingController::class, 'simpleListings']);
Route::get('/custom',  [ListingController::class, 'customListings']);

Route::get('/listing/{data}', [ListingController::class, 'viewSingleListing']);

Route::any('{query}',
    function() { return redirect('/'); })
    ->where('query', '.*');
