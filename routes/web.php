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
    return redirect('report/intreport');
}]);

// Route::group(['prefix' => 'crm'], function () {
//     Route::get('data', [
//         'as'        => 'home.data',
//         'uses'      => 'HomeController@index'
//     ]);

//     Route::get('chart', [
//         'as'        => 'home.chart',
//         'uses'      => 'HomeController@chart'
//     ]);

//     Route::get('input', [
//         'as'        => 'home.input',
//         'uses'      => 'HomeController@input'
//     ]);

//     //get data
//     Route::get('getall',[
//         'as'        => 'home.getall',
//         'uses'      => 'HomeController@getall'
//     ]);

//     Route::get('getbydate',[
//         'as'        => 'home.getbydate',
//         'uses'      => 'HomeController@getbydate'
//     ]);

//     Route::get('getbystatus',[
//         'as'        => 'home.getbystatus',
//         'uses'      => 'HomeController@getbystatus'
//     ]);

//     Route::get('getbysumber',[
//         'as'        => 'home.getbysumber',
//         'uses'      => 'HomeController@getbysumber'
//     ]);

//     Route::get('getbykategori',[
//         'as'        => 'home.getbykategori',
//         'uses'      => 'HomeController@getbykategori'
//     ]);
// });

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

Route::group(['prefix' => 'report'], function () {
    Route::get('allreport', [
        'as'        => 'report.allreport',
        'uses'      => 'ReportController@allreport'
    ]);

    Route::get('reviewtransaksi', [
        'as'        => 'report.reviewtransaksi',
        'uses'      => 'ReportController@reviewtransaksi'
    ]);

    Route::get('flowreport', [
        'as'        => 'report.flowreport',
        'uses'      => 'ReportController@flowreport'
    ]);

    Route::get('flowdatareturn', [
        'as'        => 'report.flowdatareturn',
        'uses'      => 'ReportController@flowdatareturn'
    ]);

    Route::get('intreport', [
        'as'        => 'report.intreport',
        'uses'      => 'ReportController@intreport'
    ]);

    Route::get('getorderdetail/{status}/{milestone}/{report}/{state}',[
        'as'        => 'ora.getorderdetail',
        'uses'      => 'ReportController@getorderdetail'
    ]);

    Route::get('tomsomget', [
        'as'        => 'report.tomsomget',
        'uses'      => 'ReportController@tomsomget'
    ]);

    Route::get('getorderactiondetail', [
        'as'        => 'report.getorderactiondetail',
        'uses'      => 'ReportController@getorderactiondetail'
    ]);

    Route::get('billing', [
        'as'        => 'report.billing',
        'uses'      => 'ReportController@billing'
    ]);

    Route::get('quote', [
        'as'        => 'report.quote',
        'uses'      => 'ReportController@quote'
    ]);

    Route::post('storedetailaction', [
        'as'        => 'report.storedetailaction',
        'uses'      => 'ReportController@storedetailaction'
    ]);

    Route::get('download/{status}/{milestone}/{report}/{state}', [
        'as'        => 'report.download',
        'uses'      => 'ReportController@download'
    ]);

    Route::get('orderreport', [
        'as'        => 'report.orderreport',
        'uses'      => 'ReportController@orderreport'
    ]);

    Route::get('segment', [
        'as'        => 'report.segment',
        'uses'      => 'ReportController@segment'
    ]);

    Route::get('getsegmentdata', [
        'as'        => 'report.getsegmentdata',
        'uses'      => 'ReportController@getsegmentdata'
    ]);

    Route::get('segmentpivot', [
        'as'        => 'report.segmentpivot',
        'uses'      => 'ReportController@segmentpivot'
    ]);
    Route::get('segmentpivotchange', [
        'as'        => 'report.segmentpivotchange',
        'uses'      => 'ReportController@segmentpivotchange'
    ]);

    Route::get('segmentdetail/{segment}/{bulan}/{tahun}/{type}',[
        'as'        => 'report.segmentdetail',
        'uses'      => 'ReportController@segmentdetail'
    ]);

    Route::get('segmentlinedetail/{agreenum}',[
        'as'        => 'report.segmentlinedetail',
        'uses'      => 'ReportController@segmentlinedetail'
    ]);

    Route::get('downloadsegmentdetail/{segment}/{bulan}/{tahun}/{type}',[
        'as'        => 'report.downloadsegmentdetail',
        'uses'      => 'ReportController@downloadsegmentdetail'
    ]);
});

