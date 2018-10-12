<?php

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
    Route::resource('pet-registration', 'PetRegistrationController');
    Route::resource('adoption-request', 'AdoptionRequestController');
    Route::resource('users', 'UsersController');

    // adopted pets report
    Route::get('adopted-pets', 'AdoptedPetsController')->name('adopted-pets.index');
    Route::get('adopted-pets/{pet}', 'AdoptedPetsController@show')->name('adopted-pets.show');

    //impound pets report
    Route::get('impounded-pets', 'ImpoundLogsController')->name('impounded-pets.index');

    Route::group(['prefix' => 'pet/{pet}/manage-adoption-requests', 'as' => 'pet-adoption-requests.'], function () {
        Route::get('/', 'ManagePetAdoptionRequestsController@index')->name('index');
        Route::post('/', 'ManagePetAdoptionRequestsController@approve')->name('approve');
    });

    Route::post('adoption-request/{adoptionRequest}/send-notification', 'AdoptionRequestNotificationController')->name('adoption-request-notification');

    Route::patch('users/{user}/disable', 'DisabledUsersConroller@store');
    Route::patch('users/{user}/enable', 'DisabledUsersConroller@destroy');

});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.', 'middleware' => 'role:standard,admin'], function () {
    // Route::resource('animal-impound', 'AnimalImpoundController');
    Route::resource('pet-registration', 'PetRegistrationController');
    Route::resource('adoption-request', 'AdoptionRequestController');
    Route::post('cancel-adoption-request', 'CancelAdoptionRequestController')->name('adoption-request.cancel');
});

Route::post('update-profile', 'ProfileController')->name('profile.update')->middleware('auth');
