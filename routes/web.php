<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/Employee/fetch','Cms\EmployeeController@index');
$router->get('/Employee/detail/{id}','Cms\EmployeeController@detail');
$router->post('/Employee/store','Cms\EmployeeController@store');
$router->put('/Employee/update/{id}','Cms\EmployeeController@update');
$router->delete('/Employee/delete/{id}','Cms\EmployeeController@delete');

$router->post('/Employee/login','Cms\AuthEmployeeController@login');

$router->get('/Banner/fetch','Cms\BannerController@index');
$router->get('/Banner/detail/{id}','Cms\BannerContoller@detail');
$router->post('/Banner/store','Cms\BannerController@store');
$router->put('/Banner/update/{id}','Cms\BannerController@update');
$router->delete('/Banner/delete/{id}','Cms\BannerController@delete');
