<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Helpers\PriceHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerFacades();
    }

    /**
     * @return void
     */
    private function registerFacades(): void
    {
        $this->app->bind('price.convert', function () {
            return new PriceHelper();
        });
    }
}
