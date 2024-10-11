<?php

namespace App\Providers;

use App\Services\EcorrectionService;
use App\Services\Impl\EcorrectionServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EcorrectionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public array $singletons = [
      EcorrectionService::class => EcorrectionServiceImpl::class
   ];

    public function provides(): array{
      return [
          EcorrectionService::class
      ];
  }

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
