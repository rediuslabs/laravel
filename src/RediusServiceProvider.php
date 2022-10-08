<?php

namespace Redius;

use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RediusServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/redius.php' => config_path('redius.php'),
        ]);

        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations'),
        ], 'migrations');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../migrations/');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/redius.php', 'redius'
        );

        $this->registerRoutes();
        $this->registerCommands();
    }

    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => 'redius',
            'namespace' => 'Redius',
            'as' => 'redius.',
            'middleware' => [
                SubstituteBindings::class,
            ],
        ], function () {
            Route::get('{rediusResourceName}', Endpoints\ListResources::class)->name('resources.list');
            Route::post('{rediusResourceName}', Endpoints\CreateResource::class)->name('resource.store');
            Route::get('{rediusResourceName}/{rediusResourceId}', Endpoints\GetResource::class)->name('resource.show');
            Route::patch('{rediusResourceName}/{rediusResourceId}', Endpoints\UpdateResource::class)->name('resource.update');
            Route::delete('{rediusResourceName}/{rediusResourceId}', Endpoints\DeleteResource::class)->name('resource.delete');

            Route::get('{rediusResourceName}/-/fields', Endpoints\ListFields::class)->name('resource.fields');
            Route::get('{rediusResourceName}/-/filters', Endpoints\ListFilters::class)->name('resource.filters');
            Route::get('{rediusResourceName}/-/scopes', Endpoints\ListScopes::class)->name('resource.scopes');
            Route::get('{rediusResourceName}/-/actions', Endpoints\ListActions::class)->name('resource.actions');

            Route::post('{rediusResourceName}/-/actions', Endpoints\PerformAction::class)->name('resource.perform-action');
        });

        Route::bind('rediusResourceName', function ($resourceName) {
            return Redius::resource($resourceName);
        });
    }

    public function registerCommands()
    {
        $this->commands([
            Console\ResourceMakeCommand::class,
        ]);
    }
}
