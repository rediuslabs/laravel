<?php

namespace Redius;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Redius\Controllers\CreateResource;
use Redius\Controllers\DeleteResource;
use Redius\Controllers\GetResource;
use Redius\Controllers\ListActions;
use Redius\Controllers\ListFields;
use Redius\Controllers\ListFilters;
use Redius\Controllers\ListResources;
use Redius\Controllers\ListViews;
use Redius\Controllers\UpdateResource;

class RediusServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishes([
            \dirname(__DIR__).'/migrations/' => database_path('migrations'),
        ], 'migrations');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(\dirname(__DIR__).'/migrations/');
        }
    }

    public function register()
    {
        Route::group([
            'prefix' => 'redius',
            'namespace' => 'Redius\Controllers',
            'as' => 'redius.',
        ], function () {
            Route::get('{resource}', ListResources::class)->name('list.resources');
            Route::post('{resource}', CreateResource::class)->name('create.resource');
            Route::get('{resource}/{resourceId}', GetResource::class)->name('get.resource');
            Route::patch('{resource}/{resourceId}', UpdateResource::class)->name('update.resource');
            Route::delete('{resource}/{resourceId}', DeleteResource::class)->name('delete.resource');
            Route::get('{resource}/fields', ListFields::class)->name('list.resource.fields');
            Route::get('{resource}/filters', ListFilters::class)->name('list.resource.filters');
            Route::get('{resource}/views', ListViews::class)->name('list.resource.views');
            Route::get('{resource}/actions', ListActions::class)->name('list.resource.actions');
        });
    }
}
