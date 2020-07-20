<?php

namespace App\Providers;

use App\Models\Links;
use App\Models\PaymentSupportImage;
use Encore\Admin\AdminServiceProvider;
use Encore\Admin\Config\Config;
use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
                $config['notify_url'] = env('ALI_NOTIFY_URL', route('payment.alipay.notify'));
                $config['return_url'] = env('ALI_RETURN_URL', route('payment.alipay.return'));
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

        $table = config('admin.extensions.table', 'admin_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }
        $payment_image = [];
        try {
            $payment_image = PaymentSupportImage::query()->orderBy('weight')->get();
        } catch (\Exception $exception) {

        }
        #支持支付类型图片
        View::share('payment_image', $payment_image);

        $links = [];
        try {
            $links = Links::query()->orderBy('sort', 'desc')->get();
        } catch (\Exception $exception) {

        }
        #友情连接
        View::share('links', $links);

        if ($this->app->environment('local')) {
            DB::listen(function ($query) {
                $sql = Str::replaceArray('?', $query->bindings, $query->sql);
                Log::debug($sql);
            });
        }
    }
}
