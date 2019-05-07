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

Route::get('/', 'PagesController@index');
Route::get('/search', 'PagesController@search');

// Route::get('/companies', 'PagesController@companies');

Route::get('/destinations', 'PagesController@destinations');
// Route::get('/itineraires', 'PagesController@itineraires');

Route::get('/services', 'PagesController@services');

Route::get('/reservation', 'PagesController@reservation');

Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');


// Dark side Mounyahaha

Route::get('/dashboard', 'AdminController@index');
//
Route::resource('/dashboard/itineraires', 'ItinerairesController');
Route::resource('/dashboard/newsletter', 'NewsletterController');
Route::resource('/dashboard/questions', 'QuestionsController');
Route::resource('/dashboard/roles', 'RolesController');
Route::resource('/dashboard/villes', 'VillesController');
Route::resource('/dashboard/voyages', 'VoyagesController');
Route::resource('/dashboard/voyageurs', 'VoyageursController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
