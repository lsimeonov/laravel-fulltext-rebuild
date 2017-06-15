<?php


namespace Ucaka\FullTextRebuild\Providers;


use Illuminate\Support\ServiceProvider;

class FullTextRebuildProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $this->commands([\Ucaka\FullTextRebuild\Console\Commands\FullTextRebuild::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}