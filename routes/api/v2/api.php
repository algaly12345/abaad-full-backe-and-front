<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api\v2', 'prefix' => 'v2', 'middleware' => ['api_lang']], function () {
    Route::group(['prefix' => 'agent', 'namespace' => 'agent'], function () {

        Route::get('agent-info', 'agentController@agent_info');
        Route::get('agent-delivery-man', 'agentController@agent_delivery_man');
        Route::get('shop-product-reviews', 'agentController@shop_product_reviews');
        Route::get('shop-product-reviews-status','agentController@shop_product_reviews_status');
        Route::put('agent-update', 'agentController@agent_info_update');
        Route::get('monthly-earning', 'agentController@monthly_earning');
        Route::get('monthly-commission-given', 'agentController@monthly_commission_given');
        Route::put('cm-firebase-token', 'agentController@update_cm_firebase_token');

        Route::get('shop-info', 'agentController@shop_info');
        Route::get('transactions', 'agentController@transaction');
        Route::put('shop-update', 'agentController@shop_info_update');

        Route::post('balance-withdraw', 'agentController@withdraw_request');
        Route::delete('close-withdraw-request', 'agentController@close_withdraw_request');

        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandController@getBrands');
        });

        Route::group(['prefix' => 'estates'], function () {
            Route::post('upload-images', 'ProductController@upload_images');
            Route::post('upload-digital-product', 'ProductController@upload_digital_product');
            Route::post('add', 'ProductController@add_new');
            Route::get('list', 'ProductController@list');
            Route::get('stock-out-list', 'ProductController@stock_out_list');
            Route::get('status-update','ProductController@status_update');
            Route::get('edit/{id}', 'ProductController@edit');
            Route::put('update/{id}', 'ProductController@update');
            Route::delete('delete/{id}', 'ProductController@delete');
            Route::get('barcode/generate', 'ProductController@barcode_generate');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('list', 'OrderController@list');
            Route::get('/{id}', 'OrderController@details');
            Route::put('order-detail-status/{id}', 'OrderController@order_detail_status');
            Route::put('assign-delivery-man', 'OrderController@assign_delivery_man');
            Route::put('order-wise-product-upload', 'OrderController@digital_file_upload_after_sell');

            Route::post('assign-third-party-delivery','OrderController@assign_third_party_delivery');
            Route::post('update-payment-status','OrderController@update_payment_status');
        });
        Route::group(['prefix' => 'refund'], function () {
            Route::get('list', 'RefundController@list');
            Route::get('refund-details', 'RefundController@refund_details');
            Route::post('refund-status-update', 'RefundController@refund_status_update');

        });

        Route::group(['prefix' => 'shipping'], function () {
            Route::get('get-shipping-method', 'shippingController@get_shipping_type');
            Route::get('selected-shipping-method', 'shippingController@selected_shipping_type');
            Route::get('all-category-cost','shippingController@all_category_cost');
            Route::post('set-category-cost','shippingController@set_category_cost');
        });

        Route::group(['prefix' => 'shipping-method'], function () {
            Route::get('list', 'ShippingMethodController@list');
            Route::post('add', 'ShippingMethodController@store');
            Route::get('edit/{id}', 'ShippingMethodController@edit');
            Route::put('status', 'ShippingMethodController@status_update');
            Route::put('update/{id}', 'ShippingMethodController@update');
            Route::delete('delete/{id}', 'ShippingMethodController@delete');
        });

        Route::group(['prefix' => 'messages'], function () {
            Route::get('list', 'ChatController@messages');
            Route::post('send', 'ChatController@send_message');
        });

        Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
            Route::post('login', 'LoginController@login');

            Route::post('forgot-password', 'ForgotPasswordController@reset_password_request');
            Route::post('verify-otp', 'ForgotPasswordController@otp_verification_submit');
            Route::put('reset-password', 'ForgotPasswordController@reset_password_submit');
        });

        Route::group(['prefix' => 'registration', 'namespace' => 'auth'], function () {
            Route::post('/', 'RegisterController@store');
        });
    });
    Route::post('ls-lib-update', 'LsLibController@lib_update');

    Route::group(['prefix' => 'delivery-man', 'namespace' => 'delivery_man'], function () {

        Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
            Route::post('login', 'LoginController@login');
        });

        Route::group(['middleware' => ['delivery_man_auth']], function () {
            Route::get('info', 'DeliveryManController@info');
            Route::get('current-orders', 'DeliveryManController@get_current_orders');
            Route::get('all-orders', 'DeliveryManController@get_all_orders');
            Route::post('record-location-data', 'DeliveryManController@record_location_data');
            Route::get('order-delivery-history', 'DeliveryManController@get_order_history');
            Route::put('update-order-status', 'DeliveryManController@update_order_status');
            Route::put('update-payment-status', 'DeliveryManController@order_payment_status_update');
            Route::get('order-details', 'DeliveryManController@get_order_details');
            Route::get('last-location', 'DeliveryManController@get_last_location');
            Route::put('update-fcm-token', 'DeliveryManController@update_fcm_token');
        });
    });
});
