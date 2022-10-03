<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;

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

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
$pages = Page::all();
foreach ($pages as $page) {
    Route::get('/'.$page->slug.'', function() use($page) {
        return view('frontend.page',compact('page'));
    });
}

// Frontend
Route::get('success', [App\Http\Controllers\HomeController::class, 'success'])->name('success');
Route::get('wishlist', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist')->middleware('auth');
Route::get('cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart')->middleware('auth');
Route::get('checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('tours', [App\Http\Controllers\FrontendController::class, 'tour'])->name('tour');
Route::get('tours/{id}', [App\Http\Controllers\FrontendController::class, 'tourShow'])->name('tour.show');

// Newsletter
Route::post('/newsletter/store', [App\Http\Controllers\HomeController::class, 'newsletter'])->name('newsletter.store');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function(){
    // Dashboard
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    // Profile
    Route::get('profile', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('profile');
    Route::patch('profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('profile.update');
    // Users
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'userList'])->name('users');
    Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::get('users/activate/{id}', [App\Http\Controllers\Admin\UserController::class, 'activate'])->name('users.activate');
    Route::get('users/deactivate/{id}', [App\Http\Controllers\Admin\UserController::class, 'deactivate'])->name('users.deactivate');
    // Page
    Route::get('pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages');
    Route::get('pages/{id}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('pages.edit');
    Route::get('pages/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('pages.create');
    Route::post('pages/store', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
    Route::patch('pages/{id}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('pages.update');
    Route::get('pages/activate/{id}', [App\Http\Controllers\Admin\PageController::class, 'activate'])->name('pages.activate');
    Route::get('pages/deactivate/{id}', [App\Http\Controllers\Admin\PageController::class, 'deactivate'])->name('pages.deactivate');
    Route::delete('pages/destroy/{id}', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');
    // Testimonials
    Route::get('testimonials', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials');
    Route::get('testimonials/create', [App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('testimonials/store', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('testimonials/{id}/edit', [App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::patch('testimonials/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('testimonials.update');
    Route::get('testimonials/activate/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'activate'])->name('testimonials.activate');
    Route::get('testimonials/deactivate/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'deactivate'])->name('testimonials.deactivate');
    Route::delete('testimonials/destroy/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    // Country
    Route::get('country', [App\Http\Controllers\Admin\CountryController::class, 'index'])->name('country');
    Route::get('country/create', [App\Http\Controllers\Admin\CountryController::class, 'create'])->name('country.create');
    Route::post('country/store', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('country.store');
    Route::get('country/{id}/edit', [App\Http\Controllers\Admin\CountryController::class, 'edit'])->name('country.edit');
    Route::patch('country/{id}', [App\Http\Controllers\Admin\CountryController::class, 'update'])->name('country.update');
    Route::delete('country/destroy/{id}', [App\Http\Controllers\Admin\CountryController::class, 'destroy'])->name('country.destroy');
    // City
    Route::get('city', [App\Http\Controllers\Admin\CityController::class, 'index'])->name('city');
    Route::get('city/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('city.create');
    Route::post('city/store', [App\Http\Controllers\Admin\CityController::class, 'store'])->name('city.store');
    Route::get('city/{id}/edit', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('city.edit');
    Route::patch('city/{id}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('city.update');
    Route::delete('city/destroy/{id}', [App\Http\Controllers\Admin\CityController::class, 'destroy'])->name('city.destroy');
});

Route::group(['as'=>'customer.','prefix'=>'customer','namespace'=>'Customer','middleware'=>['auth','customer']], function(){
    Route::get('dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\Customer\UserController::class, 'index'])->name('profile');
    Route::patch('profile/{id}', [App\Http\Controllers\Customer\UserController::class, 'update'])->name('profile.update');
});
