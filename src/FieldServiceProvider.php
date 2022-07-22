<?php

namespace Mateusztumatek\NovaModelLinkField;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Mateusztumatek\NovaModelLinkField\Contracts\ResolveResourceWithLinkContract;
use Mateusztumatek\NovaModelLinkField\Services\ResolveReourcesWithLinksService;
use Mateusztumatek\TestTool\Http\Middleware\Authorize;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-model-link-field', __DIR__ . '/../dist/js/field.js');
            Nova::style('nova-model-link-field', __DIR__ . '/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ResolveResourceWithLinkContract::class, ResolveReourcesWithLinksService::class);
        Route::middleware(['nova', \Laravel\Nova\Http\Middleware\Authorize::class])
            ->prefix('nova-vendor/model-link-field')
            ->group(__DIR__ . '/routes/api.php');
    }
}
