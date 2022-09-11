<?php

namespace Redius;

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
            'namespace' => 'Redius\Controllers',
            'as' => 'redius.',
        ], function () {
            Route::get('{resource}', Controllers\ListResources::class)->name('list.resources');
            Route::post('{resource}', Controllers\CreateResource::class)->name('create.resource');
            Route::get('{resource}/{resourceId}', Controllers\GetResource::class)->name('get.resource');
            Route::patch('{resource}/{resourceId}', Controllers\UpdateResource::class)->name('update.resource');
            Route::delete('{resource}/{resourceId}', Controllers\DeleteResource::class)->name('delete.resource');

            Route::get('{resource}/-/fields', Controllers\ListFields::class)->name('list.resource.fields');
            Route::get('{resource}/-/filters', Controllers\ListFilters::class)->name('list.resource.filters');
            Route::get('{resource}/-/views', Controllers\ListViews::class)->name('list.resource.views');
            Route::get('{resource}/-/actions', Controllers\ListActions::class)->name('list.resource.actions');
        });
    }

    public function registerCommands()
    {
        $this->commands([
            Console\ResourceMakeCommand::class,
        ]);
    }
}
