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

    Route::get('input', [
        'as'        => 'home.input',
        'uses'      => 'HomeController@input'
    ]);

    //get data
    Route::get('getall',[
        'as'        => 'home.getall',
        'uses'      => 'HomeController@getall'
    ]);

    Route::get('getbydate',[
        'as'        => 'home.getbydate',
        'uses'      => 'HomeController@getbydate'
    ]);

    Route::get('getbystatus',[
        'as'        => 'home.getbystatus',
        'uses'      => 'HomeController@getbystatus'
    ]);

    Route::get('getbysumber',[
        'as'        => 'home.getbysumber',
        'uses'      => 'HomeController@getbysumber'
    ]);

    Route::get('getbykategori',[
        'as'        => 'home.getbykategori',
        'uses'      => 'HomeController@getbykategori'
    ]);
});

Route::group(['prefix' => 'feedback'], function () {
    Route::get('input', [
        'as'        => 'feedback.input',
        'uses'      => 'FeedbackController@index'
    ]);
    Route::post('store', [
        'as'        => 'feedback.store',
        'uses'      => 'FeedbackController@store'
    ]);
});

Route::group(['prefix' => 'ora'], function () {
    Route::get('oraexcel', [
        'as'        => 'ora.oraexcel',
        'uses'      => 'OraController@index'
    ]);

    Route::get('oracount', [
        'as'        => 'ora.oracount',
        'uses'      => 'OraController@oracount'
    ]);

    //get
    Route::get('oraexcelget', [
        'as'        => 'ora.oraexcelget',
        'uses'      => 'OraController@getora'
    ]);

    Route::get('downloadexcel', [
        'as'        => 'ora.downloadexcel',
        'uses'      => 'OraController@downloadexcel'
    ]);
});

Route::group(['prefix' => 'force'], function () {
    Route::get('oraexcel', [
        'as'        => 'force.oraexcel',
        'uses'      => 'OraController@forceexcel'
    ]);

    Route::get('oracount', [
        'as'        => 'force.oracount',
        'uses'      => 'OraController@forcecount'
    ]);

});