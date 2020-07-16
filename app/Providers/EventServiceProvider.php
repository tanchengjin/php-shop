<?php

namespace App\Providers;

use App\Events\Paid;
use App\Events\Reviewed;
use App\Listeners\CalculateReviewCount;
use App\Listeners\CalculateSale;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        #注册后触发
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        #支付后触发
        Paid::class => [
            CalculateSale::class
        ],
        #评论后触发
        Reviewed::class=>[
            CalculateReviewCount::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
