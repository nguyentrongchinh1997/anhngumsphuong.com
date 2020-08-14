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

Route::get('/', 'SiteController@home')->name('home');
// =========================login google===========================
Route::get('auth/google', 'SiteController@redirectToGoogle');
Route::get('auth/google/callback', 'SiteController@handleGoogleCallback');
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