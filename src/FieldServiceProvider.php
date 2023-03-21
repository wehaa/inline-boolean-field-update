<?php

namespace Wehaa\LiveupdateBoolean;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(
            function (ServingNova $event) {
                Nova::script('liveupdate-boolean', __DIR__ . '/../dist/js/field.js');
                Nova::style('liveupdate-boolean', __DIR__ . '/../dist/css/field.css');
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

}
