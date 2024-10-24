<?php

namespace App\Providers;

use App\Services\Impl\ReportGrafikServiceImpl;
use App\Services\ReportGrafikService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ReportGrafikServiceProvider extends ServiceProvider implements DeferrableProvider
{
   public array $singletons = [
      ReportGrafikService::class => ReportGrafikServiceImpl::class
  ];

  public function provides(): array{
      return [
         ReportGrafikService::class
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
