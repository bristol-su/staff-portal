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

/* Authentication Routes */
Route::get('/register', 'AuthController@showRegistrationForm');
Route::post('/register', 'AuthController@createUser');
Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

/* Dashboard */
Route::get('/', 'PortalController@getShortcuts');



/* Shortcut Routes */
//Create
Route::get('/shortcuts/create', 'ShortcutController@showCreateForm'); //Create Form
Route::post('/shortcuts/create', 'ShortcutController@create'); //Create
//Read
Route::get('/shortcuts/{shortcut}/view', 'ShortcutController@show'); //Read
Route::get('/shortcuts/department/{shortcut}/view', 'ShortcutController@departmentshow'); //Read
Route::get('/shortcuts', 'ShortcutController@showAllShortcutForm'); //Read (all as a list)

//Update
Route::get('/shortcuts/{shortcut}/edit', 'ShortcutController@showUserEditForm'); //Update Form
Route::get('/shortcuts/department/{shortcut}/edit', 'ShortcutController@showDepartmentEditForm'); //Update Form
Route::post('/shortcuts/{shortcut}/edit', 'ShortcutController@edit'); //Update
Route::post('/shortcuts/department/{shortcut}/edit', 'ShortcutController@departmentedit'); //Update

//Delete
Route::post('/shortcuts/{shortcut}/delete', 'ShortcutController@delete'); //Delete
Route::post('/shortcuts/department/{shortcut}/delete', 'ShortcutController@departmentdelete'); //Delete

Route::get('/ggg', 'PortalController@ggg');

/* Department Routes */
//Create
Route::get('/departments/create', 'DepartmentController@showCreateForm'); //Create Form
Route::post('/departments/create', 'DepartmentController@create'); //Create
//Read
Route::get('/departments/{department}/view', 'DepartmentController@show'); //Read
Route::get('/departments', 'DepartmentController@showAllDepartmentForm'); //Read (all as a list)
//Update
Route::get('/departments/{department}/edit', 'DepartmentController@showEditForm'); //Update Form
Route::post('/departments/{department}/edit', 'DepartmentController@edit'); //Update
//Delete
Route::post('/departments/{department}/delete', 'DepartmentController@delete'); //Delete
//Update User Relationships
Route::get('/departments/{department}/users', 'DepartmentController@showUpdateUsersForm');
Route::post('/departments/{department}/users/add', 'DepartmentController@updateUsers');
Route::post('/departments/{department}/users/{user}/delete', 'DepartmentController@deleteUser');



/* User Routes */
//Read
Route::get('/users/{user}/view', 'UserController@show'); //Read
Route::get('/users', 'UserController@showAllUserForm'); //Read (all as a list)
//Update
Route::get('/users/{user}/edit', 'UserController@showEditForm'); //Update Form
Route::post('/users/{user}/edit', 'UserController@edit'); //Update
Route::get('/users/validate', 'UserController@showAllValidations');
Route::post('/users/{user}/validate', 'UserController@validateUser');
//Delete
Route::post('/users/{user}/delete', 'UserController@delete'); //Delete