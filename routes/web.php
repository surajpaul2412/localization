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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
$pages = Page::all();
foreach ($pages as $page) {
    Route::get('/'.$page->slug.'', function() use($page) {
        return view('frontend.page',compact('page'));
    });
}

// Frontend
Route::get('success', [App\Http\Controllers\HomeController::class, 'success'])->name('success');
Route::get('wishlist', [App\Http\Controllers\HomeController::class, 'wishlist'])->name('wishlist')->middleware('auth');
Route::get('wishlist/add/{productId}', [App\Http\Controllers\HomeController::class, 'wishlistAdd'])->name('wishlist.add')->middleware('auth');
Route::get('wishlist/remove/{id}', [App\Http\Controllers\HomeController::class, 'wishlistRemove'])->name('wishlist.remove')->middleware('auth');
Route::get('wishlist/moveToCart/{id}', [App\Http\Controllers\HomeController::class, 'wishlistMoveToCart'])->name('wishlist.moveToCart')->middleware('auth');

Route::get('cart', [App\Http\Controllers\FrontendController::class, 'cart'])->name('cart');
Route::post('cart/add/{packageId}', [App\Http\Controllers\FrontendController::class, 'cartAdd'])->name('cart.add');
Route::get('cart/remove/{id}', [App\Http\Controllers\FrontendController::class, 'cartRemove'])->name('cart.remove');
Route::get('cart/moveToWishlist/{id}', [App\Http\Controllers\HomeController::class, 'cartMoveToWishlist'])->name('cart.moveToWishlist')->middleware('auth');
Route::get('cart/edit/{id}', [App\Http\Controllers\FrontendController::class, 'cartEdit'])->name('cart.edit');
Route::patch('cart/{id}', [App\Http\Controllers\FrontendController::class, 'cartUpdate'])->name('cart.update');


Route::get('checkout', [App\Http\Controllers\FrontendController::class, 'checkout'])->name('checkout');
Route::get('tours', [App\Http\Controllers\FrontendController::class, 'tour'])->name('tour');
Route::get('tours/{slug}', [App\Http\Controllers\FrontendController::class, 'tourShow'])->name('tour.show');
Route::get('search/city/{id}', [App\Http\Controllers\FrontendController::class, 'searchCity'])->name('search.city');
Route::get('search/category/{id}', [App\Http\Controllers\FrontendController::class, 'searchCategory'])->name('search.category');
Route::get('search/activity/{id}', [App\Http\Controllers\FrontendController::class, 'searchActivity'])->name('search.activity');
Route::post('search', [App\Http\Controllers\FrontendController::class, 'search'])->name('search');

// Admin Login
Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/start', [App\Http\Controllers\Admin\LoginController::class, 'postLogin'])->name('admin.postLogin');

// Newsletter
Route::post('/newsletter/store', [App\Http\Controllers\FrontendController::class, 'newsletter'])->name('newsletter.store');

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
    Route::get('country/activate/{id}', [App\Http\Controllers\Admin\CountryController::class, 'activate'])->name('country.activate');
    Route::get('country/deactivate/{id}', [App\Http\Controllers\Admin\CountryController::class, 'deactivate'])->name('country.deactivate');
    // City
    Route::get('city', [App\Http\Controllers\Admin\CityController::class, 'index'])->name('city');
    Route::get('city/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('city.create');
    Route::post('city/store', [App\Http\Controllers\Admin\CityController::class, 'store'])->name('city.store');
    Route::get('city/{id}/edit', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('city.edit');
    Route::patch('city/{id}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('city.update');
    Route::delete('city/destroy/{id}', [App\Http\Controllers\Admin\CityController::class, 'destroy'])->name('city.destroy');
    // Category
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/destroy/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/activate/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'activate'])->name('category.activate');
    Route::get('category/deactivate/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deactivate'])->name('category.deactivate');
    // Amenities
    Route::get('amenities', [App\Http\Controllers\Admin\AmenityController::class, 'index'])->name('amenities');
    Route::get('amenities/create', [App\Http\Controllers\Admin\AmenityController::class, 'create'])->name('amenities.create');
    Route::post('amenities/store', [App\Http\Controllers\Admin\AmenityController::class, 'store'])->name('amenities.store');
    Route::get('amenities/{id}/edit', [App\Http\Controllers\Admin\AmenityController::class, 'edit'])->name('amenities.edit');
    Route::patch('amenities/{id}', [App\Http\Controllers\Admin\AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('amenities/destroy/{id}', [App\Http\Controllers\Admin\AmenityController::class, 'destroy'])->name('amenities.destroy');
    Route::get('amenities/activate/{id}', [App\Http\Controllers\Admin\AmenityController::class, 'activate'])->name('amenities.activate');
    Route::get('amenities/deactivate/{id}', [App\Http\Controllers\Admin\AmenityController::class, 'deactivate'])->name('amenities.deactivate');
    // Activities
    Route::get('activities', [App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('activities');
    Route::get('activities/create', [App\Http\Controllers\Admin\ActivityController::class, 'create'])->name('activities.create');
    Route::post('activities/store', [App\Http\Controllers\Admin\ActivityController::class, 'store'])->name('activities.store');
    Route::get('activities/{id}/edit', [App\Http\Controllers\Admin\ActivityController::class, 'edit'])->name('activities.edit');
    Route::patch('activities/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'update'])->name('activities.update');
    Route::delete('activities/destroy/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'destroy'])->name('activities.destroy');
    Route::get('activities/activate/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'activate'])->name('activities.activate');
    Route::get('activities/deactivate/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'deactivate'])->name('activities.deactivate');
    // Packages/Tours
    Route::get('tours', [App\Http\Controllers\Admin\PackageController::class, 'index'])->name('tours');
    Route::get('tours/create', [App\Http\Controllers\Admin\PackageController::class, 'create'])->name('tours.create');
    Route::post('tours/store', [App\Http\Controllers\Admin\PackageController::class, 'store'])->name('tours.store');
    Route::get('tours/{id}/edit', [App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('tours.edit');
    Route::patch('tours/{id}', [App\Http\Controllers\Admin\PackageController::class, 'update'])->name('tours.update');
    Route::delete('tours/destroy/{id}', [App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('tours.destroy');
    Route::get('tours/activate/{id}', [App\Http\Controllers\Admin\PackageController::class, 'activate'])->name('tours.activate');
    Route::get('tours/deactivate/{id}', [App\Http\Controllers\Admin\PackageController::class, 'deactivate'])->name('tours.deactivate');
});

Route::group(['as'=>'customer.','prefix'=>'customer','namespace'=>'Customer','middleware'=>['auth','customer']], function(){
    Route::get('dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\Customer\UserController::class, 'index'])->name('profile');
    Route::patch('profile/{id}', [App\Http\Controllers\Customer\UserController::class, 'update'])->name('profile.update');
});
