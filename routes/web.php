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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/user/current', 'UserController@current');
Route::post('/support/email', 'SupportController@sendEmail');

// Front-End Pages publishers
Route::get('/dashboard', 'DashboardController@index');

//csv download page 
Route::get('/download', function(){

    $id = Auth::id();
    $table = \App\Stats::where('user_id','=',$id)->get();
    $filename = "Stats.csv";
    $handle = fopen($filename, 'w+');

     fputcsv($handle, array('DATE','SITE','TAG','IMPRESSIONS','SERVED','FILL','INCOME','eCPM'));

     foreach($table as $row) {
        fputcsv($handle, array($row['date'],$row['site'],$row['tag'], $row['impressions'],$row['served'],number_format($row->served / $row->impressions * 100, 2, '.', '').'%' ,'$'.$row['income'],'$'.number_format($row->income / $row->served * 1000, 2, '.', '') ));
    }
//replace the 'x' this is not a sign by a real multiplication sign 
       $str=file_get_contents('Stats.csv');
       $str=str_replace("×", "x",$str);
       file_put_contents('Stats.csv', $str);

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );
    return Response::download($filename, 'Stats.csv', $headers);
});
//end of csv download page 

// Admin Pages
Route::get('/admin', 'AdminController@index');
Route::get('/admin/publishers', 'AdminController@allPublishers');
Route::get('/admin/publisher/{id}/publisher_profile', 'AdminController@showPublisher');
Route::post('/admin/publisher/add_stat', 'AdminController@storeStat');
Route::put('/admin/stat/{id}/edit_stat', 'AdminController@updateStat');
Route::post('/admin/publisher/{id}/upload_stats', 'AdminController@uploadStats');
Route::get('/admin/widget_articles', 'AdminController@widgetArticles');
Route::get('/admin/other_articles', 'AdminController@otherArticles');
Route::get('/admin/article/{id}/article_profile', 'AdminController@showArticle');
Route::post('/admin/article/add_article', 'AdminController@storeArticle');
Route::put('/admin/article/{id}/edit_article', 'AdminController@updateArticle');
Route::put('/admin/confirmed/article/{id}/edit_article', 'AdminController@updateConfirmedArticleRemoveFromWidget');
Route::put('/admin/confirmed2/article/{id}/edit_article', 'AdminController@updateConfirmedArticleSwapPlacement');
Route::get('/admin/widget_settings', 'AdminController@widgetSettings');
Route::post('/admin/widget/widget_settings_update', 'AdminController@updateWidgetSettings');

Route::get('/profile', ['as' => 'profile', 'uses' => 'ProfileController@create']);
Route::post('/profile', ['as' => 'profile_store', 'uses' => 'ProfileController@store']);

Route::get('/security', ['as' => 'security', 'uses' => 'SecurityController@create']);
Route::post('/security', ['as' => 'security_update', 'uses' => 'SecurityController@update']);