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

/*登录、查询模块*/
Route::get('/','Auth\LoginController@login');
Route::post('/auth/stulogin', 'Auth\LoginController@stuLogin');
Route::get('/auth/studata/{stu_id}', ['middleware' => 'auth', 'uses' => 'Auth\LoginController@stuData']);
Route::get('/auth/stulogout','Auth\LoginController@stuLogout');
Route::get('/auth/prescription', 'Auth\LoginController@prescription');

Route::get('/admin/admlogin','Admin\LoginController@getLogin');
Route::post('/admin/admlogin','Admin\LoginController@postLogin');
Route::get('/admin/admlogout','Admin\LoginController@logout');


Route::group(['middleware' => 'admin'], function(){
	Route::get('/admin/admsearch','Admin\LoginController@search');
	
	Route::post('/admin/addAdmin','Admin\LoginController@postAddAdmin');
	Route::get('/admin/detailData/{stu_id}','Admin\LoginController@detailData');
	Route::get('/admin/prescription','Admin\LoginController@prescription');
});




/* 留言板模块*/

/*管理员*/
Route::group(['namespace' => 'Admin\Message', 'middleware' => 'admin'], function(){

//话题列表
	Route::get('/admin/topic/index', 'TopicController@index');
	Route::post('/admin/topic/reply', 'TopicController@reply');
	Route::post('/admin/topic/modify', 'TopicController@modify');
	Route::get('/admin/topic/delete', 'TopicController@delete');

//话题分类
	Route::get('/admin/topic/indexType', 'TypeController@index');
	Route::post('/admin/topic/addType', 'TypeController@add');
	Route::post('/admin/topic/modifyType', 'TypeController@modify');
	Route::get('/admin/topic/deleteType', 'TypeController@delete');

});

/*Route::post('/wangEditor/image/reply/upload', 'Admin\TopicController@imageUpload');*/
Route::post('/wangEditor/image/raise/upload', ['middleware' => 'auth','uses'=>'Auth\Message\TopicController@imageUpload']);
Route::post('/wangEditor/image/reply/upload', ['middleware' => 'admin','uses'=>'Admin\Message\TopicController@imageUpload']);


/*学生*/
Route::group(['namespace' => 'Auth\Message', 'middleware' => 'auth'], function(){

	Route::get('/auth/topic/index', 'TopicController@index');
	Route::get('/auth/topic/getAdd', 'TopicController@getAdd');
	Route::post('/auth/topic/postAdd', 'TopicController@postAdd');
});

/* 统计报表 */
Route::group(['namespace' => 'Admin\Statistics', 'middleware' => 'admin'], function(){
	Route::get('/admin/statistics', 'StatisticsController@statistics');
});