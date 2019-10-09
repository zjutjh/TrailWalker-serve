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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/oauth', 'WXLoginController@oauth');
Route::any('/wx/login', 'WXLoginController@wxLogin');

Route::get('/index/info', 'IndexController@indexInfo');
Route::any('/user/info', 'UserController@getMyInfo');
Route::any('/config/signup', 'IndexController@registerConfig');
Route::any('/config/campus', 'IndexController@campusConfig');

Route::group(['middleware' => ['cor','check.finish']], function() {
    Route::post('/user/register', 'UserController@register');
    Route::post('/user/update', 'UserController@updateInfo');

    Route::post('/group/list', 'GroupController@groupLists');
    Route::post('/group/create', 'GroupController@createGroup');
    Route::post('/group/break', 'GroupController@breakGroup');
    Route::post('/group/submit', 'GroupController@submitGroup');
    Route::post('/group/search', 'GroupController@searchTeam');
    Route::post('/group/member/list', 'GroupController@getGroupMembers');
    Route::post('/group/member/delete', 'GroupController@deleteMember');
    Route::post('/group/info', 'GroupController@getGroupInfo');
    Route::post('/group/update', 'GroupController@updateGroupInfo');
    Route::post('/group/unsubmit', 'GroupController@unSubmitGroup');
    Route::post('/group/leave', 'GroupController@leaveGroup');

    Route::post('/apply/list', 'ApplyController@getApplyList');
    Route::post('/apply/agree', 'ApplyController@agreeMember');
    Route::post('/apply/refuse', 'ApplyController@refuseMember');
    Route::post('/apply/do', 'ApplyController@doApply');
    Route::post('/apply/delete', 'ApplyController@deleteApply');
    Route::post('/apply/count', 'ApplyController@getApplyCount');
});

