<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DatabaseConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $result= \DB::select('select version() as version')[0];
        // $this->app['config']->put('database.connections.mysql.version', $result->version);
    }
}
