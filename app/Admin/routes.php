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

    $router->resource('products', 'ProductController');

    $router->get('orders', 'OrderController@index');
    $router->get('orders/{id}', 'OrderController@show');
    $router->post('orders/refund/{order}', 'OrderController@handleRefund')->name('admin.orders.refund');

    $router->post('order/ship/{order}', 'OrderController@ship')->name('admin.order.ship');

    $router->resource('categories', 'CategoryController');

    $router->get('api/categories','CategoryController@categoryApi');
});
