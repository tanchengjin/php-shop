<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('products', 'products\ProductController');
    $router->resource('productsSeckill', 'products\SeckillProductController');

    $router->get('orders', 'OrderController@index');
    $router->get('orders/{id}', 'OrderController@show');
    $router->post('orders/refund/{order}', 'OrderController@handleRefund')->name('admin.orders.refund');

    $router->post('order/ship/{order}', 'OrderController@ship')->name('admin.order.ship');

    $router->resource('categories', 'CategoryController');

    $router->get('api/categories', 'CategoryController@categoryApi');

    $router->get('contactUs', 'ContactUsController@index');

    $router->resource('paymentImage', 'PaymentImageController');

    $router->get('orders-refund', 'OrderRefundController@index');
    $router->get('orders-refund/{id}', 'OrderRefundController@show');

    $router->get('orders-deliver', 'OrderDeliverController@index');
    $router->get('orders-deliver/{id}', 'OrderDeliverController@show');

    $router->get('users', 'UserController@index');

    $router->resource('banners', 'BannerController');

});
