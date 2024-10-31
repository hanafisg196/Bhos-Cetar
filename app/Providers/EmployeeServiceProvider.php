<?php

namespace App\Providers;

use App\Services\EmployeeService;
use App\Services\Impl\EmployeeServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider implements DeferrableProvider
{
   public array $singletons = [
      EmployeeService::class => EmployeeServiceImpl::class
   ];
   public function provides(): array
   {
       return [
           EmployeeService::class
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
