<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'LoginController@index');
Route::post('/signup', 'SignUpController@index');
Route::post('/sendForgotPasswordEmail', 'SendForgotPasswordEmailController@index'); 
Route::put('/resetpassword/{user}', 'ResetPasswordController@update');
 
Route::get('/products', 'ProductController@index');
Route::get('/productswithcolors', 'ProductController@withColors');
Route::get('/productsizes', 'ProductSizeController@index');
Route::get('/productwithcolors/{product}', 'ProductController@withIdAndColors');

Route::group(['middleware' => 'auth:api'], function() {

        Route::post('imageupload', 'ImageUploadController@index');
        Route::get('/brandsWithDateFilter', 'BrandController@withDateFilter');
        Route::get('/brands', 'BrandController@index');
        Route::get('/product/sizes', 'ProductSizeController@index');
        Route::get('/brandsWithAll', 'BrandController@withAll');
        
        Route::get('/orders', 'OrderController@index');
        Route::get('/ownorders', 'OrderController@byUser');
        Route::post('/orders', 'OrderController@store');
        Route::put('/orders/{order}', 'OrderController@update');

        Route::get('/checkouts', 'CheckoutController@index');
        Route::get('/checkout/{checkout_no}', 'CheckoutController@withId');
        Route::post('/checkouts', 'CheckoutController@store');

        Route::get('/orderstatus', 'OrderStatusController@index');

        Route::get('/notifications', 'NotificationController@index');
        Route::put('/notifications/{notification}', 'NotificationController@update');

        Route::get('/rates', 'RateController@index');
        Route::post('/rates', 'RateController@store');

        Route::get('/order-cancellations', 'OrderCancellationController@index');
        Route::get('/order-cancellations/{order_id}', 'OrderCancellationController@withId');

        Route::post('/order-cancellations', 'OrderCancellationController@store');
        Route::put('/order-cancellations/{order_cancellation}', 'OrderCancellationController@update');

        Route::get('/profile', 'UserController@profile');
        Route::put('/profile/{user_id}', 'UserController@updateProfile');
        
        Route::post('/product/sizes', 'ProductSizeController@store');
        Route::post('/product/sizes/client', 'ProductSizeController@clientStore');
   
        Route::group(['middleware' => 'admin_staff' ], function() {
                Route::get('/usertypes', 'UserTypeController@index');
                Route::get('/customers', 'UserController@customers');

                Route::post('/brands', 'BrandController@store');
                Route::put('/brands/{brand}', 'BrandController@update');
                Route::delete('/brands/{brand}', 'BrandController@destroy');

                Route::put('/product/sizes/{size}', 'ProductSizeController@update');
                Route::delete('/product/sizes/{size}', 'ProductSizeController@destroy');

                Route::get('/product/colors', 'ProductColorController@withProductAndBrand');
                Route::post('/product/colors', 'ProductColorController@store');
                Route::put('/product/colors/{color}', 'ProductColorController@update');
                Route::delete('/product/colors/{color}', 'ProductColorController@destroy');                
                
                Route::post('/products', 'ProductController@store');
                Route::put('/products/{product}', 'ProductController@update');
                Route::delete('/products/{product}', 'ProductController@destroy');           

                Route::get('/payments', 'PaymentDetailController@index');

                Route::get('/inventories', 'InventoryController@index');
                Route::get('/inventories/{color_id}', 'InventoryController@withId');
                Route::post('/inventories', 'InventoryController@store');

                Route::get('/dashboard', 'DashboardController@index');

                Route::get('/accreceivable', 'AccountReceivableController@index');

                Route::get('/users', 'UserController@index');
                Route::post('/users', 'UserController@store');

                Route::get('/productsWithDateFilter', 'ProductController@withDateFilter');
                Route::get('/productColorsWithDateFilter', 'ProductColorController@withDateFilter');
                Route::get('/productSizesWithDateFilter', 'ProductSizeController@withDateFilter');
                Route::get('/ordersWithDateFilter', 'OrderController@withDateFilter');
                Route::get('/paymentsWithDateFilter', 'PaymentDetailController@withDateFilter');
                Route::get('/accountsReceivableWithDateFilter', 'AccountReceivableController@withDateFilter');
        });

        Route::group(['middleware' => 'customer'], function() {
             
                Route::get('/colors/{color}', 'ProductColorController@index');

                Route::post('/productsizes', 'ProductSizeController@store');

                // active

                Route::get('/cart', 'CartController@index');
                Route::post('/cart', 'CartController@storeOrUpdate');
                Route::put('/cart/{cart}', 'CartController@update');
                Route::delete('/cart', 'CartController@destroy');
        });
});