<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', "auth"]
    ],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            // dashboard
            Route::get('/', 'DashboardController@index')->name('index');
            Route::get('/welcome', 'DashboardController@welcome')->name('welcome');

            // categories
            Route::resource('/categories', "CategoryController")->except('show');
            Route::get("/categories/{id}/products", "ProductController@index")->name('categories.products');

            // products
            Route::resource('/products', "ProductController")->except('show');

            // clients
            Route::resource('/clients', "ClientController");
            Route::resource("/client.orders", "Client\OrderController")->except('show');

            // orders
            Route::resource("/orders", "OrderController");
            Route::get('/order/{order}', "OrderController@products")->name('order.products');

            // users
            Route::resource('/users', "UserController")->except('show');
            Route::get('/user/logout', "UserController@logout")->name('user.logout');
            Route::get('/user/profile/{id}', "UserController@editProfile")->name('user.profile');
            Route::patch('user/updateProfile/{user}', "UserController@updateProfile")->name('user.update_profile');
            Route::patch('user/changePassword/{user}', "UserController@updatePassword")->name('user.change_password');

            // roles
            Route::resource('/roles', "RoleController")->except('show');
        });
    }
);

// Route::get("/test", function () {
//     $string = "٩٨٥٤٠٣٧٦٣٢١";
//     $en_numbers = convert_nb_ar_to_en($string);
//     dd(intval($en_numbers));
// });
