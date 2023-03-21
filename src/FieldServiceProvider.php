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
        $this->app->booted(
            function () {
                $this->routes();
            }
        );

        Nova::serving(
            function (ServingNova $event) {
                Nova::script('liveupdate-boolean', __DIR__ . '/../dist/js/field.js');
                Nova::style('liveupdate-boolean', __DIR__ . '/../dist/css/field.css');
            }
        );
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

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }
        Route::middleware(['nova'])
            ->prefix('liveupdate-boolean')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