Route::group(['prefix' => 'ora'], function () {
    Route::get('statusorder', [
        'as'        => 'ora.statusorder',
        'uses'      => 'OraController@statusorder'
    ]);
    
//    Route::get('oraexcel', [
//        'as'        => 'ora.oraexcel',
//        'uses'      => 'OraController@index'
//    ]);

    Route::get('tomsom/{id}',[
        'as'        => 'ora.tomsom',
        'uses'      => 'OraController@tomsom'
    ]);

    // Route::get('lineitem', [
    //     'as'        => 'ora.lineitem',
    //     'uses'      => 'OraController@lineitem'
    // ]);

    Route::get('order', [
        'as'        => 'ora.order',
        'uses'      => 'OraController@order'
    ]);

//    Route::get('checkorder', [
//        'as'        => 'ora.checkorder',
//        'uses'      => 'OraController@checkorder'
//    ]);
//
    Route::get('checkorder2', [
        'as'        => 'ora.checkorder2',
        'uses'      => 'OraController@checkorder2'
    ]);

    Route::get('checkproduct', [
        'as'        => 'ora.checkproduct',
        'uses'      => 'OraController@checkproduct'
    ]);

    Route::get('nossftenoss', [
        'as'        => 'ora.nossftenoss',
        'uses'      => 'OraController@nossftenoss'
    ]);

    Route::get('getcom', [
        'as'        => 'ora.getcom',
        'uses'      => 'OraController@getcom'
    ]);

    Route::get('com', [
        'as'        => 'ora.com',
        'uses'      => 'OraController@com'
    ]);

    Route::get('exploreora', [
        'as'        => 'ora.exploreora',
        'uses'      => 'OraController@exploreora'
    ]);

    Route::get('test', function() {
        dd (DB::connection('oracle')->getPdo());
    });


    //get
    Route::get('oraexcelget', [
        'as'        => 'ora.oraexcelget',
        'uses'      => 'OraController@getora'
    ]);

    Route::get('downloadexcel', [
        'as'        => 'ora.downloadexcel',
        'uses'      => 'OraController@downloadexcel'
    ]);

    Route::get('massivedownload', [
        'as'        => 'ora.massivedownload',
        'uses'      => 'OraController@massivedownload'
    ]);

    Route::get('downloadexcelli', [
        'as'        => 'ora.downloadexcelli',
        'uses'      => 'OraController@downloadexcelli'
    ]);

    Route::get('getlireport', [
        'as'        => 'ora.getlireport',
        'uses'      => 'OraController@getlireport'
    ]);

    Route::get('errorlineitem', [
        'as'        => 'ora.errorlineitem',
        'uses'      => 'OraController@errorlineitem'
    ]);

    Route::get('getoreport', [
        'as'        => 'ora.getoreport',
        'uses'      => 'OraController@getoreport'
    ]);

    Route::post('getcheckorder', [
        'as'        => 'ora.getcheckorder',
        'uses'      => 'OraController@getcheckorder'
    ]);

    Route::post('getcheckorder2', [
        'as'        => 'ora.getcheckorder2',
        'uses'      => 'OraController@getcheckorder2'
    ]);

    Route::post('getcheckproduct', [
        'as'        => 'ora.getcheckproduct',
        'uses'      => 'OraController@getcheckproduct'
    ]);

    Route::get('getnossftenoss', [
        'as'        => 'ora.getnossftenoss',
        'uses'      => 'OraController@getnossftenoss'
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

Route::group(['prefix' => 'tree'], function () {
    Route::get('treeview', [
        'as'        => 'tree.treeview',
        'uses'      => 'TreeController@treeview'
    ]);

    Route::get('gettreeview/{id}',[
        'as'        => 'ora.gettreeview',
        'uses'      => 'TreeController@gettreeview'
    ]);

    Route::get('getroot/{id}',[
        'as'        => 'ora.getroot',
        'uses'      => 'TreeController@getroot'
    ]);

    Route::get('getchild/{id}/{parent_num}/{rev_num}/{agg_num}/{level}/{site}',[
        'as'        => 'ora.getchild',
        'uses'      => 'TreeController@getchild'
    ]);
});

Route::group(['prefix' => 'ebis'], function() {
    Route::get('home', [
        'as'    => 'ebis.home',
        'uses'  => 'EbisController@index'
    ]);
    Route::get('des', [
        'as'    => 'ebis.des',
        'uses'  => 'EbisController@viewDES'
    ]);
    Route::get('dbs', [
        'as'    => 'ebis.dbs',
        'uses'  => 'EbisController@viewDBS'
    ]);
    Route::get('dgs', [
        'as'    => 'ebis.dgs',
        'uses'  => 'EbisController@viewDGS'
    ]);
    Route::get('tr1', [
        'as'    => 'ebis.tr1',
        'uses'  => 'EbisController@viewTR1'
    ]);
    Route::get('tr2', [
        'as'    => 'ebis.tr2',
        'uses'  => 'EbisController@viewTR2'
    ]);
    Route::get('tr3', [
        'as'    => 'ebis.tr3',
        'uses'  => 'EbisController@viewTR3'
    ]);
    Route::get('tr4', [
        'as'    => 'ebis.tr4',
        'uses'  => 'EbisController@viewTR4'
    ]);
    Route::get('tr5', [
        'as'    => 'ebis.tr5',
        'uses'  => 'EbisController@viewTR5'
    ]);
    Route::get('tr6', [
        'as'    => 'ebis.tr6',
        'uses'  => 'EbisController@viewTR6'
    ]);
    Route::get('tr7', [
        'as'    => 'ebis.tr7',
        'uses'  => 'EbisController@viewTR7'
    ]);
});