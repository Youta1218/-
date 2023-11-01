<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use DB;
use Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        DB::beforeExecuting(function ($query) {
            if (Str::startsWith($query, ['insert', 'update'])) {
                return Str::replaceArray('?', ['\\N'], $query);
            }
            return $query; 
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      \URL::forceScheme('https');  //
      $this->app['request']->server->set('HTTPS','on');
      
    //   Paginator::useBootstrap();
    }
}
