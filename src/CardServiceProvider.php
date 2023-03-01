<?php

namespace Nagyist\Cachecardnova4;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Nagyist\NovaMarkdown\Http\Middleware\Authorize;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });


        Nova::serving(function (ServingNova $event) {
            Nova::script('cachecardnova4', __DIR__.'/../dist/js/card.js');
            Nova::style('cachecardnova4', __DIR__.'/../dist/css/card.css');
        });

    }

    /**
     * Register the card's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Nova::router(['nova:api', Authorize::class], 'cache-card')
            ->group(__DIR__.'/../routes/inertia.php');

        Route::middleware(['nova:api', Authorize::class])
            ->prefix('nova-vendor/nagyist/cachecardnova4')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
