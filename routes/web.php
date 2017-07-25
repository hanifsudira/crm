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

Route::get('/',['as' => 'home', 'uses' => function () {
    return redirect('crm/chart');
}]);

Route::group(['prefix' => 'crm'], function () {
    Route::get('data', [
        'as'        => 'home.data',
        'uses'      => 'HomeController@index'
    ]);
    Route::get('chart', [
        'as'        => 'home.chart',
        'uses'      => 'HomeController@chart'
    ]);

    //get data
    Route::get('getall',[
        'as'        => 'home.getall',
        'uses'      => 'HomeController@getall'
    ]);
});