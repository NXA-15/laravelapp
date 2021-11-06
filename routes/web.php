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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/user','UserController');
Route::resource('/company','CompanyController');
Route::resource('/employee','EmployeeController');
//Route::post('/employee/getEmployees/','EmployeeController@getEmployees')->name('employee.getEmployees');
Route::post('/company/getCompanies/','CompanyController@getCompanies')->name('company.getCompanies');
Route::post('/employee/postForm','EmployeeController@postForm')->name('employee.postForm');

