<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

//Users

Route::get('/users/{id}', 'UserController@view');

Route::get('/users/{id}/update', 'UserController@update');

Route::post('/users/{id}/update', 'UserController@update');

//Companies

Route::get('/companies/create', 'CompanyController@create');

Route::post('/companies/create', 'CompanyController@create');

Route::get('/companies/{id}/update', 'CompanyController@update');

Route::post('/companies/{id}/update', 'CompanyController@update');

//Preinscription

/*Route::get('/preinscription', 'PreinscriptionController@index');

Route::get('/preinscription/term/{term_id}', 'PreinscriptionController@term');

Route::post('/preinscription/term/{term_id}/upload', 'PreinscriptionController@upload');*/

//Projects

Route::get('/projects/register', 'ProjectController@create');

Route::post('/projects/register', 'ProjectController@create');

Route::get('/projects', 'ProjectController@index');

Route::get('/projects/{id}/update', 'ProjectController@update');

Route::post('/projects/{id}/update', 'ProjectController@update');

Route::get('/projects/{id}', 'ProjectController@view');

//Project Comments

Route::post('/projects/comment/{id}', 'ProjectCommentController@create');

Route::delete('/projects/comment/{id}', 'ProjectCommentController@destroy');

//Results

Route::post('/results/create/{id}', 'ResultController@create');

Route::get('/results/{id}/update', 'ResultController@update');

Route::post('/results/{id}/update', 'ResultController@update');

Route::delete('/results/{id}', 'ResultController@destroy');

//Products

Route::post('/products/create', 'ProductController@create');

Route::get('/products/{id}/update', 'ProductController@update');

Route::post('/products/{id}/update', 'ProductController@update');

Route::delete('/products/{id}', 'ProductController@destroy');

//Entities

Route::get('/entities/register', 'EntityController@create');

Route::post('/entities/register', 'EntityController@create');

Route::get('/entities/{id}/update', 'EntityController@update');

Route::post('/entities/{id}/update', 'EntityController@update');

Route::delete('/entities/{id}', 'EntityController@destroy');


//Costs

Route::post('/costs/create/{id}', 'CostController@create');

Route::get('/costs/{id}/update', 'CostController@update');

Route::post('/costs/{id}/update', 'CostController@update');

Route::delete('/costs/{id}', 'CostController@destroy');
