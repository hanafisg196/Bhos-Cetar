<?php

namespace App\Providers;

use App\Services\Impl\ReportHamServiceImpl;
use App\Services\ReportHamService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ReportHamServicesProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ReportHamService::class => ReportHamServiceImpl::class
    ];

    public function provides(): array{
        return [
            ReportHamService::class
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
