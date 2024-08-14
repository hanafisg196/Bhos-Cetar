<?php

namespace App\Providers;

use App\Services\Impl\ScheduleServiceImpl;
use App\Services\ScheduleService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ScheduleProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ScheduleService::class => ScheduleServiceImpl::class
    ];

    public function provides() : array
    {
        return [ScheduleService::class];
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
