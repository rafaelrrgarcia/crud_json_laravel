<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return json_encode(['success' => true]); // Root true message
});

Route::prefix('users')->group(function () { // All the user routes
    Route::get('/', 'UserController@index'); // Get all the users order by name
    Route::post('/', 'UserController@create'); // Create a new user
    Route::post('/full', 'UserController@createFull'); // Create a new user with a full form
    Route::get('/{id}', 'UserController@read'); // Read an user by id
    Route::post('/{id}', 'UserController@update'); // Update an user by id
    Route::delete('/{id}', 'UserController@delete'); // Delete an user by id
});

Route::prefix('addresses')->group(function () { // All the address routes
    Route::get('/', 'AddressController@index'); // Get all the addresses order by name
    Route::post('/', 'AddressController@create'); // Create a new address
    Route::get('/{id}', 'AddressController@read'); // Read an address by id
    Route::post('/{id}', 'AddressController@update'); // Update an address by id
    Route::delete('/{id}', 'AddressController@delete'); // Delete an address by id
});

Route::prefix('cities')->group(function () { // All the city routes
    Route::get('/', 'CityController@index'); // Get all the cities order by name
    Route::post('/', 'CityController@create'); // Create a new city
    Route::get('/{id}', 'CityController@read'); // Read an city by id
    Route::post('/{id}', 'CityController@update'); // Update an city by id
    Route::delete('/{id}', 'CityController@delete'); // Delete an city by id
});

Route::prefix('states')->group(function () { // All the states routes
    Route::get('/', 'StateController@index'); // Get all the states order by name
    Route::post('/', 'StateController@create'); // Create a new state
    Route::get('/{id}', 'StateController@read'); // Read an state by id
    Route::post('/{id}', 'StateController@update'); // Update an state by id
    Route::delete('/{id}', 'StateController@delete'); // Delete an state by id
});
