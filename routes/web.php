<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


//主页
Route::get('/', 'StaticPagesController@home')->name('home');
//帮助页
Route::get('/help', 'StaticPagesController@help')->name('help');
//关于页
Route::get('/about', 'StaticPagesController@about')->name('about');


//注册
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
//下面几行同等上面一行代码
// //显示所有用户列表的页面
// Route::get('/users', 'UsersController@index')->name('users.index');
// //创建用户的页面
// Route::get('/users/create', 'UsersController@create')->name('users.create');
// //显示用户个人信息的页面
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// //创建用户
// Route::post('/users', 'UsersController@store')->name('users.store');
// //编辑用户个人资料的页面
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// //更新用户
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
// //删除用户
// Route::delate('/users/{user}', 'UsersController@destroy')->name('users.destroy');

// 显示登录页面
Route::get('login', 'SessionsController@create')->name('login');
// 创建新会话（登录）
Route::post('login', 'SessionsController@store')->name('login');
// 销毁会话（退出登录）
Route::delete('logout', 'SessionsController@destroy')->name('logout');
