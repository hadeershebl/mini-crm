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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// remove ability to register
Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth:web']], function () {

    //============= companies section ===============
    Route::prefix('company')->group(function () {
        Route::get('/index', 'Company\CompaniesController@index')->name('company.index');
        Route::get('/create', 'Company\CompaniesController@create')->name('company.create');
        Route::Post('/store', 'Company\CompaniesController@store')->name('company.store');
        Route::get('/edit/{id}', 'Company\CompaniesController@edit')->name('company.edit');
        Route::Post('/update', 'Company\CompaniesController@update')->name('company.update');
        Route::get('/show/{id}', 'Company\CompaniesController@show')->name('company.show');
        Route::get('/delete/{id}', 'Company\CompaniesController@destroy')->name('company.delete');
    });

    //============= employees section ===============
    Route::prefix('employee')->group(function () {
        Route::get('/index', 'Employee\EmployeesController@index')->name('employee.index');
        Route::get('/create', 'Employee\EmployeesController@create')->name('employee.create');
        Route::Post('/store', 'Employee\EmployeesController@store')->name('employee.store');
        Route::get('/edit/{id}', 'Employee\EmployeesController@edit')->name('employee.edit');
        Route::Post('/update', 'Employee\EmployeesController@update')->name('employee.update');
        Route::get('/show/{id}', 'Employee\EmployeesController@show')->name('employee.show');
        Route::get('/delete/{id}', 'Employee\EmployeesController@destroy')->name('employee.delete');
    });
});
