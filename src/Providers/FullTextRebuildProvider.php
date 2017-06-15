<?php


namespace Ucaka\FullTextRebuild\Providers;


use Illuminate\Support\ServiceProvider;
use Ucaka\FulltextRebuild\Console\Commands\FullTextRebuild;

class FullTextRebuildProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $this->commands([FullTextRebuild::class]);
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