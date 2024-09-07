<?php

namespace App\Providers;

use App\Services\Impl\NotificationServiceImpl;
use App\Services\NotificationService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public  array $singletons =[
        NotificationService::class => NotificationServiceImpl::class,
    ];

    public function provides(){
        return [
            NotificationService::class
        ];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
