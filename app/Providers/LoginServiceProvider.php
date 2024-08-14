<?php

namespace App\Providers;

use App\Services\Impl\LoginServiceImpl;
use App\Services\LoginService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        LoginService::class => LoginServiceImpl::class
    ];

    public function provides(): array
    {
        return [
            LoginService::class
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
