<?php

namespace App\Providers;

use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Yansongda\Pay\Gateways\Alipay;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('alipay', function () {
            $config = config('pay.alipay');
            if ($this->app->environment() !== 'production') {
                $config['mode'] = 'dev';
                $config['log']['level'] = 'debug';
                $config['notify_url']=env('ALI_NOTIFY_URL',route('payment.alipay.notify'));
                $config['return_url']=env('ALI_RETURN_URL',route('payment.alipay.return'));
            }
            return Pay::alipay($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $table=config('admin.extensions.table','admin_config');
        if (Schema::hasTable($table)){
            Config::load();
        }

    }
}
