<?php

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
use App\Model\Restaurant;

Route::get('ads', function(){
    $highRateRestaurant = Restaurant::all()->random(6);

    return view('pages.ads', ['highRateRestaurant' => $highRateRestaurant]); 
});
Route::get('/', 'SiteController@home')->name('home');
// =========================login google===========================
Route::get('auth/google', 'SiteController@redirectToGoogle');
Route::get('auth/google/callback', 'SiteController@handleGoogleCallback');
// =========================end====================================
// =========================login facebook=========================
Route::get('/auth/redirect/facebook', 'SiteController@redirectFacebook')->name('login-facebook');
Route::get('auth/facebook/callback', 'SiteController@callbackFacebook');
// =========================end====================================
Route::get('search', 'SiteController@search')->name('search');
Route::get('nha-hang-{name}-{id}', 'SiteController@restaurantList')->where(array('id' => '[0-9]+', 'name' => '[a-z0-9\-]+'))->name('restaurant-list');
Route::get('review-nha-hang-{slug}-{id}', 'SiteController@detail')->where(array('id' => '[0-9]+', 'slug' => '[a-z0-9\-]+'))->name('detail');
Route::get('dang-nhap', 'SiteController@loginForm')->name('login-form');
Route::post('dang-nhap', 'SiteController@login')->name('login');
Route::get('dang-ky', 'SiteController@signupForm')->name('signup-form');
Route::post('dang-ky', 'SiteController@signup')->name('signup');
Route::get('dang-xuat', 'SiteController@logout')->name('logout');
Route::post('danh-gia', 'SiteController@review')->name('review');
Route::get('them-nha-hang', 'SiteController@addRestaurantForm')->name('add-restaurant');
Route::post('them-nha-hang', 'SiteController@addRestaurant')->name('add_restaurant');
Route::get('clone', 'SiteController@clone');
// Route::get('clone-foody', function(){
//     $html = file_get_html_custom('https://www.foody.vn/ho-chi-minh/buffet?CategoryGroup=food&c=buffet');
//     //$title = $html->find('.main-info-title h1', 0)->plaintext;
//     // $price = $html->find('.res-common-minmaxprice', 0)->plaintext;
//     // $time = $html->find('.micro-timesopen span', 2)->plaintext;
//     // $address = $html->find('.res-common-add', 0)->plaintext;
//     // $og_image = $html->find("meta[property='og:image']", 0)->content;
//     echo $html;
// });
Route::get('clone-foody', 'SiteController@foodyClone');
